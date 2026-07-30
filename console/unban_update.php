<?php require_once('../sys_dbconnection.php');   
//include('protect.php');
/*include('../dbconnectadmin.php');*/

  $strmid=$_GET['matriid']; 
  $date = date('Y-m-d'); 
  $sql=mysqli_query($con,"select * from register where MatriID='$strmid'");
  $row=mysqli_fetch_array($sql); 
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
mysqli_query($con,"update register set Status='$Status' where MatriID='$strmid' ");
header("location:unban_members?msg=Member Unban Successfully.");
  ?>