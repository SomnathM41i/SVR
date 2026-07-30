<?php  
/*include('dbconnectadmin.php');*/
require_once('sys_dbconnection.php');
$configdata = mysqli_query($con,"SELECT * FROM siteconfig where id='1'") or die(mysqli_error()); 
$siteinfo= mysqli_fetch_array($configdata); 
if(isset($_SESSION['matri_login']))
{
 
mysqli_query($con,"Update register set last_seen=NOW() where MatriID='".$_SESSION['matriid']."'") or die(mysqli_error());

}
?>