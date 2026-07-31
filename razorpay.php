<?php include('includes/bootstrap.php');
include_once('memprotect.php');?>
<?php include_once('siteconfig.php');
/* Legacy Razorpay "buy contact details" checkout page.
   SECURITY changes (C6 payment integrity):
   - Key id now resolves from env/config (svr_config) with the previous value
     kept only as a legacy fallback.
   - Values echoed into JavaScript are JSON-encoded (injection-safe).
   NOTE: this page has no inbound references in the current codebase and is a
   candidate for removal in the cleanup phase (its paired handler is
   contact_paid_success.php, now hardened with server-side verification). */

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

$plan_name = isset($_POST['txtplanname']) ? $_POST['txtplanname'] : '';
$amount = isset($_POST["txtamount"]) ? floatval($_POST["txtamount"]) : 0;
$name = split_name($row['Name']);
$phone = $row["Mobile"];
$email = $row["ConfirmEmail"];
$order= isset($_POST['id']) ? $_POST['id'] : '';
$searchid= isset($_POST['searchid']) ? $_POST['searchid'] : '';
$encrypt = urlencode(base64_encode($searchid));
$rzpKeyId = svr_config('SVR_RZP_KEY_ID', 'rzp_live_UCmasONfYX891y');

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var amt = <?php echo json_encode($amount) ?>;
    var id = <?php echo json_encode((string)$order) ?>;
	var encrypt = <?php echo json_encode((string)$encrypt) ?>;
	var options = {
    "key": <?php echo json_encode($rzpKeyId) ?>,
    "amount": amt * 100,
    "currency": "INR",
    "name": "Manpasand Jodidar",
    "description": "",
    "image": "branding/logos/emblem.png",
    "handler": function (response){
        jQuery.ajax({
            type:'post',
            url:'contact_paid_success.php',
            data:"payment_id="+encodeURIComponent(response.razorpay_payment_id)+"&oid="+encodeURIComponent(id)+"&searchid="+encodeURIComponent(<?php echo json_encode((string)$searchid) ?>),
            success:function(result){
                window.location.href="Vcontactdetail?id="+encrypt;


            }
        });
    }
};
var rzp1 = new Razorpay(options);
rzp1.open();

</script>
