<?php require_once('../includes/bootstrap.php'); 

$query=mysqli_query($con,"select * from siteconfig  where ID='1'");
$fetch=mysqli_fetch_array($query);
$name=$fetch['Webname'];
?>
<!DOCTYPE html>
<html lang="en"><head>  
	<title>Manpasand Jodidar — Admin Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Manpasand Jodidar"/>
	<meta name="keywords" content="Manpasand Jodidar"/>
	<meta name="author" content="Manpasand Jodidar" />

	<!-- Favicon icon -->
	<?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">

	<!-- font css -->
	<link rel="stylesheet" href="assets/fonts/feather.css">
	<link rel="stylesheet" href="assets/fonts/fontawesome.css">
	<link rel="stylesheet" href="assets/fonts/material.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
	<link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
	<link rel="stylesheet" href="assets/css/customizer.css">
<style>
html, body { height:100%; margin:0; }
body { background:url('../images/main-slider/2.jpg') no-repeat center center fixed !important; background-size:cover !important; }
body::before { content:''; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:0; }
.auth-wrapper.auth-v3 { background:transparent !important; justify-content:flex-end !important; position:relative; z-index:1; }
.auth-wrapper.auth-v3 .auth-content { margin:0; width:50%; max-width:600px; min-width:380px; display:flex; align-items:center; padding:20px 40px; }
@media (max-width:768px) {
  .auth-wrapper.auth-v3 { justify-content:center !important; }
  .auth-wrapper.auth-v3 .auth-content { width:100%; padding:20px; }
}
.auth-wrapper.auth-v3 .auth-content .card { background:#fff !important; box-shadow:0 15px 50px rgba(0,0,0,0.2); border:none; border-radius:12px; width:100%; overflow:hidden; }
.auth-wrapper.auth-v3 .auth-content .card-body { padding:40px 36px !important; }
.auth-wrapper.auth-v3 .auth-content .card .text-primary { color:#8B1A2B !important; }
.auth-wrapper.auth-v3 .auth-content .card .btn-primary { background:linear-gradient(135deg, #8B1A2B, #C9A84C); border:none; border-radius:6px; padding:10px 30px; font-weight:600; letter-spacing:0.3px; transition:all 0.3s; }
.auth-wrapper.auth-v3 .auth-content .card .btn-primary:hover { background:linear-gradient(135deg, #6e1422, #b8922e); transform:translateY(-1px); box-shadow:0 4px 12px rgba(139,26,43,0.3); }
.auth-wrapper.auth-v3 .auth-content .card .btn-light-primary { border-radius:6px; padding:10px 30px; font-weight:500; }
.auth-wrapper.auth-v3 .auth-content .card .input-group-text { background:#f8f0e6; border-color:#e0d0b8; color:#8B1A2B; border-radius:6px 0 0 6px; }
.auth-wrapper.auth-v3 .auth-content .card .form-control { border-color:#e0d0b8; border-radius:0 6px 6px 0; padding:10px 16px; font-size:14px; }
.auth-wrapper.auth-v3 .auth-content .card .form-control:focus { border-color:#C9A84C; box-shadow:0 0 0 0.2rem rgba(201,168,76,0.25); }
.auth-wrapper.auth-v3 .auth-content .card h4 { font-size:1.15rem; color:#333; }
.auth-wrapper.auth-v3 .auth-content .card .row { justify-content:flex-end; }
.auth-wrapper.auth-v3 .auth-content .card .col-md-6.img-card-side { display:none; }
.auth-wrapper.auth-v3 .auth-content .card .col-md-6 { flex:0 0 100%; max-width:100%; }
</style>
<script>

    function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
        return false;
        return true;
    }
    function blockSpecialChar(e)
    { 
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    }
    function isNumber(evt) 
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) 
        {
            return false;
        }
        return true;
    }
</script>
</head>

<!-- [ auth-signup ] start -->
 
<div class="auth-wrapper auth-v3">
	<div class="auth-content">
		<div class="card">
		<form action="login_submit.php" method="post">
			<?php require_once('../includes/security.php'); echo svr_csrf_field(); ?>
			<div class="row align-items-stretch text-center">
				<div class="col-md-6 img-card-side">
				</div>
				 
				<div class="col-md-6">
					<div class="card-body">
						<div class="">
							<img src="../branding/logos/emblem.png" alt="" style="max-width:100px;border-radius:50%;margin-bottom:10px;">
							<h4 class="mb-3 f-w-600">Welcome to <span class="text-primary"><br><?php echo  $name;?></span></h4>
							<p class="text-muted mb-3">Welcome Back, Please Login <br>Into a Secure Console.</p>
							<font color="#EA4D4D"> <?php echo $_GET['err'];?>
						</div>
						<div class="">
							<div class="input-group mb-3">
								<span class="input-group-text"><i data-feather="user"></i></span>
								<input type="text" name="userid" autofocus class="form-control"  placeholder=" Enter Username" required tabindex="1" >
							</div>
							<div class="input-group mb-4">
								<span class="input-group-text"><i data-feather="lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder=" Enter Password" tabindex="2" >
							</div>
								<div class="row">
						<div class="">
							<button class="btn btn-light-primary mt-2">Cancel</button>
							<button class="btn btn-primary mt-2">Login</button>
						</div>
							</div>
						</div>
						
						<div class="col-md-12 offset-md-1 mt-2">
	

								
								<!-- <div class="col-md-4">
								<a href="#!" class="text-primary"><span>Vendor</span></a>
								</div> -->
							</div>
					</div>
				  </div>
				
			</div>
			</form>
		</div>
	</div>
</div>

<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<?php /*<div class="pct-customizer">
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
*/ ?>
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


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/auth-signin-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:37 GMT -->
</html>
