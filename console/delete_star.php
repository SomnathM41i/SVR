<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update nakshatra SET status='disable' where id='$id'";
  
    mysqli_query($con,$q);
    header("location:add_star?flag=1&ID=$id&msg=delete");


}
else
{
    $q="Update nakshatra SET status='enable' where id='$id'";
   
    mysqli_query($con,$q);
    header("location:add_star?flag=0&ID=$id&msg=delete");

}

?>