<?php require_once('sys_dbconnection.php');
/*session_start(); 
include('dbconnectadmin.php');*/
$strid=$_SESSION['matriid'];
$matriid=$_SESSION['tempid'];

$mobile=$_SESSION['mobile'];
$password=$_SESSION['pwd']; 
$name=$_SESSION['Name'];
$qry="select * from cms where link='contact us'";
$qry1=mysqli_query($con,$qry);
$row=mysqli_fetch_array($qry1);
	
include('smtp2.php');

$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query) or svr_db_fail($con); 
$info=mysqli_fetch_array($configdata);
  //     msg starts //
 
 // Welcome To Jaipur Your Registration Created. Successfully. Your Login ID: {#var#}. Best of Luck Team - weddingsparampara.com A unit of Mahadi Group
  //"Welcome+To+Jaipur+Your+Registration+Created.+Successfully.+Your+Login+ID:+".$matriid.".+Best+of+Luck+Team+-+".$info['Webname']."+A+unit+of+Mahadi+Group"

$message="Welcome+To+Jaipur+Your+Registration+Created.+Successfully.+Your+Login+ID:+".$matriid.".+Best+of+Luck+Team+-+".$info['Webname']."+A+unit+of+Mahadi+Group";
$sms=mysqli_query($con,"select * from smsgetway where id=1");
$sms1=mysqli_fetch_array($sms);	
$username='MHDGRP';
$password=$sms1['password'];
$sender=$sms1['sender'];
$numbers=$_SESSION['mobile'];
$cout= $_SESSION['countrycode'];
$ret =mysqli_query($con,"select * from tbl_country where id=$cout");
$ret1 = mysqli_fetch_array($ret);
$country= $ret1['phonecode'];
$client_id='bb007ca9-1e5f-4f3e-99cc-a878ba7e01df';
$apiKey = 'Jj9ZeHxQjJqPFkiZ8LuGeIgpgsEMRBT6dUCO8w+Fh5g=';
$templateid='1207162937026617360';
$format='json';
$apiRoute='TRANS';
$apiRequest = 'Text';
//$url = 'http://www.alots.in/sms-panel/api/http/index.php?username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$to.'&format='.$format.'&sender='.$sender.'&TemplateID='.$templateid.'&message='.$message;
//$url ='https://api.mavyah.com/api/v2/SendSMS?ApiKey='.$apiKey.'&ClientId='.$client_id.'&SenderId='.$username.'&Message='.$message.'&MobileNumbers='.+$country.$numbers;
//echo $to.":".$mystring.'<br/></br>'; // REMOVE THIS line if not display response
$url = preg_replace("/ /", "%20", $url);
$response = file_get_contents($url);

/*$route = "default";
//Prepare you post parameters
$postData = array(
    'mobiles' => $to,
    'message' => $message,
    'sender' => $sender,
    'route' => $route
);
// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));
//get response.
$output = curl_exec($ch);
curl_close($ch);*/
//end msg // */


		
		$mememail=$_SESSION['emailtemp'];
		$webfriendlyname=$info['WebFriendlyname'];
		$Webname=$info['Webname'];
		$logo =$info['Weblogopath'];
		
		$dates=date('d-m-Y');
		$message1 = "<!doctype html>
			<html>
			<head>
			<meta charset='utf-8'>
			<title>Registration Confirmation</title>

			</head>

			<body>
			<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
			  <tr>
				<td width='222'><img src='http://localhost/SVR/css3/assets/shivraj-logo.png' width='168' height='50'  alt=''/></td>
				<td colspan='2' align='center' valign='middle'>Date: $dates</td>
			  </tr>
			  <tr>
				
			  </tr>
			  <tr>
				<td height='20' colspan='3'><p>Dear ".$name.",<br>
				  Your Matrimony account is created. <br>
				  You're Matrimony ID: <strong style='font-size:26px'>$strid</strong><br>
				</p></td>
			  </tr>
			  
			  <tr>
				<td colspan='2'>We strongly recommend that you make your profile as attractive as possible so that it receives maximum response. Set <strong>Partner Preference & Compatibility</strong> and get Your match Immediately.  <br>
				  <br>
				We wish you all the best in your partner search.</td>
				<td width='24'>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Warm Regards,</td>
				<td width='221'>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan='2'>Team: <a href='#'>$Webname </a></td>
				<td>&nbsp;</td>
			  </tr>
			</table>
			</body>
			</html>
			";
	$subject="Registration Confirmation";
	$email=$mememail;
	$mail->Subject=$subject;
	$mail->MsgHTML($message1);
	$msg="";
	if($email!="")
	{
			set_time_limit(30);
			$mail->ClearAddresses();
			$mail->AddAddress($email);
			$mail->Send();
		
			$msg="Your E-mail is Send Successfuly!";
	}
	else
	{}

?>
	

 <?php
 if (!function_exists('rteSafe'))
 {
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}}

?>


