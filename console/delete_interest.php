<?php require_once('../includes/bootstrap.php');   

/* removed dead include: include('memprotect.php'); - target never existed */
$id=$_GET['id'];
$check=$_GET['flag'];
if($check==1)
{
    $q="Update interest SET status='disable' where interest='$id'";
    echo "Update interest SET status='disable' where interest='$id'";
    mysqli_query($con,$q);
    header("location:add_interest?flag=1&ID='$id'&msg=delete");

}
else
{
    $q="Update interest SET status='enable' where interest='$id'";
    echo "Update interest SET status='enable' where interest='$id'";
    mysqli_query($con,$q);
    header("location:add_interest?flag=0&ID='$id'&msg=delete");
    
}

?>