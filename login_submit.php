<?php require_once('sys_dbconnection.php');
require_once('includes/security.php');
/*session_start();
include'dbconnectadmin.php';
//error_reporting(0);
*/
/* SECURITY (H3): CSRF token check - forged cross-site logins are rejected. */
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !svr_csrf_verify(isset($_POST['svr_csrf']) ? $_POST['svr_csrf'] : '')) {
    header('Location:login?action=wrong');
    exit;
}
//print_r($_POST); exit;
/*$myusername = $db->setfilter( $_POST['txtusername'] );
$mypassword = $db->setfilter( $_POST['txtpassword'] );*/
$myusername = $db->setfilter( $_REQUEST['txtusername'] );
$mypassword = $db->setfilter( $_REQUEST['txtpassword'] );
//echo $_GET['txtusername'];
/*echo $myusername.'<br>';
echo $mypassword.'<br>';*/
/*echo $myusername;
echo $mypassword;*/
/*$myusername =  $_POST['txtusername'] ;
$mypassword =  $_POST['txtpassword'] ;*/
$remember= $_POST['remember_me'];

if(!empty( $_POST["remember_me"] ) ) 
{
	//COOKIES for username
	setcookie ("user_login",$_POST["txtusername"],time()+ (10 * 365 * 24 * 60 * 60));
	//COOKIES for password
	setcookie ("userpassword",$_POST["txtpassword"],time()+ (10 * 365 * 24 * 60 * 60));
} 
else 	
{
	if( isset( $_COOKIE["user_login"] ) ) 
	{
		setcookie ("user_login","");
	if( isset( $_COOKIE["userpassword"] ) ) 
	{
		setcookie ("userpassword","");
	}
	}
}

