<?php  include_once('sys_dbconnection.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php');?>
<?php  
 $sender = $_GET['id'];
 $me=$_SESSION['MatriID'];
$res = mysqli_query($con,"update  viewcontact_details set status='Decline' where whom='$me' AND who='$sender'")or svr_db_fail($con);
$encrypt=base64_encode($sender);
header("location:full_profile?id=$sender");  

?>
