<?php
require 'facebook/facebook.php';

$config = array(
        'appId'=>'591353344312115',
        'secret'=>'349bbad20cf514f2f0c1a4df69d17be4'
        );

$facebook = new Facebook( $config );

$user = $facebook->getUser();
if( ! $user )
{
    // Login
    $loginUrl = $facebook->getLoginUrl();
    echo "<a href='{$loginUrl}'>Login</a>";
}
else
{
    try
    {
        $userProfile = $facebook->api( '/me' );
        echo( 'Hello '.$userProfile[ 'name' ] );
    }
    catch( FacebookApiException $e )
    {
        error_log( $e );
    }

    // Logout
    $logoutUrl = $facebook->getLogoutUrl();
    echo "<a href='{$logoutUrl}'>Logout</a>";
}

?>