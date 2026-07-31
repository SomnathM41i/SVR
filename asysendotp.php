<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);


require_once('sys_dbconnection.php');
require_once('includes/security.php');
$siteinfo = $db->get_siteconfig();
//print_r($siteinfo);
$sms = $siteinfo -> otp_on_off;
if( $sms != 1)
{
    header("Location:cancel_otp_step?flag=test");
    exit;
}
/* SECURITY (H5): throttle OTP generation/SMS-email sends - 3 per 10 min per
   mobile+IP. When throttled, keep any previously issued OTP and skip sending.
   (Placed after the otp_on_off check so disabled flows are unaffected.) */
$otpBucket = 'otp:' . (isset($_SESSION['mobile']) ? $_SESSION['mobile'] : 'unknown') . ':' . svr_client_ip();
if (!svr_throttle($otpBucket, 3, 600)) {
    header('Location: verify_otp?msg=throttled');
    exit;
}
$_SESSION['otp']=rand(111111,999999);
$msg="";
$matriid=$_SESSION['tempid'];
//echo $_SESSION['mobile'];
$opt = $_SESSION['otp'];
 $msg = "Welcome To Jaipur Your OTP: $opt. Thank You Team weddingsparampara.com A unit of Mahadi Group";
    $numbers = $_SESSION['mobile']; // Multiple numbers separated by comma
$cout= $_SESSION['countrycode'];
$ret =mysqli_query($con,"select * from tbl_country where id=$cout");
$ret1 = mysqli_fetch_array($ret);
$country= $ret1['phonecode'];
//Send SMS -----------------------------
	// Account details  
   /*$username = 'MHDGRP';
    $apiKey = 'Jj9ZeHxQjJqPFkiZ8LuGeIgpgsEMRBT6dUCO8w+Fh5g=';
	$templateid='1707166607871293324';
    $apiRequest = 'Text';
    // Message details
    $numbers = $_SESSION['mobile']; // Multiple numbers separated by comma
	
    $sender = 'MHDGRP';
	$format='json';
	$client_id='bb007ca9-1e5f-4f3e-99cc-a878ba7e01df';
	$opt = $_SESSION['otp'];
	//"Welcome To Jaipur Your OTP: {#var#}. Thank You Team weddingsparampara.com A unit of Mahadi Group";
	 $msg = "Welcome To Jaipur Your OTP: $opt. Thank You Team weddingsparampara.com A unit of Mahadi Group";
	//$msg = "Welcome To tathastu.in.net Your OTP: $opt. Thank You Team- Shivraj Maratha";
  
	// Route details
    $apiRoute = 'TRANS';
    // Prepare data for POST request
    //$data = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&format='.$format.'&sender='.$sender.'&TemplateID='.$templateid."&message=".$msg;
    // Send the GET request with cURL
    //$url = 'http://www.alots.in/sms-panel/api/http/index.php?username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&format='.$format.'&sender='.$sender.'&TemplateID='.$templateid.'&message='.$msg;
   $url ='https://api.mavyah.com/api/v2/SendSMS?ApiKey='.$apiKey.'&ClientId='.$client_id.'&SenderId='.$username.'&Message='.$msg.'&MobileNumbers='.+$country.$numbers;

   

   
   $url = preg_replace("/ /", "%20", $url);
    $response = file_get_contents($url);
	//END Send SMS -----------------------------
	*/
	   include('mail.php'); 
header('Location: verify_otp');


 ?>
 
