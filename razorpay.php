<?php include('sys_dbconnection.php');
include_once('memprotect.php');?>
<?php include_once('siteconfig.php');
// ONLY FOR RAZORPAY 
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
//echo $matriid;
$rs=mysqli_query($con,"select * from register where MatriID='$matriid'");
$dh=mysqli_query($con,"select * from payment_getway where id='1'");
$dhn=mysqli_fetch_array($dh);
$row=mysqli_fetch_array($rs);

$plan_name = $_POST['txtplanname'];
//echo $_POST['txtplanname'];
$amount = $_POST["txtamount"];
//echo $_POST["txtamount"];
$name = split_name($row['Name']);
//echo $name;
$phone = $row["Mobile"];
//echo $phone;
$email = $row["ConfirmEmail"];
//echo $email;
$order= $_POST['id'];
//echo $order;
$searchid= $_POST['searchid'];
//echo $searchid;
$encrypt = urlencode(base64_encode($searchid));

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<!-- <button id="rzp-button1">Pay</button> -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var amt =<?Php echo $amount?>;
    var id =<?Php echo $order ?>; 
	var encrypt ="<?php echo $encrypt ?>";
	//var searchid= "<?php echo $searchid ?>";
   // var encrypt =<?Php echo $matriid?>;
    
var options = {
    "key": "rzp_live_UCmasONfYX891y", 
    "amount": amt * 100, 
    "currency": "INR",
    "name": "Manpasand Jodidar",
    "description": "",
    "image": "http://localhost/SVR/css3/assets/manpasand-logo.png",
    "handler": function (response){
       /* console.log(response);
        response.razorpay_payment_id*/
        jQuery.ajax({
            type:'post',
            url:'contact_paid_success.php',
            data:"payment_id="+response.razorpay_payment_id+"&oid="+id,
            success:function(result){
                window.location.href="Vcontactdetail?id="+encrypt;
				


            } 
        });
    }
};
var rzp1 = new Razorpay(options);
rzp1.open();
    
</script>    
