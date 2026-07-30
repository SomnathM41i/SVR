<?php
$query="select * from email_sending where id=1";
$rec=mysqli_query($con,$query);
$Emailinfo=mysqli_fetch_array($rec);
include_once('Mailer/PHPMailer_5.2.4/class.phpmailer.php');
include_once('Mailer/PHPMailer_5.2.4/class.smtp.php');
$mail = new PHPMailer;

$mail->IsSMTP();       
$mail->Host =$Emailinfo['smtp']; // Specify main and backup server
$mail->Port =465;// SMTP servers
$mail->SMTPDebug = 1;
$mail->SMTPAuth =true;                               // Enable SMTP authentication
$mail->Username =$Emailinfo['username'];                            // SMTP username
$mail->Password =$Emailinfo['password'];                         // SMTP password
$mail->SMTPSecure = 'ssl';   
                                               // Enable encryption, 'ssl' also accepted
$mail->From =$Emailinfo['username'];
$mail->FromName =$Emailinfo['from_name'];


$mail->addReplyTo($Emailinfo['username'], $Emailinfo['from_name']);


$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML
?>