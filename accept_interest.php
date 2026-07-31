<?php  include_once('includes/bootstrap.php');?>
<?php  include_once('memprotect.php');?>
<?php  include_once('siteconfig.php'); ?>
<?php  



$sender = $_GET['id'];//other person
$login=$_SESSION['MatriID'];//receiver
$res = mysqli_query($con,"update expressinterest set status='Accept' where eireceiver='$login' AND eisender='$sender'")or svr_db_fail($con);

/* accept interest email sending */
 $sql=mysqli_query($con,"select * from  register WHERE MatriID='$sender' ");//receiver
  $row=mysqli_fetch_array($sql);
  $nm=$row['Name'];
  $photosender=$row['Photo1'];

  $sql2=mysqli_query($con,"select * from  register WHERE MatriID='$login'");
  $row1=mysqli_fetch_array($sql2);
  $photo=$row1['photo1'];
  

  $photo1=$row1['Photo1'];
  $age=$row1['Age'];
  
  $reli=$row1['Religion'];
  $mother_tongue=$row1['mother_tounge'];
  $edu=$row1['Education'];
  $occu=$row1['Occupation'];
  $send=$row1['ConfirmEmail'];
 $encrypt_sender=base64_encode($login);	

  $emailsql=mysqli_query($con,"select * from  email_sending WHERE id='1' ");
  $mailinfo =mysqli_fetch_array($emailsql);
   $city=$row1['City'];
    $sendernm=explode(" ",$row1['Name']);
	$age=$row1['Age'];
  $websql=mysqli_query($con,"select * from siteconfig WHERE ID='1' ");
  $webinfo=mysqli_fetch_array($websql);
  $logo =$webinfo['Weblogopath'];
    $site_name=$webinfo['Webname'];
    $webname=$webinfo['WebFriendlyname'];
    
    $qry="select * from cms where cms_id='9'";
    $qry1=mysqli_query($con,$qry);
    $row3=mysqli_fetch_array($qry1);

    // for checking on/off of SMTP
		$data_config = $db->get_siteconfig();
		    
		$on_off = $data_config-> is_smtp_set;
		$check_email = mysqli_query($con,"SELECT * FROM emailverify where MatriID='$sender'");	
				
		$fetch_email = mysqli_fetch_array($check_email);
		//END

      $strheight = $row1['Height'];
									if($strheight =="1") { $height= "4ft"; }
									else if($strheight =="") { $height= "Null"; }
									else if($strheight =="2") { $height= "4Ft 1 inch"; }
									else if($strheight =="3") { $height= "4Ft 2 inch"; }
									else if($strheight =="4") { $height= "4Ft 3 inch"; }
									else if($strheight =="5") { $height= "4Ft 4 inch"; }
									else if($strheight =="6") { $height= "4Ft 5 inch"; }
									else if($strheight =="7") { $height= "4Ft 6 inch"; }
									else if($strheight =="8") { $height= "4Ft 7 inch"; }
									else if($strheight =="9") { $height= "4Ft 8 inch"; }
									else if($strheight =="10") { $height= "4Ft 9 inch"; }
									else if($strheight =="11") { $height= "4Ft 10 inch"; }
									else if($strheight =="12") { $height= "4Ft 11 inch"; }
									else if($strheight =="13") { $height= "5Ft"; }
									else if($strheight =="14") { $height= "5Ft 1 inch"; }
									else if($strheight =="15") { $height= "5Ft 2 inch"; }
									else if($strheight =="16") { $height= "5Ft 3 inch"; }
									else if($strheight =="17") { $height= "5Ft 4 inch"; }
									else if($strheight =="18") { $height= "5Ft 5 inch"; }
									else if($strheight =="19") { $height= "5Ft 6 inch"; }
									else if($strheight =="20") { $height= "5Ft 7 inch"; }
									else if($strheight =="21") { $height= "5Ft 8 inch"; }
									else if($strheight =="22") { $height= "5Ft 9 inch"; }
									else if($strheight =="23") { $height= "5Ft 10 inch"; }
									else if($strheight =="24") { $height= "5Ft 11 inch"; }
									else if($strheight =="25") { $height= "6Ft"; }
									else if($strheight =="26") { $height= "6Ft 1 inch "; }
									else if($strheight =="27") { $height= "6Ft 2 inch"; }
									else if($strheight =="28") { $height= "6Ft 3 inch"; }
									else if($strheight =="29") { $height= "6Ft 4 inch"; }
									else if($strheight =="30") { $height= "6Ft 5 inch"; }
									else if($strheight =="31") { $height= "6Ft 6 inch"; }
									else if($strheight =="32") { $height= "6Ft 7 inch"; }
									else if($strheight =="33") { $height= "6Ft 8 inch"; }
									else if($strheight =="34") { $height= "6Ft 9 inch"; }
									else if($strheight =="35") { $height= "6Ft 10 inch"; }
									else if($strheight =="36") { $height= "6Ft 11 inch"; }
									else if($strheight =="37") { $height= "7Ft"; }
						
					if( (int)$on_off === 1 && $fetch_email['verification'] =='Yes' )
					{
						include('smtp2.php');
					  $mail->Subject="Interest Accepted";
					  $mail->Body="<!doctype html>
					<html>
					<head>
					<meta charset='utf-8'>
					<title>Interest Accepted by Someone</title>

					</head>

					<body><!--MPJ-EMAILWRAP-->
<table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background:#F9E7DC;margin:0;padding:0;'><tr><td align='center' style='padding:16px 8px;'><table role='presentation' width='600' cellpadding='0' cellspacing='0' style='background:#FFFDFB;border:1px solid #E3CBB2;border-collapse:collapse;'><tr><td align='center' style='background:#F9E7DC;padding:16px 24px;'><img src='https://weddingsparampara.com/branding/images/email-logo.png' width='150' alt='Manpasand Jodidar' style='display:block;border:0;'/></td></tr><tr><td style='height:3px;background:#BA9350;font-size:0;line-height:0;'>&nbsp;</td></tr><tr><td style='padding:24px 28px;color:#43303A;font-size:14px;line-height:1.6;font-family:Georgia,serif;'>

					<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
					  <tr>
						<td width='222'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='168' height='50'  alt=''/></td>
						<td colspan='2' align='center' valign='middle'>Date: 20-2-2021</td>
					  </tr>
					  <tr>
						
					  </tr>
					  <tr>
					   
						<td colspan='3'>
						Dear  ".$nm." ,<br>
						Interest Accepted by Someone: ".$sendernm[0]." </td>
					  </tr>
					  <tr>
						<td colspan='3'>-------------------------------------------------------------------------------</td>
					  </tr>
					  <tr>
						<td><img src='https://www.weddingsparampara.com/gallary/".$row1['Photo1']."' width='209' height='232'  alt=''/></td>
						<td width='221' valign='top'><p>Name: ".$sendernm[0]."</p>
						<p>Age: $age Years</p>
						<p>Height: $height Inch</p>
						<p>City: $city</p>
						<p>Occupation: $occu</p>
						<p>Education: $edu </p>
					   </td>  
						<td width='24'>&nbsp;</td>
					  </tr>
					  <tr>
						<td>ID:<a href='https://www.weddingsparampara.com/full_profile?id=".$login."'> ".$login." View Profile</a></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					</table>
					<!--MPJ-EMAILWRAP-->
</td></tr><tr><td align='center' style='background:#3D0C19;color:#E3CBB2;padding:14px 24px;font-family:Georgia,serif;font-size:12px;'>Manpasand Jodidar &middot; <span style='color:#DDB15F;'>Rishta Dil Se, Saath Zindagi Bhar</span></td></tr></table></td></tr></table>
</body>
					</html>
					";

$mail->AddAddress($row['ConfirmEmail'], $row['Name']);

if(!$mail->Send()) 
{
  echo "Mailer Error: " . $mail->ErrorInfo;
} else
{

}
}

/* end accept interest email sending */

$encrypt = urlencode( base64_encode( $sender ) );
header("location:full_profile?id=$encrypt&msg=contacten"); 

 
?>

 