<?php  session_start(); 
include('siteconfig.php');
/*$_SESSION['otp']=rand(111111,999999);
$_SESSION['otp1']=$_SESSION['otp'];*/
$msg="";
$matriid=$_SESSION['tempid'];
include('asysendotp.php');
/*header('location:verify_otp.php');*/
?>
