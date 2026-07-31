<?php require_once('../includes/bootstrap.php');
include('protect.php');
	?>
	<header class="pc-header bg-dark ">
			<div class="container">
				<div class="header-wrapper">
					<div class="m-header">
						<a href="index" class="b-brand">
							<!-- ========   change your logo hear   ============ -->

							<img src="http://localhost/SVR/css3/assets/shivraj-logo.png" style="width: 50px; " alt="" class="logo logo-lg">
						</a>
					</div>
					<div class="me-auto pc-mob-drp">
						<ul class="list-unstyled">
							<li class="dropdown pc-h-item pc-mega-menu">
								<a class="pc-head-link  dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
								Site Pages 
								</a>
								<div class="dropdown-menu pc-h-dropdown pc-mega-dmenu">
									<div class="row g-0">
									<div class="col">
											
											<ul class="pc-mega-list">
												<li><a href="add_aboutus" class="dropdown-item"><i class="fas fa-circle"></i> About Us</a></li>
												<li><a href="add_contactus" class="dropdown-item"><i class="fas fa-circle"></i> Contact Us</a></li>
												<li><a href="add_bankdetails" class="dropdown-item"><i class="fas fa-circle"></i> Bank Deatils</a></li>
											</ul>
										</div>
										<div class="col">
											
											<ul class="pc-mega-list">
												<li><a href="add_terms" class="dropdown-item"><i class="fas fa-circle"></i> Terms and Conditions</a></li>
												<li><a href="add_privacy" class="dropdown-item"><i class="fas fa-circle"></i> Privacy Policy</a></li>
												<li><a href="add_refundpolicy" class="dropdown-item"><i class="fas fa-circle"></i> Refund Policy</a></li>
											</ul>
										</div>
										<div class="col">
											
											<ul class="pc-mega-list">
												<li><a href="add_disclaimer" class="dropdown-item"><i class="fas fa-circle"></i> Disclaimer</a></li>
												<li><a href="add_reportmisuse" class="dropdown-item"><i class="fas fa-circle"></i> Report Misuse</a></li>
												<li><a href="logout_content" class="dropdown-item"><i class="fas fa-circle"></i> logout Content</a></li>
											</ul>
										</div>
										<div class="col">
											
											<ul class="pc-mega-list">
												<li><a href="add_applink" class="dropdown-item"><i class="fas fa-circle"></i> Andriod Link</a></li>
												<li><a href="add_direction" class="dropdown-item"><i class="fas fa-circle"></i> Map Direction</a></li>
												<li><a href="add_safematrimony" class="dropdown-item"><i class="fas fa-circle"></i> Safe Matrimony</a></li>
											</ul>
										</div>
										<!--<div class="col">
											
											<ul class="pc-mega-list">
												
												<li><a href="add_copyrights" class="dropdown-item"><i class="fas fa-circle"></i> Copyright</a></li>
												
											
											</ul>
										</div>-->
									</div>
								</div>
							</li>
							<li class="dropdown pc-h-item">
								<a class="pc-head-link  dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									SEO
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a href="homeseo?catagory=home" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Home</span>
									</a>
									<a href="aboutusseo?catagory=aboutus" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>About Us</span>
									</a>
									
									<a href="contactusseo?catagory=contact" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Contact Us</span>
									</a>

									<a href="membershipseo?catagory=membership" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Membership</span>
									</a>

									<a href="term_and_condition_seo?catagory=term_and_condition" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Term and Condition</span>
									</a>

									<a href="faq_seo?catagory=faq" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>FAQ's</span>
									</a>

									<a href="happy_story_seo?catagory=happy_story" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Happy Story</span>
									</a>

									<a href="privacy_policy_seo?catagory=privacy_policy" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Privacy Policy</span>
									</a>

									<a href="refund_policy_seo?catagory=refund_policy" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Refund Policy</span>
									</a>

									<a href="disclaimer_seo?catagory=disclaimer" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Disclaimer</span>
									</a>
									
									<a href="safe_matrimony_seo?catagory=safe_matrimony" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Safe Matrimony</span>
									</a>
									
									<a href="searchseo?catagory=search" class="dropdown-item">
										<i class="material-icons-two-tone">search</i>
										<span>Search</span>
									</a>
									
									
								</div>
							</li>
							<li class="dropdown pc-h-item">
								<a class="pc-head-link  dropdown-toggle arrow-none me-0" href="social" role="button" aria-haspopup="false" aria-expanded="false">
									Social
								</a>
								
							</li>
							</li>
							
						</ul>
					</div>
					<div class="ms-auto">
						<ul class="list-unstyled">
							<li class="dropdown pc-h-item">
								<a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									<i class="material-icons-two-tone">search</i>
								</a>
								<div class="dropdown-menu dropdown-menu-end pc-h-dropdown drp-search">
									<form class="px-3" action="search_result" method="post">
										<div class="form-group mb-0 d-flex align-items-center">
											<i data-feather="search"></i>
											<input type="search" class="form-control border-0 shadow-none" name="search" placeholder="Search here. . .">
										</div>
									</form>  
								</div>
							</li>
							
							
							
							<?php
									$query=mysqli_query($con,"select * from siteconfig  where ID='1'");
									$fetch=mysqli_fetch_array($query);
									$name=$fetch['owner'];
									?>
							<li class="dropdown pc-h-item">
								<a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									<img src="assets/images/user/admin.png" alt="user-image" class="user-avtar">
									<span>
									
										<span class="user-name"><?php echo $name?></span>
										<span class="user-desc">Administrator</span>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
									
									<a href="profileadmin" class="dropdown-item">
										
										<span>Admin Details</span>
									</a>
									<a href="changepassword" class="dropdown-item">
										<span>Change Password</span>
									</a>
									<!-- <a href="sys_settings" class="dropdown-item">
										<span>Global Setting</span>
									</a> -->
									<a href="logout" class="dropdown-item">
										<i class="fas fa-sign-out-alt"></i>
										<span>Logout</span>
									</a>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</header>
		<!-- [ Mobile header ] start -->
		<div class="pc-mob-header pc-header">
			<div class="pcm-logo">
				<a href="index"><img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="" class="logo logo-lg"></a>
			</div>
			<div class="pcm-toolbar">
				<a href="#!" class="pc-head-link" id="mobile-collapse">
					<div class="hamburger hamburger--arrowturn">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
				</a>
				<a href="#!" class="pc-head-link" id="headerdrp-collapse">
					<i data-feather="align-right"></i>
				</a>
				<a href="#!" class="pc-head-link" id="header-collapse">
					<i data-feather="more-vertical"></i>
				</a>
			</div>
		</div>
		
		<!-- [ Mobile header ] End -->
