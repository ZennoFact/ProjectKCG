<?php
	session_start();

	$client_id = '591353344312115';
	$client_secret = '349bbad20cf514f2f0c1a4df69d17be4';
	$redirect_uri = 'http://zeglass.cloudapp.net/php/';

	$code = $_REQUEST['code'];
	$error = $_REQUEST['error'];
	$error_reason = $_REQUEST['error_reason'];
	$error_description = $_REQUEST['error_description'];
	
	if (empty($code) && empty(error)) {
		$_SESSION['state'] = md5(uniqid(rand(), TRUE));

		header('Location: https//graph.facebook.com/oauth/authorize'
			. '?client_id' . $client_id
			. '&redirect_uri' . urlencode($redirect_uri));
			. '&scope=publish_stream,read_stream'
			. '&display=popup'
			. '&state=' . $_SESSION['state']);
	}
	else {
		if (!empty($code)) {
			if($_REQUEST['state'] == $_SESSION['state']){
				$token_url = 'https//graph.facebook.com/oauth/authorize'
				. '?client_id' . $client_id
				. '&redirect_uri' . urlencode($redirect_uri));
				. '&scope=publish_stream,read_stream'
				. '&display=popup'
				. '&state=' . $_SESSION['state']);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $token_url);
				curl_setopt($ch, CURLOPT_RETURHTRANSFER, true);
				$token =cutl_exec($ch);

				echo $token;
			}
		} else if(!empty($error)) {
			echo "error:" . $error;
					. '/error_reason:' . $error_reason;
					.'error_description: . $error_description;
		}
	}

?>	