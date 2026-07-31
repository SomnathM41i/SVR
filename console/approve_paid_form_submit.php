<?php

// Source - https://stackoverflow.com/a/21429652
// Posted by Fancy John, modified by community. See post 'Timeline' for change history
// Retrieved 2026-03-14, License - CC BY-SA 4.0

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once('../includes/bootstrap.php');   
include('protect.php');
include_once('agent_common.php');


$matriid = $_POST['matriid'];
$sqlrenew=$con->query("select * from register where MatriID='$matriid'");
$rowrenew=$sqlrenew->fetch_array();

$nm=$rowrenew['Name'];
$stroid = $_POST['oid'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = addslashes($_POST['address']);
$mode = $_POST['mode'];
$mobile=$rowrenew['Mobile'];
$activation_date = $_POST['activation_date'];
$plan = $_POST['txtplan'];
$discountcode = $_POST['discountcode'];


if($rowrenew['Status']=="Expired" || $rowrenew['Status']=="Active")
{
$duration = $_POST['duration'];
$contacts = $_POST['contacts'];
}
else
{
$sqlexp=$con->query("SELECT DATEDIFF( Memshipexpirydate,CURRENT_DATE ) as exp FROM register WHERE MatriID='$matriid'");
$rowexp=$sqlexp->fetch_array();

$duration = $_POST['duration']+$rowexp['exp'];
$contacts = $_POST['contacts']+$rowrenew['Noofcontacts'];	
}

$amount = $_POST['amount1'];
$discount=$_POST['discount'];
$bank_details = addslashes($_POST['bank_details']);
$agent_id = isset($_POST['agent_id']) ? (int)$_POST['agent_id'] : 0;

$memtype = $_POST['txtplanname'];
$ry=$con->query("select * from membershipplan where planname='".$memtype."'");
$ty=$ry->fetch_array();
$memtyp1=$ty['plandisplayname'];
$planId = (int)($ty['planid'] ?? 0);

$commissionSource = 'Manual Customer Purchase';
if ($rowrenew['Status'] === 'Paid' && $rowrenew['memtype'] !== '' && $rowrenew['memtype'] !== 'Free' && strtotime($rowrenew['MemshipExpiryDate']) >= strtotime(date('Y-m-d'))) {
	$commissionSource = ($rowrenew['memtype'] === $memtyp1) ? 'Package Renewal' : 'Package Upgrade';
}

$linkedAgentCustomer = agent_find_agent_customer_for_user(
	$con,
	(int)($rowrenew['ID'] ?? 0),
	$matriid,
	$mobile,
	$email
);
$agentCustomerId = 0;
if ($linkedAgentCustomer) {
	$agentCustomerId = (int)$linkedAgentCustomer['customer_id'];
	if ($agent_id <= 0) {
		$agent_id = (int)$linkedAgentCustomer['agent_id'];
	}
}

$strstatus = "Clear";

// insert the data
$insert = $con->query("insert into paiddetails (Poid,Pmatriid,Pname,Pemail,Paddress,Ppaymode,Pactivedate,Pplan,memtype,Pplanduration,Pnocontct,Pamount,Pbankdet,Pstatus,discountcode) values ('$stroid','$matriid','$name','$email','$address','$mode','$activation_date','$plan','$memtype','$duration','$contacts','$amount','$bank_details','$strstatus','$discountcode')") or die("Could not insert data because ".mysqli_error());


if ($agent_id > 0) {
	agent_create_commission_for_sale_shared($con, $stroid, $matriid, $name, $mobile, $email, $agent_id, $plan, $amount, $activation_date, array(
		'plan_id' => $planId,
		'commission_source' => $commissionSource,
		'payment_reference_id' => $stroid,
		'agent_customer_id' => $agentCustomerId,
		'auto_source_by_history' => true
	));
	$stmtAgentCustomer = $con->prepare("UPDATE agent_customers SET customer_status='Purchased', plan_id=?, plan_name=?, updated_at=NOW() WHERE agent_id=? AND ((customer_id > 0 AND customer_id=?) OR (customer_mobile <> '' AND customer_mobile=?) OR (customer_email <> '' AND customer_email=?))");
	if ($stmtAgentCustomer) {
		$stmtAgentCustomer->bind_param("isiiss", $planId, $plan, $agent_id, $agentCustomerId, $mobile, $email);
		$stmtAgentCustomer->execute();
		$stmtAgentCustomer->close();
	}
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$followers = $con->query("select *from followers where follower_id = '$matriid'");
if(mysqli_num_rows($followers)>0)
{
		while($follow_row = $followers->fetch_assoc())
		{
			$paid_follow =$con->query("insert into notification(noti_sender,noti_receiver,notification_type,notification_desc) values('$matriid','".$follow_row['profile_id']."','paid member','is a Paid Member')");
		}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////// UPDATE INTO REGISTER TABLE ////////////////////////
$strmid = $_POST['matriid'];


$strexpdate = date('Y-m-d', strtotime("+$duration days")); 

$update=$con->query("Update register set Status='Paid',memtype='$memtyp1',MemshipExpiryDate='$strexpdate',Noofcontacts='$contacts' where MatriID = '$strmid' ")
or die("Could not update data because ".mysqli_error());?>

<?php  

//echo


//exit();
?>

<?php  






             



// 			<html>
// 			<head>
// 			<meta charset='utf-8'>

// 			</head>

// 			<body>
// 			<table width='467' border='0' style='font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif' cellpadding='0' cellspacing='0'>
//                 <tr>
//                 <td width='222'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png' width='149' height='66'  alt=''/></td>

//                 </tr>
//                 <tr>
                
//                 </tr>
                
//                 <tr>
//                 <td colspan='3'>


//                 </tr>
                
//                 <br>
//                 <tr>
// 				<td colspan='2'>Note:Thank you for your purchase! Please note that all sales are final and non-refundable. For any queries or assistance, kindly reach out to us within 48 hours. We appreciate your understanding and support.</td>
// 				<td width='24'>&nbsp;</td>
// 			  </tr>
//                 <tr>
// 				<td><a href='https://www.sahivivahmatrimony.com'>sahivivahmatrimony.com</a></td>
// 				<td>&nbsp;</td>
// 				<td>&nbsp;</td>
// 			  </tr>
// 			</table>
// 			</body>
// 			</html>
// 			";


            

//             {



//             {

//             }

?>




<?php  $configdata1 = $con->query("SELECT * FROM siteconfig where id='1'");
$siteinfo= $configdata1->fetch_array(); 

$smsMessage="Hello '".$nm."',
You Have Selected '".$plan."'
Your Plan Has Been Successfully Activated

Thank You
Team-  ".$siteinfo['Webname']."";




<!---------------------------Email Sending-------------->
<?php  $qry=mysqli_query($con,"select * from cms where link='contact us'");

$row=mysqli_fetch_array($qry);




$query=$con->query("SELECT * FROM siteconfig where ID='1'");
$info=$query->fetch_array();
		$mememail=$rowrenew['ConfirmEmail'];
		$webfriendlyname=$info['WebFriendlyname'];
		$Webname=$info['Webname'];
		$logo =$info['Weblogopath'];
		
	$message1="<!DOCTYPE html>
				<html lang='en'>
				<head>
				<meta charset='utf-8' />
				<title>readymatrimonial.in</title>
				<script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
				<meta name='description' content='' />
				<meta name='keywords' content='' />
				<meta name='rating' content='general' />
				<meta name='copyright' content='2013,' />
				<meta name='revisit-after' content='31 Days' />
				<meta name='expires' content='never'> 
				<meta name='distribution' content='global' />
				<meta name='robots' content='index,follow' />
				<link rel='stylesheet' href='http://readymatrimonial.in/6.0/console/email-send/css/style.css' type='text/css'>
				</head>
				<body style='margin: 0 auto;width: 100%; background: #ccc; text-align:justify;'>
				
				<div class='wrapper' style='margin: 0 auto;	width: 590px;background: #333;'>
				<div class='wrapper-float' style='float:left;margin: 0;width: 590px;background: #c5191f;'>
				<div class='sub-wrapper' style='float: left;width: 570px; background: #f7f7f7;margin: 10px;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;'>
					
						<div class='logo' style='margin:25px 0 0 10px;float: left;	margin: 7% 0 0 25%;'><a href='http://readymatrimonial.in/6.0/index.php' target='_blank' style='transition: all 0.3s ease-in-out;-webkit-transition: all 0.3s ease-in-out;-moz-transition: all 0.3s ease-in-out;-ms-transition: all 0.3s ease-in-out;-o-transition: all 0.3s ease-in-out;text-decoration: none;'><img src='https://weddingsparampara.com/branding/logos/logo-horizontal.png'></a></div>
				<img src='http://readymatrimonial.in/6.0/console/email-send/images/registration-confirmation-icon.png' style='margin:20px 30px 0 0; float:right;'>
					<br><br>
				
			
						 
			 <table width='570' height='50' border='1' style='font-family:Verdana; font-size:14px; color:#919191; border:#bbb7b7; border-collapse:collapse' cellpadding='2' cellspacing='0'>		
			 <tr>
			<td height='35' bgcolor='#ff5a60' ><span style='color:#FFF; font-size:18px'>Payment Successfully</span></td>
		  </tr>
		  </table>		  	
				<div class='cont-wrapper' style='margin:163px 10px 15px 10px; background:none;float: left;width: 549px;margin: 10px 10px 15px 10px;'>
			   <p class='content' style='font-family: 'AvantGardeBkBTBook';font-weight: bold;font-size: 14px;color: #000;text-align: left;line-height: 23px;text-align: left;'>
				Dear  ".$nm.",
			<p style='color:#000000'>Welcome to readymatrimonial, You Are Now Paid Member</p>
		<table width='550' height='300' border='1' style='font-family:Verdana; font-size:14px; color:#919191; border:#bbb7b7; border-collapse:collapse' cellpadding='2' cellspacing='0'>			
			<tr>
    <td align='center' style='font-family:Verdana, font-size:36px, color:#000000'> You Have Selected : 
    ".$plan."<br></td>
  </tr>
   <tr>
    <td align='center' style='font-family:Verdana, font-size:36px, color:#000000'>Amount : 
    ".$amount."<br></td>
  </tr>
   <tr>
    <td align='center' style='font-family:Verdana, font-size:36px, color:#000000'>Duration : 
    ".$duration."<br></td>
  </tr>
   <tr>
    <td align='center' style='font-family:Verdana, font-size:36px, color:#000000'>No Of Contacts : 
    ".$contacts."<br></td>
  </tr>
   
 
  </table><br>
				Warm Regards,<br>
				<span class='color-2' style='color: #c5191f;'> $Webname </span> Team<br>
				$Webname  to visit this site. 
				</p>
				</div>
				</div>
				</div>
				</div>
				</body>
				</html>";
	
	$subject="Payment Details";

	

	$msg="";
	if($email!="")
	{
			set_time_limit(30);
		
		
		
		
			$msg="Your E-mail is Send Successfuly!";
	}
	
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

header("location:profile_view?ID=$matriid&flag=11&msg=success");
?>
