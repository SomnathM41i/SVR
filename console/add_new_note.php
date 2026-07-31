<?php require_once('../sys_dbconnection.php');
$MatriID = $_REQUEST['id'];
$notes = $_REQUEST['note'];
mysqli_query($con,"INSERT INTO `notes`(`MatriID`, `note`) VALUES ('$MatriID','$notes')");
header("Location: profile_view?msg=success&flag=23&ID=".$MatriID);
exit;

/*$cnt = mysqli_query($con,"SELECT count(id) from notes where MatriID = '$MatriID' ");
$fetch_cnt = mysqli_fetch_array($cnt);
$check =  $fetch_cnt['count(id)'];*/


/*if( $check == 1 )
{
	mysqli_query($con," UPDATE notes SET note='$notes' WHERE MatriID = '$MatriID' ");
		
}
else
{
mysqli_query($con,"INSERT INTO `notes`(`MatriID`, `note`) VALUES ('$MatriID','$notes')");
		
}*/



?>