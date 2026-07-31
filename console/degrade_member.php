<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
/*include('../dbconnectadmin.php'); */
$id=$_GET['matriid'];

$con->query("update register set Status='Active' , memtype='Free', Noofcontacts='0',  MemshipExpiryDate='' where MatriID='$id' ")
or svr_db_fail($con);
echo "update register set Status='Active' , memtype='Free', Noofcontacts='0',  MemshipExpiryDate='' where MatriID='$id' ";
$sql=$con->query("SELECT * FROM  paiddetails WHERE Pmatriid ='$id' ORDER BY Paidid DESC");

if($row=$sql->fetch_assoc())
{
	$oid=$row['Paidid'];
	$con->query("delete from paiddetails where Paidid='$oid' ");

}

header('location:profile_view?flag=12&msg=success&ID='.$id);
?>