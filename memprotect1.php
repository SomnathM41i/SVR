<?php //error_reporting(0);
/*ini_set('display_errors', 0);
session_start();*/
 
$_SESSION['url']=$_SERVER['REQUEST_URI'];
if(empty($_SESSION['MatriID'])) 
 {
	header('location:index');
	exit;
} 

?>