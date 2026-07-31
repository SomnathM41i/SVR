<?php
require_once('includes/bootstrap.php');
require_once(dirname(__FILE__).'/includes/security.php');
svr_cron_guard(); /* SECURITY (H6): cron endpoint now guarded (CLI always allowed; web requires SVR_CRON_KEY when configured). */
/*include 'dbconnectadmin.php';*/
include 'siteconfig.php';
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Kolkata');
$todaysdate=date('m-d');
//Get Today Birth day Notification Records
$rsmaleexpired=mysqli_query($con,"SELECT ifnull(`MatriID`,'') as mid
,ifnull(`ConfirmEmail`,'') as email
,ifnull(`Name`,'') as name
,ifnull(`DOB`,'') as DOB 
FROM `register` WHERE 1 AND DATE_FORMAT(`DOB`, '%m-%d')='".$todaysdate."'");
if($rsmaleexpired){
 mysqli_errno($con);
}

include('smtp2.php');
$message1 = "";
while($datasetDOBNotification = mysqli_fetch_array($rsmaleexpired)){ //Today All Birthday Date Records, Start Loop
        		 /*print_r($datasetDOBNotification);
        		 echo $datasetDOBNotification['mid'];
        		 echo $datasetDOBNotification['email'];
        		 echo $datasetDOBNotification['name'];
        		 echo $datasetDOBNotification['DOB'];*/
        		 
        	$message1= '<html> 
    <head> 
        <title>Birthday Notification</title> 
    </head> 
    <body><!--MPJ-EMAILWRAP-->
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F9E7DC;margin:0;padding:0;"><tr><td align="center" style="padding:16px 8px;"><table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#FFFDFB;border:1px solid #E3CBB2;border-collapse:collapse;"><tr><td align="center" style="background:#F9E7DC;padding:16px 24px;"><img src="https://weddingsparampara.com/branding/images/email-logo.png" width="150" alt="Manpasand Jodidar" style="display:block;border:0;"/></td></tr><tr><td style="height:3px;background:#BA9350;font-size:0;line-height:0;">&nbsp;</td></tr><tr><td style="padding:24px 28px;color:#43303A;font-size:14px;line-height:1.6;font-family:Georgia,serif;">
<table width="467" border="0" style="font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif" cellpadding="0" cellspacing="0">
          <tr>
          
            <td width="222"><img src="https://weddingsparampara.com/branding/logos/logo-horizontal.png" width="168" height="50"  alt=""/></td>
            <td colspan="2" align="center" valign="middle">Date:'.$datasetDOBNotification['DOB'].'</td>
          </tr>
          <tr>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td height="20" colspan="3"><p>Dear '.$datasetDOBNotification['name'].',<br>
              Happy Birthday<br>
            </p></td>
          </tr>
          
          <tr>
            <td colspan="2" valign="top">Wishing you a beautiful day with good health and happiness forever. Happy birthday.<br></td>
            <td width="24">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><img src="https://www.weddingsparampara.com/images/happy-birthday.jpg" width="300" height="294"  alt=""/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">Warm Regards,</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">Team: <a href="#">'.$siteinfo['app_name'].' </a></td>
            <td>&nbsp;</td>
          </tr>
        </table><!--MPJ-EMAILWRAP-->
</td></tr><tr><td align="center" style="background:#3D0C19;color:#E3CBB2;padding:14px 24px;font-family:Georgia,serif;font-size:12px;">Manpasand Jodidar &middot; <span style="color:#DDB15F;">Rishta Dil Se, Saath Zindagi Bhar</span></td></tr></table></td></tr></table>
</body> 
    </html>';
        
        $subject="Happy Birthday";
        $email=$datasetDOBNotification['email'];
        $mail->Subject=$subject;
        $mail->MsgHTML($message1);
        $msg="";
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($email) && !empty($email)) {
                set_time_limit(30);
            	$mail->ClearAddresses();
            	$mail->AddAddress($email);
            	$Success = $mail->Send();
            	if($Success){
            	    $msg="Your E-mail is Send Successfuly!";    
            	}
            }
} // End Loop
	 
 ?>
