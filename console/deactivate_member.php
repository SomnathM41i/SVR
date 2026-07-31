<?php require_once('../includes/bootstrap.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/
  $strmid=$_GET['matriid'];  
$sql=mysqli_query($con,"update register set Status='Banned',deletestatus='1' where MatriID='$strmid'");

$sqlexp=$con->query("update expressinterest set banstatus='1' where eireceiver='$strmid' or eisender='$strmid'");

$sqlview=$con->query("update profile_views set banstatus='1' where whom='$strmid' or who='$strmid'");

$sqlshortlist=$con->query("update shortlist_profile set banstatus='1' where mat_id='$strmid' or profile_id='$strmid'");

$sqlviewadd=$con->query("update viewedaddress set banstatus='1' where who1='$strmid' or whom1='$strmid'");

$sqlignore=$con->query("update `ignore` set banstatus='1' where matriid='$strmid' or profile_id='$strmid'");

$sqlblock=$con->query("update `block_member` set banstatus='1' where matriid='$strmid' or profile_id='$strmid'");

$sqlreceivemessage=$con->query("update `receivemessage` set banstatus='1' where ToID='$strmid' or FromID='$strmid'");

header("location:profile_view?flag=25&msg=success&ID=$strmid ");
 ?>