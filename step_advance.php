<?php require_once('sys_dbconnection.php');
include_once('memprotect.php');?>
<?php //include_once('siteconfig.php');?>
<?php //include('dbconnectadmin.php'); 
//session_start();
$ms=implode(",",$_POST['ms']);
$from_age=$_POST['txtSAge'];
$to_age=$_POST['txtEAge'];
$height1=$_POST['height1'];
$height2=$_POST['height2'];
$taluka="";
if($_POST['religion']!="")
{
$religion=implode(",",$_POST['religion']);
}
if($_POST['caste']!="")
{
$caste=implode(",",$_POST['caste']);
}
if($_POST['education']!="")
{
$education=implode(",",$_POST['education']);
}
if($_POST['occupation']!="")
{
$occupation=implode(",",$_POST['occupation']);
}
if($_POST['Country1']!="")
{
$Country1=implode(",",$_POST['Country1']);
}
if($_POST['cbostate']!="")
{
$cbostate=implode(",",$_POST['cbostate']);
}
if($_POST['dist']!="")
{
$dist=implode(",",$_POST['dist']);
}
if(!empty($_POST['taluka']))
{
$taluka=implode(",",$_POST['taluka']);
}
if($_POST['city']!="")
{
$city2=implode(",",$_POST['city']);
}
$with_photo=$_POST['with_photo'];

mysqli_query($con,"insert into advance_saveandsearch (MatriID,maritialstatus,fromage,toage,fromheight,toheight,religion,caste,education,occupation,country,state,district,taluka,city,withphoto)values
('".$_SESSION['matri_login']."','$ms','$from_age','$to_age','$height1','$height2','$religion','$caste','$education','$occupation','$Country1',
'$cbostate','$dist','$taluka','$city2','$with_photo')");

$last_id =mysqli_insert_id($con);
//echo $last_id;
//echo "insert into advance_saveandsearch (MatriID,maritialstatus,fromage,toage,fromheight,toheight,religion,caste,subcaste,education,occupation,country,state,district,city,withphoto)values
//('".$_SESSION['matri_login']."','$ms','$from_age','$to_age','$height1','$height2','$religion','$caste','$subcaste','$education','$occupation','$Country1','$cbostate','$dist','$city2','$with_photo')";

header('location:select_advancesearch?id='.$last_id);?>
