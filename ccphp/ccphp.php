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

	/**
	 * Constructor.
	 *
	 * Sets the server address for the queries
	 * 
	 * @param $url Server URL with http prefix and /api/events postix. For example: http://<server_url_here>/api/events
	 * 
	 */
	public function __construct($url){
		$this->server = $url;
	}

	/**
	 * Default value changer.
	 *
	 * This function sets the default request values for all the other requests after this.
	 * 
	 * @param array $params Parameter array.
	 *     Possible keys could be:
	 *         * description 	- Description/message
	 *         * criticality 	- Error/event level
	 *         * category 		- Error/event category
	 *         
	 */
	public function set_defaults($params = array()){
		$this->default_params = array_merge($this->default_params, $params);
	}

	/**
	 * HTTP authtentication configuration.
	 * 
	 * @param string $user HTTP auth user
	 * @param string $pass HTTP auth pass
	 * 
	 */
	public function set_auth($user = "", $pass = ""){
		$this->http_auth_user = $user;
		$this->http_auth_pass = $pass;
	}

	/**
	 * Send a simple message.
	 *
	 * This function uses the ``send`` command and only sets the ``description`` value in the request array
	 * 
	 * @param  [type] $msg Message/description to send
	 * 
	 */
	public function send_msg($msg){
		$this->send(array("description" => $msg));
	}


	/**
	 * Send a message to the changelog server.
	 *
	 * 
	 * @param  array  $params Parameter array
	 *     Possible keys could be:
	 *         * description 	- Description/message
	 *         * criticality 	- Error/event level
	 *         * category 		- Error/event category
	 * 
	 */
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