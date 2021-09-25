<?php

	require __DIR__ . '/vendor/autoload.php';

	require( 'config.php' );
	
	$tuya = new \tuyapiphp\TuyaApi( $config );

	$data = $tuya->token->get_new( );
	
	$data = $tuya->token->get_refresh( $data->result->refresh_token );