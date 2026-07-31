<?php include('protect.php');?>
	<header class="pc-header bg-dark ">
			<div class="container">
				<div class="header-wrapper">
					<div class="m-header">
						<a href="index.php" class="b-brand">
							<img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="" class="logo logo-lg">
						</a>
					</div>
					
					<div class="ms-auto">
						<ul class="list-unstyled">
							<?php  require_once('../sys_dbconnection.php'); /*include('../dbconnectadmin.php');*/
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
									<a href="pay_sms_details" class="dropdown-item">
										
										<span>Gateway/API</span>
									</a>
									<a href="payment_getway_details" class="dropdown-item">
										
										<span>Payment Gateway</span>
									</a>
									<a href="datbasebackup" class="dropdown-item">
										
										<span>Generate Backup</span>
									</a>
									<a href="changepassword" class="dropdown-item">
										<span>Change Password</span>
									</a>
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