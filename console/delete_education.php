<?php require_once('../includes/bootstrap.php'); 
require_once(dirname(__FILE__).'/protect.php');
	
	$id=$_GET['id'];
	echo $id;
	$check=$_GET['flag'];
	
	
	if($check==1)
	{
		$q="Update education SET status='disable' where id='$id'";
		echo "Update education SET status='disable' where id='$id'";
		header("location:add_education?ID='$id'&msg=delete&flag=1" );
		
		mysqli_query($con,$q);
	}
	else
	{
		$q="Update education SET status='enable' where id='$id'";
		
		mysqli_query($con,$q);
		header("location:add_education?ID='$id'&msg=delete&flag=0");
	
	}
	
	
?>