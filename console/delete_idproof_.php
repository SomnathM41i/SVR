<?php require_once('../sys_dbconnection.php');  
$id=$_GET['matriid'];
/*include('../dbconnectadmin.php');*/
include('protect.php');
mysqli_query($con,"update register set idproof_approve='No',adhar='' where MatriID='".$_GET['matriid']."'");
header("location:id_proof_approval?ID=$id&msg=delete"); ?>