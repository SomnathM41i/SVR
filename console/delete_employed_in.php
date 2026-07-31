<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');

$id=$_GET['id'];
$check=$_GET['flag'];
echo $check;
if($check==1)
{
    $q="Update employed_in SET status='disable' where id='$id'";
    
    
    mysqli_query($con,$q);
    header("location:add_employed_in?ID='$id'&msg=delete&flag=1");


}
else
{
    $q="Update employed_in SET status='enable' where id='$id'";
    
    
    mysqli_query($con,$q);
    header("location:add_employed_in?ID='$id'&msg=delete&flag=0");

}

?>