<?php  include_once('sys_dbconnection.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php');?>
<?php  



$sender = $_GET['id'];//other person
$login=$_SESSION['MatriID'];//receiver
$res = mysqli_query($con,"update  viewcontact_details set status='Accept' where whom='$login' AND who='$sender'")or svr_db_fail($con);


$encrypt = urlencode( base64_encode( $sender ) );
header("location:full_profile?id=$encrypt&msg=acceptco"); 

 
?>

 