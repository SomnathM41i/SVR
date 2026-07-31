<?php  require_once('../sys_dbconnection.php');
//include'../dbconnectadmin.php';
$id=$_GET['id'];
$check=$_GET['flag'];
echo $check;
if($check==1)
{
    $q="Update moon_sign SET status='disable' Where ID='$id'";
  //  echo "Update moon_sign SET status='disable' Moon_Sign='$id'";
    mysqli_query($con,$q);
    header("location:add_moonsign?flag=1&ID=$id&msg=delete");
    
}
else
{
    $q="Update moon_sign SET status='enable' Where ID='$id'";
  //  echo "Update moon_sign SET status='enable' Moon_Sign='$id'";
    mysqli_query($con,$q);
    header("location:add_moonsign?flag=0&ID=$id&msg=delete");

}
exit;
?>