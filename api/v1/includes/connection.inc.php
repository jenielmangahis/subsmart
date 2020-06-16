<?php
	include_once("database.class.php");

	$server 	= "gator4155.hostgator.com";
	$database 	= "admintom_nsmart_companies";
	$user 		= "admintom_admin";
	$password 	= "SmarTrac1$!";


	global $db_object;

	$db_object = new database_handler();
	$db_connect = $db_object->connect($server, $database, $user, $password);
?>
