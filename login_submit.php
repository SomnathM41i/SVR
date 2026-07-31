<?php require_once('includes/bootstrap.php');
require_once('includes/security.php');

/* SECURITY (H3): CSRF token check - forged cross-site logins are rejected. */
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !svr_csrf_verify(isset($_POST['svr_csrf']) ? $_POST['svr_csrf'] : '')) {
    header('Location:login?action=wrong');
    exit;
}


$myusername = $db->setfilter( $_REQUEST['txtusername'] );
$mypassword = $db->setfilter( $_REQUEST['txtpassword'] );




$remember= $_POST['remember_me'];

/* SECURITY (H4): the remember-me cookie no longer stores the PASSWORD.
   Only the username is remembered; the legacy userpassword cookie is always
   expired. Cookies are HttpOnly/SameSite=Lax (Secure on HTTPS). */
if(!empty( $_POST["remember_me"] ) )
{
	svr_set_cookie("user_login", $_POST["txtusername"], time()+ (10 * 365 * 24 * 60 * 60));
	svr_set_cookie("userpassword", "", time() - 3600);
}
else
{
	if( isset( $_COOKIE["user_login"] ) )
	{
		svr_set_cookie("user_login", "", time() - 3600);
	if( isset( $_COOKIE["userpassword"] ) )
	{
		svr_set_cookie("userpassword", "", time() - 3600);
	}
	}
}
/* SECURITY (H5): throttle member logins - 5 attempts / 10 min per username+IP. */
if (!svr_throttle('login:' . strtolower($myusername) . ':' . svr_client_ip(), 5, 600)) {
	header('Location:login?action=wrong');
	exit;
}

$var=base64_encode($mypassword);
$sql1=mysqli_query($con,"select * from register");
while($row=mysqli_fetch_array($sql1))
{
	if($row['MatriID'] == $myusername && $row['ConfirmPassword'] == $var)
	{
		
		$sql="select * from register where MatriID='$myusername' and ConfirmPassword='$var'";
		$rs = mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp = mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where MatriID='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['ConfirmEmail'] == $myusername && $row['ConfirmPassword']== $var)
	{
		
		$sql="select * from register where ConfirmEmail='$myusername' and ConfirmPassword='$var'";
		
		$rs=mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where ConfirmEmail='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['ConfirmEmail'] == $myusername && $row['ConfirmPassword']== $mypassword)
	{
		
		$sql="select * from register where ConfirmEmail='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where ConfirmEmail='$myusername' and ConfirmPassword='$mypassword'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['MatriID'] == $myusername && $row['ConfirmPassword'] == $mypassword)
	{
		
		$sql="select * from register where MatriID='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where  MatriID='$myusername' and ConfirmPassword='$mypassword' ");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['Mobile'] == $myusername && $row['ConfirmPassword'] == $var)
	{
		
		$sql="select * from register where Mobile='$myusername' and ConfirmPassword='$var'";
		$rs=mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where  Mobile='$myusername' and ConfirmPassword='$var'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
	else if($row['Mobile'] == $myusername && $row['ConfirmPassword']==$mypassword)
	{
		
		$sql="select * from register where Mobile='$myusername' and ConfirmPassword='$mypassword'";
		$rs=mysqli_query($con,$sql) or svr_db_fail($con);
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where Mobile='$myusername' and ConfirmPassword='$mypassword'");
		$fetchotp1 = mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
}

if($count == 1)
{
	
	if($fetchotp['otp']=="yes")
	{
		
		if($count == 1)
		{
							 
			if(isset($_REQUEST['remember']))
			{
				
				$remember =	$_REQUEST['remember'];	
				setcookie("MatriID",$_REQUEST['txtusername'],time()+31556926);	
					
			}
			
			/* SECURITY (H11): regenerate the session id at privilege change and
			   clear the login throttle bucket on success. */
			session_regenerate_id(true);
			svr_throttle_reset('login:' . strtolower($myusername) . ':' . svr_client_ip());
			$_SESSION['matri_login']=$fetchotp['MatriID'];
			
			$_SESSION['matriid']=$fetchotp['MatriID'];
			$_SESSION['myusername']=$fetchotp['MatriID'];
			/* new session*/
			$_SESSION['MatriID']=$fetchotp['MatriID'];
			/* end new session */
			
			$_SESSION['gend']=$fetchotp['Gender'];
			$strid=$fetchotp['MatriID'];
			
			$_SESSION['MStatus']=$fetchotp['status'];
			
			$_SESSION['Smname']=$fetchotp['Name'];
			$name123=explode(" ",$fetchotp['Name']);
			$_SESSION['Fmname']=$name123[0];
			$_SESSION['Lmname']=$name123[1];
			
			$_SESSION['EmailID']=$fetchotp['ConfirmEmail'];
			$_SESSION['welcome']='txtt';
			/* SECURITY (H4): the plaintext password is no longer copied into the
			   session (nothing in the codebase reads $_SESSION['password']). */
				  
			$_SESSION['login_user_name'] = $fetchotp['Name'];
			
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
				
				$actid=$rowfl['profile_id'];
				$sqlwish=mysqli_query($con,"select DOB from register where MatriID='$actid'");				
				while($rowwish=mysqli_fetch_array($sqlwish))
				{
					
					$arrbdate=explode("-",$rowwish['DOB']);
					if($arrbdate[1]==date('m') && $arrbdate[2]==date('d'))
					{
						
						$arrwish[$cntwish]=$actid;
					}
				}
				
				$sqlact=mysqli_query($con,"select * from activity where matri_id='$actid' or matri_id='$strid'");				
				while($rowact=mysqli_fetch_array($sqlact))
				{
						
						$arractidtemp[$cnt]=$rowact['act_id'];
						$cnt++;
				}	
			}
			
			$arractid=array_unique($arractidtemp);
			rsort($arractid);
			
			
			if(count($arrwish)>0)
			{
				
				$dt=date('Y-m-d');
			
				$sqlcheck=mysqli_query($con,"select * from activity where act_date='$dt' and matri_id='$strid'");
				if(mysqli_num_rows($sqlcheck)==0)
				{
					
					$bday=implode(",",$arrwish);
					mysqli_query($con,"insert into activity(matri_id,act_type,act_date,act_desc) values('$strid','bday','$dt','$bday')");

				}
			}
			
			$matriid=$fetchotp['MatriID'];
            if($fetchotp['reg_step']=='1')
			{
					
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
				
				
				print "<script>";
			print " self.location='pageloader1';"; // Comment this line if you don't want to redirect
			print "</script>";
				exit;
				
				
			}
		}
		
	}
	else
	{
		
		
		$_SESSION['otp_user']=$myusername;
		
	}
}
else
{
	
	header('Location:login?action=wrong');
	exit;
	
}
?>
