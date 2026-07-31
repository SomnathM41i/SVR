<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);

require_once('sys_dbconnection.php');
include('memprotect.php');

$matriid = $_SESSION['MatriID'];

// Fetch member info
$matriid_safe = mysqli_real_escape_string($con, $matriid);
$result = mysqli_query($con, "SELECT * FROM register WHERE MatriID = '$matriid_safe'")
    or die(mysqli_error($con));
$record = mysqli_fetch_array($result);

// Fetch plan info
$strplanid = mysqli_real_escape_string($con, $_POST['choose'] ?? '');
$plan = mysqli_query($con, "SELECT * FROM membershipplan WHERE planid = '$strplanid'")
    or die(mysqli_error($con));
$plan_row = mysqli_fetch_array($plan);

// Check payment gateway status
$data_config = $db->get_siteconfig();
//$pay_on_off  = $data_config->is_pay_gateway_set;
$pay_on_off = 1;
// Razorpay Keys
define('RZP_KEY_ID',     'rzp_live_SjeGNwfy1DxQuC');  // ← Your Razorpay Key ID
define('RZP_KEY_SECRET', 'WrbEZmhz7NlXIHiH58Qb9ux1');    // ← Your Razorpay Key Secret

// Generate unique order/transaction ID
$strinv     = "MAT";
$strorderid = $strinv . strtoupper(uniqid());

// Fetch email
$rs123    = mysqli_query($con, "SELECT * FROM register WHERE MatriID = '$matriid_safe'");
$rowrs123 = mysqli_fetch_array($rs123);

$amount         = floatval($plan_row['planamount']);
$amountInPaise  = (int) round($amount * 100);
$rzpOrderId     = '';
$rzpError       = '';

