<?php require_once('../includes/bootstrap.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/
$strmid=$_GET['matriid'];  
  $strmid=$_GET['matriid']; 
  $date = date('Y-m-d'); 
  $sql=$con->query("select * from register where MatriID='$strmid'");
  $row=$sql->fetch_array(); 
  $memtype=$row['memtype'];
  $Status=$row['Status'];
  $MemshipExpiryDate=$row['MemshipExpiryDate'];
  
   if($memtype==""){
	  $Status='Active';
  } else {
	  if($MemshipExpiryDate!=""){
 	   if($MemshipExpiryDate >  $date){
		     $Status='Paid';
	   }else{
		   $Status='Expired';  
	   }
	  }else
	  {
		 $Status='Active'; 
	  }
  }
$sql=mysqli_query($con,"update register set Status='$Status' where MatriID='$strmid' ");

$sqlexp=$con->query("update expressinterest set banstatus='0' where eireceiver='$strmid'  or eisender='$strmid'");

$sqlview=$con->query("update profile_views set banstatus='0' where whom='$strmid' or  who='$strmid'");

$sqlshortlist=$con->query("update shortlist_profile set banstatus='0' where mat_id='$strmid' or profile_id='$strmid'");

$sqlviewadd=$con->query("update viewedaddress set banstatus='0' where who1='$strmid' or whom1='$strmid'");

$sqlignore=$con->query("update `ignore` set banstatus='0' where matriid='$strmid' or profile_id='$strmid'");

$sqlblock=$con->query("update `block_member` set banstatus='0' where matriid='$strmid' or profile_id='$strmid'");

$sqlreceivemessage=$con->query("update `receivemessage` set banstatus='0' where ToID='$strmid' or FromID='$strmid'");


header("location:profile_view?flag=14&msg=success&ID=$strmid ");
 ?>