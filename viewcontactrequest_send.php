<?php require_once('includes/bootstrap.php');



$idurl=$_GET['searchid'];
$searchid = $idurl;
$profileid=$_SESSION['matri_login'];
$vreq=$_POST['vreq'];
mysqli_query($con,"insert into viewcontact_details(who,whom,status,date)values('$profileid','$searchid','Pending',NOW())");

$paid_follow =mysqli_query($con,"insert into notification(noti_sender,noti_receiver,notification_type,notification_desc) values('$profileid','$searchid','Contact Request','Has Requested For Contact')");
$encrypt = urlencode( base64_encode( $searchid ) );
header('location:full_profile?msg=reqsend&id='.$encrypt);

?>



