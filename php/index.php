<?php
	session_start();
>
<html>
<body>
<?php
	require_once("../facebook/facebook.php");
	$appdata = array(
		'appId' => '591353344312115',
		'secret' => '349bbad20cf514f2f0c1a4df69d17be4'
	);
	$facebook = new Facebook($appdata);
	$loginUrl = $facebook->getLoginUrl();
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
	$userId = $facebook->getLoginUrl();

	cho $userId;

	$code = $_REQUEST('code');
	$redirect_uri = 'http://zeglass.cloudapp.net/php/';
	$token_url = 'https://graph.facebook.com/oauth/access_token'
					. '?client_id=' . $userId
					. '&redirect_uri=' . urlencode($redirect_uri)
					. '&client_secret=' . $appdata['secret'];
					. '&code=' . $code;
	// アクセストークン取得
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $token_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$token = curl_exec($ch);

	echo $token;


?>
</body>
<html>