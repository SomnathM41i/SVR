<?php require_once('../includes/bootstrap.php');   
include('protect.php');

$strmid=$_POST['ID']; 

$txtStar =$_POST['txtStar'];
$gan =$_POST['gan'];
$nadi =$_POST['nadi'];
$devak =$_POST['devak'];


$txtMoon = $_POST['txtMoon'];
$txtHorosMatch=$_POST['txtHorosMatch'];



$txtManglik = $_POST['txtManglik'];
$txtGothra=$_POST['txtGothra'];
$txt_shani= $_POST['shani'];
$bplace=$_POST['bplace'];
$cplace=$_POST['cplace'];
$btime=$_POST['bhour'].":".$_POST['bminute'].":".$_POST['bsecond'].":".$_POST['bampm'];

$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];


if($reg_step<3)
{
$con->query("update register set Star='$txtStar',Gan='$gan',nadi='$nadi',devak='$devak',Moonsign='$txtMoon',Horosmatch='$txtHorosMatch',Manglik='$txtManglik',Gothram='$txtGothra',shani='$txt_shani',POB='$bplace',POC='$cplace',TOB='$btime', reg_step='3' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}else{
$con->query("update register set Star='$txtStar',Gan='$gan',nadi='$nadi',devak='$devak',Moonsign='$txtMoon',Horosmatch='$txtHorosMatch',Manglik='$txtManglik',Gothram='$txtGothra',shani='$txt_shani',POB='$bplace',POC='$cplace',TOB='$btime' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}	
header('location:profile_view?flag=7&msg=success&ID='.$strmid);
exit;
?>