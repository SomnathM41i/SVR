<?php  

require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
$facebook=$_POST['facebook'];
$twitter=$_POST['twitter'];


$other_social=$_POST['others'];
$youtube=$_POST['youtube'];

$rec=mysqli_query($con,"update siteconfig set facebook='$facebook',twitter='$twitter',other_social='$other_social',youtube='$youtube'") or mysqli_error($con,$error());

header('location:social?msg=Link');
?>