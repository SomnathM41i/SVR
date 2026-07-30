<?php require_once('../sys_dbconnection.php');   
     //$id=$_GET['matriid'];
	$MatriID = $_GET['MatriID']; 
	/*include('../dbconnectadmin.php');*/
	include('protect.php');
	mysqli_query($con,"update document set docapprove='Yes' where doc_id='".$_GET['docid']."'");
	mysqli_query($con,"UPDATE register SET docapprove='Yes' WHERE MatriID='$MatriID'");
	
	header("location:document_approval?ID=$id&msg=success"); 
?>