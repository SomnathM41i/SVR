<?php //error_reporting(0);

 
$_SESSION['url']=$_SERVER['REQUEST_URI'];
if(empty($_SESSION['MatriID'])) 
 {
	header('location:index');
	exit;
} 

?>