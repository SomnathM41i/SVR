<?php  include_once('sys_dbconnection.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php');

//$block_id = $_GET['id'];
$strid = $_SESSION['matriid'];
//$searchid=$_GET['id'];
$idurl=$_GET['id'];
$block_rec = mysqli_query($con,"delete from block_member where matriid ='".$strid."' AND profile_id = '".$idurl."'");

header("location:full_profile?id=$idurl"); 
?>
