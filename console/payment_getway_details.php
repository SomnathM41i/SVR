<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
  
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
    
  //error_reporting(0);<img src ="otpsystem/OTP-step-remove.jpg">
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Payment Getway</title>
   
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .pc-horizontal .pc-container .pcoded-content > .row:first-child 
        {
        padding-top: 0px;
        }
        .card-header
        {
            padding: 10px 25px;
        }
        .fa-solid
        {
            font-size: 40px;
        }

        .form-switch .paycheck
        {
           padding: 20px;
           margin-left: -27px;
           position: absolute;
        } 
        input[type=checkbox], input[type=radio] {
            box-sizing: border-box;
            padding: 0;
            height: 20px;
            width: 20px;
        }
        .form-switch .radiocss
        {
           padding: 20px;
           margin-left: -27px;
           position: absolute;
        } 
        .form-switch {
            padding-left: 2em;
        }
        
        .card-body img
        {
            width: 200px;
            height: 50px;
            margin-left: -18px;
        }
        .card-body .payuImg
        {
            width: 200px;
            height: 50px;
            margin-left: -47px;
        }
        .card-footer img
        {
            width: 200px;
            height: 50px;
            margin-left: -24px;
        }
        .card-footer .stripeImg
        {
            width: 200px;
            height: 50px;
            margin-left: -54px;
        }
        .heading
        {
            font-size: 18px;
        }
        .card .card-header2 {
            border-bottom: 1px solid #f1f1f1;
            margin-top: -32px;
        }
        .secondRow
        {
            margin-top: 30px;
           
        }
        .btn
        {
            color: #ff0000;
            border: none;
            padding: 0px;
        }
        .btn1
        {
            color: #11aa70;
        }
        .btn:hover
        {
            color: #ff0000;
        }
        .btn1:hover
        {
            color: #11aa70;
        }
        .off
        {
            background: #9ea3a7;
            padding: 2px 6px;
            border-radius:8px;
            color: white;
        }
        .on
        {
            background: #11aa70;
            padding: 2px 6px;
            border-radius:8px;
            color: white;
        }

        @media screen and (max-width: 768px)
        {
            .secondRow
            {
                margin-top: 30px;
            }
            .card1
            {
                margin-top: 20px;
            }
        }
    </style>
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
                <div class="card card1">
                    <div class="card-header">
                        <h5><span class="p-l-5 heading">National Getway</span></h5>
                    </div>
                    <div class="card-body">
                    
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4 " >
                                <div class="form-group">
                                    <img src="assets/images/rozer.png" />
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss"> 
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss"> 
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://dashboard.razorpay.com/signin?screen=sign_in" target=_blank >Go Live</a><br>
                                         Merchant ID: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a>
                                            <br><br>
                                        <button class="btn btn1" type="submit" name="update_pay">Activated</button>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <img src="assets/images/instamojo.png" />
                                    <!-- <form action="change_settings" METHOD="POST"> -->
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                           <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://www.instamojo.com/accounts/login" target=_blank >Go Live</a><br>
                                         Private API Key: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                         Private Auth Token: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                         Private Salt: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_salt']; ?></a><br><br>
                                        <button class="btn" type="submit" name="update_pay">Inactivated</button>
                            <!-- </form> -->
                                </div>
                            </div>
                            <?php 
                                //FOR PAYMENT GATEWAY    
                            ?>
                            <div class="col-md-4" >
                                <div class="form-group">
                                    <img src="assets/images/payumoney.png" class="payuImg" />
                                   <!--  <form action="change_settings" METHOD="POST"> -->
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://onboarding.payu.in/app/account/signin?_ga=2.229375327.297948003.1663830156-617882172.1663830156&_gac=1.49092692.1663850814.Cj0KCQjwj7CZBhDHARIsAPPWv3c1yEPyYNpxhCIrSC1_zTda2HwTIEJoYNZvSgFDDPXjlsiW7LVtKOoaAnUEEALw_wcB" target=_blank >Go Live</a><br>
                                         Merchant ID: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                            Merchant Key: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                            Merchant Salt: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_salt']; ?></a><br><br>
                                        <button class="btn" type="submit" name="update_pay">Inactivated</button>
                                   <!--  </form> -->
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <img src="assets/images/paytm.png" />
                           <!--  <form action="change_settings" METHOD="POST"> -->
                                    <?php 

                                    if($pay_on_off != 0)
                                    { 
                                    ?>
                                    <div class="form-check form-switch">
                                        <input type="radio" name="pub" class="radiocss">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway is <span class="on">On<span></label>
                                    </div>
                                    <?php 
                                        }
                                        else
                                        {
                                    ?>
                                    <div class="form-check form-switch">
                                        <input type="radio" name="pub" class="radiocss">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway is  <span class="off">Off</span></label>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <br>
                                    <a href="https://dashboard.paytm.com/login/" target=_blank >Go Live</a><br>
                                     mid: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                        string: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                        mandatory: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_salt']; ?></a><br><br>
                                    <button class="btn" type="submit" name="update_pay">Inactivated</button>
                            <!-- </form> -->
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <img src="assets/images/ccavenue.png" />
                                <!-- <form action="change_settings" METHOD="POST"> -->
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input type="radio" name="pub" class="radiocss">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://dashboard.ccavenue.com/jsp/merchant/merchantLogin.jsp" target=_blank >Go Live</a><br>
                                         Merchant ID: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                            Access Code: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                            Working Key: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_salt']; ?></a><br><br>
                                        <button class="btn" type="submit" name="update_pay">Inactivated</button>
                                </form>
                                </div>
                            </div>
							  <!-- <div class="col-md-4 mt-3" >
                                <div class="form-group">
                                    <h3><i class="fa-solid fa-money-bill-1-wave"></i></h3>
                                    <h3>Google Translator on/off</h3>
                                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($translator_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Google Translator on</label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Google Translator off</label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br><br>
                                        <button class="btn  btn-warning" type="submit" name="update_translator_status">Update</button>
                                    </form>
                                </div>
                            </div> -->
                            <div class="col-md-4" >
                                <div class="form-group">
                                    
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
                <div class="card-footer">
                        <div class="row">
                         <div class="card-header card-header2">
                        <h5><span class="heading heading2">International Getway</span></h5>
                        </div>
                        <div class="row secondRow">
                             <div class="col-md-4">
                           
                    <img src="assets/images/paypal.png" />
                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://www.paypal.com/signin" target=_blank >Go Live</a><br>
                                         Payment Link: <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                            Email Id: <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br>
                                            <br>
                                        <button class="btn btn1" type="submit" name="update_pay">Activated</button>
                                    </form>
                        </div>
                        <div class="col-md-4">
                    <img src="assets/images/stripe.png" class="stripeImg" />
                    <form action="change_settings" METHOD="POST">
                                        <?php 

                                        if($pay_on_off != 0)
                                        { 
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault" checked>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="on">On<span></label>
                                        </div>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <div class="form-check form-switch">
                                            <input class="paycheck" type="checkbox" id="flexSwitchCheckDefault"  >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Payment Gateway <span class="off">Off</span></label>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                        <a href="https://dashboard.stripe.com/login" target=_blank >Go Live</a><br>
                                         Publishable <a href="#!" class="mb-1 text-muted align-items-end text-h-primary"> <?php echo $pay_fetch1['merchent_id']; ?></a><br>
                                            Secret <a href="#!" class="mb-1 text-muted  align-items-end text-h-primary"><?php echo $pay_fetch1['merchant_key']; ?></a><br><br>
                                        <button class="btn btn1" type="submit" name="update_pay">Activated</button>
                                    </form>
                       
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
<!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

</script>
<?php include('footer.php');?>
    
<!-- Apex Chart -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>
<script>
    function btneff(){
        var a = document.fname.
    }
</script>

</body>
</html>