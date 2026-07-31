<?php require_once('sys_dbconnection.php');/*include('dbconnectadmin.php');*/ 
$limit = 6; 
 if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;
$seo=mysqli_query($con,"Select * from seo where catagory='happy_story'");
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
<link href="modal.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">

<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
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
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block">Happy Story</h1>
            <ul class="bread-crumb clearfix">
                <?php 
                    $login=$_SESSION['MatriID'];
                    if(!(isset($login)==0))
                    { 
                ?>
                <li><a href="index_dashboard">Home</a></li>
                <li>Happy Story</li>
                <?php
                    }
                    else
                    {
                ?>
                <li><a href="index">Home</a></li>
                <li>Happy Story</li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Pricing Section -->
	<?php $sql12="select * from successstory where approve='Yes' order by id DESC LIMIT $start_from, $limit"; 
	  $sql1="select COUNT(*) from successstory where approve='Yes'";
	  //echo "select COUNT(*) from successstory where approve='Yes'";
	  $rs_result1 = mysqli_query($con,$sql1);  
		$row = mysqli_fetch_row($rs_result1);  
		$total_records = $row[0];  
		$total_pages = ceil($total_records / $limit);
          $result1=mysqli_query($con,$sql12);
           if(mysqli_num_rows($result1)>0)
	             { ?>
    <section class="">
       

        <div class="auto-container">
            <div class="sec-title text-center">
                <?php /*<span class="title">Get Ticket</span>*/?>
                
				 <?php $sql=mysqli_query($con,"select * from successstory where approve='Yes' order by id DESC");?> 
            </div>
           <div class="row">
        	<?php
				while($aboutfetch = mysqli_fetch_array($result1)) { ?>
        	
			<?php //$sql=mysqli_query($con,"select * from successstory where approve='Yes' order by id DESC");?> 
			
				           <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInRight">
				    <div class="inner-box"> 
                        <div class="image-box">    
                            <figure class="image">
							<a href="#">
							<img src="photoprocess.php?image=success/<?php echo $aboutfetch['weddingphoto'] ?>&square=300" alt="">
                            </a>
                            </figure>
                        </div>
                        <div class="lower-content">
                            <ul class="post-info">
							<li>
							 <a href="#" class="">
							<?php
								$formatted = date('d F Y', strtotime($aboutfetch['marriagedate']));
								echo $formatted;
								?> </a></li>
                            	<a href="#" class="text-dark">
									
								</a>
								


                            </ul>    
                            <h4><a href="#"><?php echo $aboutfetch['bridename'] ?> & <?php echo $aboutfetch['groomname'] ?></a></h4>
							<div class="btn-box">
		                             <button type="button" class="theme-btn btn-style-three" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $aboutfetch['ID'];?>" > <span class="btn-title">Read More</span></button>
									 </div>
                        </div>
                    </div>
					 </div>
				<?php  }?>	
				<?php if($limit<$total_records) { ?>  

						<div align="center" class="col-lg-12 mb-2">
							<ul class='styled-pagination' id="pagination" >
							<?php if($page > 1){ 
								$prev = ($page - 1); ?>
								<li id="<?php echo $i;?>"></li>
							<?php }         ?>
							 <li class='setPage'>Page <?php echo $page?> of <?php echo $total_pages?></li>
							<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
										if($i == $_GET['page']):?>
									   <li class='active' id="<?php echo $i;?>"><a  class='active' href='success_story?page=<?php echo $i;?>' ><?php echo $i;?></a></li> 
										
										<?php else:?>
										<li id="<?php echo $i;?>" ><a href='success_story?page=<?php echo $i;?>' ><?php echo $i;?></a></li>
										
										
									<?php endif;?>  
								  
							<?php endfor;?>
							  <?php // Build Next Link 
							if($page < $total_pages){ 
								$next = ($page + 1); 
								?>
								
								<li id="<?php echo $i;?>"><a href='success_story?page=<?php echo $next;?>'><span class="icon fa fa-angle-right"></span></a></li>
							</a></li>
							<?php }         ?><?php endif;?> 
							 </ul>
							 </div></div>
							 <?php } ?> 
     </div>
</div>
    </section>
	
				<?php } else { ?>
			<section class="error-section">
					<div class="anim-icons full-width">
						<span class="icon icon-circle-blue wow fadeIn"></span>
						<span class="icon icon-dots wow fadeInleft"></span>
						<span class="icon icon-line-1 wow zoomIn"></span>
						<span class="icon icon-circle-1 wow zoomIn"></span>
					</div>

					<div class="auto-container">
						<div class="error-title">OOP'S</div>
						<h4>Sorry Result Not Found</h4>
						<div class="text">Success story not updated yet.</div>
						<!--<a href="smart_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>-->
						<!--<a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>-->
					</div>
				</section>
					   <?php } ?>
	 </div>
	 
    <!-- Main Footer -->
     <?php include('footer.php');?>
    <!-- End Footer -->

</div>
    <!--End News Section -->

    <!--End Pricing Section -->

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
    
<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
  
    </div>
<script>
$(document).ready(function(){
    $('#myModal2').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'modalup_readmore.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});

</script>
</body>
</html>