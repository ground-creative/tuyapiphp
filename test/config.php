<?php

	$config =
	[
		"secretKey" => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" ,
		"accessKey" => "xxxxxxxxxxxxxxxxxxxxxxx" ,
		'baseUrl'		=> 'https://openapi.tuyaus.com' ,
		'debug'		=> true
	];
	
	require( '../src/TuyaApi.php' );
	require( '../src/DebugHandler.php' );
	require( '../src/Caller.php' );
	require( '../src/Request.php' );
	require( '../src/Scenes.php' );
	require( '../src/Token.php' );
	require( '../src/Devices.php' );