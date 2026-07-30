<?php $idurl=$_GET['id'];
$bann=mysqli_query($con,"select * from register where MatriID='$idurl'");
$ban=mysqli_fetch_array($bann);
$baned=$ban['Status'];
if( $baned == "Banned" )
{ 
	header('location:banprofile.php');
}
else
{
	
}


?>