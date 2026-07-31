<?php  require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');


include('../smtp.php');
$query="SELECT * FROM siteconfig where ID='1'";
$configdata=mysqli_query($con,$query) or svr_db_fail($con); 
$info=mysqli_fetch_array($configdata);
$qry="select * from cms where cms_id='9'";
$qry1=mysqli_query($con,$qry);
$row3=mysqli_fetch_array($qry1);

$mememail=$_POST['emailto'];			
$query1="SELECT * FROM register where ConfirmEmail='$mememail'";
$forpass=mysqli_query($con,$query1) or svr_db_fail($con); 
$forpass1=mysqli_fetch_array($forpass);
$matriid=$forpass1['MatriID'];

	
if($forpass1>0)
{
		
		$id=$forpass1['MatriID'];
		$name=$forpass1['Name'];
		
		$subject =$_POST['subject'];
		$strbody =$_POST['Message'];
		$strbody=str_replace("\"","'",$strbody);
		$strbody=str_replace("\'","'",$strbody);
		$strbody=str_replace("\&#39;","'",$strbody);
		$webfriendlyname=$info['WebFriendlyname'];
		$logo =$info['Weblogopath'];
		$Webname=$info['Webname'];
		$dates=date('d-m-Y');
		$message = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Personal mail</title>

</head>

<body>
<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
  <tr>
  
    <td width='222'><img src='http://localhost/SVR/css3/assets/shivraj-logo.png' width='168' height='50'  alt=''/></td>
    <td colspan='2' align='center' valign='middle'>Date:$dates </td>
  </tr>
  <tr>
    
  </tr>
  <tr>
    <td height='20' colspan='3'><p>Dear $name,<br>
      Subject: $subject  <br>
    </p></td>
  </tr>
  
  <tr>
    <td colspan='2' valign='top'>$strbody<br></td>
    <td width='24'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Warm Regards,</td>
    <td width='221'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='2'>Team: <a href='#'>$Webname </a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
";
	$subject='Personal Mail';
	$email=$mememail;
	$mail->Subject=$subject;
	$mail->MsgHTML($message);
	$msg="";
	if($mememail!="")
	{
			set_time_limit(30);
			$mail->ClearAddresses();
			$mail->AddAddress($mememail);
			$mail->Send();
			$msg="Your E-mail is Send Successfuly!";
        echo $msg;
		$insert=mysqli_query($con,"insert into group_mail(MatriID,name,email,memtype,gender,marital_status,subject,mail_send,mail_type,date) values('$id','$name','$mememail','NULL','NULL','NULL','$subject','$strbody','Personal',NOW())");
	 
		
        

	}
    header("location:profile_view?msg=success&flag=17&ID=$matriid");
	
 ?>
<?php  
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);

	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}
}
else
{
	$msg="Oops.! We Can't Found Your Record.";
}
?>