<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update religion SET status='disable' where ID='$id'";
    mysqli_query($con,$q);
    header("location:add_religion?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update religion SET status='enable' where ID='$id'";
    mysqli_query($con,$q);
    header("location:add_religion?flag=0&ID='$id'&msg=delete");
    
}
exit;
?>