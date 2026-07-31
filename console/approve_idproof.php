<?php require_once('../includes/bootstrap.php'); 
	$id=$_GET['matriid'];
	
	include('protect.php');
	mysqli_query($con,"update register set idproof_approve='Yes' where MatriID='".$_GET['matriid']."'");
	header("location:id_proof_approval?ID=$id&msg=success"); 
?>