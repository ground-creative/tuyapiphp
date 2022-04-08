<?php

	require( 'config.php' );
	
	$app_id = 'xxxxxxxxxxxxxxxxxxxx';
	
	$device_id = 'xxxxxxxxxxxxxxxxxxx';
	
	$tuya = new \tuyapiphp\TuyaApi( $config );
	
	// Get a token
	$token = $tuya->token->get_new( )->result->access_token;
	
	// Get list of devices connected with android app
	$tuya->devices( $token )->get_app_list( $app_id );
	
	// Get device status
	$tuya->devices( $token )->get_status( $device_id );

	// Set device name
	$tuya->devices( $token )->put_name( $device_id , [ 'name' => 'FAN' ] );
	
	// Send command to device
	$payload = [ 'code' => 'switch_1' , 'value' => false ];
	$tuya->devices( $token )->post_commands( $device_id , [ 'commands' => [ $payload ] ] );