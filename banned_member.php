<?php  
include('protect.php');
require_once('sys_dbconnection.php');
/*include('../dbconnectadmin.php');*/
  $strmid=$_GET['matriid'];  
$sql=mysqli_query($con,"update register set Status='Banned' where MatriID='$strmid'");
header("location:profile_view?flag=13&msg=success&ID=$strmid ");
 ?>