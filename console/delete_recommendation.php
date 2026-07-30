<?php require_once('../sys_dbconnection.php');
	$MatriID = $_REQUEST['matriid'];
	$id = $_REQUEST['id'];
	
	mysqli_query($con,"DELETE FROM `recommendation` WHERE `id` = '$id'");
	header("location:view_recommendation?msg=delete&id=".$MatriID);
	exit;

?>