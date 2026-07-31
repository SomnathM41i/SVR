<?php
/*
session_start();
include'dbconnectadmin.php';
//$fname=mysqli_real_escape_string($con,$_POST['fname']);
//$lname=mysqli_real_escape_string($con,$_POST['lname']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$id=mysqli_real_escape_string($con,$_POST['id']);
echo $id;
echo $name;
echo $email;
/*echo $_SESSION['matriid'];
$matriid=$_SESSION['matriid'];
*//*
$sql1=mysqli_query($con,"select * from register");
while($row=mysqli_fetch_array($sql1))
{
	if( $row['facebook_id']==$id )
	{
		$sql=" select * from register where facebook_id='$id' ";
		echo " select * from register where facebook_id='$id' ";
		$rs=mysqli_query($con,$sql) or die(mysqli_error());
		$fetchotp=mysqli_fetch_assoc($rs);
		$sql1=mysqli_query($con,"select  COUNT(*) from register where facebook_id='$id'");
		$fetchotp1=mysqli_fetch_array($sql1);
		$count=$fetchotp1[0];
	}
}
*/
?>
<?php

	session_start();
	include'dbconnectadmin.php';
	//$fname=mysqli_real_escape_string($con,$_POST['fname']);
	//$lname=mysqli_real_escape_string($con,$_POST['lname']);
	//$email=mysqli_real_escape_string($con,$_POST['email']);
	$name = mysqli_real_escape_string( $con, $_POST['name'] );
	$id = mysqli_real_escape_string( $con, $_POST['id'] );
	echo $id;
	echo $name;
	//echo $email;
	//echo $_SESSION['matriid'];
	/*$matriid=$_SESSION['matriid'];
	mysqli_query($con," UPDATE register SET facebook_id='$id' WHERE MatriID='$matriid' ");
	echo " UPDATE register SET facebook_id='$id' WHERE MatriID='$matriid' ";
	*/
?>