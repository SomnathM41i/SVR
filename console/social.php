<?php 
    
    require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Social</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/popup.css">
	<style>
		@media (max-width: 575.98px) {
			.pc-container .pcoded-content {
				padding: 0px;
			} 
			}
			
			@media screen and (max-width: 768px) {
			
				.card-body {
					flex: 1 1 auto;
					padding: 25px 0px;
				}
			}
			@media screen and (max-width: 568px) {
			
			.card-body {
					flex: 1 1 auto;
					padding: 25px 0px;
				}
			}
	</style>
</head>
<body class="pc-horizontal">
    <div class="container">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        <!-- [ Mobile header ] start -->
       
        <!-- [ Mobile header ] End -->
        <!-- [ Header ] start -->
    
        <!-- [ Header ] end -->
        <!-- [ navigation menu ] start -->
        
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
          <?php include('topheader.php');?>
          <?php include('header.php');?>
        <!-- [ navigation menu ] end -->
        <!-- Modal -->
        <?php include('notification.php');?>
        <!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
                   
          <?php  $seting=mysqli_query($con,"select * from siteconfig");
                       $rowconfig=mysqli_fetch_array($seting); ?>
                            <div class="card-body">
                            
                             <form role="form" method="post" action="social_submit" > 
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-facebook text-white"  >
                                            <i class="fab fa-facebook-f"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Profile Url" id="facebook" name="facebook" value="<?php  echo $rowconfig['facebook'];?>">
                                        <button class="btn btn-primary bg-facebook" type="submit">Connect</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-twitter text-white" id="twitter" name="twitter">
                                            <i class="fab fa-twitter"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Profile Url"  name="twitter" value="<?php  echo $rowconfig['twitter'];?>">
                                        <button class="btn btn-info bg-twitter" type="submit" id="twitter">Connect</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">You Tube</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-youtube text-white" >
                                            <i class="fab fa-youtube"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Profile Url" id="youtube" name="youtube" value="<?php  echo $rowconfig['youtube'];?>">
                                        <button class="btn btn-danger bg-youtube" type="submit">Connect</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-instagram text-white" >
                                            <i class="fab fa-instagram"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Profile Url" id="others" name="others" value="<?php  echo $rowconfig['other_social'];?>" >
                                        <button class="btn btn bg-instagram" type="submit">Connect</button>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                    </form>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
</div>
<?php include('footer.php');?>
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script src="assets/js/plugins/select2.full.min.js"></script>
<script>
    $(function() {
        $(".skill-mlt-select").select2();
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
     $(window).load(function(){        
       $('#myModal13').modal('show');
        }); 
    </script>

<?php if($_GET['msg']=='Link'){ ?>

  <div id="myModal13" class="modal " role="dialog" style="margin-top: 100px;">
  <div class="modal-dialog">
         <div class="modal-content">     
    <div class="modal-body modalb">
<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
<div class="swal2-header">
<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
<div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
      <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
      <div class="swal2-success-ring"></div> 
      <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
      <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
    </div>
    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Link Updated Successfully</h2>
    </div>
    <div class="swal2-actions">
    
    <a href="social" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      </div>
    </div> 
</div>
</div>   
</div>
</div>   
</div>
<?php } ?>


<div class="pct-customizer">
    <div class="pct-c-btn">
        <button class="btn btn-light-danger" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
        <button class="btn btn-light-primary" data-bs-toggle="tooltip" title="Document" data-placement="left">
            <i data-feather="book"></i>
        </button>
        <button class="btn btn-light-success" data-bs-toggle="tooltip" title="Buy Now" data-placement="left">
            <i data-feather="shopping-bag"></i>
        </button>
        <button class="btn btn-light-info" data-bs-toggle="tooltip" title="Support" data-placement="left">
            <i data-feather="headphones"></i>
        </button>
    </div>
    <div class="pct-c-content ">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">DashboardKit Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2"><i data-feather="credit-card" class="me-2"></i>Header settings</h6>
            <hr class="my-2">
            <div class="theme-color header-color">
                <a href="#!" class="" data-value="bg-default"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="layout" class="me-2"></i>Sidebar settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="cust-sidebar">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebar">Light Sidebar</label>
            </div>
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-sidebrand">
                <label class="form-check-label f-w-600 pl-1" for="cust-sidebrand">Color Brand</label>
            </div>
            <div class="theme-color brand-color d-none">
                <a href="#!" class="active" data-value="bg-primary"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-danger"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-warning"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-info"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-success"><span></span><span></span></a>
                <a href="#!" class="" data-value="bg-dark"><span></span><span></span></a>
            </div>
            <h6 class="mt-4"><i data-feather="sun" class="me-2"></i>Layout settings</h6>
            <hr class="my-2">
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-darklayout">
                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">Dark Layout</label>
            </div>
        </div>
    </div>
</div>

<script>
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');
    });
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'http://localhost/SVR/css3/assets/shivraj-logo.png');
            $('.m-header').addClass(temp);
        }
    });
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
        }
    });
    $('#cust-darklayout').change(function() {
        if ($(this).is(":checked")) {
            $("#main-style-link").attr("href", "assets/css/style-dark.css");
        } else {
            $("#main-style-link").attr("href", "assets/css/style.css");
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:37 GMT -->
</html>
