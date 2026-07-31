<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
    
  
  error_reporting(0);
 
?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    
    <title>Ban Member</title>
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

    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
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

<section class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Zero config table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ban Report</h5>
                    </div>
                    <div class="card-body">
                         <p align="center" style="#060606"><b><?php  echo $_GET['msg'];?></b></p>
						<div class="dt-responsive table-responsive">
						  <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
										 <th>Profile id</th>
										<th>Blocked Person</th>
										<th>Profile id</th>
										<th>Who Blocked</th>
										<th>Date</th>
										<?php //<th width="100px">Action</th>	?>					
								     </tr>
                                </thead>
                                <tbody>
										
										  <?php  
										$blocksql2=mysqli_query($con,"select * from block_member")or svr_db_fail($con);
 
										
											while($blockrow2 = mysqli_fetch_array($blocksql2))
											{
												$profile_id=$blockrow2['profile_id'];
												$matriid=$blockrow2['matriid'];
								              
											$blocksql3=mysqli_query($con,"select * from register where MatriID='$profile_id'")or svr_db_fail($con);
											$who_blocksql3=mysqli_query($con,"select * from register where MatriID='$matriid'")or svr_db_fail($con);
							$block3=0;
							if($blockrow3=mysqli_fetch_assoc($blocksql3) )
							{
								$block3=$blockrow3['Name'];
								
							}
							if( $who_blockrow3=mysqli_fetch_assoc($who_blocksql3) )
							{
								$who_block_name = $who_blockrow3['Name'];	
							} 
											
											?>
													
												 <tr>
													<td>
                                                        <a href="profile_view?ID=<?php  echo $blockrow3['MatriID'];?>"><?php  echo $blockrow2['profile_id'];?></a>
                                                     </td>
													<td>
														<?php  echo $block3;?>	
													
													 </td>
													 <td>
													 	<a href="profile_view?ID=<?php  echo $who_blockrow3['MatriID'];?>"><?php  echo $who_blockrow3['MatriID'];?></a>
													 </td>
													<td>
														<?php  echo $who_block_name;?>
													</td>
													<td>
														<?php 
															echo $blockrow2['when1'];
														?>
													</td>
													<?php  ?>
													
												  </tr>
												  <?php  }?>
									</tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			</div>
			</section>
			<?php include('footer.php');?>
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->
<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/pages/data-basic-custom.js"></script>
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
            url : 'delete_ban_new.php', //Here you will fetch records 
            data :  'rowid='+ rowid, 
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
<!-- Apex Chart -->
<!-- trumbowyg editor -->
<script src="assets/js/plugins/trumbowyg.min.js"></script>

<script type="text/javascript">
    // tinymce editor
    $(window).on('load', function() {
        $('#tinymce-editor').trumbowyg({
            svgPath: 'assets/css/plugins/icons.svg',
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        });
    });
</script>
<?php include('footersection.php');?>
</script>

   
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>

</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
 