	
    <section class="newsletter-section">
        <div class="anim-icons full-width">
            <span class="icon icon-shape-3 wow fadeIn"></span>
            <span class="icon icon-line-1 wow fadeIn"></span>
        </div>
        <div class="auto-container">
            <!--Subscribe Form-->
			<div class="row">
			 <div class="col-lg-2 col-md-4 col-sm-4">
			 </div>
             <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="contact-form">
                             <div class="sec-title text-center"> 
                            <!--<div class="icon-box"><span class="fa fa-envelope"></span></div>-->
                            <br/><h2>Login</h2> 
                            <div class="text">Existing Member? Login</div>
                        </div>
						 <?php if(isset($_GET['action'])){
                    ?><h5 class="text mb-5" align="center" ><font color="#FF0000">You are enter Wrong Username or Password <br>Please reenter and submit </font></h5>
                    <?php } ?>
                    <?php if(isset($_GET['action1'])){
                    ?><h5 class="w3ls-title w3ls-title1" align="center"><font color="#FF0000">Your Password Change Successfully</font></h5>
                    <?php } ?>
                            <form method="post" action="login_submit.php" id="contact-form">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="emailerror">
                                       <input type="text" name="txtusername" placeholder="Email ID / Username / Mobile No." tabindex="1"   required value="<?php if(isset($_COOKIE["user_login"])) 
                      { echo $_COOKIE["user_login"]; } ?>" >
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
									 <input type="password" name="txtpassword" placeholder="Enter Password" maxlength="35"  id="pass" tabindex="2" required value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" >

											</div>
						 <div class="col-lg-9 col-md-9 col-sm-9 mt-2">            
						  <li class="switch-agileits float-left"></li>
							<label class="labelcss" style="vertical-align: middle">
							  <input type="checkbox" style="vertical-align: middle" name="remember_me" value="1">
								<span class="slider-switch round "></span>
									Keep me signed in
							</label>
						  
							</div>
              
							<div class="col-lg-3 col-md-3 col-sm-3 mt-2 ">	  
                               <a href="forgot_password.php" class="ml-4">Trouble login in?</a>
			                </div>		
                                   
                                    
                                    
                                    
                                   <div class="col-lg-12 col-md-12 col-sm-12 mt-3 ">
							   <div class="btn-box">	
								<button class="theme-btn btn-style-one " type="submit" name="submit" style="width:100%"><span class="btn-title">Submit</span></button>
                            							
							   </div> 
							   
							    
                           </div>
									 <div class="col-lg-9 col-md-9 col-sm-9 mt-3">
						    <span class="">  New Member Register ?<a href="signup.php"> SignUp</a></span>
							   
						   </div>
						   	<div class="col-lg-3 col-md-3 col-sm-3 mt-3 ">	

                  <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                  </fb:login-button>
                  <div id="status">
                  </div>
                  <!-- Load the JS SDK asynchronously -->
                  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>               
			        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
		</div>
    </section>