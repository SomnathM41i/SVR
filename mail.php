<?php
require_once('includes/bootstrap.php');

$name = $_SESSION['Name'];
$mememail = $_SESSION['emailtemp'];

$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query);
$info=mysqli_fetch_array($configdata);

$Webname=$info['Webname'];
$dates=date('d-m-Y');

$otp = $_SESSION['otp']; // make sure otp exists

$subject = "OTP Verification";

$message1 = "
<html>
<body><!--MPJ-EMAILWRAP-->
<table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background:#F9E7DC;margin:0;padding:0;'><tr><td align='center' style='padding:16px 8px;'><table role='presentation' width='600' cellpadding='0' cellspacing='0' style='background:#FFFDFB;border:1px solid #E3CBB2;border-collapse:collapse;'><tr><td align='center' style='background:#F9E7DC;padding:16px 24px;'><img src='https://weddingsparampara.com/branding/images/email-logo.png' width='150' alt='Manpasand Jodidar' style='display:block;border:0;'/></td></tr><tr><td style='height:3px;background:#BA9350;font-size:0;line-height:0;'>&nbsp;</td></tr><tr><td style='padding:24px 28px;color:#43303A;font-size:14px;line-height:1.6;font-family:Georgia,serif;'>

<table width='467'>
<tr>
<td><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168'></td>
<td>Date: $dates</td>
</tr>

<tr>
<td colspan='2'>Dear $name</td>
</tr>

<tr>
<td colspan='2' style='font-size:30px'><b>$otp</b></td>
</tr>

<tr>
<td colspan='2'>Thank you for registration with us.</td>
</tr>

<tr>
<td colspan='2'>Team $Webname</td>
</tr>

</table>
<!--MPJ-EMAILWRAP-->
</td></tr><tr><td align='center' style='background:#3D0C19;color:#E3CBB2;padding:14px 24px;font-family:Georgia,serif;font-size:12px;'>Manpasand Jodidar &middot; <span style='color:#DDB15F;'>Rishta Dil Se, Saath Zindagi Bhar</span></td></tr></table></td></tr></table>
</body>
</html>
";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: support@weddingsparampara.com\r\n";

if(mail($mememail,$subject,$message1,$headers)){
    echo "Mail Sent Successfully";
}else{
    echo "Mail Sending Failed";
}
?>