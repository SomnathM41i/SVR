<?php include('sys_dbconnection.php');

$MatriID = $_SESSION['MatriID'];
$order_id = $_REQUEST['oid'];
$serch_id= $_REQUEST['searchid'];
echo $serch_id;
//exit;
/*echo $amount;*/
if( isset($_POST['oid']) && isset($_POST['payment_id']) )
{
    $payment_id =$_POST['payment_id'];
    $order_id = $_POST['oid'];
    echo $payment_id;
    echo $order_id;
    $sqlrenew=mysqli_query($con,"select * from register where MatriID='$MatriID'");
    //echo "select * from register where MatriID='$MatriID'".'<br>';

$rowrenew=mysqli_fetch_array($sqlrenew);
$name2=$rowrenew['Name'];
$mobile=$rowrenew['Mobile'];
$na=explode(" ",$name1);
$sqlplan=mysqli_query($con,"select * from membershipplan where planid='$order_id'");
echo "select * from membershipplan where planid='$order_id'";

$rowplan=mysqli_fetch_array($sqlplan);
 
function orderid() {
    $chars = "0123456789";
    srand((double)microtime()*1000000000);
    $i = 0;
    $pass = '';

    while ($i <= 20) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}
$strinv = "AMAT";
$stroid =  $strinv.orderid();
$name = $rowrenew['Name'];
$email = $rowrenew['ConfirmEmail'];
$address = addslashes($rowrenew['Address']);
$mode = "Razorpay";
$activation_date = date('d-m-Y');
$amount =$_POST['txtamount'];
echo $amount;
/*
if($rowrenew['Status']=="Expired" || $rowrenew['Status']=="Active")
{
$duration = $rowplan['planduration'];
$noofcontacts=$rowplan['plannoofcontacts'];
}
else
{
$sqlexp=$con->query("SELECT DATEDIFF( Memshipexpirydate,CURRENT_DATE ) as exp FROM register WHERE MatriID='$MatriID'");
$rowexp=$sqlexp->fetch_array();

$duration = $rowplan['planduration']+$rowexp['exp'];
$noofcontacts=$rowplan['plannoofcontacts']+$rowrenew['Noofcontacts'];
}
$plannm=$rowplan['plandisplayname'];
$amount = $rowplan['planamount']; */
$strstatus = "Paid";

$insert = $con->query("insert into contactpaid (pcoid,cmatriid,cname,cpaymode,cdate,camount,cstatus,csearchid) values ('$stroid','$MatriID','$name','$mode',now(),'$amount','$strstatus','$serch_id')".mysqli_error($con));
echo "insert into contactpaid (pcoid,cmatriid,cname,cpaymode,cdate,camount,cstatus,csearchid) values ('$stroid','$MatriID','$name','$mode',now(),'$amount','$strstatus','$serch_id'";
echo "insert into paiddetails (Poid,Pmatriid,Pname,Pemail,Paddress,Ppaymode,Pactivedate,Pplan,memtype,Pplanduration,Pamount,Pstatus,Pnocontct) values ('$stroid','$MatriID','$name','$email','$address','$mode','$activation_date','$plannm','".$rowplan['planname']."','$duration','$amount','$strstatus','$noofcontacts')";

//exit;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* $followers = $con->query("select *from followers where follower_id = '$MatriID'");
if(mysqli_num_rows($followers)>0)
{
        while($follow_row = $followers->fetch_assoc())
        {
        $paid_follow =$con->query("insert into notification(noti_sender,noti_receiver,notification_type,notification_desc) values('$MatriID','".$follow_row['profile_id']."','paid member','Has Been a Paid Member')");
        }  
} */
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////// UPDATE INTO REGISTER TABLE ////////////////////////
/*$strmid = $_SESSION['matriid'];*/
//$stractivedate = $_POST['txtp6'];
//echo $str82;
/* $strexpdate = date('Y-m-d', strtotime("+$duration days")); 

$update=$con->query("Update register set Status='Paid',memtype='".$rowplan['plandisplayname']."',MemshipExpiryDate='$strexpdate',Noofcontacts='$noofcontacts' where MatriID = '$MatriID' ")
or die("Could not update data because ".mysqli_error($con));
 */
 
/*$MatriID = $_GET['mat'];*/
 $newl=mysqli_query($con,"select * from register where MatriID='$MatriID'");
 echo "select * from register where MatriID='$MatriID'";
 $newlfet=mysqli_fetch_array($newl);
 $pass=$newlfet['ConfirmPassword'];
 echo $pass;
 //echo $matriid;
 /*echo "1".$pass;*/

$encrypt = urlencode(base64_encode($matriid));

//header('location:full_profile.php?id='.$encrypt);

}

?>