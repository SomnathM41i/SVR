<?php require_once('../includes/bootstrap.php');   
require_once(dirname(__FILE__).'/protect.php');

	$id=$_GET['id'];  
    echo $id;
	$q="delete from successstory where ID='$id'";
    mysqli_query($con,$q);
	header('location:delete_success_story?msg=success');
exit;
?>