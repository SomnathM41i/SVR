<?php require_once('sys_dbconnection.php');
// include_once('memprotect.php');?>
<?php  //include_once('siteconfig.php');
/*session_start();
include("dbconnectadmin.php");*/
$searchid = $_GET['id'];
$strid = $_SESSION['matriid'];
//$idurl=base64_decode($_GET['id']);
//$searchid = $idurl;

$block_rec = mysqli_query($con,"delete from block_member where matriid ='".$strid."' AND profile_id = '".$searchid."'");
//$encrypt=base64_encode($searchid) ;
$encrypt = urlencode( base64_encode( $searchid ) );
header("location:full_profile?id=$encrypt"); 
?>
