<?php require_once('../sys_dbconnection.php'); 
/*include('../dbconnectadmin.php'); */
$id=$_GET['matriid'];

$con->query("update register set Status='Active' , memtype='Free', Noofcontacts='0',  MemshipExpiryDate='' where MatriID='$id' ")
or die(mysqli_error($con));
echo "update register set Status='Active' , memtype='Free', Noofcontacts='0',  MemshipExpiryDate='' where MatriID='$id' ";
$sql=$con->query("SELECT * FROM  paiddetails WHERE Pmatriid ='$id' ORDER BY Paidid DESC");

if($row=$sql->fetch_assoc())
{
	$oid=$row['Paidid'];
	$con->query("delete from paiddetails where Paidid='$oid' ");

}

header('location:profile_view?flag=12&msg=success&ID='.$id);
?>