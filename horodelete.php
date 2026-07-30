<?php /*include('dbconnectadmin.php');*/
require_once('sys_dbconnection.php');
$id=$_GET['id'];
mysqli_query($con,"update register set horoscope='' where MatriID='$id'");
header('location:horoscope.php'); ?>