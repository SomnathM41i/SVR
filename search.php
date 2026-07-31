<?php 
    require_once('sys_dbconnection.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Eventrox - Digital Events HTML Template | Error Page</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">


<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Main Header-->
    <?php include('header.php')?>
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Error Page</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Error Page</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Error Section-->
    <section class="error-section">
        <div class="anim-icons full-width">
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-dots wow fadeInleft"></span>
            <span class="icon icon-line-1 wow zoomIn"></span>
            <span class="icon icon-circle-1 wow zoomIn"></span>
        </div>

        <div class="auto-container">
		   <div class="contact-form">
            <div class="error-title">Smart Search</div>
           
            <div class="text">Sorry, we couldn't find the page you're looking for</div>
			<div class="col-lg-12">
                  <div class="row">		
                   	  
			                     <div class="col-lg-3 col-md-3 col-sm-12 form-group ">
									 <select class="category2" name="looking[]" required >
										<option value="Male"  >Male</option>
										<option value="Female">Female</option>
									 </select> 	
								</div> 										
                                <div class="col-lg-3 col-md-3 col-sm-12  form-group">
                                    <select class="category2" value="Select" name="txtSAge" required>
                                     <option value="">Select Age</option>
        		    				      <option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                          <option value="21" >21</option>
                                          <option value="22"selected>22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28" >28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                          <option value="32">32</option>
                                          <option value="33">33</option>
                                          <option value="34">34</option>
                                          <option value="35">35</option>
                                          <option value="36">36</option>
                                          <option value="37">37</option>
                                          <option value="38">38</option>
                                          <option value="39">39</option>
                                          <option value="40">40</option>
                                          <option value="41">41</option>
                                          <option value="42">42</option>
                                          <option value="43">43</option>
                                          <option value="44">44</option>
                                          <option value="45">45</option>
                                          <option value="46">46</option>
                                          <option value="47">47</option>
                                          <option value="48">48</option>
                                          <option value="49">49</option>
                                          <option value="50">50</option>
                                          <option value="51">51</option>
                                          <option value="52">52</option>
                                          <option value="53">53</option>
                                          <option value="54">54</option>
                                          <option value="55">55</option>
                                          <option value="56">56</option>
                                          <option value="57">57</option>
                                          <option value="58">58</option>
                                          <option value="59">59</option>
                                          <option value="60">60</option>
                                          <option value="61">61</option>
                                          <option value="62">62</option>
                                          <option value="63">63</option>
                                          <option value="64">64</option>
                                          <option value="65">65</option>
						            </select>
                                    </div>
                               <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                     <select class="category2" value="Select" name="txtEAge" required>
										<option value="" >To Age</option>
										<option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                          <option value="21">21</option>
                                          <option value="22">22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28"selected >28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                          <option value="32">32</option>
                                          <option value="33">33</option>
                                          <option value="34">34</option>
                                          <option value="35">35</option>
                                          <option value="36">36</option>
                                          <option value="37">37</option>
                                          <option value="38">38</option>
                                          <option value="39">39</option>
                                          <option value="40">40</option>
                                          <option value="41">41</option>
                                          <option value="42">42</option>
                                          <option value="43">43</option>
                                          <option value="44">44</option>
                                          <option value="45">45</option>
                                          <option value="46">46</option>
                                          <option value="47">47</option>
                                          <option value="48">48</option>
                                          <option value="49">49</option>
                                          <option value="50">50</option>
                                          <option value="51">51</option>
                                          <option value="52">52</option>
                                          <option value="53">53</option>
                                          <option value="54">54</option>
                                          <option value="55">55</option>
                                          <option value="56">56</option>
                                          <option value="57">57</option>
                                          <option value="58">58</option>
                                          <option value="59">59</option>
                                          <option value="60">60</option>
                                          <option value="61">61</option>
                                          <option value="62">62</option>
                                          <option value="63">63</option>
                                          <option value="64">64</option>
                                          <option value="65">65</option>
						            </select>
                                    </div>
								 <div class="col-lg-3 col-md-3 col-sm-3 form-group">
									<select class="category2" name="looking[]" required multiple >
										<option value="Unmarried" selected >Unmarried</option>
										<option value="Separated">Separated</option>
										<option value="Widowed">Widowed</option>
										<option value="Divorced">Divorced</option>
										<option value="Any">Any</option>
									</select> 
								</div>  
                        <div class="col-lg-3 col-md-3 col-sm-3 form-group">
								<select class="category2" value="Select" name="religion[]" id="religion" multiple onChange="fillcaste(this.value)" required>
											<option value="Hindu" selected >Hindu</option>					
											 <?php 
											$rrs=mysqli_query($con,"select * from religion where Religion!='Hindu' ");

											while($rrow=mysqli_fetch_array($rrs))
											{
											if($rrow['Religion']==$row['Religion'])
											{
												?>

												  <option value="<?php echo $rrow['Religion'];?>" selected><?php echo $rrow['Religion'];?></option>
												<?php
											}
											else
											{?>
											<option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
											<?php }
											}
											?>
								 </select>
						</div>  	
						 <div class="col-lg-3 col-md-3 col-sm-3 form-group">
								<select class="category2" name="edu[]"   id="education" size="5" multiple >

								 <?php 
									$edusql=mysqli_query($con,"select * from education ");
									while($edurow=mysqli_fetch_array($edusql))
									{

									if($edurow['edu']==$row['Education'] && $edurow['edu']!="")
									{
									?>
									<option value="<?php echo $edurow['edu']; ?>" selected><?php echo $edurow['edu']; ?></option>
									<?php
									}else
									{
									$str="";
									if($edurow['status']=='disabled')
									{
									$str="disabled";	
									}
									?>
									<option value="<?php echo $edurow['edu']; ?>" <?php echo $str; ?>><?php echo $edurow['edu']; ?></option>
									<?php
									}
									}
									?>
									</select>
									</div>  
                            <div class="col-lg-3 col-md-3 col-sm-3 form-group">
								<select class="category2" name="occu[]" id="occupation"  size="5" multiple >
								 	<?php 
									  $occsql=mysqli_query($con,"select * from occupation ");
								      while($occrow=mysqli_fetch_array($occsql))
										 {
									   if($occrow['occu']==$row['Occupation'] )
										 {
							     	   ?>
								      <option value="<?php echo $occrow['occu']; ?>" selected><?php echo $occrow['occu']; ?></option>
								      <?php }else{	 ?>
									  <option value="<?php echo $occrow['occu']; ?>" ><?php echo $occrow['occu']; ?></option>
							        <?php }  }  ?>
								</select>
							</div>  
						
							</div>
                    </div>							
									
            <a href="index.html" class="theme-btn btn-style-three"><span class="btn-title">Save Search</span></a>
            <a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Search</span></a>
        </div>
		</div>
    </section>
    <!--Error Section-->

    <!-- Main Footer -->
<?php include('footer.php')?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->
<div class="color-palate">
    <div class="color-trigger">
        <i class="fa fa-cog"></i>
    </div>
    <div class="color-palate-head">
        <h6>Choose Your Demo</h6>
    </div>
    <ul class="box-version option-box"> <li>Full width</li> <li class="box">Boxed</li> </ul>
    <ul class="rtl-version option-box"> <li>LTR Version</li> <li class="rtl">RTL Version</li> </ul>
    <div class="palate-foo">
        <span>You will find much more options for colors and styling in admin panel. This color picker is used only for demonstation purposes.</span>
    </div>
    <a href="#" class="purchase-btn">Purchase now</a>
</div><!-- End Color Switcher -->

<!--Search Popup-->
<?php include('popup.php')?>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
</body>
</html>