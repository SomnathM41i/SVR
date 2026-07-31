<?php




$email=mysqli_real_escape_string($con,$_POST['email']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$id=mysqli_real_escape_string($con,$_POST['id']);
echo $id;
echo $name;
echo $email;

?>
<?php

	session_start();
	include'dbconnectadmin.php';
	
	
	
	$name = mysqli_real_escape_string( $con, $_POST['name'] );
	$id = mysqli_real_escape_string( $con, $_POST['id'] );
	echo $id;
	echo $name;
	
	
	
?>