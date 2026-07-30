<?php  require_once('../sys_dbconnection.php');
//include'../dbconnectadmin.php';
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update e_city SET status='disable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_city?flag=1&ID=$id&msg=delete");

}
else
{
    $q="Update e_city SET status='enable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_city?flag=1&ID=$id&msg=delete");

}
//echo $id;
exit;
?>