<?php require_once('../sys_dbconnection.php');
include('protect.php');

if(isset($_POST['submit2']))
	{
		echo "hello";
		echo $_GET['ID'];
		
		if(isset($_GET['ID']))
		{
			$id= $_GET['ID'];
			
			
			$amount=$_POST['camount'];
			echo $amount;
			$amot1=mysqli_query($con,"update contactpaidamount set contactamount='$amount' where cid='$id'");
			if($amt1>0) 
			{
				$msg="Amount updated successfully";
			}
			
		}
			header('location:add_contactamount?msg=success');
	}


?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/member-membership.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:56 GMT -->
<head>
    <title>Amount</title>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	  <link rel="stylesheet" href="assets/css/popup.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript">
	 $(window).load(function(){        
	   $('#myModal').modal('show');
		}); 
	</script>
	<style>
	

.badge {
    padding: 0.55em 1em;
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
			  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		<?php include('notification.php');?>
		<!-- [ Header ] end -->
		<!-- [ Header ] end -->
		<!-- [ navigation menu ] start -->
	
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		
		<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
		 <div class="col-sm-10 text-center mb-4">
		 </div>
		    <div class="col-sm-2 text-end">
            <!--  <button class="btn btn-success btn-sm mb-3 btn-round" data-bs-toggle="modal" data-bs-target="#modal-report" data-id="1"><i class="feather icon-plus"></i> Add New Plan</button>
             --> </div>
            <!-- liveline-section start -->
          
		<div class="col-sm-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php  $row1=mysqli_query($con,"select * from contactpaidamount where cid='1'");
						       $row12=mysqli_fetch_array($row1);?>
                        <h4 class="mt-3"><?php  
						 <h5 class="mt-3">Amount :<?php  echo $row12['contactamount'];?></h5>
                       
                        <hr>
					

                       <button type="button" class="btn btn-icon btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#modal-report12" data-id="<?php echo $row12['cid'];?>"><i class="feather icon-edit-2"></i></button>
                      <?php  ?>
					</div>
                </div>
            </div> <br><br>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="modal-report2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#modal-report2').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'get_membership.php', //Here you will fetch records 
            data :  'rowid='+ rowid, 
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>

<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#modal-report').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'add_membership.php', //Here you will fetch records 
            data :  'rowid='+ rowid, 
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
<div class="modal fade" id="modal-report12" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#modal-report12').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'ContactAmount.php', //Here you will fetch records 
            data :  'rowid='+ rowid, 
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script>

</script>
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
<?php if($_GET['msg']!=''){ ?>
<div id="myModal" class="modal " role="dialog" style="margin-top: 100px;">
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
						<?php if($_GET['msg']=='success'){?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Amount Updated Succesfully" ?></h2>
						<?php } else if($_GET['msg']=='active') { ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Amount Activated Succesfully" ?></h2>
    					<?php } else if($_GET['msg']=='inactive') { ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "Amount Inactivated Succesfully" ?></h2>
						<?php } else if($_GET['msg']=='newsuccess') { ?>
							<h2 class="swal2-title" id="swal2-title" style="display: flex;"><?php echo "New Plan Added Succesfully" ?></h2>
    					<?php }?>
	
					</div>
					<div class="swal2-actions">
						<a href="add_contactamount" data-target="#" class="swal2-confirm swal2-styled"  style="display: inline-block;">OK</a>
      				</div>
    			</div> 
			</div>
		</div>   
	</div>
</div>
<?php } ?>




<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
  
  
  
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

</body>

<?php include('footer.php')?>
<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/member-membership.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:57 GMT -->
</html>
