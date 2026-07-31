<?php  require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update e_country SET status='disable' where country='$id'";
    mysqli_query($con,$q);
    header("location:add_country?flag=1&ID=$id&msg=delete");
}
else
{
    $q="Update e_country SET status='enable' where country='$id'";
    mysqli_query($con,$q);
    header("location:add_country?flag=0&ID=$id&msg=delete");
    
}

exit;
?>