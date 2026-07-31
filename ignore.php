<?php 
/*session_start();
include("dbconnectadmin.php");*/
require_once('sys_dbconnection.php');
$strid=$_SESSION['matri_login']; //or sender id
$searchid=$_GET['id'];
$idurl=base64_decode($_GET['id']);
//$searchid = $idurl;
$shortview=mysqli_query($con,"select * from `ignore` where matriid='$strid' and profile_id='$searchid'")or svr_db_fail($con);

$fetch=mysqli_query($con,"Select * from register");
if(mysqli_num_rows($shortview)==0)
{
$now=date('d-m-Y');
$shortview=mysqli_query($con,"insert  into `ignore`(matriid,profile_id,when1) value('$strid','$searchid','$now')")or svr_db_fail($con);
//echo "insert  into `ignore`(matriid,profile_id,when1) value('$strid','$searchid','$now')";
}
//exit;
//$encrypt=base64_encode($searchid) ;	
$encrypt = urlencode( base64_encode( $searchid ) );

header("location:full_profile?msg=ignored&id=$encrypt"); 
?>
