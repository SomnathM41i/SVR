<?php //MEMBERSHIP EDIT ?>

<title>Edit Membership</title>
<?php require_once('../sys_dbconnection.php');    
require_once(dirname(__FILE__).'/protect.php');
date_default_timezone_set('Asia/Kolkata');

$strmid=$_POST['ID']; 
$contacts =mysqli_real_escape_string($con, $_POST['txtName']);
$date =mysqli_real_escape_string($con,$_POST['date']);
echo $date.'<br>';
echo $today = date("Y-m-d").'<br>';
if($today <= $date )
{
	
	$query = $con->query("update register set Status='Paid',Noofcontacts='$contacts',MemshipExpiryDate='$date' where MatriID='$strmid' ") or svr_db_fail($con);
}
else
{
	
	$query = $con->query("update register set Status='Expired',Noofcontacts='$contacts',MemshipExpiryDate='$date' where MatriID='$strmid' ") or svr_db_fail($con);
	
}

header('location:profile_view?flag=15&msg=success&ID='.$strmid);
echo "<script>window.location.href='profile_view?flag=15&msg=success&ID=$strmid';</script>";
exit;
?>
