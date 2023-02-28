<?php

	namespace tuyapiphp;

	Class Devices
	{
		public function __construct( $config , $token )
		{
			$this->_config = $config;
			$this->_token = $token;
		}
		
		public function __call( $name , $args = [ ] )
		{
			$request = new Caller( $this->_config , $this->_endpoints , $this->_token );
			return $request->send( $name , $args );
		}

		protected $_token = '';
		
		protected $_endpoints = 
		[
			'get_app_list'			=>	'/v1.0/users/{appId}/devices' ,
			'get_list'				=>	'/v1.0/devices' ,
			'get_user_list'			=>	'/v1.0/users/{uid}/devices' ,
			'get_details'			=>	'/v1.0/devices/{device_id}' ,
			'get_logs'				=>	'/v1.0/devices/{device_id}/logs' ,
			'get_subdevices'		=>	'/v1.0/devices/{deviceId}/sub-devices' ,
			'get_factory_info'		=>	'/v1.0/devices/factory-infos' ,
			'get_user'				=>	'/v1.0/devices/{device_id}/users/{user_id}' ,
			'get_users'			=>	'/v1.0/devices/{device_id}/users' ,
			'get_category'			=>	'/v1.0/functions/{category}' ,
			'get_functions'			=>	'/v1.0/devices/{device_id}/functions' ,
			'get_specifications'		=>	'/v1.0/devices/{device_id}/specifications' ,
			'get_status'			=>	'/v1.0/devices/{device_id}/status' ,
			'get_multiple_names'	=>	'/v1.0/devices/{device_id}/multiple-names' ,
			'get_groups'			=>	'/v1.0/device-groups' ,
			'get_group'			=>	'/v1.0/device-groups/{group_id}' ,
			'get_user_groups'		=>	'/v1.0/users/{uid}/device-groups' ,
			'put_function_code'		=>	'/v1.0/devices/{device_id}/functions/{function_code}' ,
			'put_reset_factory'		=>	'/v1.0/devices/{device_id}/reset-factory' ,
			'put_name'			=>	'/v1.0/devices/{device_id}' ,
			'put_user'				=>	'/v1.0/devices/{device_id}/users/{user_id}' ,
			'put_multiple_names'	=>	'/v1.0/devices/{device_id}/multiple-name' ,
			'put_group'			=>	'/v1.0/device-groups/{group_id}' ,
			'post_commands'		=>	'/v1.0/devices/{device_id}/commands' ,
			'post_user'			=>	'/v1.0/devices/{device_id}/user' ,
			'post_group'			=>	'/v1.0/device-groups' ,
			'post_group_issued'		=>	'/v1.0/device-groups/{device_group_id}/issued' ,
			'post_stream_allocate'	=>	'/v1.0/users/{uid}/devices/{device_id}/stream/actions/allocate' ,
			'delete_device'			=>	'/v1.0/devices/{device_id}' ,
			'delete_user'			=>	'/v1.0/devices/{device_id}/users/{user_id}' ,
			'delete_group'			=>	'/v1.0/device-groups/{group_id}'
		];
	}