<?php

	namespace tuyapiphp;

	Class Scenes
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
			"get_list"					=>"/v1.0/homes/{home_id}/scenes" ,
			"get_default_pictures"		=>"/v1.0/scenes/default-pictures" ,
			"get_device_support"		=>"/v1.0/homes/{home_id}/scene/devices" ,
			"get_device_bound"		=>"/v1.0/devices/{device_id}/scenes" ,
			"get_automations"			=>"/v1.0/homes/{home_id}/automations" ,
			"get_automation"			=>"/v1.0/homes/{home_id}/automations/{automation_id}" ,
			"get_device_automation"	=>"/v1.0/homes/{home_id}/automation/devices" , 
			"get_weather"			=>"/v1.0/homes/automation/weather/conditions" ,
			"get_supported_actions"	=>"/v1.0/homes/{home_id}/enable-linkage/codes" , 
			"post_trigger"				=>"/v1.0/homes/{home_id}/scenes/{scene_id}/trigger" ,
			"post_add"				=>"/v1.0/homes/{home_id}/scenes" ,
			"post_bind"				=>"/v1.0/devices/{device_id}/scenes/{scene_id}" ,
			"post_automation"			=>"/v1.0/homes/{home_id}/automations" ,
			"delete_scene"			=>"/v1.0/homes/{home_id}/scenes/{scene_id}" ,
			"delete_ubind"			=>"/v1.0/devices/{device_id}/scenes/{scene_id}" ,
			"delete_automation"		=>"/v1.0/homes/{home_id}/automations/{automation_id}" ,
			"put_modify"				=>"/v1.0/homes/{home_id}/scenes/{scene_id}" ,
			"put_modify_automation"	=>"/v1.0/homes/{home_id}/automations/{automation_id}" ,
			"put_enable_automation"	=>"/v1.0/homes/{home_id}/automations/{automation_id}/actions/enable" ,
			"put_disable_automation"	=>"/v1.0/homes/{home_id}/automations/{automation_id}/actions/disable"
		];
	}