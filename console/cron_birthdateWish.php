<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');
/*include 'dbconnectadmin.php';*/
include 'siteconfig.php';

//print_r($siteinfo);
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$todaysdate=date('m-d');
//echo "UPDATE `register` SET `Status`='Expired' WHERE 1 AND DATE_FORMAT(`MemshipExpiryDate`, '%Y-%m-%d')='".$todaysdate."'"; exit;

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
	 while($datasetDOBNotification = mysqli_fetch_array($rsmaleexpired)){
		 /*print_r($datasetDOBNotification);
		 echo $datasetDOBNotification['mid'];
		 echo $datasetDOBNotification['email'];
		 echo $datasetDOBNotification['name'];
		 echo $datasetDOBNotification['DOB'];*/
		 
	$message1= '<table width="467" border="0" style="font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif" cellpadding="0" cellspacing="0">
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
</table>';


		$subject="Happy Birthday";
		$email=$datasetDOBNotification['email'];
		$mail->Subject=$subject;
		$mail->MsgHTML($message1);
		$msg="";
		if($email!="")
		{
			set_time_limit(30);
			$mail->ClearAddresses();
			$mail->AddAddress($email);
			$mail->Send();

			//$msg="Your E-mail is Send Successfuly!";
		}

}
	 
 ?>
