<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
echo $check;
if($check==1)
{
    $q="Update employed_in SET status='disable' where id='$id'";
    //echo "delete from e_state where state='$id'";
    //echo "Update employed_in SET status='disable' where employed='$id'";
    mysqli_query($con,$q);
    header("location:add_employed_in?ID='$id'&msg=delete&flag=1");


}
else
{
    $q="Update employed_in SET status='enable' where id='$id'";
    //echo "Update employed_in SET status='enable' where employed='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_employed_in?ID='$id'&msg=delete&flag=0");

}
//exit;
?>