<?php

	namespace tuyapiphp;

	Class Request
	{
		public function __construct($config, $endpoint, $request, $token = null, $payload = null, $sigHeaders = null)
		{
			$this->_config = $config;
			$this->_time = round(microtime(true) * 1000);
			$this->_endpoint = $endpoint;
			$this->_request = strtoupper($request);
			$this->_token = ($token) ? $token : '';
			$this->_sigHeaders = $sigHeaders; // todo
			$this->_payload = $this->_setPayload($payload);
			$this->_body = ($payload && $this->_request != 'GET') ? json_encode($payload) : '';
			$string = [strtoupper($request), hash('sha256' , $this->_body), '', $this->_endpoint];
			$stringtosign = implode("\n", $string);
			$sign = $this->_sign($this->_time, $stringtosign);
			$this->_headers = $this->_headers($sign);
			$this->_debug = new DebugHandler($this->_config);
		}
		
		protected function _setPayload($payload)
		{
			if (!$payload){ return ''; }
			if ($this->_request == 'POST' ||  $this->_request == 'PUT')
			{
				return json_encode($payload);
			}
			else
			{
				ksort($payload);
				/*$paramsJoined = [];
				foreach($payload as $param => $value) 
				{
					$paramsJoined[] = "$param=$value";
				}
				$payload = implode('&', $paramsJoined);*/
				$payload = http_build_query($payload);
				$payload = str_replace("%2C", ",", $payload);	// fix comma url encoding
				$this->_endpoint = $this->_endpoint . ((preg_match('#\?#', 
									$this->_endpoint)) ? '&' . $payload : '?' . $payload);	
				return '';
			}
		}
		
		public function call()
		{
			$this->_debug->output($this->_request . ' ' . $this->_config[ 'baseUrl' ] . $this->_endpoint);
			$this->_debug->output('Headers:' , $this->_headers);
			if ($this->_body)
			{
				$this->_debug->output('Payload:', json_decode( 
							$this->_body , $this->_config['associative']));
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL , $this->_config['baseUrl'] . $this->_endpoint);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_headers);
			//curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->_request); 
			if ($this->_request == 'POST' || $this->_request == 'PUT')
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_body);
			}
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, $this->_config['curl_http_version']);
			$result = curl_exec($ch);
			if (curl_errno($ch))
			{ 
				$this->_debug->output('Curl error:', curl_error($ch));
			}
			$return = json_decode($result, $this->_config['associative']);
			$this->_debug->output('Result:', $return);
			return $return;
		}
		
		protected function _sign($time, $stringToSign)
		{
			$sign = strtoupper(hash_hmac('sha256', $this->_config['accessKey'] . 
					$this->_token . $time . $stringToSign , $this->_config['secretKey']));
			return $sign;
		}	

		protected function _headers($sign)
		{
			$headers = 
			[
				'Accept: application/json, text/plan, */*' ,
				't: ' . $this->_time ,
				'sign_method: HMAC-SHA256' ,
				'client_id: ' . $this->_config[ 'accessKey' ] ,
				'sign: ' . $sign ,
				'User-Agent: tuyapiphp' ,
				'Signature-Headers: ' // todo
			];
			if ($this->_request == 'POST' || $this->_request == 'PUT')
			{
				$headers[] = 'Content-Type: application/json';	
			}
			if ($this->_token)
			{
				$headers[] = 'access_token: ' . $this->_token;	
			}
			return $headers;
		}
		
		protected $_config = [];
		
		protected $_time = '';
		
		protected $_endpoint = '';
		
		protected $_headers = '';
		
		protected $_request = '';
		
		protected $_token = '';
		
		protected $_body = '';
		
		protected $_payload = '';
		
		protected $_sigHeaders = '';
	}