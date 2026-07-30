<?php require_once('../sys_dbconnection.php');
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update subcaste SET status='disable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_subcaste?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update subcaste SET status='enable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_subcaste?flag=0&ID='$id'&msg=delete");

}
//echo $id;
exit;
?>