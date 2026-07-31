<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update e_dist SET status='disable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_dist?flag=1&ID=$id&msg=delete");

}
else
{
    $q="Update e_dist SET status='enable' where id='$id'";
    mysqli_query($con,$q);
    header("location:add_dist?flag=0&ID=$id&msg=delete");
    
}

exit;
?>