$var=base64_encode($mypassword);
$sql1=mysqli_query($con,"select * from register");
while($row=mysqli_fetch_array($sql1))
{
	if($row['MatriID'] == $myusername && $row['ConfirmPassword'] == $var)
	{
		/*echo "1".'<BR>';*/
		$sql="select * from register where MatriID='$myusername' and ConfirmPassword='$var'";
		$rs = mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp = mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where MatriID='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['ConfirmEmail'] == $myusername && $row['ConfirmPassword']== $var)
	{
		/*echo "2".'<BR>';*/
		$sql="select * from register where ConfirmEmail='$myusername' and ConfirmPassword='$var'";
		/*echo "select * from register where ConfirmEmail='$myusername' and ConfirmPassword='$var'"."<BR>";*/
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where ConfirmEmail='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['ConfirmEmail'] == $myusername && $row['ConfirmPassword']== $mypassword)
	{
		/*echo "3".'<BR>';*/
		$sql="select * from register where ConfirmEmail='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where ConfirmEmail='$myusername' and ConfirmPassword='$mypassword'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['MatriID'] == $myusername && $row['ConfirmPassword'] == $mypassword)
	{
		/*echo "4".'<BR>';*/
		$sql="select * from register where MatriID='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where  MatriID='$myusername' and ConfirmPassword='$mypassword' ");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['Mobile'] == $myusername && $row['ConfirmPassword'] == $var)
	{
		/*echo "5".'<BR>';*/
		$sql="select * from register where Mobile='$myusername' and ConfirmPassword='$var'";
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where  Mobile='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['Mobile'] == $myusername && $row['ConfirmPassword']==$mypassword)
	{
		/*echo "6".'<BR>';*/
		$sql="select * from register where Mobile='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where Mobile='$myusername' and ConfirmPassword='$mypassword'");
		$fetchotp1 = mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
}
/*echo $count.'<BR>';*/
if($count == 1)
{
	/*echo "7".'<BR>';*/
	if($fetchotp['otp']=="yes")
	{
		/*echo "8".'<BR>';*/
		if($count == 1)
		{
			/*echo "9".'<BR>';*/				 
			if(isset($_REQUEST['remember']))
			{
				/*echo "10".'<BR>';*/
				$remember =	$_REQUEST['remember'];	
				setcookie("MatriID",$_REQUEST['txtusername'],time()+31556926);	
					//echo $_COOKIE["MatriID"];
			}
			/*echo "11".'<BR>';*/
			$_SESSION['matri_login']=$fetchotp['MatriID'];
			// $_SESSION['profile']=mysql_result($rs,0);
			$_SESSION['matriid']=$fetchotp['MatriID'];
			$_SESSION['myusername']=$fetchotp['MatriID'];
			/* new session*/
			$_SESSION['MatriID']=$fetchotp['MatriID'];
			/* end new session */
			//$_SESSION['gend']=mysql_result($rs,0,'Gender');
			$_SESSION['gend']=$fetchotp['Gender'];
			$strid=$fetchotp['MatriID'];
			//$_SESSION['MStatus']=mysql_result($rs,0,'status');
			$_SESSION['MStatus']=$fetchotp['status'];
			//$_SESSION['Smname']=mysql_result($rs,0,'Name');
			$_SESSION['Smname']=$fetchotp['Name'];
			$name123=explode(" ",$fetchotp['Name']);
			$_SESSION['Fmname']=$name123[0];
			$_SESSION['Lmname']=$name123[1];
			//$_SESSION['EmailID']=mysql_result($rs,0,'ConfirmEmail');
			$_SESSION['EmailID']=$fetchotp['ConfirmEmail'];
			$_SESSION['welcome']='txtt';
			//$_SESSION['password'] = mysql_result($rs,0,'ConfirmPassword');
			$_SESSION['password'] = $fetchotp['ConfirmPassword'];
				  //$_SESSION['login_user_name']=mysql_result($rs,0,'Name');
			$_SESSION['login_user_name'] = $fetchotp['Name'];
			//$_SESSION['login_user_status']=mysql_result($rs,0,'Status');
			$_SESSION['login_user_status'] = $fetchotp['Status'];
			$id=$_SESSION['matriid'];
			$theme=mysqli_query($con,"select * from register where MatriID='".$_SESSION['matri_login']."'"); 
		    $theme1=mysqli_fetch_array($theme);
			date_default_timezone_set("Asia/Kolkata");
			$dt=date('Y-m-d');
			$hr=date('h');
			$min=date('i');
			$sec=date('s');
			$am=date('a');  
			mysqli_query($con,"update register set last_seen_date='$dt',last_seen_hour='$hr',last_seen_min='$min',last_seen_am='$am' where MatriID='$id'");
			mysqli_query($con,"update register set online_status='Online' where MatriID='$id'");
			$cnt=0;
			$cntwish=0;
			date_default_timezone_set("Asia/Kolkata");
			$arractidtemp=array();
			$arrwish=array();
        	$sqlfl=mysqli_query($con,"select * from followers where follower_id='$strid'");
			while($rowfl=mysqli_fetch_array($sqlfl))
			{
				/*echo "12".'<BR>';*/
				$actid=$rowfl['profile_id'];
				$sqlwish=mysqli_query($con,"select DOB from register where MatriID='$actid'");				
				while($rowwish=mysqli_fetch_array($sqlwish))
				{
					/*echo "13".'<BR>';*/
					$arrbdate=explode("-",$rowwish['DOB']);
					if($arrbdate[1]==date('m') && $arrbdate[2]==date('d'))
					{
						/*echo "14".'<BR>';*/
						$arrwish[$cntwish]=$actid;
					}
				}
				/*echo "15".'<BR>';*/
				$sqlact=mysqli_query($con,"select * from activity where matri_id='$actid' or matri_id='$strid'");				
				while($rowact=mysqli_fetch_array($sqlact))
				{
						/*echo "16".'<BR>';*/
						$arractidtemp[$cnt]=$rowact['act_id'];
						$cnt++;
				}	
			}
			/*echo "17".'<BR>';*/
			$arractid=array_unique($arractidtemp);
			rsort($arractid);
			/*print_r($arrwish);*/
			/*echo count($arrwish);*/
			if(count($arrwish)>0)
			{
				/*echo "18".'<BR>';*/
				$dt=date('Y-m-d');
			
				$sqlcheck=mysqli_query($con,"select * from activity where act_date='$dt' and matri_id='$strid'");
				if(mysqli_num_rows($sqlcheck)==0)
				{
					/*echo "19".'<BR>';*/
					$bday=implode(",",$arrwish);
					mysqli_query($con,"insert into activity(matri_id,act_type,act_date,act_desc) values('$strid','bday','$dt','$bday')");

				}
			}
			//mysql_query("update register set reg_step='9' where MatriID='$id'");
			$matriid=$fetchotp['MatriID'];
            if($fetchotp['reg_step']=='1')
			{
				/*echo "20".'<BR>';*/	
				header('location:register_success?id='.$matriid);
				exit;
			}
			else if($fetchotp['reg_step']=='2')
			{
				header('location:horoscope?id='.$matriid);
				exit;
			}
			else if($fetchotp['reg_step']=='3')
			{
				header('location:contact?id='.$matriid);
				exit;
			}
			else if($fetchotp['reg_step']=='4')
			{
				header('location:education?id='.$matriid);
				exit;
			}
			/*else if($fetchotp['reg_step']=='5')
			{
				header('location:physical.php?id='.$matriid);
				exit;
			}*/
			else if($fetchotp['reg_step']=='5')
			{
				header('location:family?id='.$matriid);
				exit;
			}	
			else if($fetchotp['reg_step']=='6')
			{
				header('location:upload_photo?id='.$matriid);
				exit;
			}	
            else if($fetchotp['reg_step']=='7')
			{
				header('location:upload_idproof?id='.$matriid);
				exit;
			}	
			else if($fetchotp['reg_step']=='8')
			{
				header('location:partner_prefrence?id='.$matriid);
				exit;
			}
			else
			{
				/*echo '<BR>'."07".'<BR>';*/
				/*header('Location: pageloader1');*/
				print "<script>";
			print " self.location='pageloader1';"; // Comment this line if you don't want to redirect
			print "</script>";
				exit;
				
				
			}
		}
		/*else
		{         
			echo "22".'<BR>';
			header('Location:login?action=wrong');
			exit;
		}*/
	}
	else
	{
		/*echo "20".'<BR>';*/
		//$_SESSION['emailtemp']=$myusername;
		$_SESSION['otp_user']=$myusername;
		//header('location:../user_regsiter///');
	}
}
else
{
	/*echo "21".'<BR>';*/
	header('Location:login?action=wrong');
	exit;
	
}
?>
