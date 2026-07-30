<?php  include_once('sys_dbconnection.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php');?>
<?php  
 $sender = $_GET['id'];
 $me=$_SESSION['MatriID'];
$res = mysqli_query($con,"update expressinterest set status='Decline' where eireceiver='$me' AND eisender='$sender'")or die(mysqli_error());

$encrypt = urlencode( base64_encode( $sender ) );
header("location:full_profile?id=$encrypt");  

?>