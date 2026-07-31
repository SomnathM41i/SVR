<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');

$strmid1=$_GET['ID']; 
$ty=$_GET['type'];
echo $strmid1;
echo $ty;
if(isset($ty))
{
mysqli_query($con,"DELETE FROM document  where type=$ty and  MatriID='".$_GET['ID']."'");



header("location:profile_view?ID=$strmid1&msg=delete3" );
}
?>