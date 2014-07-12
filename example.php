<?php

include "ccphp/ccphp.php";

$client = new Ccphp("http://<server_url_here>/api/events");

//Set all params
$client->send(array("description" => "hello", "criticality" => 5, "category" => "info"));


//Set a message only
$client->send(array("description" => "hello only"));


//Set the default values or a single value
//Every other requests after this would use these options
$client->set_defaults(array("criticality" => 3));


//Send a single message but with criticality 3
$client->send(array("description" => "hello crit 3"));



//Set HTTP authentication
$client->set_auth("username", "password");
$client->send_msg("Simple message without array");

?>