<?php  


require_once('sys_dbconnection.php');
include_once('memprotect.php');?>
<?php include_once('siteconfig.php');



$strid=$_SESSION['matri_login']; //or sender id
$searchid=$_GET['id'];

$shortview=mysqli_query($con,"delete  from  expressinterest where eisender='$strid' and eireceiver='$searchid'")or svr_db_fail($con);
$encrypt=base64_encode($searchid);
header("location:full_profile?id=$encrypt");  
?>

