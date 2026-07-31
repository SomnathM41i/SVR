<?php
require_once('includes/bootstrap.php');
include_once('memprotect.php');?>
$limit = 8; 
 if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Who Viewed My Profile</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="icon" href="branding/favicons/icon-32.png" type="image/png">
<style>
@media screen and (max-width: 568px){
.speaker-block .inner-box {
    width: 135px;
    height: 135px;
    box-shadow: 0 5px 10px rgb(0 0 0 / 40%);
}
}
.speaker-block-three .info-box:before { right: -43px; }
.speakers-section-three { padding: 36px 0 90px; }
.speakers-section:before { background-color: #ffffff; }
</style>
</head>
<body>
<?php include('header.php')?>
<main>
<section class="mvv-page-hero">
  <div class="mvv-container">
    <span class="mvv-page-hero__eyebrow">Dashboard &bull; Profile Activity</span>
    <h1 class="mvv-page-hero__title">Who Viewed My Profile</h1>
    <p class="mvv-page-hero__subtitle">तुमचे प्रोफाइल कोणी पाहिले ते पहा</p>
    <nav class="mvv-breadcrumb">
      <a href="index_dashboard">Home</a>
      <span>Who Viewed My Profile</span>
    </nav>
  </div>
</section>
<?php
	
$check=mysqli_query($con,"select matriid from block_member where profile_id='$login'"); 
$data1=array();
while($check1=mysqli_fetch_array($check))
{
	$data1[]=$check1['matriid'];
}
$matriid=implode("','",$data1);

$check2=mysqli_query($con,"select profile_id from block_member where matriid='$login'"); 
$data = array();
while($check3=mysqli_fetch_array($check2))
{
	$data[] = $check3['profile_id'];
}
$profile=implode("','", $data);

 $sql="select date,who from profile_views where whom='$login' And  who  NOT IN('$profile') And  who  NOT IN ('$matriid') and banstatus!='1' LIMIT $start_from, $limit";
$sql1="SELECT COUNT(*)  FROM  profile_views where  whom='$login' And  who  NOT IN('$profile') And  who  NOT IN ('$matriid') and banstatus!='1' ";
$rs_result1 = mysqli_query($con,$sql1);  
$row = mysqli_fetch_row($rs_result1);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);
          $result1=mysqli_query($con,$sql);
           if(mysqli_num_rows($result1)>0)
	              { ?>
<section class="mvv-section">
  <div class="mvv-container">
    <div class="row">
                	<?php
				while($recs = mysqli_fetch_array($result1)) {
				

				  $s=mysqli_query($con,"select * from  register where MatriID='".$recs['who']."'");
				
				   while($rec=mysqli_fetch_array($s))
					{
				$cnt++;
				$path="";
				$is_block = mysqli_query($con,"select *from block_member where matriid ='$login' AND profile_id = '".$recs['who']."'");
				
				if(mysqli_num_rows($is_block)==1)
				continue;
				?>  
                <!-- Speaker Block -->
                <div class="speaker-block col-xl-3 col-lg-4 col-md-6 col-sm col-6">
                    <div class="inner-box">
                        <div class="image-box">
                        	<?php 
                                $encrypt = urlencode( base64_encode($rec['MatriID'] ) );
                            ?>
					     <a href="full_profile?id=<?php echo $encrypt?>" target="_blank">	
                          <figure class="image">
						  
                            <?php
							//paid member photo 
							 if($rec['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($rec['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($rec['Photo1']!='nophoto.jpg' ) {
														 ?>	
															 
								<img src="photoprocess.php?image=gallary/<?php echo $rec['Photo1'];?>&square=500" > 
												  <?php  } else   {   ?>
								 <img src="blur.php?image=gallary/<?php echo $rec['Photo1'];?>"> 
										  <?php } } else { ?>
								 <img src="blur.php?image=gallary/<?php echo $rec['Photo1'];?>"> 
										 
										 <?php  } } 
		 
							     elseif($rec['photo_visibility']=='allphoto' && $rec['Photo1Approve']=='Yes' ) 
							     	{ 
							     		if($rec['Photo1']!='nophoto.jpg' )
							     		{
							    ?>
										
								<img src="photoprocess.php?image=gallary/<?php echo $rec['Photo1'];?>&square=500" > 
								<?php 
										}
										else
										{
								?>
								<img src="gallary/<?php echo $rec['Photo1'];?>" >
								<?php
										}
									} 
									else 
									{
								?>
										<img src="images/nophoto.jpg" > 
										   <?php }?>
															</a>
							</figure> 
					   </div>
                       <div class="info-box">
                            <div class="inner">
                              <h4 class="name"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank">
							  <?php echo $rec['MatriID']?></h4>
                               <span class="designation"><?php echo substr($rec['Education'],0,20) ?>
								<?php echo substr($rec['Occupation'],0,20) ?>
								<?php echo $rec['Age'] ?> Yrs,<?php echo get_height($rec['Height']);?></span>
                               <ul class="social-links social-icon-colored">
								 <div class="row">
								  <div class="wrapper">
								   <li class="spces"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-user fa-skype"></i></a></li>
							      <div class="tooltip spces "> Profile </div>
								 </div>
								 <div class="wrapper">
									  <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-heart fa-google-plus "></i></a></li>
							     <div class="tooltip "> Shortlist </div>
								</div>
								 <div class="wrapper">
								  <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-comment-dots fa-bitbucket"></i></a></li>
							    <div class="tooltip "> Message </div>
								</div>
								 <div class="wrapper">
								  <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-user-plus fa-bitcoin"></i></a></li>
							    <div class="tooltip "> Connect </div>
								</div>
                               </div>
                           </ul>
						  
									<span class="designation">Date: <?php echo $recs['date'];?> </span>
                            </div>
							</a>
                        </div>
                    </div>

<div class="info-box-two">
    <div class="inner text-center">
      <h4 class="name"> 
        <a href="full_profile?id=<?php echo $encrypt?>" target="_blank">
							  <?php echo $rec['MatriID']?>
        <span class="designation">
          <?php echo substr($rec['Education'],0,20) ?> <?php echo substr($rec['Occupation'],0,20) ?>
					<?php echo $rec['Age'] ?> Yrs,<?php echo get_height($rec['Height']);?>
        </span><br>
		<span class="designation">Date: <?php echo $recs['date'];?> </span>
    </a>
      </h4>
    </div>
  </div>

                </div>
           <?php } } ?>
            </div>
			 <?php if($limit<$total_records) { ?>  

						<div align="center" class="col-lg-12">
							<ul class='styled-pagination' id="pagination" >
							<?php if($page > 1){ 
								$prev = ($page - 1); ?>
								<li id="<?php echo $i;?>"></li>
							<?php }         ?>
							 <li class='setPage'>Page <?php echo $page?> of <?php echo $total_pages?></li>
							<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
										if($i == $_GET['page']):?>
									   <li class='active' id="<?php echo $i;?>"><a  class='active' href='who_viewed_my_profile?page=<?php echo $i;?>' ><?php echo $i;?></a></li> 
										
										<?php else:?>
										<li id="<?php echo $i;?>" ><a href='who_viewed_my_profile?page=<?php echo $i;?>' ><?php echo $i;?></a></li>
										
										
									<?php endif;?>  
								  
							<?php endfor;?>
							  <?php // Build Next Link 
							if($page < $total_pages){ 
								$next = ($page + 1); 
								?>
								
								<li id="<?php echo $i;?>"><a href='who_viewed_my_profile?page=<?php echo $next;?>'><span class="icon fa fa-angle-right"></span></a></li>
							</a></li>
							<?php }         ?><?php endif;?> 
							 </ul>
							 </div></div>
							 <?php } ?> 
		  </div>
		</section>
		
		<?php } else { ?>
			<section class="mvv-section">
        <div class="mvv-container">
          <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;">
            <strong>OOP'S</strong><br>
            <h4 style="margin:8px 0;color:var(--mvv-maroon);">Sorry Result Not Found</h4>
            <p style="margin:0 0 12px;">Your profile is yet to be viewed.</p>
            <a href="smart_search" style="display:inline-block;background:var(--mvv-maroon);color:#fff;padding:8px 20px;border-radius:6px;text-decoration:none;">Search</a>
          </div>
        </div>
      </section>
					   <?php } ?>
	
</main>
<?php include('footer3.php')?>

<?php 
function get_height($strheight)
{
if($strheight =="1") { echo "4Ft "; }
else if($strheight =="2") { echo "4Ft 1 inch "; }
else if($strheight =="3") { echo "4Ft 2 inch "; }
else if($strheight =="4") { echo "4Ft 3 inch "; }
else if($strheight =="5") { echo "4Ft 4 inch "; }
else if($strheight =="6") { echo "4Ft 5 inch "; }
else if($strheight =="7") { echo "4Ft 6 inch "; }
else if($strheight =="8") { echo "4Ft 7 inch "; }
else if($strheight =="9") { echo "4Ft 8 inch "; }
else if($strheight =="10") { echo "4Ft 9 inch "; }
else if($strheight =="11") { echo "4Ft 10 inch "; }
else if($strheight =="12") { echo "4Ft 11 inch "; }
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
else if($strheight =="37") { echo "7Ft "; }
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
