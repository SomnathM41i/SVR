<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
/*include 'dbconnectadmin.php';*/
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$todaysdate=date('Y-m-d');
//echo "UPDATE `register` SET `Status`='Expired' WHERE 1 AND DATE_FORMAT(`MemshipExpiryDate`, '%Y-%m-%d')='".$todaysdate."'"; exit;
$rsmaleexpired=mysqli_query($con,"UPDATE `register` SET `Status`='Expired' WHERE 1 AND DATE_FORMAT(`MemshipExpiryDate`, '%Y-%m-%d')='".$todaysdate."'");
 if($rsmaleexpired){
	 echo mysqli_errno($con);
 }
 ?>
