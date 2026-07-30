<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];

if($check==1)
{
    $q="Update caste SET status='disable' where ID='$id'";
    //echo "Update caste SET status='disable' where caste='$id'";
    mysqli_query($con,$q);
    header("location:add_caste?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update caste SET status='enable' where ID='$id'";
    //echo "Update caste SET status='enable' where caste='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_caste?flag=0&ID='$id'&msg=delete");

}
exit;
?>