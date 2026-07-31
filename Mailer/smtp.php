<?php
$query="select * from email_sending where id=1";
$rec=mysql_query($query);
$Emailinfo=mysql_fetch_array($rec);

include('../Mailer/PHPMailer_5.2.4/class.phpmailer.php');
include('../Mailer/PHPMailer_5.2.4/class.smtp.php');
$mail = new PHPMailer;

//$mail->isSMTP(); // Set mailer to use SMTP  
 $mail->IsSMTP();       
$mail->Host =$Emailinfo['smtp']; // Specify main and backup server
 $mail->Port =465;// SMTP servers
 $mail->SMTPDebug = 1;
$mail->SMTPAuth =true;                               // Enable SMTP authentication
$mail->Username =$Emailinfo['username'];                            // SMTP username
$mail->Password =$Emailinfo['password'];                         // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted


$mail->From =$Emailinfo['username'];
$mail->FromName =$Emailinfo['from_name'];

//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo($Emailinfo['username'], $Emailinfo['from_name']);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
?>