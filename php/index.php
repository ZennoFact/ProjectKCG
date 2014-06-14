<?php
session_start();
>
<html>
<body>
<?php
// ※「アクセストークン取得までの流れ」での解説を参照
$client_id = '...'; // 【client_id】
$client_secret = '...'; // 【client_secret】
$redirect_uri = '...'; // 【redirect_uri】

$code = $_REQUEST['code'];
$error = $_REQUEST['error'];
$error_reason = $_REQUEST['error_reason'];
$error_description = $_REQUEST['error_description'];

if (empty($code) && empty($error)) {

    // Facebook認証後のリダイレクトによるアクセスではない場合
    // （= GETパラメータに "code" または "error" がない場合）
    
    // CSRF protection
    $_SESSION['state'] = md5(uniqid(rand(), TRUE));
        
    // Facebook認証に遷移
    // 例；
    // Facebook未ログインの場合 → Facebookログイン画面を表示
    // Facebookログイン済 + アプリを許可済の場合
    // → "redirect_uri" に指定したURLに、GETパラメータ "code" 付きで
    // リダイレクトされる
    header('Location: https://graph.facebook.com/oauth/authorize'
                   . '?client_id=' . $client_id
                   . '&redirect_uri=' . urlencode($redirect_uri)
                   . '&scope=publish_stream,read_stream'
                   . '&display=popup'
                   . '&state=' . $_SESSION['state']);
} else {
    
    // Facebook認証後のリダイレクトによるアクセスの場合
    
    if (!empty($code)) {
        
        // Facebook認証成功の場合
        
        // "redirect_uri" に指定したURLに、
        // GETパラメータ "code" が付加されてリダイレクトされる
        if($_REQUEST['state'] == $_SESSION['state']) { // CSRF protection
            
            // アクセストークン取得用のURL生成
            $token_url = 'https://graph.facebook.com/oauth/access_token' 
                       . '?client_id=' . $client_id
                       . '&redirect_uri=' . urlencode($redirect_uri) 
                       . '&client_secret=' . $client_secret 
                       . '&code=' . $code;
            
            // アクセストークン取得
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $token_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $token = curl_exec($ch);
            
            // アクセストークンを表示
            echo $token;
        }
        
    } else if (!empty($error)) {
        
        // アクセス拒否の場合
        
        // Facebookアプリのインストール / 権限許可の画面で
        // "キャンセル" ボタンを押す等した場合、
        // "redirect_uri" に指定したURLにGETパラメータ 
        // "error" "error_reason" "error_description"
        // が付加されてリダイレクトされる
        echo 'error:' . $error 
          . '/error_reason:' . $error_reason 
          . '/error_description:' . $error_description;
    }
}

?>



?>
</body>
<html>