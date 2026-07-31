<?php require_once('../sys_dbconnection.php');   
/*include'../dbconnectadmin.php';*/
	$id=$_GET['id'];  
    echo $id;
	$q="delete from successstory where ID='$id'";
    mysqli_query($con,$q);
	header('location:delete_success_story?msg=success');
exit;
?>