<?php

class Ccphp{

	//server URL
	private $server;
	//default parameters
	private $default_params = array(
		"description" => "",
		"criticality" => 1,
		"category" => "misc");

	public function __construct($url){
		$this->server = $url;
	}

	public function set_defaults($params = array()){
		$this->default_params = array_merge($this->default_params, $params);
	}


	public function send($params = array()){

		$data = array_merge(
			$this->default_params,
			array("unix_timestamp" => time()), //add the timestamp too
			$params);


		$ch = curl_init($this->server);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);
	}
}