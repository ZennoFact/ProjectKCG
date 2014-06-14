<html>
<body>
<?php
require_once('php-sdk/facebook.php');
$config = array(
	'appId'  => '591353344312115',
	'secret' => '349bbad20cf514f2f0c1a4df69d17be4'
);

$redirect_uri = 'http://zeglass.cloudapp.net/php/'; 

$facebook = new Facebook($config);
 
	//ログイン済みの場合はユーザー情報を取得
	if ($facebook->getUser()) {
		try {
			$userId = $facebook->getUser();
			$user = $facebook->api('/me','GET');
		} catch(FacebookApiException $e) {
			error_log($e->getType());
			error_log($e->getMessage());
		}
	}
}

?>

<html>
	<body>
	<?php
		if (isset($user)) {
			//ログイン済みでユーザー情報が取れていれば表示
			echo '<pre>';
			echo　$user;
			echo　$userId;
			echo '</pre>';
		} else {
			//未ログインならログイン URL を取得してリンクを出力
			$loginUrl = $facebook->getLoginUrl();
			echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
		}
	?>
	</body>
</html>