<?php require_once('sys_dbconnection.php');	
include_once('memprotect.php');?>
<?php include_once('siteconfig.php');
/*include_once('dbconnectadmin.php');
session_start();*/
$from_age=$_POST['txtSAge'];
$to_age=$_POST['txtEAge'];
if($_POST['religion']!="")
{
$religion=implode(",",$_POST['religion']);
}//$caste=implode(",",$_POST['caste']);
//$subcaste=implode(",",$_POST['subcaste']);
if($_POST['edu']!="")
{
$education=implode(",",$_POST['edu']);
}
if($_POST['occu']!="")
{
$occupation=implode(",",$_POST['occu']);
}
if($_POST['looking']!="")
{
$looking=implode(",",$_POST['looking']);
}

$withphoto=$_POST['with_photo'];

mysqli_query($con,"insert into basic_saveandsearch (MatriID,fromage,toage,religion,caste,subcaste,education,occupation,Maritial_status,withphoto)values('".$_SESSION['matri_login']."','$from_age','$to_age','$religion','$caste','$subcaste','$education','$occupation','$looking','$withphoto')");


$last_id =mysqli_insert_id($con);
//echo "insert into basic_saveandsearch (MatriID,fromage,toage,religion,caste,subcaste,education ,occupation,Maritial_status,withphoto)values('".$_SESSION['matri_login']."','$from_age','$to_age','$religion','$caste','$subcaste','$education','$occupation','$looking','$withphoto')";
//exit;
header('location:select_search?id='.$last_id);
?>