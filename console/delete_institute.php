<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
	
	$id=$_GET['id'];
	
	
	$check=$_GET['flag'];
	
	
	if($check==1)
	{
		$q="Update iit SET status='disable' where Iid='$id'";
		echo "Update iit SET status='disable' where Iid='$id'";
		header("location:add_institue?ID='$id'&msg=delete&flag=1" );
		
		mysqli_query($con,$q);
	}
	else
	{
		$q="Update iit SET status='enable' where Iid='$id'";
		
		mysqli_query($con,$q);
		header("location:add_institue?ID='$id'&msg=delete&flag=0");
	
	}
	
	
?>