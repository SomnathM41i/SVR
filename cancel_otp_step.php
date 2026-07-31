<?php 
require_once('sys_dbconnection.php');
require_once('agent_commission_lib.php');
$sql = mysqli_query($con,"SELECT ConfirmEmail FROM register where ConfirmEmail='".$_SESSION['emailtemp']."'");

if(mysqli_num_rows($sql)==0)
{
	$sqlmob=mysqli_query($con,"select Mobile FROM register where Mobile='".$_SESSION['mobile']."'");
	if(mysqli_num_rows($sqlmob)==0)
    {
    	if(mysqli_query($con,$_SESSION['querystr'])!=0)
		{
			$lastid=mysqli_insert_id($con);
			mysqli_query($con,$_SESSION['querystr2']);
			$sql = "SELECT MAX(id) AS max from register";
			$result = mysqli_query($con,$sql) or svr_db_fail($con);
			$row = mysqli_fetch_assoc($result);
			$RID = $lastid;
			$respre=mysqli_query($con,'select * from siteconfig');
			$rowpre=mysqli_fetch_array($respre);
			$ch123=$rowpre['prefix'].$RID;
 			$ch=mysqli_query($con,"select * from deleted_profile where MatriID='$ch123'");
			if(mysqli_num_rows($ch)==0)
			{
    			$rand1=rand(11111,99999);
    			if($_SESSION['Gender']=='Male')
				{
					$mid=$rowpre['prefix'].$rand1;
				}
				else if($_SESSION['Gender']=='Female')
				{
					$mid=$rowpre['prefix'].$rand1;
				}
			}
			else
			{   
				$rand2=rand(11111,99999);
				$mysqk=mysqli_query($con,"select MAX(id) AS max from deleted_profile");
				$mysqk1=mysqli_fetch_array($mysqk);
				$chek=$mysqk1['max'];
				$new=mysqli_query($con,"select * from deleted_profile where ID='$chek'");
				$new1=mysqli_fetch_array($new);
				$new_id=$new1['ID_reg']+1;
				if($_SESSION['Gender']=='Male')
				{
					$mid=$rowpre['prefix'].$rand2;
				}
				else if($_SESSION['Gender']=='Female')
				{
					$mid=$rowpre['prefix'].$rand2;
				}
			}
		}
		$check=mysqli_query($con,"select * from register where MatriID='$mid'");
		$check_fetch=mysqli_fetch_array($check);
		$numrows=mysqli_num_rows($check);
		if($numrows>0)
		{
    		$rand2=rand(11111,99999);
			$mid=$rowpre['prefix'].$rand2; 
			mysqli_query($con,"update register set MatriID='$mid',Age=DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,DOB)),'%y') where ID='$lastid'") or svr_db_fail($con);
    	}
    	else
      	{
      		mysqli_query($con,"update register set MatriID='$mid',Age=DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,DOB)),'%y') where ID='$lastid'") or svr_db_fail($con);
		}
		if(isset($_POST['otp'])!="555777")
		{ 
			mysqli_query($con,"insert into otp_check(otp,MatriID,status)values('".$_SESSION['otp']."','$mid','yes')");
		} else 
		{
			mysqli_query($con,"insert into otp_check(otp,MatriID,status)values('".$code."','$mid','yes')");	 
		}
		/* registration confirmation coding */
		$check=mysqli_query($con,"select * from register where MatriID='$mid'");
		$check_fetch=mysqli_fetch_array($check);
		/* end registration confirmation coding */
		$_SESSION['tempid']=$mid;
	    $_SESSION['matriid']=$mid;
$_SESSION['MatriID']=$mid;
		agent_link_registered_customer($con, $lastid, $mid, $_SESSION['mobile'] ?? '', $_SESSION['emailtemp'] ?? '');
		include('registrationconfirmation.php');
		print "<script>";
		//print " self.location='register_success?id=$mid';"; // Comment this line if you don't want to redirect
		//print " self.location='admin_mail?id=$mid&flag=mail';";
		print "</script>";
		exit;  
	}
	else
	{
		$url1="signup?mobile=The Mobile Number is already Exists";
		header('Location:'.$url1);
	}
}
else
{
	$url="signup?error=The email address is already registered";
	header('Location:'.$url);
}
exit;

?>
