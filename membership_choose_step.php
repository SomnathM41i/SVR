<?php include_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');?>
<?php include_once('siteconfig.php');
$pay_details = mysqli_query($con,"SELECT * FROM payment_getway WHERE id = 1 ");
$row = mysqli_fetch_array($pay_details );
$key =  $row['merchant_key'];
$auth =  $row['merchent_id'];



function split_name($nm1)
{
$nm1=trim($nm1);
$arrnm1=explode(".",$nm1);
$nm="";
if(count($arrnm1)>1)
{
	$arrnm5=explode(" ",trim($arrnm1[1]));
	$nm=$arrnm5[0];
}
else
{
	$arrnm1=explode(" ",$nm1);
	$nm=$arrnm1[0];
} 
return $nm;
}
$matriid = $_SESSION['matriid'];  
$rs=mysqli_query($con,"select * from register where MatriID='$matriid'");
$dh=mysqli_query($con,"select * from payment_getway where id='1'");
$dhn=mysqli_fetch_array($dh);
$row=mysqli_fetch_array($rs);
?>
<?php 
include 'src/instamojo.php';//
$api = new Instamojo\Instamojo( $key , $auth,'https://www.instamojo.com/api/1.1/');

$plan_name = $_POST['txtplanname'];
$amount = $_POST["txtamount"];
$name = split_name($row['Name']);
$phone = $row["Mobile"];
$email = $row["ConfirmEmail"];
$order=$_POST['id'];


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $plan_name,
        "amount" => $amount,
        "buyer_name" => $name,
        "phone" => $phone,
		"email" => $email,
        "send_email" => true,
        "send_sms" => true,
        'allow_repeated_payments' => false,
        "redirect_url" => "https://holychristianmatrimony.com/payment_success.php?id=$order&mat=$matriid",
        "webhook" => "https://holychristianmatrimony.com/webhook.php"
        ));
   $pay_ulr = $response['longurl']; 
    header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
?>


