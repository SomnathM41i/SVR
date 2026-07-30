<?php require_once('../sys_dbconnection.php'); 
include('protect.php');
/*include('../dbconnectadmin.php');*/
$strid = $_GET['id'];
echo $strid;
$query=mysqli_query($con,"select * from gallary where photo_id='$strid'");
$fet=mysqli_fetch_array($query);
$mat=$fet['matri_id'];
$query1=mysqli_query($con,"select * from register where MatriID='$mat'");
$q1=mysqli_fetch_array($query1);

if($q1['Photo1']==$fet['photo_name']){
$con->query("delete from gallary where photo_id='$strid'");
$con->query("update register set Photo1='nophoto.jpg' where MatriID='$mat'");
}
else{
	$con->query("delete from gallary where photo_id='$strid'");
}
//echo "delete from gallary where photo_id='$strid'";

//echo $mat; 
header('location:profile_view?msg=success&flag=18&ID='.$mat);

?>