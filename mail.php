<?php
require_once('sys_dbconnection.php');

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
<body>
<table width='467'>
<tr>
<td><img src='http://localhost/SVR/css3/assets/shivraj-logo.png' width='168'></td>
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