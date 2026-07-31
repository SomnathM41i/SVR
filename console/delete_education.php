<?php require_once('../sys_dbconnection.php'); 
	/*include'../dbconnectadmin.php';*/
	$id=$_GET['id'];
	echo $id;
	$check=$_GET['flag'];
	//echo $id;
	//echo $check;
	if($check==1)
	{
		$q="Update education SET status='disable' where id='$id'";
		echo "Update education SET status='disable' where id='$id'";
		header("location:add_education?ID='$id'&msg=delete&flag=1" );
		//echo "Update education SET status='disable' where edu='$id'"; 
		mysqli_query($con,$q);
	}
	else
	{
		$q="Update education SET status='enable' where id='$id'";
		//echo "Update education SET status='enable' where edu='$id'"; 
		mysqli_query($con,$q);
		header("location:add_education?ID='$id'&msg=delete&flag=0");
	
	}
	
	//exit;
?>