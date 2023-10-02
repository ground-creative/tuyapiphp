<?php

	namespace tuyapiphp;

	Class DebugHandler
	{
		public function __construct($config)
		{
			$this->_config = $config;
		}
	
		public function output($msg, $data = null)
		{
			if (@$this->_config['debug'] != true){ return; }
			if ($data)
			{
				echo $msg;
				echo "<pre>" . print_r($data, true) . "</pre>";
				return;
			}
			echo $msg . "<br>\n";
		}
	}