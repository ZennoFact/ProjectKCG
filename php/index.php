<?php
	require_once("../facebook/facebook.php");
	$config = array(
		'appId' => '591353344312115',
		'secret' => '349bbad20cf514f2f0c1a4df69d17be4'
	);

	$facebook _ new Facebook($config);

	$loginUrl = $facebook->getLoginUrl();
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
?>