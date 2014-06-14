<?php
	require_once("../facebook/facebook.php");
	$appdata = array(
		'appId' => '591353344312115',
		'secret' => '349bbad20cf514f2f0c1a4df69d17be4'
	);
	var_dump($appdata);
	$facebook _ new Facebook($appdata);

	var_dump($appdata);
	$loginUrl = $facebook->getLoginUrl();
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
?>