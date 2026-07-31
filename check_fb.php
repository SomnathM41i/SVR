<?php
session_start();
include'dbconnectadmin.php';


$email=mysqli_real_escape_string($con,$_POST['email']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$id=mysqli_real_escape_string($con,$_POST['id']);
echo $id;
echo $name;
echo $email;
echo $_SESSION['matriid'];
$matriid=$_SESSION['matriid'];
mysqli_query($con," UPDATE register SET facebook_id='$id' WHERE MatriID='$matriid' ");


?>