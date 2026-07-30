<?php require_once('../sys_dbconnection.php'); 
/*include'../dbconnectadmin.php';*/
$strmid1=$_GET['ID']; 
$ty=$_GET['type'];
echo $strmid1;
echo $ty;
if(isset($ty))
{
mysqli_query($con,"DELETE FROM document  where type=$ty and  MatriID='".$_GET['ID']."'");
//echo "DELETE FROM document  where type=$ty and  MatriID='".$_GET['ID']."'";
//echo "update register set adhar='' where MatriID='".$_GET['ID']."'";
//exit;
header("location:profile_view?ID=$strmid1&msg=delete3" );
}
?>