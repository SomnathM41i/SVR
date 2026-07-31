<?php require_once('../sys_dbconnection.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/
$strmid=$_POST['ID']; 

$txtStar =$_POST['txtStar'];
$gan =$_POST['gan'];
$nadi =$_POST['nadi'];
$devak =$_POST['devak'];
//$dosh = $_POST['dosh1'];
//$doshtype = $_POST['dosh_type'];
$txtMoon = $_POST['txtMoon'];
$txtHorosMatch=$_POST['txtHorosMatch'];
//$txtCharan = $_POST['txtCharan'];
//$cboGan = $_POST['cboGan'];
//$cbonadi=$_POST['cbonadi'];
$txtManglik = $_POST['txtManglik'];
$txtGothra=$_POST['txtGothra'];
$txt_shani= $_POST['shani'];
$bplace=$_POST['bplace'];
$cplace=$_POST['cplace'];
$btime=$_POST['bhour'].":".$_POST['bminute'].":".$_POST['bsecond'].":".$_POST['bampm'];
//$bstate=$_POST['bstate'];
$reg=mysqli_query($con,"Select * from register where MatriID='$strmid'");
$regfet=mysqli_fetch_array($reg);
$reg_step=$regfet['reg_step'];
//echo $reg_step;

if($reg_step<3)
{
$con->query("update register set Star='$txtStar',Gan='$gan',nadi='$nadi',devak='$devak',Moonsign='$txtMoon',Horosmatch='$txtHorosMatch',Manglik='$txtManglik',Gothram='$txtGothra',shani='$txt_shani',POB='$bplace',POC='$cplace',TOB='$btime', reg_step='3' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}else{
$con->query("update register set Star='$txtStar',Gan='$gan',nadi='$nadi',devak='$devak',Moonsign='$txtMoon',Horosmatch='$txtHorosMatch',Manglik='$txtManglik',Gothram='$txtGothra',shani='$txt_shani',POB='$bplace',POC='$cplace',TOB='$btime' WHERE MatriID= '$strmid' ") or svr_db_fail($con);
}	
header('location:profile_view?flag=7&msg=success&ID='.$strmid);
exit;
?>