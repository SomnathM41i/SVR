<?php
	//error_reporting(E_ALL);
	/*function is_session_started()
	{
	    if ( php_sapi_name() !== 'cli' ) {
	        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	        } else {
	            return session_id() === '' ? FALSE : TRUE;
	        }
	    }
	    return FALSE;
	}

	if ( is_session_started() === FALSE ) session_start();*/
	 
	error_reporting(E_ERROR);
	if (!isset($_SESSION)) { session_start(); }
	
	ob_start();
	$DB ["host"] = "82.25.121.160";
	$DB ["dbName"] = "u320743426_MJ";
	$DB ["user"] = "u320743426_MJ";
	$DB ["pass"] = "&fw0f=HBv6";
	$con=new mysqli($DB["host"],$DB["user"],$DB["pass"],$DB["dbName"]);
		
?>