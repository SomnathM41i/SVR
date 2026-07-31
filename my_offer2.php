<?php //include('dbconnectadmin.php');
require_once('sys_dbconnection.php');
$strid = $_SESSION['MatriID'];
$result = mysqli_query($con,"SELECT * from register where MatriID = '$strid'")or svr_db_fail($con);
$record = mysqli_fetch_array($result); 
 
function orderid() {
    $chars = "0123456789";
    srand((double) microtime() * 1000000000); 
    $i    = 0;
    $pass = ''; 
    while ($i <= 20) {
        $num  = rand() % 33;
        $tmp  = substr($chars, $num, 1); 
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$strinv     = "MP";
$strorderid = $strinv . orderid();
//echo $strorderid;
$strplanid =  "1";
$plan = mysqli_query($con,"SELECT * from membershipplan where planid = '$strplanid' ")or svr_db_fail($con);

$plan_row = mysqli_fetch_array($plan);
$seo=mysqli_query($con,"Select * from seo where catagory='membership'");
$seof=mysqli_fetch_array($seo);
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $seof['title']; ?></title>
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
<meta name="keywords" content="<?php echo $seof['keyword']; ?>" />
<meta name="description" content="<?php echo $seof['description']; ?>" />


<style>
.contacts
{
	    margin-left: 40px;
}
button, input, optgroup, select, textarea
{
	height: 42px;
	background-color:white;
}
.pricing-section 
{
    position: relative;
    padding: 50px 0 30px;
    overflow: hidden;
}

/* Add a right margin to each icon */
/*.fas {
  margin-left: -12px;
  margin-right: 8px;
}*/
</style>

</head>

<body>

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->

    <!-- Header Span -->
    <span class="header-span"></span>

   <?php include('header.php');?>

    <!--Page Title-->
	<?php  if(isset($strid)&& $regvar=='9') { ?>           
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Membership Plan</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Membership Plan</li>
            </ul>
        </div>
    </section>
	<?php } else {?>
	<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Membership Plan</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Membership Plan</li>
            </ul>
        </div>
    </section>
	<?php } ?>

    <!--End Page Title-->

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="anim-icons">
            <span class="icon icon-circle-green wow fadeIn"></span>
            <span class="icon icon-circle-blue wow fadeIn"></span>
            <span class="icon icon-circle-pink wow fadeIn"></span>
        </div>
		
               
        <div class="auto-container">
            
            <div class="outer-box">
                <div class="row">
				
				  <?php 
				$qry_plan = mysqli_query($con,"select * from membershipplan where plan_status='Active' ORDER BY planid ASC") or svr_db_fail($con);
				//echo "select * from membershipplan where plan_status='Active' ORDER BY planid ASC";
				while($plan = mysqli_fetch_array($qry_plan))
					
				{?> 
                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-4 col-sm-4 wow fadeInUp">
					<?php  if(isset($login))
			{?>
					  <form method="post" action="membership_choose" name="my_plan">

                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><span class="icon flaticon-paper-plane"></span></div>
                            </div>
                            <div class="price-box">
                                <div class="title"><?php echo $plan['plandisplayname'];
								$_SESSION['plan']=$plan['plandisplayname']; ?></div>
                                <h4 class="price">INR: <?php echo $plan['planamount']." <i class='fa fa-inr' ></i> <br>
                               Days ".$plan['planduration']." ";?></h4>
                            </div>
						
                            <ul class="features">
								<?php if($plan['description1'] !="") { ?>
                                <li class="true"><?php echo $plan['description1']?></li>
								<?php } ?><?php if($plan['description2']!="") { ?>
                                <li class="true"><?php echo $plan['description2']?></li>
								<?php } ?><?php if($plan['description3']!="") { ?> 
                                <li class="true"><?php echo $plan['description3']?></li>
								<?php } ?><?php if($plan['description4']!="") { ?> 
                                <li class="true"><?php echo $plan['description4']?></li>
								<?php } ?><?php if($plan['description5']!="") { ?> 
                                <li class="true"><?php echo $plan['description5']?></li>
								<?php } ?><?php if($plan['description6']!="") { ?> 
								<li class="true"><?php echo $plan['description6']?></li>
								<?php } ?><?php if($plan['description7']!="") { ?> 
                                <li class="true"><?php echo $plan['description7']?></li>
								<?php } ?>
                            </ul>
							<p class="contacts">
							<span class="price" style="font-size:15px;">Allowed Contacts/Address:<?php echo $plan['plannoofcontacts'];?></span>
                                                    
							</p>
                          	 <div class="btn-box">
							    <input name="choose" type="hidden" value="<?php echo $plan['planid']?>"> 
								<button type="submit" class="theme-btn"><a  class="theme-btn btn btn-style-one"><span class="btn-title">Pay Now
							  </span></a></button>
                        </div>
							<input name="txtplan" type="hidden" id="txtplan" value="<?php echo $plan['planname']?>">
							<input name="txtplanname" type="hidden" id="txtplanname" value="<?php echo $plan['plandisplayname']?>">
							<input name="txtoid" type="hidden" id="txtoid" value="<?php echo $strorderid; ?>">
							<input type="hidden" name="id" value="<?php echo $plan['planid'] ?>"> 
							<input type="hidden" name="pm" value="op4" class="formtext" onClick="getPayForm(this.value)" checked>

                        </div>
					             
			</form>
      
			<?php } else { ?>
			  
                    <!-- Pricing Block -->
                               <form method="post" action="login" name="my_plan">

                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><span class="icon flaticon-paper-plane"></span></div>
                            </div>
                            <div class="price-box">
                                <div class="title"><?php echo $plan['plandisplayname'];
								$_SESSION['plan']=$plan['plandisplayname']; ?></div>
                                <h4 class="price">INR: <?php echo $plan['planamount']." <i class='fa fa-inr' ></i> <br>
                               Days ".$plan['planduration']." ";?></h4>
                            </div>
                            <ul class="features">
                               <?php if($plan['description1'] !="") { ?>
                                <li class="true"><?php echo $plan['description1']?></li>
								<?php } ?><?php if($plan['description2']!="") { ?>
                                <li class="true"><?php echo $plan['description2']?></li>
								<?php } ?><?php if($plan['description3']!="") { ?> 
                                <li class="true"><?php echo $plan['description3']?></li>
								<?php } ?><?php if($plan['description4']!="") { ?> 
                                <li class="true"><?php echo $plan['description4']?></li>
								<?php } ?><?php if($plan['description5']!="") { ?> 
                                <li class="true"><?php echo $plan['description5']?></li>
								<?php } ?><?php if($plan['description6']!="") { ?> 
								<li class="true"><?php echo $plan['description6']?></li>
								<?php } ?><?php if($plan['description7']!="") { ?> 
                                <li class="true"><?php echo $plan['description7']?></li>
								<?php } ?>
                            </ul>
							<p class="contacts">
							<span class="price" style="font-size:15px;">Allowed Contacts/Address:<?php echo $plan['plannoofcontacts'];?></span>
                                                       
							</p>
                           
							 <div class="btn-box">							
                              <input name="choose" type="hidden" value="<?php echo $plan['planid']?>">

                            <button type="submit" class="theme-btn"><a  class="theme-btn btn btn-style-one"><span class="btn-title">Pay Now</span></a></button>
                        </div>
							<input name="txtplan" type="hidden" id="txtplan" value="<?php echo $plan['planname']?>">
							<input name="txtplanname" type="hidden" id="txtplanname" value="<?php echo $plan['plandisplayname']?>">
							<input name="txtoid" type="hidden" id="txtoid" value="<?php echo $strorderid; ?>">
							<input type="hidden" name="id" value="<?php echo $plan['planid'] ?>">
							<input type="hidden" name="pm" value="op4" class="formtext" onClick="getPayForm(this.value)" checked>
                             
                        </div>
						 </form>
						 <?php }?>
                    </div>
					  <?php } ?>
                  </div>
		       </div>
			 
             </div>  
			</div>
            
			
			
			
			    <div class="pricing-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp">
				<?php $qry="select * from cms where cms_id='22'";
						$result=mysqli_query($con,$qry);
						//echo $qry;
					$res=mysqli_fetch_array($result);?>
					<div class="col-sm-12 ">
					<div class="contact-grid1 text-center">
					<p>	<?php echo $res['content']; ?>		</p>
					</div>
				</div>
				</div>
    </section>
    <!--End Pricing Section -->

    

    <!-- Main Footer -->
     <?php include('footer.php');?>
    <!-- End Footer -->

</div>
<!--End pagewrapper-->

<!-- Color Palate / Color Switcher -->

<!--Search Popup-->


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
<!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPH8h1UpcK01BdcvoZeOzq-_wJqRxN1Pc"></script>
<script src="js/map-script.js"></script>
<!--End Google Map APi-->
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin fas "></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>

</body>
</html>