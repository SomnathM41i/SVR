<?php
require_once('includes/bootstrap.php');/*include_once('dbconnectadmin.php');*/
// include_once('memprotect.php');
// include_once('siteconfig.php');
$from = 0;
$max_results = 10; 

date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['submit']))
{
$receiver=$_POST['sender'];
$sender=$_POST['receiver'];
$mess=addslashes($_POST['message']);

$qry1=mysqli_query($con,"select * from notification where noti_sender='$sender' AND noti_receiver='$receiver' and notification_type='Message'");

$row2=mysqli_fetch_array($qry1);
$type=$row2['notification_type']; 
if(mysqli_num_rows($qry1)==0)
{
mysqli_query($con,"insert into notification(noti_sender,noti_receiver,notification_type,notification_desc,seen,date_time)values('$sender','$receiver','Message','Send Message','unseen',NOW())");
}
$date = date('d-m-Y');
$status=mysqli_query($con,"insert into receivemessage(ToID,FromID,Msg,SendDate,Date) values('$receiver','$sender','$mess','$date',now())")or svr_db_fail($con);



$strid=$_SESSION['matriid'];

$sender_sql=mysqli_query($con,"select * from  register where MatriID='$receiver'");
$sender_info=mysqli_fetch_array($sender_sql);

$mem_sql=mysqli_query($con,"select * from  register where MatriID='$sender'");
$mem_info=mysqli_fetch_array($mem_sql);

$chat = mysqli_query($con,"SELECT * FROM receivemessage WHERE ToID IN('$strid','$sender') order by rid DESC LIMIT $from, $max_results ");

date_default_timezone_set("Asia/Kolkata");
$dt=date('Y-m-d');
$hr=date('h');
$min=date('i');
$sec=date('s');
$am=date('a');
header('location:send_message.php?id='.$receiver);
}
?>
