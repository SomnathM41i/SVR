<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
	$MatriID = $_REQUEST['matriid'];
	$id = $_REQUEST['id'];
	
	mysqli_query($con,"DELETE FROM `recommendation` WHERE `id` = '$id'");
	header("location:view_recommendation?msg=delete&id=".$MatriID);
	exit;

?>