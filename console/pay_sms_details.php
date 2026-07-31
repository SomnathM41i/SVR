<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
  /*include '../dbconnectadmin.php';*/
    $result=mysqli_query($con,"select * from siteconfig where ID='1'");
    $fetch1=mysqli_fetch_array($result);
    $domain_name = $fetch1['domain_name'];
   
    $sms=mysqli_query($con,"select * from smsgetway where id='1'");
    $sms_fetch1=mysqli_fetch_array($sms);
    $pay=mysqli_query($con,"select * from payment_getway where id='1'");
    $pay_fetch1=mysqli_fetch_array($pay);
    $email=mysqli_query($con,"select * from email_sending where id='1'");
    $email_fetch1=mysqli_fetch_array($email);
    
    $data_config = $db->get_siteconfig();
    $on_off = $data_config-> is_smtp_set;
    $auto_on_off = $data_config-> auto_approve;
    $sms_on_off = $data_config-> is_sms_set;
    $pay_on_off = $data_config-> is_pay_gateway_set;
    $otp_on_off = $data_config-> otp_on_off;
    $translator_on_off = $data_config-> translator_on_off;
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Admin Profile</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit"/>

    <!-- Favicon icon -->
      <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css"> 
    <link rel="stylesheet" href="assets/css/popup.css">
    <!--popup css-->



</head>
<body class="pc-horizontal">
    <div class="container">
    
        <!-- [ Pre-loader ] start -->
        
        <!-- [ Pre-loader ] End -->
        <!-- [ Mobile header ] start -->
       
        <!-- [ Header ] end -->
        <!-- [ navigation menu ] start -->
          <?php include('topheader.php');?>
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
          <?php include('topheader-empty.php');?>
        
        <!-- [ Header ] end -->
  
<!-- [ Main Content ] start -->
<div class="pc-container">  
    <div class="pcoded-content">     
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5><span class="p-l-5">Gateway Details</span></h5>
                    </div>
                    <div class="card-body">
                    
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4 " >
                                <div class="form-group">
                                    <h3>SMTP-Mail(API) </h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                            if($on_off != 0)
                                            { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">SMTP-Mail On</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">SMTP-Mail Off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        
                                        <br>
                                        <a href="<?php echo $domain_name ?>webmail/" target=_blank >Go Live</a><br>
                                        Username: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $email_fetch1['username']; ?></a><br>
                                        SMTP: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $email_fetch1['smtp']; ?></a><br>
                                        Password: ******
                                        <br><br>
                                        <button class="btn  btn-warning" type="submit" name="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <h3>SMS(API)</h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($sms_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">SMS is Set</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">SMS is Unset</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="<?php echo $sms_fetch1['sms_url']; ?>" target=_blank >Go Live</a><br>
                                        Username: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $sms_fetch1['username']; ?></a><br>
                                            Sender/Header: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $sms_fetch1['sender']; ?></a><br>
                                            Password: ******
                                            <br><br>
                                        <button class="btn  btn-warning " type="submit" name="update1">Update</button>
                                    </form>
                                </div>
                            </div>

                            <?php 
                                //FOR PAYMENT GATEWAY    
                            ?>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <h3>Payment Gateway(API)</h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway is On</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway is  Off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="<?php echo $pay_fetch1['gateway_url']; ?>" target=_blank >Go Live</a><br>
                                         Merchant ID: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                            Merchant Key: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                            Merchant Salt: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_salt']; ?></a><br><br>
                                        <button class="btn  btn-warning" type="submit" name="update_pay">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <h3>Automatic Profile Approve </h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($auto_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Auto Approve On</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Auto Approve Off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <button class="btn  btn-warning mt-4" type="submit" name="update">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <h3>OTP on/off</h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($otp_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">OTP Step on</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">OTP Step off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <a href="otp_system" target=_blank >Know The System?</a><br><br>
                                        <button class="btn  btn-warning" type="submit" name="update_otp">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <h3>Google Translator on/off</h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($translator_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Google Translator on</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Google Translator off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br><br>
                                        <button class="btn  btn-warning" type="submit" name="update_translator_status">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <!-- <h3 class="">SMS Gateway</h3> -->
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <!-- <h3 class="">Payment Gateway</h3> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
</div>
</div>

</div>

<?php include('footersection.php');?>


</script>
<?php include('footer.php');?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
<!-- Apex Chart -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

</body>
</html>