<?php

	namespace tuyapiphp;

	Class TuyaApi
	{
		public function __construct( $config )
		{
			$this->_checkConfig( $config );
			$this->_config = array_merge( $this->_config , $config );
		}
		
		public function devices( $token )
		{
			return new Devices( $this->_config , $token );
		}
		
		public function token( )
		{
			return new Token( $this->_config );
		}

		public function __get( $name )
		{
			return $this->$name( );
		}
		
		protected function _checkConfig( $config )
		{
			try 
			{
				if ( count( array_intersect_key( array_flip( $this->_required ) , 
									$config ) ) !== count( $this->_required ) ) 
				{
					$msg = "Please set 'accessKey', 'secretKey' and 'baseUrl', aborting!";
					throw new \Exception( $msg );
				}
			} 
			catch( \Exception $e ) 
			{
				echo $e->getMessage( );
				die( );
			}
		}
		
		protected $_config = 
		[
			'accessKey' 	=> '' ,
			'secretKey' 	=> '' ,
			'baseUrl'		=> '' ,
			'debug'		=> false ,
			'associative'	=> false
		];
		
		protected $_required = [ 'accessKey' , 'secretKey' , 'baseUrl' ];
	}	