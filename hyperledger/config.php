<?php
	session_start();
	$config_server = "localhost";
	$config_username = "root";
	$config_password = "";
	$config_dbname = "hyperlederpoc";


	// Create connection
	$config_dbconn = new mysqli($config_server, $config_username, $config_password, $config_dbname);

	// Check connection
	if ($config_dbconn->connect_error) 
	die("Connection failed: " . $config_dbconn->connect_error);
	//else
	 	//echo 'DB connected';

	$config_base_url = "http://192.168.1.13/hyperleder";
	$hyperledger_base_url = "http://192.168.1.15:3000/api/";
	$config_namespace = "org.twex.poc";
	error_reporting(0);
?>
