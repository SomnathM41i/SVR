<title>Birthday wish</title>
<?php 
/*include('dbconnectadmin.php');*/
require_once('sys_dbconnection.php');
include('smtp2.php'); 

date_default_timezone_set('Asia/Kolkata');
?>
<?php $sql=mysqli_query($con,"select * from register");
while($row=mysqli_fetch_array($sql))
{
    $exp=$row['MemshipExpiryDate'];
 	$arr= explode("-", $exp);
	$dobyear= $arr[0]; 
	$dobmonth= $arr[1]; 
	$dobday= $arr[2]; 
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$name=$row['Name'];

	if($month==$dobmonth && $day==$dobday)
	{
		$name_nm=explode(" ",$row['Name']);
		$cont=count($name_nm);
		if($cont==4)
		{
			$name=$name_nm[1];
		} else {
			$name=$name_nm[0];
		}
		
		$mememail= $row['ConfirmEmail'];
		$message1="<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8' />
<title>weddingsparampara.com</title>
<meta name='description' content='' />
<meta name='keywords' content='' />
<meta name='rating' content='general' />
<meta name='copyright' content='2013,' />
<meta name='revisit-after' content='31 Days' />
<meta name='expires' content='never'> 
<meta name='distribution' content='global' /> 
<meta name='robots' content='index,follow' />
</head>
<body style='margin: 0 auto;
	width: 100%;
	background: #ccc;
	text-align: left;'>
<div class='wrapper' style='margin: 0 auto;	width: 590px;background: #333;'>
<div class='wrapper-float' style='float: left;margin: 0;width: 590px;background: #fff;'>
<div class='logo' style='float: left;
	margin: 5% 0 0 29%;'>
	<a href='#' style='transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	text-decoration: none;'><img src='http://localhost/SVR/css3/assets/shivraj-logo.png'></a></div>
<div class='cont-wrapper' style='margin:-128px 10px 15px 10px;; background:none;float: left;width: 549px;margin: -128px 10px 15px 10px;'>
<p class='content' style='font-family: 'AvantGardeBkBTBook';font-weight: bold;font-size: 14px;color: #000;text-align: left;line-height: 23px;text-align: left;'><br><br><br><br><br><br><br><br>
Dear User,<br><br>
Happy birthday from <a href='#' class='color-2' style='color: #c5191f;transition: all 0.3s ease-in-out;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	text-decoration: none;'>weddingsparampara.com</a> Team. <br>

Your Membership has been Expired.<br>


</div>
<br><br><br><br><br><br><br><br><br><br><br>

<p class=content  style='margin:0 0 0 10px;margin:0 0 0 10px; font-family: 'AvantGardeBkBTBook';
	font-weight: bold;
	font-size: 14px;
	color: #000;
	text-align: left;
	line-height: 23px;
	text-align: left;clear: both;'>
Warm Regards,<br>
<span class='color-2' style='color: #c5191f;'>weddingsparampara.com</span> Team<br>
<a href='https://weddingsparampara.com'>Click here</a> to visit this site. 

</p>


</div>
<br><br>
	<br>
</div>
</div>
</div>
</body>
</html>";
	
	$subject="Membership Expire";
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
}
}
	
 ?>
 <?php
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
}
?>