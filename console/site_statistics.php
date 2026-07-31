<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
//include'../dbconnectadmin.php';


?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
<head>
    <title>Site Statistics</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
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

    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
	<style>
	.row {
    --bs-gutter-x: -0.5rem;
	}
	
	</style>

</head>
<body class="pc-horizontal">
	<div class="">
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
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		<?php include('notification.php');?>
		
		<!-- [ Header ] end -->

<!-- [ Main Content ] start -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
		 <section class="content">
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Site Statistics</h5>
                    </div>
                    <div class="card-body">
                        
                        <!--<div class="row align-items-center m-l-0">
                            <div class="col-sm-6">
							  <h3></h3>
                            </div>
                           
                        </div>-->
                        <div class="dt-responsive table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                           <th>Religion</th>
											<th>Grooms</th>
											<th>Brides</th>
     
                                    </tr>
                                </thead>
                                <tbody>
								 <?php  
										$relsql=$con->query("select * from religion ORDER BY Religion ASC")or svr_db_fail($con);
											while($relrow = $relsql->fetch_assoc())
											{
												$religion=$relrow['Religion'];
											$groomsql=$con->query("select IFNULL(Count(*),0) as num  from register where Religion='$religion' And Gender='Male' ")or svr_db_fail($con);
							$groom=0;
							if($groomrow=$groomsql->fetch_assoc())
							{
							$groom=	$groomrow['num'];
							}
											$bridesql=$con->query("select IFNULL(Count(*),0) as num  from register where Religion='$religion' And Gender='Female' ")or svr_db_fail($con);
 	
							$bride=0;
							if($briderow=$bridesql->fetch_assoc())
							{
							$bride=	$briderow['num'];
							}
											?>
											<tr>
											    <td><?php  echo $religion;?></td>
												<td><?php  echo $groom?></td>
												<td><?php  echo $bride;?></td>
											</tr>
											<?php  
										  
										  }
										  ?>
                                    
                                    
                                </tbody>
                            <!--</table>
							 <table id="report-table" class="table table-bordered table-striped mb-0">-->
                                <thead>
                                    <tr>
                                           <th>Caste</th>
											<th>Grooms</th>
											<th>Brides</th>
     
                                    </tr>
                                </thead>
                                <tbody>
								 <?php  
										$relsql=$con->query("select * from caste ORDER BY Caste ASC")or svr_db_fail($con);
 
										
											while($relrow = $relsql->fetch_assoc())
											{
												$caste=$relrow['Caste'];
											$groomsql=$con->query("select IFNULL(Count(*),0) as num  from register where Caste='$caste' And Gender='Male' ")or svr_db_fail($con);
							$groom=0;
							if($groomrow=$groomsql->fetch_assoc())
							{
							$groom=	$groomrow['num'];
							}
											$bridesql=$con->query("select IFNULL(Count(*),0) as num  from register where Caste='$caste' And Gender='Female' ")or svr_db_fail($con);
 	
							$bride=0;
							if($briderow=$bridesql->fetch_assoc())
							{
							$bride=	$briderow['num'];
							}
											?>
											<tr>
											     <td><?php  echo $caste;?></td>
												 <td><?php  echo $groom?></td>
												  <td><?php  echo $bride;?></td>
											</tr>
											<?php  
										  
										  }
										  ?>
                                    
                                    
                                </tbody>
                            </table>
						
                        </div>
                    </div>
                </div>
            </div>
            <!-- customar project  end -->
			
        </div>
		</section>
		
        <!-- [ Main Content ] end -->
		
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

<!--<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>-->
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script>
    // DataTable start
    $('#report-table').DataTable();
    // DataTable end
</script>
</script>
<?php include('footersection.php');?>
</script>
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
           
        </div>
    </div>
</div>


<div class="modal fade" id="modal-report2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog">
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
            url : 'editcountry_pop.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
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


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/hospital-doctor.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:53 GMT -->
</html>
