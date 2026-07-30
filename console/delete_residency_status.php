<?php require_once('../sys_dbconnection.php');   
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update residency_status SET status='disable' where id='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_residency_status?flag=1&ID='$id'&msg=delete");


}
else
{
    $q="Update residency_status SET status='enable' where id='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_residency_status?flag=0&ID='$id'&msg=delete");

}
exit;
?>