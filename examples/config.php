<?php
/*
China Data Center	https://openapi.tuyacn.com
Western America Data Center	https://openapi.tuyaus.com
Eastern America Data Center	https://openapi-ueaz.tuyaus.com
Central Europe Data Center	https://openapi.tuyaeu.com
Western Europe Data Center	https://openapi-weaz.tuyaeu.com
India Data Center	https://openapi.tuyain.com
*/
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
