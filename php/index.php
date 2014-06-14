<?php
session_start();
>
<html>
<body>
<?php
$client_secret = '349bbad20cf514f2f0c1a4df69d17be4'; 
$redirect_uri = 'http://zeglass.cloudapp.net/php/'; 

$code = $_REQUEST['code'];
$error = $_REQUEST['error'];
$error_reason = $_REQUEST['error_reason'];
$error_description = $_REQUEST['error_description'];

if (empty($code) && empty($error)) {
    $_SESSION['state'] = md5(uniqid(rand(), TRUE));
        
    header('Location: https://graph.facebook.com/oauth/authorize'
                   . '?client_id=' . $client_id
                   . '&redirect_uri=' . urlencode($redirect_uri)
                   . '&scope=publish_stream,read_stream'
                   . '&display=popup'
                   . '&state=' . $_SESSION['state']);
} else {
    if (!empty($code)) {
        if($_REQUEST['state'] == $_SESSION['state']) { 
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