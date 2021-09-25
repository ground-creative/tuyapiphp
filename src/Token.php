<?php

	namespace tuyapiphp;

	Class Token
	{
		public function __construct( $config )
		{
			$this->_config = $config;
		}
		
		public function __call( $name , $args = [ ] )
		{
			$request = new Caller( $this->_config , $this->_endpoints , $this->_token );
			return $request->send( $name , $args );
		}
		
		protected $_token = '';

		protected $_endpoints = 
		[
			'get_new'		=> '/v1.0/token?grant_type=1' ,
			'get_refresh'	=> '/v1.0/token/{refresh_token}'
		];
	}