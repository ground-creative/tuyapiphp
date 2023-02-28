<?php

	namespace tuyapiphp;

	use PHPUnit\Framework\TestCase;

	final class TokenTest extends TestCase
	{
		public static function setUpBeforeClass( ) : void
		{
			$config =
			[
				'accessKey' 	=> $GLOBALS['TUYA_ACCESS_KEY'],
				'secretKey' 	=> $GLOBALS['TUYA_SECRET_KEY'],
				'baseUrl'		=> $GLOBALS['TUYA_BASE_URL'],
			];
			static::$_tuya = new \tuyapiphp\TuyaApi($config);
		}
	 
		public function testGetNewToken()
		{
			$request = static::$_tuya->token->get_new();
			$this->assertTrue($request->success);
			static::$_access_token = $request->result->access_token;
			static::$_refresh_token = $request->result->refresh_token;
		}
		/**
		* @depends testGetNewToken
		*/
		public function testGetRefreshToken()
		{
			$request = static::$_tuya->token->get_refresh(static::$_refresh_token);
			$this->assertTrue($request->success);
			static::$_access_token = $request->result->access_token;
		}
		
		public static $_tuya = "";
		
		public static $_access_token = "";
		
		public static $_refresh_token = "";
	}