<?php 
require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

/**/
$id = base64_decode( urldecode($_REQUEST['id']) );
$my_profile = mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$id'");
$me = mysqli_fetch_array($my_profile);
include 'get_count.php';


?>
<!DOCTYPE html>
<html lang="en">


<head>
    <title> </title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
    
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
	<link rel="stylesheet" href="assets/css/stylnew.css" id="main-style-link">
	<link rel="stylesheet" href="assets/css/advance.css" id="main-style-link">

	<!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<link href="../css/style.css?v=505020.0" rel="stylesheet">
 
        <style>
        .form-control{
            width: 107% !important;
        }
        .input-group .btn {
        	margin-left: -14px;
        }
        .faic {
            margin-left: -3px;
            margin-right: -4px;
        }
        .mt-3 {
            margin-top: 2rem !important;
        }
        .alert-info {
            color: #257980;
            background-color: #dce9ff;
            border-color: #dce9ff;
        }
        .card {
            box-shadow: 0 2px 6px -1px rgb(16 16 16 / 23%);
            margin-bottom: 24px;
            transition: box-shadow 0.2s ease-in-out;
        }
        .card1 {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #dce9ff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0.125);
            border-radius: 4px;
        }
        * {
            margin: 0px;
            padding: 0px;
            border: none;
            outline: none;
        }
          
        .fa-check-circle:before {
            content: "\f058";
        }
        .gallery-item1 {
            position: relative;
            /* margin-bottom: 30px; */
        }
        .fancybox-navigation .fancybox-button--arrow_right {
            display: none;
        }
        .fancybox-navigation .fancybox-button--arrow_left {
            display: none;
        }
        .fancybox-is-sliding
        {
        	display:none;
        }
        .card-body {
            flex: 1 1 auto;
            padding: 24px 17px;
        }
        .gallery-item1 .overlay-box {
            position: absolute;
            left: 0;
            top: 0;
            height: 99%;
            width: 39%;
            text-align: center;
            content: "";
            opacity: 0;
            background-color: transparent;
            margin-left: 14%;
        }
        .gallery-item1 .overlay-box a {
            position: absolute;
            left: 8%;
            top: 161px;
            margin-top: -15px;
            margin-left: 84px;
        }
        .gallery-item1 .image-box .image img {
            display: block;
            width: 100%;
            height: 459px;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            color: #f20487;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        .search-popup1 {
            position: fixed;
            left: 0px;
            bottom: -100%;
            width: 100%;
            height: 100%;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            overflow: auto;
            background: rgba(0,0,0,0.80);
            transition: all 700ms ease;
            -moz-transition: all 700ms ease;
            -webkit-transition: all 700ms ease;
            -ms-transition: all 700ms ease;
            -o-transition: all 700ms ease;
        }
        * {
            margin: 0px;
            padding: 0px;
            border: none;
            outline: none;
        }
        .ticks{
            font-size: 16px;
            line-height: 30px;
             color: #777777;
        }
        .table.table-xs td, .table.table-xs th {
            padding: 0.1rem 0.1rem;
        }
        .tick {
            font-size: 16px;
            line-height: 30px;
            color: #2bd40f;
        }
		.atss .at-share-btn.at-svc-facebook{
			display:none;
		}
		.atss .at-share-btn.at-svc-twitter{
			display:none;
		}
		.atss .at-share-btn.at-svc-print {
			display:none;
		}
		.atss .at-share-btn.at-svc-compact {
			display:none;
		}
        .atss .at-share-btn.at-svc-gmail {
            display:none;
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
	
		
		<?php 
		<?php 
		
		<?php 


<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
       
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ task-board-left ] start -->
            <div class="col-xl-3 col-lg-4">
                <div class="card1 e-comm-card">
                    <div class="card-body py-3">
                        <div class="show" id="ecommfilstatus">
                            <div class="form-check ">
                                <b>User Profile | <?php echo $me['MatriID']; ?></b>
                            </div>
                            <div class="card-body pb-0">
                                <div class="gallery-item1  wow fadeIn">
    							    <div class="image-box ">
                                        <a href="../photoprocess.php?image=gallary/<?php echo $me['Photo1'];?>&square=500" class="lightbox-image"  data-fancybox='gallery'>
                                            <figure class="">
                                                <img src="../photoprocess.php?image=gallary/<?php echo $me['Photo1']; ?>&square=500" alt="prod img" class="img-fluid" >
                                            </figure>
                                        </a>
                                    </div>
							    </div>
							</div>
                            <div class="form-check mb-2">
                                <b>We found <span class='change_color'><?php echo $match_queryfetch['totalCount']; ?> Mutual Matches For This Profile.</b>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <b>Profile Expectation  </b>
                            </div>
                            <div class="form-check mb-2">
                                <table class="table table-xs w-auto table-borderless m-0">
                                    <tbody>
                                        <?php include 'self_preferences.php';?>
                                       	
                                          
                                    </tbody>
                                </table>
                                <!-- <a href="whatsapp://send?text=http://server-pc/7.0/console/share.php?id=TkQ0MQ%3D%3D" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp">SHARE</a> -->	
                                
                            </div>
                        </div>
                    </div>
				</div>
                
			</div>
			<!-- [ task-board-left ] end -->
            
            <!-- [ task-board-right ] start -->
            
		</div>

	</div>
