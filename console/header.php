<?php 
require_once('../includes/bootstrap.php');
include('protect.php'); ?>


<nav class="topbar ">
			<div class="container">
				<div class="navbar-wrapper">
					<ul class="pc-navbar">
						<li class="pc-item pc-hasmenu">
							<a href="#!" class="pc-link"><span class="pc-micon"><i class="material-icons-two-tone">home</i></span><span class="pc-mtext">Dashboard/Home</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
							<ul class="pc-submenu">
							
								<li class="pc-item pc-hasmenu">
									<a href="index" class="pc-link">Dashboard<span class="pc-arrow"></span></a>
								
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="today_member" class="pc-link">Today's Members<span class="pc-arrow"></span></a>
								
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="today_paidmember" class="pc-link">Today's Paid Members<span class="pc-arrow"></span></a>
								
								</li>				
							
						     	<li class="pc-item pc-hasmenu">
									<a href="membership" class="pc-link">Membership Plan's<span class="pc-arrow"></span></a>
								
								</li>
							    <li class="pc-item pc-hasmenu">
									<a href="delete_profile_requests" class="pc-link">Profile Deletion Requests<span class="pc-arrow"></span></a>
									
								</li>
								 <li class="pc-item pc-hasmenu">
									<a href="deactivate_profile" class="pc-link"> Deactivate Profile<span class="pc-arrow"></span></a>
									
								</li>
                                <li class="pc-item pc-hasmenu">
									<a href="feedback" class="pc-link">Feedback<span class="pc-arrow"></span></a>
									
								</li>
								
								<!--<li class="pc-item pc-hasmenu">
									<a href="featured_user" class="pc-link dropdown-toggle" >Set Featured User</a>
								</li>-->
								
								
							
							</ul>
						</li>
						<li class="pc-item pc-hasmenu">
							<a href="#!" class="pc-link"><span class="pc-micon"><i class="material-icons-two-tone">groups</i></span><span class="pc-mtext">Agent Management</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
							<ul class="pc-submenu">
								<li class="pc-item"><a href="agent_dashboard" class="pc-link">Dashboard</a></li>
								<li class="pc-item"><a href="agents" class="pc-link">All Agents</a></li>
								<li class="pc-item"><a href="agent_add" class="pc-link">Add Agent</a></li>
								<li class="pc-item"><a href="agent_assign_plans" class="pc-link">Assign Plans</a></li>
								<li class="pc-item"><a href="agent_customers" class="pc-link">Agent Customers</a></li>
								<li class="pc-item"><a href="agent_sales" class="pc-link">Agent Sales</a></li>
								<li class="pc-item"><a href="commission_report" class="pc-link">Commission Report</a></li>
								<li class="pc-item"><a href="agent_withdrawals" class="pc-link">Withdrawal Requests</a></li>
							</ul>
						</li>
						<!-- DATA Approval menu hidden as requested
							<li class="pc-item pc-hasmenu">
							<a href="#!" class="pc-link"><span class="pc-micon"><i class="material-icons-two-tone">layers</i></span><span class="pc-mtext">DATA Approval</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
							<ul class="pc-submenu">
								<li class="pc-item pc-hasmenu">
									<a href="#!" class="pc-link"> Photo Approval<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
									<ul class="pc-submenu">
										<li class="pc-item"><a class="pc-link" href="photo_approve">Profile Photo</a></li>
										<li class="pc-item"><a class="pc-link" href="gal_photo_approve">Other Photo</a></li>
										
										
										
									</ul>
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="id_proof_approval" class="pc-link">ID Proof Approval</a>
									
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="document_approval" class="pc-link">Document Approval</span></a>
									
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="horoscope_approval" class="pc-link">Horoscope Approval</span></a>
									
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="profile_approval" class="pc-link">Profile Description Approval</a>
									
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="family_approval" class="pc-link">Family Approval</a>
									
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="partener_expectation" class="pc-link">Partner Expectation</a>
									
								</li>
						        
								
							</ul>
						</li>
						-->
						<li class="pc-item pc-hasmenu">
							<a href="#!" class="pc-link"><span class="pc-micon"><i class="material-icons-two-tone">layers</i></span><span class="pc-mtext">Insert Data</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
							<ul class="pc-submenu">
								<li class="pc-item pc-hasmenu">
									<a href="#!" class="pc-link"> City/State/Country<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
									<ul class="pc-submenu">
										<li class="pc-item"><a class="pc-link" href="add_country">Add Country</a></li>
										<li class="pc-item"><a class="pc-link" href="add_state">Add State</a></li>
										<li class="pc-item"><a class="pc-link" href="add_dist">Add District</a></li>
										<li class="pc-item"><a class="pc-link" href="add_taluka">Add Taluka</a></li>
										<li class="pc-item"><a class="pc-link" href="add_city">Add City</a></li>										
									</ul>
								</li> 
								<li class="pc-item pc-hasmenu">
									<a href="#!" class="pc-link">Religion/Caste<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
									<ul class="pc-submenu">
										<li class="pc-item"><a class="pc-link" href="add_religion">Add Religion</a></li>
										<li class="pc-item"><a class="pc-link" href="add_caste">Add Caste</a></li>
										<li class="pc-item"><a class="pc-link" href="add_subcaste">Add Subcaste</a></li>
										
									</ul>
								</li>
								<li class="pc-item pc-hasmenu">
									<a href="#!" class="pc-link">Success Story<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
									<ul class="pc-submenu">
										<li class="pc-item"><a class="pc-link" href="add_successstory">Add</a></li>
										<li class="pc-item"><a class="pc-link" href="delete_success_story">Delete</a></li>
									</ul>
								</li>
								
						        <li class="pc-item pc-hasmenu">
									<a href="#!" class="pc-link dropdown-toggle" >Add Register Field's<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
									<ul class="pc-submenu">
										<li class="pc-item"><a class="pc-link" href="add_education">Add Education</a></li>
										<li class="pc-item"><a class="pc-link" href="add_occupation">Add Occupation</a></li>
										<li class="pc-item pc-hasmenu"><a class="pc-link" href="#!">Add Horoscope<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
											<ul class="pc-submenu">
												<li class="pc-item"><a class="pc-link" href="add_star">Add Star</a></li>
												<li class="pc-item"><a class="pc-link" href="add_moonsign">Add Moon Sign</a></li>
											</ul>
										</li>
										<li class="pc-item"><a class="pc-link" href="add_employed_in">Add Employed In Field</a></li>
										
										
										<li class="pc-item"><a class="pc-link" href="add_residency_status">Add Residency Status</a></li>
										<li class="pc-item"><a class="pc-link" href="add_institue">Add IIT/IIM/NIT Institute</a></li>
									</ul>

								</li>
							</ul>
						</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
