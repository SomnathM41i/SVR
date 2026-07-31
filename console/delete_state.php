<?php  require_once('../sys_dbconnection.php');
//include'../dbconnectadmin.php';
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update e_state SET status='disable' where id='$id'";
    //echo "Update e_state SET status='disable' where state='$id'";
    mysqli_query($con,$q);
    header("location:add_state?flag=1&ID=$id&msg=delete");

}
else
{
    $q="Update e_state SET status='enable' where id='$id'";
    //echo "Update e_state SET status='enable' where state='$id'";
    mysqli_query($con,$q);
    header("location:add_state?flag=0&ID=$id&msg=delete");

}
exit;
?>