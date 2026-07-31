<?php  include_once('sys_dbconnection.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php');?>
<?php  

//$me = $_GET['id'];
//$sender = $_GET['id2'];
$sender = $_GET['id'];//other person
$login=$_SESSION['MatriID'];//receiver
$res = mysqli_query($con,"update  viewcontact_details set status='Accept' where whom='$login' AND who='$sender'")or die(mysqli_error($con));

//$encrypt=base64_encode($sender);	
$encrypt = urlencode( base64_encode( $sender ) );
header("location:full_profile?id=$encrypt&msg=acceptco"); 

 
?>

 