<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update nakshatra SET status='disable' where id='$id'";
  //  echo "Update nakshatra SET status='disable' where Nakshatra='$id'";
    mysqli_query($con,$q);
    header("location:add_star?flag=1&ID=$id&msg=delete");


}
else
{
    $q="Update nakshatra SET status='enable' where id='$id'";
   // echo "Update nakshatra SET status='enable' where Nakshatra='$id'";
    mysqli_query($con,$q);
    header("location:add_star?flag=0&ID=$id&msg=delete");

}
//exit;
?>