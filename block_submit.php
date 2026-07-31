<?php  
/*session_start();
include("dbconnectadmin.php");*/
require_once('sys_dbconnection.php');
$login=$_SESSION['MatriID'];  //or sender id
$searchid=$_GET['id'];
						
//$idurl=base64_decode($_GET['id']);
//$searchid = $idurl;
$shortview=mysqli_query($con,"select * from block_member where matriid='$login' and profile_id='$searchid'")or die(mysqli_error());

$fetch=mysqli_query($con,"Select * from register");
if(mysqli_num_rows($shortview)==0)
{
$now=date('d-m-Y');
$shortview=mysqli_query($con,"insert  into block_member(matriid,profile_id,when1) value('$login','$searchid','$now')")or die(mysqli_error());
}
//echo "select * from block_member where matriid='$strid' and profile_id='$searchid'";
//echo "insert  into block_member(matriid,profile_id,when1) value('$strid','$searchid','$now')";
 //$encrypt=base64_encode($searchid);
$encrypt = urlencode( base64_encode( $searchid ) );
header("location:full_profile?msg=blocksuccess&id=$encrypt"); 
?>
