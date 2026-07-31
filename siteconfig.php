<?php  

require_once('includes/bootstrap.php');
$configdata = mysqli_query($con,"SELECT * FROM siteconfig where id='1'") or svr_db_fail($con); 
$siteinfo= mysqli_fetch_array($configdata); 
if(isset($_SESSION['matri_login']))
{
 
mysqli_query($con,"Update register set last_seen=NOW() where MatriID='".$_SESSION['matriid']."'") or svr_db_fail($con);

}
?>