</div>
	 <!--  -->          
  
</div>
<script src="plugins/node-waves/waves.js"></script>
<script>  


</script>  

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-604b0dafb173c8ba"></script>
<script>

    
    
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
<?php 
function get_height($strheight)
{
if($strheight =="1") { echo "4Ft "; }
else if($strheight =="2") { echo "4Ft 1 inch "; }
else if($strheight =="3") { echo "4Ft 2 inch "; }
else if($strheight =="4") { echo "4Ft 3 inch "; }
else if($strheight =="5") { echo "4Ft 4 inch "; }
else if($strheight =="6") { echo "4Ft 5 inch "; }
else if($strheight =="7") { echo "4Ft 6 inch "; }
else if($strheight =="8") { echo "4Ft 7 inch "; }
else if($strheight =="9") { echo "4Ft 8 inch "; }
else if($strheight =="10") { echo "4Ft 9 inch "; }
else if($strheight =="11") { echo "4Ft 10 inch "; }
else if($strheight =="12") { echo "4Ft 11 inch "; }
else if($strheight =="13") { echo "5Ft "; }
else if($strheight =="14") { echo "5Ft 1 inch "; }
else if($strheight =="15") { echo "5Ft 2 inch "; }
else if($strheight =="16") { echo "5Ft 3 inch "; }
else if($strheight =="17") { echo "5Ft 4 inch "; }
else if($strheight =="18") { echo "5Ft 5 inch "; }
else if($strheight =="19") { echo "5Ft 6 inch "; }
else if($strheight =="20") { echo "5Ft 7 inch "; }
else if($strheight =="21") { echo "5Ft 8 inch "; }
else if($strheight =="22") { echo "5Ft 9 inch "; }
else if($strheight =="23") { echo "5Ft 10 inch "; }
else if($strheight =="24") { echo "5Ft 11 inch "; }
else if($strheight =="25") { echo "6Ft "; }
else if($strheight =="26") { echo "6Ft 1 inch "; }
else if($strheight =="27") { echo "6Ft 2 inch "; }
else if($strheight =="28") { echo "6Ft 3 inch "; }
else if($strheight =="29") { echo "6Ft 4 inch "; }
else if($strheight =="30") { echo "6Ft 5 inch "; }
else if($strheight =="31") { echo "6Ft 6 inch "; }
else if($strheight =="32") { echo "6Ft 7 inch "; }
else if($strheight =="33") { echo "6Ft 8 inch "; }
else if($strheight =="34") { echo "6Ft 9 inch "; }
else if($strheight =="35") { echo "6Ft 10 inch "; }
else if($strheight =="36") { echo "6Ft 11 inch "; }
else if($strheight =="37") { echo "7Ft "; }
}
?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
    <!--<script src="assets/js/plugins/feather.min.js"></script>-->
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script>
    $('.e-comm-filter .form-check-input').change(function() {
        $('.filter-data').append('<div class="overlay-div"><div class="spinner-border text-primary" role="status"></div></div>');
        setTimeout(function() {
            $('.filter-data .overlay-div').fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>
<!-- plugin-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>




<!-- Latest compiled and minified CSS -->

<script src="../js/jquery.fancybox.js"></script>



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
            $('.m-header > .b-brand > .logo-lg').attr('src', '../branding/logos/emblem.png');
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
<?php 


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/ecom-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:05 GMT -->
</html>
