<?php
	//error_reporting(E_ALL);
	
	 
	error_reporting(E_ERROR);
	if (!isset($_SESSION)) { session_start(); }
	
	ob_start();
	$DB ["host"] = "localhost";
	$DB ["dbName"] = "tathastu.in.net";
	$DB ["user"] = "root";
	$DB ["pass"] = "";
	$con=new mysqli($DB["host"],$DB["user"],$DB["pass"],$DB["dbName"]);
		
?>