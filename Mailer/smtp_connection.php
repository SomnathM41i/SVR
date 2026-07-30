<?php
require("../Mailer/PHPMailer_5.2.4/class.phpmailer.php");
$mail = new PHPMailer;
//$mail->isSMTP(); // Set mailer to use SMTP  
 $mail->IsSMTP();   
 
$mailinfo=$mailinfo['smtp'];
$mail->Host =$mailinfo['smtp']; // Specify main and backup server
 $mail->Port =465;// SMTP servers
// $mail->SMTPDebug = 2;
$mail->SMTPAuth =true;                               // Enable SMTP authentication
$mail->Username = $mailinfo['username'];                            // SMTP username
$mail->Password = $mailinfo['password'];                          // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

$mail->From = $mailinfo['username'];        
$mail->FromName = $mailinfo['from_name'];

//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo($mailinfo['username'] ,  $mailinfo['from_name']);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
?>