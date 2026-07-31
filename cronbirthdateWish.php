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
    <body><table width="467" border="0" style="font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif" cellpadding="0" cellspacing="0">
          <tr>
          
            <td width="222"><img src="http://localhost/SVR/css3/assets/shivraj-logo.png" width="168" height="50"  alt=""/></td>
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
        </table></body> 
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
