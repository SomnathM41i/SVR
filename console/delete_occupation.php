<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
//echo $check;
//echo $id;\
if($check==1)
{
    $q="Update occupation SET status='disable' where id='$id'";
    header("location:add_occupation?ID='$id'&msg=delete&flag=1");
    //echo "Update occupation SET status='disable' where occu='$id'";
    mysqli_query($con,$q);
}
else
{
    $q="Update occupation SET status='enable' where id='$id'";
    header("location:add_occupation?ID='$id'&msg=delete&flag=0");
    //echo "Update occupation SET status='enable' where occu='$id'";
    mysqli_query($con,$q);
}


exit;
?>