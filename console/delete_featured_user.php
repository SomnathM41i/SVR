<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];

$q="update register set featured_user='No' where MatriId='$id'";
mysqli_query($con,$q);

header("location:featured_user.php?ID=$id&msg=delete");
exit;
?>