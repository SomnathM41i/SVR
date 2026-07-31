<?php require_once(dirname(__FILE__).'/protect.php'); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:53:41 GMT -->
<head>
    <title>Admin Dashboard</title>
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
    <link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">

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
		  <?php include('topheader.php');?>
		  <?php include('header.php');?>
		<!-- [ navigation menu ] end -->
		<!-- Modal -->
		<div class="modal notification-modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close">
						</button>
						<ul class="nav nav-pill tabs-light mb-3" id="pc-noti-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pc-noti-home-tab" data-bs-toggle="pill" href="#pc-noti-home" role="tab" aria-controls="pc-noti-home" aria-selected="true">Notification</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pc-noti-news-tab" data-bs-toggle="pill" href="#pc-noti-news" role="tab" aria-controls="pc-noti-news" aria-selected="false">News<span
										class="badge badge-danger ms-2 d-none d-sm-inline-block">4</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pc-noti-settings-tab" data-bs-toggle="pill" href="#pc-noti-settings" role="tab" aria-controls="pc-noti-settings" aria-selected="false">Setting<span
										class="badge badge-success ms-2 d-none d-sm-inline-block">Update</span></a>
							</li>
						</ul>
						<div class="tab-content pt-4" id="pc-noti-tabContent">
							<div class="tab-pane fade show active" id="pc-noti-home" role="tabpanel" aria-labelledby="pc-noti-home-tab">
								<div class="media">
									<img src="assets/images/user/avatar-1.jpg" alt="images" class="img-fluid avtar avtar-l">
									<div class="media-body ms-3 align-self-center">
										<div class="float-end">
											<div class="btn-group card-option">
												<button type="button" class="btn shadow-none">
													<i data-feather="heart" class="text-danger"></i>
												</button>
												<button type="button" class="btn shadow-none px-0 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i data-feather="more-horizontal"></i>
												</button>
												<div class="dropdown dropdown-menu dropdown-menu-end">
													<a class="dropdown-item" href="#!"><i data-feather="refresh-cw"></i> reload</a>
													<a class="dropdown-item" href="#!"><i data-feather="trash"></i> remove</a>
												</div>
											</div>
										</div>
										<h6 class="mb-0 d-inline-block">Ashoka T.</h6>
										<p class="mb-0 d-inline-block"> • 06/20/2019 at 6:43 PM </p>
										<p class="my-3">Cras sit amet nibh libero in gravida nulla Nulla vel metus scelerisque ante sollicitudin.</p>
										<div class="p-3 mb-3 border rounded">
											<div class="media align-items-center">
												<div class="media-body">
													<h6 class="mb-1">Death Star original maps and blueprint.pdf</h6>
													<p class="mb-0">by Ashoka T. • 06/20/2019 at 6:43 PM </p>
												</div>
												<div class="btn-group d-none d-sm-inline-flex">
													<button type="button" class="btn shadow-none">
														<i data-feather="download-cloud"></i>
													</button>
													<button type="button" class="btn shadow-none px-0 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i data-feather="more-horizontal"></i>
													</button>
													<div class="dropdown dropdown-menu dropdown-menu-end">
														<a class="dropdown-item" href="#!"><i data-feather="refresh-cw"></i> reload</a>
														<a class="dropdown-item" href="#!"><i data-feather="trash"></i> remove</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr class="mb-4">
								<div class="media">
									<img src="assets/images/user/avatar-2.jpg" alt="images" class="img-fluid avtar avtar-l">
									<div class="media-body ms-3 align-self-center">
										<div class="float-end">
											<div class="btn-group card-option">
												<button type="button" class="btn shadow-none px-0 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i data-feather="more-horizontal"></i>
												</button>
												<div class="dropdown dropdown-menu dropdown-menu-end">
													<a class="dropdown-item" href="#!"><i data-feather="refresh-cw"></i> reload</a>
													<a class="dropdown-item" href="#!"><i data-feather="trash"></i> remove</a>
												</div>
											</div>
										</div>
										<h6 class="mb-0 d-inline-block">Ashoka T.</h6>
										<p class="mb-0 d-inline-block"> • 06/20/2019 at 6:43 PM </p>
										<p class="my-3">Cras sit amet nibh libero in gravida nulla Nulla vel metus scelerisque ante sollicitudin.</p>
										<img src="assets/images/slider/img-slide-3.jpg" alt="images" class="img-fluid wid-90 rounded m-r-10 m-b-10">
										<img src="assets/images/slider/img-slide-7.jpg" alt="images" class="img-fluid wid-90 rounded m-r-10 m-b-10">
									</div>
								</div>
								<hr class="mb-4">
								<div class="media mb-3">
									<img src="assets/images/user/avatar-3.jpg" alt="images" class="img-fluid avtar avtar-l">
									<div class="media-body ms-3 align-self-center">
										<div class="float-end">
											3 <i data-feather="heart" class="text-danger"></i>
										</div>
										<h6 class="mb-0 d-inline-block">Ashoka T.</h6>
										<p class="mb-0 d-inline-block"> • 06/20/2019 at 6:43 PM </p>
										<p class="my-3">Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur.</p>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pc-noti-news" role="tabpanel" aria-labelledby="pc-noti-news-tab">
								<div class="pb-3 border-bottom mb-3 media">
									<a href="#!"><img src="assets/images/news/img-news-2.jpg" class="wid-90 rounded" alt="..."></a>
									<div class="media-body ms-3">
										<p class="float-end mb-0 text-success"><small>now</small></p>
										<a href="#!">
											<h6>This is a news image</h6>
										</a>
										<p class="mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
									</div>
								</div>
								<div class="pb-3 border-bottom mb-3 media">
									<a href="#!"><img src="assets/images/news/img-news-1.jpg" class="wid-90 rounded" alt="..."></a>
									<div class="media-body ms-3">
										<p class="float-end mb-0 text-muted"><small>3 mins ago</small></p>
										<a href="#!">
											<h6>Industry's standard dummy</h6>
										</a>
										<p class="mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
										<a href="#" class="badge badge-light">Html</a>
										<a href="#" class="badge badge-light">UI/UX designed</a>
									</div>
								</div>
								<div class="pb-3 border-bottom mb-3 media">
									<a href="#!"><img src="assets/images/news/img-news-2.jpg" class="wid-90 rounded" alt="..."></a>
									<div class="media-body ms-3">
										<p class="float-end mb-0 text-muted"><small>5 mins ago</small></p>
										<a href="#!">
											<h6>Ipsum has been the industry's</h6>
										</a>
										<p class="mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
										<a href="#" class="badge badge-light">JavaScript</a>
										<a href="#" class="badge badge-light">Scss</a>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pc-noti-settings" role="tabpanel" aria-labelledby="pc-noti-settings-tab">
								<h6 class="mt-2"><i data-feather="monitor" class="me-2"></i>Desktop settings</h6>
								<hr>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="pcsetting1" checked>
									<label class="custom-control-label f-w-600 pl-1" for="pcsetting1">Allow desktop notification</label>
								</div>
								<p class="text-muted ms-5">you get lettest content at a time when data will updated</p>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="pcsetting2">
									<label class="custom-control-label f-w-600 pl-1" for="pcsetting2">Store Cookie</label>
								</div>
								<h6 class="mb-0 mt-5"><i data-feather="save" class="me-2"></i>Application settings</h6>
								<hr>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="pcsetting3">
									<label class="custom-control-label f-w-600 pl-1" for="pcsetting3">Backup Storage</label>
								</div>
								<p class="text-muted mb-4 ms-5">Automaticaly take backup as par schedule</p>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="pcsetting4">
									<label class="custom-control-label f-w-600 pl-1" for="pcsetting4">Allow guest to print file</label>
								</div>
								<h6 class="mb-0 mt-5"><i data-feather="cpu" class="me-2"></i>System settings</h6>
								<hr>
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="pcsetting5" checked>
									<label class="custom-control-label f-w-600 pl-1" for="pcsetting5">View other user chat</label>
								</div>
								<p class="text-muted ms-5">Allow to show public user message</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-danger btn-sm" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-light-primary btn-sm">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Home</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Admin Dashboard </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      
                
     
		
		  <div class="row"> 
		 <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Terms</h2>
                        <h6 class="text-white">Create CMS for T & c</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Faq's</h2>
                        <h6 class="text-white">Create CMS For FAQ</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-warning text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Contact Us</h2>
                        <h6 class="text-white">Create CMS For Contact Us</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
          <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">About Us</h2>
                        <h6 class="text-white">Create CMS For About Us</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Privacy Policy</h2>
                        <h6 class="text-white">Create CMS For Privacy Policy</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-warning text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Refund Policy</h2>
                        <h6 class="text-white">Create CMS For Refund Policy</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>   
         <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Disclaimer</h2>
                        <h6 class="text-white">Create CMS For Disclaimer</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Report Misuse</h2>
                        <h6 class="text-white">Create CMS For Report Misuse</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-warning text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Bank Deatils</h2>
                        <h6 class="text-white">Create CMS For Bank Deatils</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>   
            <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">logout Content</h2>
                        <h6 class="text-white">Create CMS For logout Content</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>   
            <div class="col-sm-4">
                <div class="card bg-primary  text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Tagline</h2>
                        <h6 class="text-white">Create CMS For Tagline</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>   
           <div class="col-sm-4">
                <div class="card bg-warning text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Andriod Link</h2>
                        <h6 class="text-white">Create CMS For Andriod Link</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>   
           <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Map Direction</h2>
                        <h6 class="text-white">Create CMS For Map Direction</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>  
          <div class="col-sm-4">
                <div class="card bg-primary  text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Copyright</h2>
                        <h6 class="text-white">Create CMS For Copyright</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>  	
          <div class="col-sm-4">
                <div class="card bg-warning text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">Safe Matrimony</h2>
                        <h6 class="text-white">Create CMS For Safe Matrimony</h6>
                        <i class="material-icons-two-tone d-block f-46 text-white">description</i>
                    </div>
                </div>
            </div>  			
		   </div>
		   
		 </div>
	   </div>
	 </div>
</div>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>

<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>

<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>
</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:27 GMT -->
</html>
