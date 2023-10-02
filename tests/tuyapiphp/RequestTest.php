<?php

	namespace tuyapiphp;

	use PHPUnit\Framework\TestCase;

	final class RequestTest extends TestCase
	{
		/**
		* @Depends TokenTest::testGetNewToken
		*/
		public function testGetCall()
		{
			$request = TokenTest::$_tuya->devices(TokenTest::$_access_token)->get_app_list($GLOBALS['TUYA_APP_ID']);
			$this->assertTrue($request->success);
		}
		/**
		* @Depends TokenTest::testGetNewToken
		*/
		public function testGetCallWithParams()
		{
			$request = TokenTest::$_tuya->devices(TokenTest::$_access_token)->get_logs($GLOBALS['TUYA_DEVICE_ID'], ["type" => "1,2" ,"start_time" => 1677340155, "end_time" => 1677599355]);
			$this->assertTrue($request->success);
		}
		/**
		* @Depends TokenTest::testGetNewToken
		*/
		public function testPostCall()
		{
			$payload = ['code' => 'switch_1' , 'value' => false];
			$request = TokenTest::$_tuya->devices(TokenTest::$_access_token)->post_commands($GLOBALS['TUYA_DEVICE_ID'], ['commands' => [$payload]]);
			$this->assertTrue($request->success);
		}
		/**
		* @Depends TokenTest::testGetNewToken
		*/
		public function testPutCall()
		{
			$request = TokenTest::$_tuya->devices(TokenTest::$_access_token)->put_name($GLOBALS['TUYA_DEVICE_ID'], ['name' => 'FAN']);
			$this->assertTrue($request->success);
		}
	}