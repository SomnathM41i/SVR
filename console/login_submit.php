<?php require_once('../sys_dbconnection.php');


/*session_start();
include('../dbconnectadmin.php');*/

$uid=$db->setfilter($_POST['userid']);
//echo $uid;
$pwd=$db->setfilter($_POST['password']);
//echo $pwd;
$rs=$con->query("select * from adminlogin where adminusername='$uid' and adminpassword='$pwd'");
//echo "select * from adminlogin where adminusername='$uid' and adminpassword='$pwd'";
//exit;
if(mysqli_num_rows($rs)==1)
{
	$row=$rs->fetch_array();
	if($row['adminpassword']==$pwd)
	{
		$_SESSION['admin_id']=$row['adminusername'];
		
		$_SESSION['id']=$row['id'];	
		header("location:index");
		
		$last=mysqli_query($con,"update  siteconfig set lastlogin=now()");
		
		
	}
	else
	{
		header("location:login?err=Invalid Password");
	}
}
else
{
	header("location:login?err=No Such User");
}
$_SESSION['uid']=$uid;
?>




