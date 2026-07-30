<?php require_once('../sys_dbconnection.php');   
$id=$_GET['docid'];
$MatriID=$_GET['MatriID'];

/*include('../dbconnectadmin.php');*/
include('protect.php');

mysqli_query($con,"DELETE FROM document WHERE doc_id ='$id'");
//echo " DELETE FROM document WHERE doc_id ='$id' ";
mysqli_query($con,"UPDATE register SET docapprove='Rejected' WHERE MatriID='$MatriID' ");

//echo "DELETE FROM document WHERE doc_id ='$id'";
header("location:document_approval?msg=delete"); 
?>