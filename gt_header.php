  <!-- GT Header-->
    
    <header class="main-header">
	
        <div class="main-box">
		
            <div class="auto-container clearfix ">
			
                
                
                <!--Nav Box-->
                <div class="nav-outer clearfix">
				
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span>
					
					</div>
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
					
                        <div class="navbar-header">
                            <!-- Togg le Button -->      
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon flaticon-menu-button"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
						
                            <ul class="navigation clearfix">
							
                                <li class="current dropdown"><a href="index">Home</a></li>
								
                                <li class="dropdown"><a href="about-us">About</a>
								
								<ul>
                                        <li><a href="about-us">About Us</a></li>
                                        <li><a href="terms-conditions">Terms & Condation</a></li>
                                        <li><a href="faqs">FAQ's</a></li>
                                        <li><a href="privacy-policy">Privacy Policy</a></li>
                                        <li><a href="returns-and-cancellation">Refund Policy</a></li>
                                        <li><a href="disclaimer">Disclaimer</a></li>
									    <li><a href="safematrimony">Safe Matrimony</a></li>
                                    </ul>
                                </li>
                                
                                <li class="dropdown"><a href="my_offer">Membership </a></li>
                                <!--<li class="dropdown"><a href="success_story">Happy Story</a></li>-->
                                <li><a href="contactus">Contact </a></li>
								<!--<li><a href="https://readymatrimonial.in/blog/" target="_blank">Blog</a></li>-->
								
                            </ul>
							
                        </div>
                    </nav>
					
                    <!-- Main Menu End-->

                    <!-- Outer box -->
                    <div class="outer-box">
					
                        <!--Search Box-->
                        <div class="search-box-outer">
						
                            <div class="search-box-btn">
							<span class="flaticon-search">
							</span></div>
                        </div>

                        <!-- Button Box -->
                          <div class="btn-box">
						  
                            <a href="login" class="theme-btn btn btn-style-one"><span class="btn-title">Login</span></a>
                        </div>
                        <div class="btn-box">
                            <a href="signup" class="theme-btn btn btn-style-one"><span class="btn-title">SignUp</span></a>
							
                        </div>
						
                    </div>
					
                </div>
            </div>
        </div>
		

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
		
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
            
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="nav-logo"><a href="index"><img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="" title=""></a>
				</div>
                
                <ul class="navigation clearfix">
				
				<!--Keep This Empty / Menu will come through Javascript--></ul>
				<li class="dropdown" style="margin-left:22px;margin-top:8px;font-size:16px;font-weight:600"><a href="success_story" style="color:#343a40">Happy Story</a></li><hr>
				<a href="login" class="theme-btn btn-style-one ml-4 mt-2"><span class="btn-title">Login</span></a>
				<a href="signup" class="theme-btn btn-style-one mt-2 ml-3"><span class="btn-title">SignUp</span></a>
            </nav>
        </div><!-- End Mobile Menu -->

    </header>
    <!--End Main Header -->
	
	<?php //include('idsearch')?>
	<div id="search-popup" class="search-popup">
	<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
	<div class="popup-inner">
		<div class="overlay-layer"></div>
    	<div class="search-form">
        	<form method="post" action="idsearch_result.php">
            	<div class="form-group">
                	<fieldset>
                        <input type="search" class="form-control" placeholder="Enter Matrimony ID" value="" 
						name="matriid" required >
						<input type="submit" value="Search Profile!" name="submit_id" class="theme-btn">
                    </fieldset>
                </div>
            </form>
            
            <br>
            <h3>Recent Search Keywords</h3>
            <ul class="recent-searches">
			<?php $castesql=mysqli_query($con,"SELECT * FROM religion WHERE status='enable' ORDER BY Religion ASC");?> 
			 <?php while($castefetch=mysqli_fetch_array($castesql)) { ?>
           
				<li><a href="religion_search?religion=<?php echo $castefetch['Religion'];?>" ><?php echo $castefetch['Religion'];?></a></li>

                 <?php } ?>
            </ul>
        
        </div>
        
    </div>
</div>
