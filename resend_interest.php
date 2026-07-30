<?php  

/*include("dbconnectadmin.php");*/
require_once('sys_dbconnection.php');
include_once('memprotect.php');?>
<?php include_once('siteconfig.php');

//$idurl=base64_decode($_GET['id']);
///$searchid = $idurl;
$strid=$_SESSION['matri_login']; //or sender id
$searchid=$_GET['id'];
//echo $searchid;
$shortview=mysqli_query($con,"delete  from  expressinterest where eisender='$strid' and eireceiver='$searchid'")or die(mysqli_error());
$encrypt=base64_encode($searchid);
header("location:full_profile?id=$encrypt");  
?>