// Create Razorpay Order via API (server-side)
if ($pay_on_off != 0 && $amount > 0) {
    $payload = json_encode([
        'amount'          => $amountInPaise,
        'currency'        => 'INR',
        'receipt'         => $strorderid,
        'payment_capture' => 1,
        'notes'           => [
            'MatriID' => $matriid,
            'planid'  => $strplanid,
            'orderid' => $strorderid,
        ],
    ]);

    $ch = curl_init('https://api.razorpay.com/v1/orders');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_USERPWD        => RZP_KEY_ID . ':' . RZP_KEY_SECRET,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT        => 30,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $rzpOrder   = json_decode($response, true);
        $rzpOrderId = $rzpOrder['id'];

        // Insert pending transaction into DB
        $plan_name = mysqli_real_escape_string($con, $plan_row['planname']);
        $plan_display = mysqli_real_escape_string($con, $plan_row['plandisplayname']);
        $now = date('Y-m-d H:i:s');
        mysqli_query($con, "
            INSERT INTO transactions 
                (order_id, matri_id, plan_id, plan_name, amount, rzp_order_id, status, created_at)
            VALUES 
                ('$strorderid', '$matriid_safe', '$strplanid', '$plan_display', '$amount', '$rzpOrderId', 'Pending', '$now')
        ");
        // Note: Create this table if it doesn't exist — see payment_success.php comments
    } else {
        $rzpError = 'Could not connect to payment gateway. Please try again.';
        error_log('Razorpay order creation failed: ' . $response);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Membership Choose</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/color-switcher-design.css" rel="stylesheet">
<link href="card.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
button, input, optgroup, select, textarea { background-color: inherit; }
.fas { margin-left: -12px; margin-right: 8px; }
</style>
</head>
<body>

<div class="page-wrapper">
    <span class="header-span"></span>
    <?php include('header.php'); ?>

    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Order Review</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Order Review</li>
            </ul>
        </div>
    </section>

    <section class="features-section">
        <div class="auto-container">
            <div class="anim-icons">
                <span class="icon icon-shape-3 wow fadeIn"></span>
                <span class="icon icon-line-1 wow fadeIn"></span>
            </div>

            <?php if ($rzpError): ?>
                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($rzpError); ?></div>
            <?php endif; ?>

            <div class="row">
                <!-- Member Information -->
                <div class="feature-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="icon-box"><span class="icon flaticon-search"></span></div>
                        <h4><a href="#">Member Information</a></h4>
                        <div class="text">
                            Matrimony ID: <b><?php echo htmlspecialchars($record['MatriID']); ?></b><br>
                            Name: <b><?php echo htmlspecialchars($record['Name'] ?? $record['MatriID']); ?></b><br>
                            Contact: <b><?php echo htmlspecialchars($record['Mobile']); ?></b><br>
                            Mobile: <b><?php echo htmlspecialchars($record['Mobile2']); ?></b><br>
                        </div>
                    </div>
                </div>

                <!-- Plan Information -->
                <div class="feature-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="icon flaticon-diamond-1"></span></div>
                        <h4><a href="#">Plan Information</a></h4>
                        <div class="text">
                            Plan ID: <b><?php echo htmlspecialchars($plan_row['planid']); ?></b><br>
                            Plan Type: <b><?php echo htmlspecialchars($plan_row['plandisplayname']); ?></b><br>
                            Validity Days: <b><?php echo htmlspecialchars($plan_row['planduration']); ?> Days</b><br>
                            Amount (INR): <b>₹<?php echo htmlspecialchars($plan_row['planamount']); ?></b> <small>Inclusive of all taxes</small><br>
                        </div>
                    </div>
                </div>

                <!-- Payment Mode -->
                <div class="feature-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="icon flaticon-success"></span></div>
                        <h4><a href="#">Payment Mode</a></h4>
                        <div class="text">
                            <input type="radio" name="pm" value="op4" checked style="vertical-align:middle; margin-left:10px;">
                            Pay By Debit Card, Credit Card, Visa Card, Netbanking, UPI and Wallet Account.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Make Payment Button -->
            <div class="register-form text-center" style="margin-top:20px;">
                <?php if ($pay_on_off != 0 && !$rzpError && $rzpOrderId): ?>
                    <button class="theme-btn btn btn-style-one" id="rzp-pay-btn" style="width:50%;">
                        <span class="btn-title">Make Payment</span>
                    </button>
                <?php elseif ($pay_on_off != 0 && $rzpError): ?>
                    <a href="javascript:history.back()" class="theme-btn btn btn-style-one" style="width:50%;">
                        <span class="btn-title">Go Back & Retry</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Gateway Maintenance Message -->
            <?php if ((int)$pay_on_off === 0): ?>
                <div class="pricing-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
                    <?php
                    $qry    = "SELECT * FROM cms WHERE cms_id='22'";
                    $result = mysqli_query($con, $qry);
                    $res    = mysqli_fetch_array($result);
                    ?>
                    <div class="col-sm-12">
                        <div class="contact-grid1 text-center">
                            <h5>Online Payment gateway is under maintenance, please choose manual payment</h5>
                            <p><?php echo $res['content']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <?php include('footer.php'); ?>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<script src="js/color-settings.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>

<?php if ($pay_on_off != 0 && $rzpOrderId): ?>
<script>
var rzpOptions = {
    key:         '<?php echo RZP_KEY_ID; ?>',
    amount:      '<?php echo $amountInPaise; ?>',
    currency:    'INR',
    name:        'Weddings parampara',
    description: '<?php echo addslashes($plan_row["plandisplayname"]); ?> Plan',
    image:       'logo-2.png',   // ← your logo path
    order_id:    '<?php echo $rzpOrderId; ?>',
    prefill: {
        name:    '<?php echo addslashes($record["Name"] ?? $record["MatriID"]); ?>',
        email:   '<?php echo addslashes($rowrs123["ConfirmEmail"] ?? ""); ?>',
        contact: '<?php echo addslashes($record["Mobile"] ?? ""); ?>',
    },
    notes: {
        MatriID:  '<?php echo $matriid; ?>',
        order_id: '<?php echo $strorderid; ?>',
        plan_id:  '<?php echo $strplanid; ?>',
    },
    theme: { color: '#c0392b' },

    handler: function(response) {
        // Build a hidden form and POST to payment_success.php
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'https://weddingsparampara.com/payment_success.php';

        var fields = {
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_order_id:   response.razorpay_order_id,
            razorpay_signature:  response.razorpay_signature,
            local_order_id:      '<?php echo $strorderid; ?>',
            plan_id:             '<?php echo $strplanid; ?>',
            amount:              '<?php echo $amount; ?>',
        };

        for (var k in fields) {
            var inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = k;
            inp.value = fields[k];
            form.appendChild(inp);
        }
        document.body.appendChild(form);
        form.submit();
    },

    modal: {
        ondismiss: function() {
            var btn = document.getElementById('rzp-pay-btn');
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = '<span class="btn-title">Make Payment</span>';
            }
        }
    }
};

var rzp = new Razorpay(rzpOptions);

rzp.on('payment.failed', function(response) {
    fetch('payment_failed_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            local_order_id: '<?php echo $strorderid; ?>',
            error: response.error.description
        })
    }).finally(function() {
        window.location.href = 'payment_failed.php?error=' + encodeURIComponent(response.error.description);
    });
});

document.getElementById('rzp-pay-btn').addEventListener('click', function() {
    this.disabled = true;
    this.innerHTML = '<i class="fa fa-spinner fa-spin fas"></i><span class="btn-title"> Opening Razorpay...</span>';
    rzp.open();
});
</script>
<?php endif; ?>

</body>
</html>