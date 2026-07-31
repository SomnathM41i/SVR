<?php 
require_once(dirname(__FILE__).'/protect.php');
    include('../dbconnectadmin.php');
    require_once('../includes/annual_income.php');
    //session_start();
    $strmid=$_GET['ID']; 
    //echo $strmid;
    $result =mysqli_query($con,"SELECT * FROM register where MatriID='$strmid' ");
    $row = mysqli_fetch_assoc($result);
    //echo $row;
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/user-profile-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:43 GMT -->
<head>
<style>
 table {

}.text-overflow {
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.cell-breakWord {
	
   word-wrap: break-word;
   max-width: 1px;
}


</style>
	<title>Demo</title>
	<script>
	function PrintPage() {
		window.print();
	}
	</script>
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
	<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

	<!-- ekko-lightbox css -->
	<link rel="stylesheet" href="assets/css/plugins/ekko-lightbox.css">
	<link rel="stylesheet" href="assets/css/plugins/lightbox.min.css">
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
	<br>
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
		<!-- [ Main Content ] start -->
		<!-- profile header start -->
		<?php /* ?>
		<div class="user-profile user-card mb-4">
			<div class=class="card-header border-0 p-0 pb-0">
				
			</div>
			
			<div class="card-body py-0">
				<div class="user-about-block m-0">
					<div class="row">
						
						<div class="col-md-4 text-center mt-n5">
							<div class="change-profile text-center">
								<div class="dropdown w-auto d-inline-block">
									<a class="dropdown-toggle" >
										<div class="profile-dp">
											<div class="position-relative d-inline-block">
												<img class="img-radius img-fluid wid-100" src="../gallary/<?php echo $row['Photo1']?>" alt="User image">
											</div>
											
										</div>
										<div class="certificated-badge">
											<i class="fas fa-certificate text-primary bg-icon"></i>
											<i class="fas fa-check front-icon text-white"></i>
										</div>
									</a>
									
								</div>
							</div>
							<h5 class="mb-1"><?php echo $row['Name']?></h5>
							<p class="mb-2 text-muted"><?php echo $row['MatriID'] ?> </p>
						</div>
						
						<div class="col-md-8 mt-md-4">
							<div class="row">
								<div class="col-md-6">
								
									<i class="feather icon-globe me-2 f-18"></i><?php echo $row['ConfirmEmail']?>
									<div class="clearfix"></div>
									<i class="fa fa-user me-2 f-18" aria-hidden="true"></i>  <?php echo $row['Gender'] ?>
									<div class="clearfix"></div>
									<i class="feather icon-phone me-2 f-18"></i><?php echo $row['Mobile']?>
                                        <?php echo $row['Mobile2']?>
								</div>
								<div class="col-md-6">
									<div class="media">
										<i class="feather icon-map-pin me-2 mt-1 f-18"></i>
										<div class="media-body">
											<p class="mb-0 text-muted"><?php echo $row['Address']?> ,<?php echo $row['Dist']?>, <?php echo $row['State']?>, <?php echo $row['Country']?>.</p>
											<p class="mb-0 text-muted"><?php echo $row['Pincode'] ?> </p>
											
										</div>
										
									</div>
										<i class="fas fa-smoking"></i>  	 
										<?php echo $row['Smoke'] ; ?> &nbsp;
										       
										<i class="fas fa-wine-glass-alt	"></i>
										<?php echo $row['Drink']; ?> &nbsp;	

										<i class="fab fa-cc-visa"></i>
										<?php echo $row['Residencystatus']; ?> &nbsp;	
											
										
											
									
								</div>
										
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php */?>
		<!-- profile header end -->
		
		<!-- profile body start -->
		<div class="row">
			

			<div class="col-lg-4 order-md-1">
		    	<div class="card">
			    	
					

					<div class="card-body">
						<div class="container">
                            <div class="row">
								<img class="img-fluid img-thumbnail mb-3 img-radius img-fluid" src="../gallary/<?php echo $row['Photo1']?>" alt="User image">
									<?php /*
										<table class="table table-borderless">
										<tr>
											<td>
											</td>
											<td align="center"><b><h5 class="mb-1"><?php echo $row['Name']?></b></h5>
												<p class="mb-2 text-muted"><?php echo $row['MatriID'] ?> </p> 
											</td>
											<td> </td>
										</tr>
										</table>*/ 
									?>
								
                                    

                            </div>
                                
                    	</div>

	                     
						
					</div>
				</div>
				
			</div>
			<!-- BASIC -->
        	<div class="col-md-8 order-md-2">
		    	<div class="card">
			    	<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="mb-0">Basic</h5>
					</div>
					

					<div class="card-body">
					<div class="container">
                            <div class="row">
                                    

                                    <div class="col-md-6">
                                        <div class="box-body">
										<table class="table table-borderless">
										<tbody>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Name
															</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Name']?></td>
															
                                                        </tr>
															<td class="">Age</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Age']?></td>
                                       
										                <tr>
                                                            
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            
                                                        </tr>
                                                        <tr>
                                                            
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Religion</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Religion']?></td>
                                                        </tr>
                                                        <tr>
														<td class="">Subcaste
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Subcaste']?></td>
                                                        </tr>
                                                        <?php 
															if( $row['Maritalstatus'] != "Unmarried")
															{
																?>
                                                        <tr bgcolor="#DFDFDF">
															<td class="">No of Childrens</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_HaveChildren']?></td>
                                                        </tr>
														<?php	
															}
														?>

														
                	                                    
                                                    </tbody>
                                                </table> 
                                            
                                        </div>
                                    </div>

									<div class="col-md-6">
                                        <div class="box-body">
											<table class="table table-borderless">
												<tbody>
                                                        <tr bgcolor="#DFDFDF">
														<td class="">Gender</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Gender']?></td>
															
                                                        </tr>
                                       
										                <tr>
														<td class="">Email</td>
                                                            <td class="">:</td>
                                                            <td class="cell-breakWord"><span class="text-overflow"><?php echo $row['ConfirmEmail']?></span></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Caste</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Caste']?></td>
                                                        </tr>
														<?php /*
														<tr>
                                                            <td class="">Date OF Birth</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['DOB']?></td>
                                                        </tr>*/ ?>
                                                        <tr >
                                                            <td class="">Marital Status</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Maritalstatus']?></td>
                                                        </tr>

														<?php 
															if( $row['Maritalstatus'] != "Unmarried")
															{
																?>
                                                        <tr bgcolor="#DFDFDF">
															<td class="">Children Living Status</td>
                                                            <td class="">:</td>
                                                            <td class="cell-breakWord"><span class="text-overflow"><?php echo $row['childrenlivingstatus']?></span></td>
																
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

	                     
						
						</div>
					</div>
				
				</div>
				
				<!-- CONTACT -->
				<div class="col-md-6 order-md-3">
		    		<div class="card">
			    	<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="mb-0">Contact Details</h5>
					</div>
					

					<div class="card-body">
					<div class="container">
                            <div class="row">
                                    

                                    
                                        <div class="box-body">
										<table class="table table-borderless">
										<tbody>
                                                        
                                                        <tr bgcolor="#DFDFDF">
														<td class="">Address</td>
    	                                                    <td class="">:</td>
        	                                                <td ><?php echo $row['Address']?> </td>
                                                        </tr>

														<tr >
														<td class="">City</td>
    	                                                    <td class="">:</td>
        	                                                <td class=""><?php echo $row['City']?></td>
                                                    	</tr>
                                       
										            	

														<tr bgcolor="#DFDFDF">
															<td class="">District</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Dist']?></td>
	                                                        
            	                                        </tr>
														
														<tr>
                                                            <td class="">State
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['State']?></td>
                                                        </tr>

														
                                                        <tr bgcolor="#DFDFDF">
														<td class="">Country</td>
    	                                                    <td class="">:</td>
        	                                                <td class=""><?php echo $row['Country']?></td>
                                                        </tr>
                                                        
														<tr >
                                                            <td class="">Mobile
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Mobile']?></td>
                                                        </tr>

														<tr bgcolor="#DFDFDF">
                                                            <td class="">Whatsapp Number
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Mobile2']?></td>
                                                        </tr>

														<tr >
                                                            <td class="">Residence
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Residencystatus']?></td>
                                                        </tr>

														

														
                	                                    
                                                    </tbody>
                                                </table> 
                                            
                                        </div>
                                    
                                        



                                </div>
                                
							</div>

	                     
						
						</div>
					</div>
				
				</div>
				
				<!-- BASIC AND LIFESTYLE-->
				<div class="col-md-6 order-md-3">
		    		<div class="card">
			    	<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="mb-0">Basic And Lifestyle</h5>
					</div>
					

					<div class="card-body">
					<div class="container">
                            <div class="row">
                                    

                                    
                                        <div class="box-body">
										<table class="table table-borderless">
										<tbody>
                                                        
										<tr>
															<td>Height</td>
															<td>:</td>
															<td>
															<?php                                       
																$strheight = $row['Height'];
																if($strheight =="1") { echo "4Ft "; }
																else if($strheight =="") { echo "Null"; }
																else if($strheight =="2") { echo "4Ft 1 inch "; }
																else if($strheight =="3") { echo "4Ft 2 inch "; }
																else if($strheight =="4") { echo "4Ft 3 inch "; }
																else if($strheight =="5") { echo "4Ft 4 inch "; }
																else if($strheight =="6") { echo "4Ft 5 inch "; }
																else if($strheight =="7") { echo "4Ft 6 inch "; }
																else if($strheight =="8") { echo "4Ft 7 inch "; }
																else if($strheight =="9") { echo "4Ft 8 inch "; }
																else if($strheight =="10") { echo "4Ft 9 inch ";}
																else if($strheight =="11") { echo "4Ft 10 inch ";}
																else if($strheight =="12") { echo "4Ft 11 inch ";}
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
																else if($strheight =="37") { echo "7Ft "; } ?>
															
															</td>
														</tr>

														<tr bgcolor="#DFDFDF">
															<td>Weight</td>
															<td>:</td>
															<td><?php echo $row['Weight']?></td>
														</tr>

														<tr >
															<td>Blood Group</td>
															<td>:</td>
															<td><?php echo $row['BloodGroup']?></td>
														</tr>

														<tr bgcolor="#DFDFDF">
															<td>Body Type</td>
															<td>:</td>
															<td><?php echo $row['Bodytype']?></td>
														</tr>

														<tr >
															<td>Complexion</td>
															<td>:</td>
															<td><?php echo $row['Complexion']?></td>
														</tr>

														<tr bgcolor="#DFDFDF">
															<td>Diet</td>
															<td>:</td>
															<td><?php echo $row['Drink']?></td>
														</tr>

														<tr>
															<td>Smoke</td>
															<td>:</td>
															<td><?php echo $row['Smoke']?></td>
														</tr>
														<tr bgcolor="#DFDFDF">
															<td>Drink</td>
															<td>:</td>
															<td><?php echo $row['Drink']?></td>
														</tr>

														<tr >
															<td>Special Cases</td>
															<td>:</td>
															<td class="cell-breakWord"><span class="text-overflow"><?php echo $row['spe_cases']?></span></td>
														</tr>
														<?php if($row['spe_cases']!="None")
															{
																?>
																<tr bgcolor="#DFDFDF">
															<td>Special Reason</td>
															<td>:</td>
															<td><?php echo $row['spe_reason']?></td>
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
					</div>
				
				</div>
				<!-- EDUCATIONAL DETAILS-->
				<div class="col-md-6 order-md-3">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="card">
							<div class="card-header">
                                <h5 class="font-weight-normal"><b class="font-weight-bolder">Educational Details</b> </h5>
								
							</div>
							<div class="card-body">
                                
                                            
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Education</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Education']?></td>
															
                                                        </tr>
                                       
										                <tr>
                                                            <td class="">Occupation</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Occupation']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Education Details</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['EducationDetails']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Occupation Details</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['occu_details']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Employed in</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Employedin']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Income
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo htmlspecialchars(annual_income_format($row['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Working Hour
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['working_hours']?></td>
                                                        </tr>

														<tr >
                                                        	<td  class="">Working Location</td>
                                                        	<td class="">:</td>
                                                        	<td class=""><?php echo $row['workinglocation']?></td>
                                                    	</tr>
                                       
										            	
                	                                    
                                                    </tbody>
                                                </table>   
                            </div>
						</div>
					</div>
				</div>
            
			</div>

			<!-- HOROSCOPE DETAILS-->
			<div class="col-md-6 order-md-4">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="card">
							<div class="card-header">
                                <h5 class="font-weight-normal"><b class="font-weight-bolder">Horoscope Details</b> </h5>
								
							</div>
							<div class="card-body">
                                
                                            
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">MoonSign</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Moonsign']?></td>
															
                                                        </tr>
                                       
										                <tr>
                                                            <td class="">Star</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Star']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Gotra</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Gothram']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Mangalik</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Manglik']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Shani</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['shani']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Horoscope Match
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Horosmatch']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Place of Birth	
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['POB']?></td>
                                                        </tr>

														<tr >
                                                        	<td  class="">Place Of Country</td>
                                                        	<td class="">:</td>
                                                        	<td class=""><?php echo $row['POC']?></td>
                                                    	</tr>
                                       
										            	<tr bgcolor="#DFDFDF">
	                                                        <td class="">Time Of Birth</td>
    	                                                    <td class="">:</td>
        	                                                <td class=""><?php echo $row['TOB']?></td>
            	                                        </tr>
                	                                    
                                                    </tbody>
                                                </table>   
                            </div>
						</div>
					</div>
				</div>
            
			</div>
			
			<!-- FAMILY DETAILS-->
			<div class="col-md-6 order-md-5	">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="card">
							<div class="card-header">
                                <h5 class="font-weight-normal"><b class="font-weight-bolder">Family Details</b> </h5>
								
							</div>
							<div class="card-body">
                                
                                            
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Family Values</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Familyvalues']?></td>
															
                                                        </tr>
                                       
										                <tr>
                                                            <td class="">Family Status</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['FamilyStatus']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">No. Of Brothers</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['noofbrothers']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">No. Of Brothers Married</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['noyubrothers']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Father Name</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Fathername']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Mother Name
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Mothersname']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Family Wealth
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['family_wealth']?></td>
                                                        </tr>

														<tr >
                                                        	<td  class="">Family Type</td>
                                                        	<td class="">:</td>
                                                        	<td class=""><?php echo $row['FamilyType']?></td>
                                                    	</tr>
                                       
										            	<tr bgcolor="#DFDFDF">
	                                                        <td class="">Mother Tounge</td>
    	                                                    <td class="">:</td>
        	                                                <td class=""><?php echo $row['mother_tounge']?></td>
            	                                        </tr>
                	                                    <tr >
                    	                                    <td class="">No. of Sisters</td>
                        	                                <td class="">:</td>
                            	                            <td class=""><?php echo $row['noofsisters']?></td>
                                	                    </tr>
                                    	                <tr bgcolor="#DFDFDF">
                                        	                <td class="">No. Of Sisters Married</td>
                                            	            <td class="">:</td>
                                                	        <td class=""><?php echo $row['noyusisters']?></td>
	                                                    </tr>
    	                                                <tr >
        	                                                <td class="">Father Occupation</td>
            	                                            <td class="">:</td>
                	                                        <td class=""><?php echo $row['Fathersoccupation']?></td>
                    	                                </tr>
                        	                            <tr bgcolor="#DFDFDF">
                            	                            <td class="">Mother Ocuupation
                                	                        </td>
                                    	                    <td class="">:</td>
                                        	                <td class=""><?php echo $row['Mothersoccupation']?></td>
                                            	        </tr>
                                                	    <tr 	>
                                                    	    <td class="">Relatives Information</td>
                                                        	<td class="">:</td>
                                                        	<td class=""><?php echo $row['relatives']?></td>
                                                    	</tr>
                                                    </tbody>
                                                </table>   
                                            
                                        
                                        
                                         
                                            
                                                
                                        	
                                    	
							</div>
						</div>
					</div>
				</div>
            
			</div>
			
			
			<!-- PATNER PREFERENCE-->
			
			<div class="col-md-6 order-md-5">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="card">
							<div class="card-header">
                                <h5 class="font-weight-normal"><b class="font-weight-bolder">Patner Preference</b> </h5>
								
							</div>
							<div class="card-body">
                                
                                            
                                                <table class="table table-borderless">
                                                    <tbody>
													<tr bgcolor="#DFDFDF">
                                                            <td class="">Looking For</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['Looking']?></td>
														</tr>
                                       
										                <tr>
                                                            <td class="">Age</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_FromAge']?> To <?php echo $row['PE_ToAge']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Education </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Education']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Religion</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Religion']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Country Living in</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Countrylivingin']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">City
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_City']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Patner Expection</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PartnerExpectations']?></td>
                                                        </tr>
                                       
										            	
                	                                    
                                               
													&nbsp;
                                            
                                            
                                     

                                  
                                                        <tr>
                                                            <td class="">Complextion</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Complexion']?></td>
															
                                                        </tr>
                                       
										                <tr  bgcolor="#DFDFDF">
                                                            <td class="">Height</td>
                                                            <td class="">:</td>
                                                            
															<td>
															<?php                                       
																$strheight = $row['PE_from_Height'];
																if($strheight =="1") { echo "4Ft "; }
																else if($strheight =="") { echo "Null"; }
																else if($strheight =="2") { echo "4Ft 1 inch "; }
																else if($strheight =="3") { echo "4Ft 2 inch "; }
																else if($strheight =="4") { echo "4Ft 3 inch "; }
																else if($strheight =="5") { echo "4Ft 4 inch "; }
																else if($strheight =="6") { echo "4Ft 5 inch "; }
																else if($strheight =="7") { echo "4Ft 6 inch "; }
																else if($strheight =="8") { echo "4Ft 7 inch "; }
																else if($strheight =="9") { echo "4Ft 8 inch "; }
																else if($strheight =="10") { echo "4Ft 9 inch ";}
																else if($strheight =="11") { echo "4Ft 10 inch ";}
																else if($strheight =="12") { echo "4Ft 11 inch ";}
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
																else if($strheight =="37") { echo "7Ft "; } ?>
																To
															<?php                                       
																$strheight = $row['PE_to_Height'];
																if($strheight =="1") { echo "4Ft "; }
																else if($strheight =="") { echo "Null"; }
																else if($strheight =="2") { echo "4Ft 1 inch "; }
																else if($strheight =="3") { echo "4Ft 2 inch "; }
																else if($strheight =="4") { echo "4Ft 3 inch "; }
																else if($strheight =="5") { echo "4Ft 4 inch "; }
																else if($strheight =="6") { echo "4Ft 5 inch "; }
																else if($strheight =="7") { echo "4Ft 6 inch "; }
																else if($strheight =="8") { echo "4Ft 7 inch "; }
																else if($strheight =="9") { echo "4Ft 8 inch "; }
																else if($strheight =="10") { echo "4Ft 9 inch ";}
																else if($strheight =="11") { echo "4Ft 10 inch ";}
																else if($strheight =="12") { echo "4Ft 11 inch ";}
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
																else if($strheight =="37") { echo "7Ft "; } ?>



															</td>
														</tr>
                                                        <tr >
                                                            <td class="">Occupation</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Occupation']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Caste</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Caste']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">State</td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_State']?></td>
                                                        </tr>
                                                        <tr bgcolor="#DFDFDF">
                                                            <td class="">Resident Status
                                                            </td>
                                                            <td class="">:</td>
                                                            <td class=""><?php echo $row['PE_Residentstatus']?></td>
                                                        </tr>
                                       
										            	
                	                                    
                                                    </tbody>
                                                </table>   
                            </div>
						</div>
					</div>
				</div>
            
			</div>


			
		</div>
		<!-- profile body end -->
	</div>
</div>
<!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

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
            <h5 class="mb-0 text-white f-w-500">Demo</h5>
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

<!-- ekko-lightbox Js -->
<script src="assets/js/plugins/ekko-lightbox.min.js"></script>
<script src="assets/js/plugins/lightbox.min.js"></script>
<script src="assets/js/pages/ac-lightbox.js"></script>
<script>
	// [ customer-scroll ] start
	var px = new PerfectScrollbar('.cust-scroll', {
		wheelSpeed: .5,
		swipeEasing: 0,
		wheelPropagation: 1,
		minScrollbarLength: 40,
	});
	// [ customer-scroll ] end
</script>
</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/user-profile-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:54:49 GMT -->
</html>
