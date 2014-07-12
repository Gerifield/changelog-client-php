<?php

include "ccphp/ccphp.php";

$client = new Ccphp("http://80.240.138.19/api/events");

//Set all params
$client->send(array("description" => "hello", "criticality" => 5, "category" => "info"));


//Set message only
$client->send(array("description" => "hello only"));


//Set the default values or a single value
$client->set_defaults(array("criticality" => 3));


//Send a single message but with criticality 3
$client->send(array("description" => "hello crit 3"));



//Set HTTP authentication
$this->set_auth("username", "password");
$this->send_msg("Simple message without array");

?>