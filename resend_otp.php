<?php  session_start(); 
include('siteconfig.php');

$msg="";
$matriid=$_SESSION['tempid'];
include('asysendotp.php');

?>
