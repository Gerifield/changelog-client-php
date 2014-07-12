CCPHP: Changelog Client PHP
====================

PHP client for http://github.com/prezi/changelog

Requirements
============

* PHP cURL extension


Example
===========

	include "ccphp/ccphp.php";

	$client = new Ccphp("http://server_url.com/api/events");
	$client->send(array("description" => "This is a simple message"));

For more examples check the ``example.php``!