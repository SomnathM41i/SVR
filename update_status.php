<?php 
	require_once('sys_dbconnection.php');
	$id = $_REQUEST['id'];
	$flag = $_REQUEST['flag'];
	$status_query = mysqli_query($con,"SELECT * FROM recommendation WHERE id='$id'");
	$row = mysqli_fetch_array($status_query);
	if($flag == 1){
		mysqli_query($con,"UPDATE recommendation SET status = 'disliked' WHERE id = '$id' ");
	}else{
		mysqli_query($con,"UPDATE recommendation SET status = 'liked' WHERE id = '$id' ");
	}
	
	
	
	
?>