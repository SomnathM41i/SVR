<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
	/*include'../dbconnectadmin.php';*/
	$id=$_GET['id'];
	//echo $id;
	//exit;
	$check=$_GET['flag'];
	//echo $id;
	//echo $check;
	if($check==1)
	{
		$q="Update iit SET status='disable' where Iid='$id'";
		echo "Update iit SET status='disable' where Iid='$id'";
		header("location:add_institue?ID='$id'&msg=delete&flag=1" );
		//echo "Update education SET status='disable' where edu='$id'"; 
		mysqli_query($con,$q);
	}
	else
	{
		$q="Update iit SET status='enable' where Iid='$id'";
		//echo "Update education SET status='enable' where edu='$id'"; 
		mysqli_query($con,$q);
		header("location:add_institue?ID='$id'&msg=delete&flag=0");
	
	}
	
	//exit;
?>