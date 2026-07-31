<!DOCTYPE html>
<?php 
require_once('includes/bootstrap.php');
$data_config = $db->get_siteconfig();
$domain_name = $data_config -> WebFriendlyname;
$siteinfo = $data_config -> Webname;

?>
<html class="no-js" lang="en"> 
<head>
   <meta charset="utf-8">
	<title>Page Not Found</title>
	<meta name="description" content="">  
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="404/base.css">  
    <link rel="stylesheet" href="404/main.css"> 
	<script src="js/modernizr.js"></script>
	<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
    <link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
</head>
<body>
   <header class="main-header">
   	<div class="row">
   		<div class="logo">
	         <a href="index"><?php echo $domain_name; ?></a>
	      </div>   		
   	</div>   
   </header>
   <main id="main-404-content" class="main-content-particle-js">

   	<div class="content-wrap">

		   <div class="shadow-overlay"></div>

		   <div class="main-content">
		   	<div class="row">
		   		<div class="col-twelve">
			  		
			  			<h1 class="kern-this">404 Error.</h1>
			  			<p>
						Oooooops! Looks like nothing was found at this location.
						Maybe try on of the links below, click on the top menu
						or try a search?
			  			</p>

			  			<div class="search">
				      	<form>
								<input type="text" id="s" name="s" class="search-field" placeholder="Type and hit enter …">
							</form>
				      </div>	   			

			   	</div> <!-- /twelve --> 		   			
		   	</div> <!-- /row -->    		 		
		   </div> <!-- /main-content --> 

		   <footer>
		   	<div class="row">

		   		<div class="col-seven tab-full social-links pull-right">
			   		<ul>
				   		<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					      <li><a href="#"><i class="fa fa-behance"></i></a></li>
					      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
					      <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
					      <li><a href="#"><i class="fa fa-instagram"></i></a></li>   			
				   	</ul>
			   	</div>
		  			<div class="col-five tab-full bottom-links">
			   		<ul class="links">
				   		<li><a href="index">Homepage</a></li>
				         <!-- <li><a href="https://www.readymatrimonial.in/matrimony-script/matrimonial-website-demo-script-7.0">Live Demo</a></li> -->
				         <li><a href="contactus">Contact</a></li>
				         <!-- <li><a href="https://readymatrimonial.in/blog/">Read Blog</a></li> -->
				   	</ul>
			   	</div>   		   		
		   	</div>   		  		
		   </footer>
		</div>
   </main>
   <div id="preloader"> 
    	<div id="loader"></div>
   </div> 
   <script src="404/jquery-2.1.3.min.js"></script>
   <script src="404/plugins.js"></script>
   <script src="404/main.js"></script>

</body>

</html>