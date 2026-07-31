<?php  require_once('../sys_dbconnection.php');
/*include('../dbconnectadmin.php');*/
$id=$_GET['ID'];
mysqli_query($con,"delete from deleted_profile where MatriID='$id'");
//echo "delete from deleted_profile where MatriID='$id'";
//exit;
header("location:delete_profiles.php"); ?>