<?php

class Ccphp{

	//server URL
	private $server;
	//default parameters
	private $default_params = array(
		"description" => "",
		"criticality" => 1,
		"category" => "misc");

	//HTTP authentication data
	private $http_auth_user;
	private $http_auth_pass;

	public function __construct($url){
		$this->server = $url;
	}

	public function set_defaults($params = array()){
		$this->default_params = array_merge($this->default_params, $params);
	}

	public function set_auth($user = "", $pass = ""){
		$this->http_auth_user = $user;
		$this->http_auth_pass = $pass;
	}

	public function send($params = array()){

		$data = array_merge(
			$this->default_params,
			array("unix_timestamp" => time()), //add the timestamp too
			$params);


		$ch = curl_init($this->server);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		if(!empty($this->http_auth_user)){
			curl_setopt($ch, CURLOPT_USERPWD, $this->http_auth_user.":".$this->http_auth_pass);
		}
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);
	}
}