<?php
	require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
	$matriID = $_GET['ID'];
	mysqli_query($con,"UPDATE register SET auto_approve='1' where MatriID='$matriID'");
	header("Location: profile_view?msg=success&flag=24&ID=$matriID");

?>