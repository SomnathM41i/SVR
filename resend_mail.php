<?php require_once('includes/bootstrap.php');



$qry="select * from cms where link='contact us'";
$qry1=mysqli_query($con,$qry);
$row=mysqli_fetch_array($qry1);
$_SESSION['otpe']=rand(111111,999999);
$mid=$_GET['id'];
$rowf=mysqli_query($con,"select * from register where MatriID='$mid'");
$rowfe=mysqli_fetch_array($rowf);
$check_u=mysqli_query($con,"select COUNT(id) from emailverify where MatriID='$mid'");
ECHO "select COUNT(id) from emailverify where MatriID='$mid'";
$fetch_u=mysqli_fetch_array($check_u);

$check = $fetch_u['COUNT(id)'];
echo $check.'<br>';
$datev=date('d-m-Y');
$name=$rowfe['Name'];
$verifye= $_SESSION['otpe'];
$mememail=$rowfe['ConfirmEmail'];
$matriid=$rowfe['MatriID'];
if( $check == 1 )
{
	$verifymail=mysqli_query($con,"update emailverify set code='$verifye', date='$datev' where MatriID = '$matriid'") ;
	ECHO "update emailverify set code='$verifye', date='$datev' where MatriID = '$matriid'";
	
}
else
{
	$verifymail=mysqli_query($con,"insert into  emailverify(MatriID,code,verification,date) values('$matriid','$verifye','No','$datev')");
	ECHO "insert into  emailverify(MatriID,code,verification,date) values('$matriid','$verifye','No','$datev')";
	
}

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

			<body>
			<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
			  <tr>
			  
				<td width='326'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168' height='50'  alt=''/></td>
				<td colspan='2' align='center' valign='middle'>Date: $dates</td>
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
				<td colspan='2' valign='top'>Enter the followign code in our $Webname to activate your account.<br></td>
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
	header('Location: verifycode.php')
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


