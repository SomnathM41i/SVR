<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];


if($check==1)
{
    $q="Update occupation SET status='disable' where id='$id'";
    header("location:add_occupation?ID='$id'&msg=delete&flag=1");
    
    mysqli_query($con,$q);
}
else
{
    $q="Update occupation SET status='enable' where id='$id'";
    header("location:add_occupation?ID='$id'&msg=delete&flag=0");
    
    mysqli_query($con,$q);
}


exit;
?>