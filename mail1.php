<?php require_once('includes/bootstrap.php');



$qry="select * from cms where link='contact us'";
$qry1=mysqli_query($con,$qry);
$row=mysqli_fetch_array($qry1);
$_SESSION['otpe']=rand(111111,999999);
$mid=$_GET['id'];
$rowf=mysqli_query($con,"select *from register where MatriID='$mid'");
$rowfe=mysqli_fetch_array($rowf);
$datev=date('d-m-Y');

$name=$rowfe['Name'];
$verifye= $_SESSION['otpe'];
$mememail=$rowfe['ConfirmEmail'];
$matriid=$rowfe['MatriID'];

$verifymail=mysqli_query($con,"insert into  emailverify(MatriID,code,verification,date) values('$matriid','$verifye','No','$datev')");




include('smtp2.php');

$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query) or svr_db_fail($con); 
$info=mysqli_fetch_array($configdata);

		$mememail=$rowfe['ConfirmEmail'];
		$webfriendlyname=$info['WebFriendlyname'];
		$Webname=$info['Webname'];
		$logo =$info['Weblogopath'];
		
		$dates=date('d-m-Y');
		$message1 =  "
		<!doctype html>
			<html>
			<head>
			<meta charset='utf-8'>
			<title>Email Verify</title>

			</head>

			<body><!--MPJ-EMAILWRAP-->
<table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background:#F9E7DC;margin:0;padding:0;'><tr><td align='center' style='padding:16px 8px;'><table role='presentation' width='600' cellpadding='0' cellspacing='0' style='background:#FFFDFB;border:1px solid #E3CBB2;border-collapse:collapse;'><tr><td align='center' style='background:#F9E7DC;padding:16px 24px;'><img src='https://weddingsparampara.com/branding/images/email-logo.png' width='150' alt='Manpasand Jodidar' style='display:block;border:0;'/></td></tr><tr><td style='height:3px;background:#BA9350;font-size:0;line-height:0;'>&nbsp;</td></tr><tr><td style='padding:24px 28px;color:#43303A;font-size:14px;line-height:1.6;font-family:Georgia,serif;'>

			<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
			  <tr>
			  
				<td width='326'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168' height='50'  alt=''/></td>
				<td colspan='2' align='center' valign='middle'>Date: ".$datev."</td>
			  </tr>
			  <tr>
			  </tr>
			  <tr>
				<td height='20' colspan='3'><p>Dear ".$name.",<br>
				  Subject: Please verify your email for $Webname
				  <br>
				</p></td>
			  </tr>
			  
			  <tr>
				<td colspan='2' valign='top'>Enter the followign code in our $Webname.in to activate your account.<br></td>
				<td width='28'>&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan='3'><h1>".$_SESSION['otpe']."</h1></td>
			  </tr>
			  <tr>
				<td colspan='2'>Warm Regards,</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan='2'>Team: <a href='#'>$Webname </a></td>
				<td>&nbsp;</td>
			  </tr>
			</table>
			<!--MPJ-EMAILWRAP-->
</td></tr><tr><td align='center' style='background:#3D0C19;color:#E3CBB2;padding:14px 24px;font-family:Georgia,serif;font-size:12px;'>Manpasand Jodidar &middot; <span style='color:#DDB15F;'>Rishta Dil Se, Saath Zindagi Bhar</span></td></tr></table></td></tr></table>
</body>
			</html>";
								
	
	$subject="Email Verification";
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

	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}}
?>


