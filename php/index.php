<?php
	$client_id = '591353344312115';
	$redirect_uri = 'http://zeglass.cloudapp.net/php/';

	header('Location: https//graph.facebook.com/oauth/authorize'
		. '?client_id' . $client_id
		. '&redirect_uri' . urlencode($redirect_uri));
	
?>
