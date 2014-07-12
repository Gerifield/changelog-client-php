CCPHP: Changelog Client PHP
====================

PHP client for http://github.com/prezi/changelog

Example
===========

	include "ccphp/ccphp.php";

	$client = new Ccphp("http://server_url.com");
	$client->send(array("message" => "This is a simple message"));