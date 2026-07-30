<?php require_once('sys_dbconnection.php');?>
<?php //include_once('memprotect.php');?>
<?php //include_once('siteconfig.php');
/*include("dbconnectadmin.php");*/

//$idurl=base64_decode($_GET['id']);
//$searchid = $idurl;
$searchid = $_GET['id'];
$login=$_SESSION['MatriID']; 

$block_rec = mysqli_query($con,"delete from  `ignore` where matriid ='".$login."' AND profile_id = '".$searchid."'");
//echo "delete from  `ignore` where matriid ='".$login."' AND profile_id = '".$searchid."'";
//exit;
$encrypt=base64_encode($searchid);	
header("location:full_profile?id=$searchid"); 
?>
