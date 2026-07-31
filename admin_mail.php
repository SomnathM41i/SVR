<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require_once('includes/bootstrap.php');

$strid   = $_SESSION['matriid'];
$matriid = $_SESSION['tempid'];
$mobile  = $_SESSION['mobile'];
$password= $_SESSION['pwd']; 
$name    = $_SESSION['Name'];
$email   = $_SESSION['emailtemp'];

$qry="select * from cms where link='contact us'";
$qry1=mysqli_query($con,$qry);
$row=mysqli_fetch_array($qry1);

/* Get Admin Email */
$ademail=mysqli_query($con,"select * from email_sending where id='1'");
$Emailinfo=mysqli_fetch_array($ademail);
$admin_mail = $Emailinfo['owner_email'];

/* Site Config */
$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query);
$info=mysqli_fetch_array($configdata);

$mememail= $admin_mail;

$Webname=$info['Webname'];
$dates=date('d-m-Y');

/* Email Message */
$message1 = "
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Registration Confirmation</title>
</head>

<body><!--MPJ-EMAILWRAP-->
<table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background:#F9E7DC;margin:0;padding:0;'><tr><td align='center' style='padding:16px 8px;'><table role='presentation' width='600' cellpadding='0' cellspacing='0' style='background:#FFFDFB;border:1px solid #E3CBB2;border-collapse:collapse;'><tr><td align='center' style='background:#F9E7DC;padding:16px 24px;'><img src='https://weddingsparampara.com/branding/images/email-logo.png' width='150' alt='Manpasand Jodidar' style='display:block;border:0;'/></td></tr><tr><td style='height:3px;background:#BA9350;font-size:0;line-height:0;'>&nbsp;</td></tr><tr><td style='padding:24px 28px;color:#43303A;font-size:14px;line-height:1.6;font-family:Georgia,serif;'>

<table width='467' border='0'>
<tr>
<td width='222'>
<img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168'>
</td>
<td>Date: $dates</td>
</tr>

<tr>
<td colspan='2'>
New Registration.<br>
Matrimony ID: <strong style='font-size:26px'>$strid</strong><br><br>

Name: <strong>$name</strong><br>
Mobile No: <strong>$mobile</strong><br>
Email ID: <strong>$email</strong><br>

</td>
</tr>

</table>
<!--MPJ-EMAILWRAP-->
</td></tr><tr><td align='center' style='background:#3D0C19;color:#E3CBB2;padding:14px 24px;font-family:Georgia,serif;font-size:12px;'>Manpasand Jodidar &middot; <span style='color:#DDB15F;'>Rishta Dil Se, Saath Zindagi Bhar</span></td></tr></table></td></tr></table>
</body>
</html>
";

/* Email Subject */
$subject="New Registration Found.";

/* Email Headers */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: support@weddingsparampara.com\r\n";

/* Send Mail */
if(!empty($mememail)){
    if(mail($mememail,$subject,$message1,$headers)){
        $msg="Your E-mail is Sent Successfully!";
    }else{
        $msg="Mail sending failed.";
    }
}

/* Redirect */
if($_GET['flag']){
	header('Location: register_success?msg=flag&id='.$strid);	
}else{
	header('Location: register_success?id='.$strid);
}
exit;
?>