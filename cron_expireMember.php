<?php
require_once('includes/bootstrap.php');
require_once(dirname(__FILE__).'/includes/security.php');
svr_cron_guard(); /* SECURITY (H6): cron endpoint now guarded (CLI always allowed; web requires SVR_CRON_KEY when configured). */
/*include 'dbconnectadmin.php';*/
//
date_default_timezone_set('Asia/Kolkata');
$todaysdate=date('Y-m-d');
//echo "UPDATE `register` SET `Status`='Expired' WHERE 1 AND DATE_FORMAT(`MemshipExpiryDate`, '%Y-%m-%d')='".$todaysdate."'"; exit;
$rsmaleexpired=mysqli_query($con,"UPDATE `register` SET `Status`='Expired' WHERE 1 AND DATE_FORMAT(`MemshipExpiryDate`, '%Y-%m-%d')='".$todaysdate."'");
 if($rsmaleexpired){
	 echo mysqli_errno($con);
 }
 ?>
