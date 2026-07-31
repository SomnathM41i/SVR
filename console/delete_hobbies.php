<?php require_once('../sys_dbconnection.php');   
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update hobbies SET status='disable' Where hobbies='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_hobbies?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update hobbies SET status='enable' Where hobbies='$id'";
    //echo "delete from e_state where state='$id'";
    mysqli_query($con,$q);
    header("location:add_hobbies?flag=0&ID='$id'&msg=delete");
}

exit;
?>