<?php require_once('../includes/bootstrap.php');   
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update residency_status SET status='disable' where id='$id'";
    
    mysqli_query($con,$q);
    header("location:add_residency_status?flag=1&ID='$id'&msg=delete");


}
else
{
    $q="Update residency_status SET status='enable' where id='$id'";
    
    mysqli_query($con,$q);
    header("location:add_residency_status?flag=0&ID='$id'&msg=delete");

}
exit;
?>