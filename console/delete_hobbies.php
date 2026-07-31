<?php require_once('../includes/bootstrap.php');   
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update hobbies SET status='disable' Where hobbies='$id'";
    
    mysqli_query($con,$q);
    header("location:add_hobbies?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update hobbies SET status='enable' Where hobbies='$id'";
    
    mysqli_query($con,$q);
    header("location:add_hobbies?flag=0&ID='$id'&msg=delete");
}

exit;
?>