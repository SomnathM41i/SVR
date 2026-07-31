<?php
require_once('sys_dbconnection.php');
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
