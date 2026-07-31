<?php  
require_once(dirname(__FILE__).'/console/protect.php'); /* admin-only (was a silently-failing include of non-existent root protect.php) */
require_once('includes/bootstrap.php');

  $strmid = mysqli_real_escape_string($con, $_GET['matriid']); /* escaped (was raw GET -> SQL) */  
$sql=mysqli_query($con,"update register set Status='Banned' where MatriID='$strmid'");
header("location:profile_view?flag=13&msg=success&ID=$strmid ");
 ?>