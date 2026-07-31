<?php require_once('includes/bootstrap.php');





$strid=$_SESSION['matriid'] ?? ($_SESSION['MatriID'] ?? '');
$login=$_SESSION['MatriID'] ?? $strid;
if($strid == '') {
	header('Location: login');
	exit;
}
$_SESSION['matriid'] = $strid;
$_SESSION['MatriID'] = $login;
$matriid=$_SESSION['tempid'] ?? $strid;
$mobile=$_SESSION['mobile'] ?? '';
$password=isset($_SESSION['pwd']) ? base64_decode($_SESSION['pwd']) : '';


	$sql=mysqli_query($con,"select * from  register WHERE MatriID='$matriid' ");
	$row=mysqli_fetch_array($sql);
	
 
	$emailsql=mysqli_query($con,"select * from  email_sending WHERE id='1' ");
	$mailinfo =mysqli_fetch_array($emailsql);

	$websql=mysqli_query($con,"select * from siteconfig WHERE ID='1' ");
	$webinfo=mysqli_fetch_array($websql);
	
	$qry="select * from cms where link='contact us'";
	$qry1=mysqli_query($con,$qry);
	$row2=mysqli_fetch_array($qry1);

	$pwd1=substr($row['ConfirmPassword'],strlen($row['ConfirmPassword'])-2);

	$pwdstar="";
		for($i=0;$i<strlen($row['ConfirmPassword'])-2;$i++)
		{
			$pwdstar.="*";
		}
		
	?>

<?php


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Loading</title>
<style>
html, body {
	margin: 0;
	min-height: 100%;
	font-family: Arial, sans-serif;
	background: #FFFDFB;
}
.page-loader-wrapper {
	position: fixed;
	inset: 0;
	z-index: 999999;
	display: flex;
	align-items: center;
	justify-content: center;
	background: #ffffff;
}
.loader {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 18px;
	color: #5E1426;
	font-size: 16px;
	font-weight: 600;
}
.preloader {
	position: relative;
	width: 74px;
	height: 74px;
	border: 5px solid rgba(201, 85, 106, 0.18);
	border-top-color: #C9556A;
	border-right-color: #5E1426;
	border-radius: 50%;
	animation: loader-spin 0.8s linear infinite;
}
.preloader::after {
	content: "";
	position: absolute;
	left: 50%;
	top: 50%;
	width: 34px;
	height: 34px;
	transform: translate(-50%, -50%);
	border-radius: 50%;
	background: url("branding/images/splash-logo.jpg") center / contain no-repeat;
}
.spinner-layer,
.circle-clipper,
.circle {
	display: none;
}
.loader::after {
	content: "Please wait...";
}
@keyframes loader-spin {
	to { transform: rotate(360deg); }
}
</style>
</head>
<body>
<div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
           <!-- <p>Please wait...</p>-->
        </div>
    </div>
    <script language="javascript">
	function change_theme(color)
	{
		var url=document.URL;
		window.location="change_theme.php?color="+color+"&url="+url;	
	}
	</script>
<?php


$safeMatriID = mysqli_real_escape_string($con, $_SESSION['matriid']);
$update1 = mysqli_query($con,"update register set LastLogin=NOW() WHERE MatriID='".$safeMatriID."'");

$Insert1 = mysqli_query($con,"UPDATE register SET Thislogin = NOW() WHERE MatriID='".$safeMatriID."'");

$authent = mysqli_query($con,"SELECT * FROM register where MatriID='".$safeMatriID."'") or svr_db_fail($con);


          
		if($row = mysqli_fetch_array($authent))
		{
			$Strname=$row['Name'];
			$Strstatus=$row['Status'];
			$_SESSION['status'] = $row['Status'];
			$_SESSION['gender'] = $row['Gender'];	
			$_SESSION['name'] = $row['Name'];
			$_SESSION['welcome1']="welcome";
			if ($Strstatus == "Banned")
			{
				print "<script>";
				print " setTimeout(function(){ self.location='logoutbanned'; }, 700);"; // Comment this line if you 						don't want to redirect
				print "</script>";
			}
			else if(($_GET['pay'] ?? '') =='yes')
			{
				print "<script>";
				print " setTimeout(function(){ self.location='invoice'; }, 700);"; // Comment this line if you don't want to redirect
				print "</script>";
			}else {	
				$_SESSION['Smname']=$Strname;
				$_SESSION['MStatus']=$Strstatus;
				$check_flag = $row['auto_approve'];
				if($check_flag == 0)
				{
					print "<script>";
					print " setTimeout(function(){ self.location='approval_wait?id=$login '; }, 700);"; // Comment this line if you don't want to redirect
					print "</script>";
					
				}
				else{
					print "<script>";
					print " setTimeout(function(){ self.location='index_dashboard'; }, 700);";
					print "</script>";	
				}
			}
		}
		else
		{
			header('Location: login');
			exit;
		}
		
?>
</body>
</html>
