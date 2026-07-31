<?php require_once('../sys_dbconnection.php');  
	$id=$_GET['matriid'];
	
	include('protect.php');
	mysqli_query($con,"update register set HorosApprove='Yes' where MatriID='".$_GET['matriid']."'");
	header("location:horoscope_approval?ID=$id&msg=success"); 
?>