<?php
require_once('sys_dbconnection.php');
require_once('includes/partner_match.php');
include_once('memprotect.php');
include_once('siteconfig.php');

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

$matriid=$_SESSION['MatriID'];
$login=mysqli_query($con,"select * from compatibility where MatriID ='$matriid'");
$me=mysqli_fetch_array($login);

$login_profile=mysqli_query($con,"select * from compatibility where MatriID NOT LIKE '$matriid'");


while($profiles=mysqli_fetch_array($login_profile)){
 	       $matid=$profiles['MatriID'];
			/*question 1*/
			
			$looking="select * from compatibility where MatriID = '$matid' ";
            
			if($me['que1']!="" && $me['que1']!="NULL")
				{
					
				$answer1=$me['que1'];
					
				}
				$looking.=" and que1='$answer1'";
				
				$lokingcheck=mysqli_query($con,$looking);	
				
				if($tot1=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
             /*question 2*/
	          $looking="select * from compatibility where MatriID = '$matid' ";
              if($me['que2']!="" && $me['que2']!="NULL")
				{
					
				$answer2=$me['que2'];
					
				}
				$looking.=" and que2='$answer2'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot2=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				
				
					/*question 3*/
				if($me['que3']!="" && $me['que3']!="NULL")
					{ 
					$looking="select * from compatibility where MatriID='$matid'";	
					$PE_star_exp=explode(",", $me['que3']);
					$PE_star_term = array();
					$query = mysqli_query($con,"SELECT que3 ,MatriID FROM compatibility ");
					while($row = mysqli_fetch_assoc($query)){
					$look=explode(",",$row['que3']);
					$result1 = array_intersect($PE_star_exp, $look);
					if(count($result1)>0)
					{
					$getMatchMembersarray[] = $row['MatriID'];
					}
					}
					$lookingmembers=implode("','",$getMatchMembersarray);
					$looking.="AND MatriID IN('$lookingmembers') ";
					}
					$lokingcheck=mysqli_query($con,$looking);
					
				   
				if($tot3=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
					
			/*question 4*/
	           $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que4']!="" && $me['que4']!="NULL")
				{
					
				$answer4=$me['que4'];
					
				}
				$looking.=" and que4='$answer4'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot4=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 5*/
				 $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que5']!="" && $me['que5']!="NULL")
				{
					
				$answer5=$me['que5'];
					
				}
				$looking.=" and que5='$answer5'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot5=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 6*/
				 $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que6']!="" && $me['que6']!="NULL")
				{
					
				$answer6=$me['que6'];
					
				}
				$looking.=" and que6='$answer6'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot6=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 7*/
					/*question 3*/
				if($me['que7']!="" && $me['que7']!="NULL")
					{ 
					$looking="select * from compatibility where MatriID='$matid'";	
					$PE_star_exp=explode(",", $me['que7']);
					$PE_star_term = array();
					$query = mysqli_query($con,"SELECT que7 ,MatriID FROM compatibility ");
					while($row = mysqli_fetch_assoc($query)){
					$look=explode(",",$row['que7']);
					$result1 = array_intersect($PE_star_exp, $look);
					if(count($result1)>0)
					{
					$getMatchMembersarray[] = $row['MatriID'];
					}
					}
					$lookingmembers=implode("','",$getMatchMembersarray);
					$looking.="AND MatriID IN('$lookingmembers') ";
					}
					$lokingcheck=mysqli_query($con,$looking);
					
				   
				if($tot7=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 8*/
				 $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que8']!="" && $me['que8']!="NULL")
				{
					
				$answer8=$me['que8'];
					
				}
				$looking.=" and que8='$answer8'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot8=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 9*/
				 $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que9']!="" && $me['que9']!="NULL")
				{
					
				$answer9=$me['que9'];
					
				}
				$looking.=" and que9='$answer9'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot9=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
				/*question 10*/
				 $looking="select * from compatibility where MatriID = '$matid' ";
				 if($me['que10']!="" && $me['que10']!="NULL")
				{
					
				$answer10=$me['que10'];
					
				}
				$looking.=" and que10='$answer10'";
				
				$lokingcheck=mysqli_query($con,$looking);				
				if($tot10=mysqli_num_rows($lokingcheck)>=1) { ?>
				<?php } else { ?>
				<?php }
			   // echo "-----";		
				$totcount=$tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10;				
			  //  echo $totcount;
                 
				if($totcount>=5)
				{
					
				
				
                $matriid=$_SESSION['MatriID'];
				$my_profile = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
				$me = mysqli_fetch_array($my_profile);
				$religion=$me['Religion'];	
				$caste = $me['Caste'];
				$age = $me['Age'];
				$height = $me['Height'];
				if($me['Gender']=='Male')
				$match_sex = "Female";
				if($me['Gender']=='Female')
				$match_sex = "Male";
				
				
				$items[] = $matid;
                $item=implode("','",$items);
				}
}
//print_r($matid);
				
				$limit = 8; 
				 if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
				$start_from = ($page-1) * $limit;
				
//echo $item;
				
				
                $matriid=$_SESSION['MatriID'];
				$my_profile = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
				$me = mysqli_fetch_array($my_profile);
				$religion=$me['Religion'];	
				$caste = $me['Caste'];
				$age = $me['Age'];
				$height = $me['Height'];
				if($me['Gender']=='Male')
				$match_sex = "Female";
				if($me['Gender']=='Female')
				$match_sex = "Male";
				$check=mysqli_query($con,"select matriid from block_member where profile_id='$matriid'"); 
				$data1=array();
				while($check1=mysqli_fetch_array($check))
				{
					$data1[]=$check1['matriid'];
				}
				$matriid1=implode("','",$data1);

				$check2=mysqli_query($con,"select profile_id from block_member where matriid='$matriid'"); 
				$data = array();
				while($check3=mysqli_fetch_array($check2))
				{
					$data[] = $check3['profile_id'];
				}
				$profile=implode("','", $data);
				
				$final="Select * from register where  MatriID In ('".$item."') and  visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND  MatriID NOT LIKE '$matriid' and ";
				if($profile!="")
				{
					$final.=" MatriID NOT IN ('$profile') and "; 
				}
				if($matriid1!="")
				{
					$final.=" MatriID NOT IN ('$matriid1') and  ";  
				}
				
				$final.="  Gender='$match_sex' AND ";
                $final.=" Religion='$religion' AND ";
				$final.=" Caste='$caste' AND ";
				if($me['Gender']=='Male'){
				$final.=" age<=$age and Height<=$height ";
				}else {
				$final.=" age>=$age and Height>=$height  ";
                }
                $final.="ORDER BY Regdate DESC LIMIT $start_from, $limit";
				$sqlview=mysqli_query($con,$final);
			
				
					
				$matriid=$_SESSION['MatriID'];
				
				
				$matriid=$_SESSION['MatriID'];
				$my_profile = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
				$me = mysqli_fetch_array($my_profile);
				$religion=$me['Religion'];	
				$caste = $me['Caste'];
				$age = $me['Age'];
				$height = $me['Height'];
				if($me['Gender']=='Male')
				$match_sex = "Female";
				if($me['Gender']=='Female')
				$match_sex = "Male";
			
				$check=mysqli_query($con,"select matriid from block_member where profile_id='$matriid'"); 
				$data1=array();
				while($check1=mysqli_fetch_array($check))
				{
					$data1[]=$check1['matriid'];
				}
				$matriid1=implode("','",$data1);

				$check2=mysqli_query($con,"select profile_id from block_member where matriid='$matriid'"); 
				$data = array();
				while($check3=mysqli_fetch_array($check2))
				{
					$data[] = $check3['profile_id'];
				}
				$profile=implode("','", $data);
				
				$count="Select COUNT(*) as  totalCount  from register where  MatriID In ('".$item."') and  visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$matriid' and ";
				if($profile!="")
				{
					$count.=" MatriID NOT IN ('$profile') and "; 
				}
				if($matriid1!="")
				{
					$count.=" MatriID NOT IN ('$matriid1') and  ";  
				}
				
				$count.="  Gender='$match_sex' AND ";
                $count.=" Religion='$religion' AND ";
				$count.=" Caste='$caste' AND ";
				if($me['Gender']=='Male'){
				$count.=" age<=$age and Height<=$height ";
				}else {
				$count.=" age>=$age and Height>=$height  ";
                }
			   

					$rs_result1 = mysqli_query($con,$count);  
					$row = mysqli_fetch_array($rs_result1);  
					
					$total_records = $row[0];  
					$total_pages = ceil($total_records / $limit);
     
		
	 $total = $row['totalCount'];
	//echo  $total;
//echo $final;
//echo $count;	
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Compatibility Matches</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
    .match-card { background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.06); overflow:hidden; margin-bottom:24px; transition:box-shadow .2s; }
    .match-card:hover { box-shadow:0 4px 24px rgba(0,0,0,0.1); }
    .match-card img { width:100%; height:260px; object-fit:cover; }
    .match-card .info { padding:16px; }
    .match-card .info h4 { margin:0 0 4px; font-size:1.05rem; }
    .match-card .info .meta { color:#888; font-size:0.85rem; }
    .partner-match-badge{display:inline-flex;margin:0 0 8px;padding:5px 9px;border-radius:999px;background:#fff0e0;color:#6b1a1a;font-size:.75rem;font-weight:800}.partner-match-badge.perfect{background:#e8f7ed;color:#24653a}
  </style>
</head>
<body>
<?php include('header.php'); ?>

<?php if($total >0) { ?>
<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Matches</div>
      <h1>Compatibility Matches</h1>
      <p>अनुकूल सदस्य</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Compatibility Matches</span>
      </nav>
    </div>
  </section>

<section class="mvv-section" >
	 <div class="auto-container">
        <div class="row">
                
		 <?php 
		 $sqlview=mysqli_query($con,$final);	
		 while($rec=mysqli_fetch_array($sqlview))
			  {
			  $partnerScore=partner_match_score($me,$rec);
			
			?>
                <!-- Speaker Block -->
                <div class="speaker-block col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                        	<?php 
                        		$encrypt = urlencode( base64_encode( $rec['MatriID'] ) );
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
	 
							      elseif($rec['photo_visibility']=='allphoto' && $rec['Photo1Approve']=='Yes' ) { 
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
								} else {?>
										<img src="images/nophoto.jpg" > 
										   <?php }?>
															</a>
							</figure>
					   </div>
                       <div class="info-box">
                            <div class="inner">
                              <div class="partner-match-badge <?php echo $partnerScore['is_100']?'perfect':''; ?>" title="<?php echo $partnerScore['matched']; ?> of 10 preference points matched"><?php echo partner_match_badge($partnerScore); ?></div>
                              <h4 class="name"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank">
							  <?php echo $rec['MatriID']?></h4>
                               <span class="designation"><?php echo substr($rec['Education'],0,20) ?>
								<?php echo substr($rec['Occupation'],0,20) ?>
								<?php echo $rec['Age'] ?> Yrs,<?php echo get_height($rec['Height']);?></span>
                                <ul class="social-links social-icon-colored">
						 <div class="row">
							 <div class="wrapper">
								  <li class="spce"><a href="full_profile?id=<?php $encrypt?>" target="_blank"><i class="fas fa-heart"></i></a></li>
						 <div class="tooltip "> Shortlist </div>
							</div>
							 <div class="wrapper">
								  <li class="spce"><a href="full_profile?id=<?php $encrypt?>" target="_blank"><i class="fas fa-comment-dots"></i></a></li>
						 <div class="tooltip "> Message </div>
							</div>
							 <div class="wrapper">
								  <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-user-plus"></i></a></li>
						 <div class="tooltip "> Connect </div>
							</div>
							<div class="wrapper">
								   <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							      <div class="tooltip spce"> Facebook </div>
								 </div>
								 <div class="wrapper">
								   <li class="spce"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
							      <div class="tooltip spce"> Instagram </div>
								 </div>
							</div>
							<div class="wrapper">
								   <li class="spce"><?php
                $waHL = $rec['Height'] ? getHeightValue($rec['Height']) : '';
                $waLL = implode(', ', array_filter([$rec['City'] ?? '', $rec['Dist'] ?? '']));
                $waLA = [];
                $waLA[] = "\u{1F496} Check out this Matrimony Profile!";
                $waLA[] = '';
                $waLA[] = "\u{1F194} Profile ID: {$rec['MatriID']}";
                $waLA[] = "\u{1F382} Age: {$rec['Age']} years";
                if (!empty($rec['Religion'])) $waLA[] = "\u{1F54A} Religion: {$rec['Religion']}";
                if (!empty($rec['Maritalstatus'])) $waLA[] = "\u{1F48D} Marital Status: {$rec['Maritalstatus']}";
                if (!empty($rec['Education'])) $waLA[] = "\u{1F393} Education: {$rec['Education']}";
                if (!empty($rec['Occupation'])) $waLA[] = "\u{1F4BC} Occupation: {$rec['Occupation']}";
                if (!empty($waHL)) $waLA[] = "\u{1F4CF} Height: $waHL";
                if (!empty($waLL)) $waLA[] = "\u{1F4CD} Location: $waLL";
                $waLA[] = '';
                $waLA[] = "\u{1F517} View Full Profile:";
                $waLA[] = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($rec['MatriID']));
                $waLA[] = '';
                $waLA[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
                $waUR = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLA));
              ?><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a></li>
							      <div class="tooltip spce"> Share </div>
								 </div>
								</ul>
                            </div>
							</a>
                        </div>
                    </div>
					
				<div class="info-box-two">
				<div class="inner text-center">
				<h4 class="name">
				<a href="full_profile?id=<?php echo $encrypt ?>" target="_blank">
				<?php echo $rec['MatriID'] ?> <?php echo $rec['Age'] ?> Yrs,<?php echo get_height($rec['Height']); ?><br>
				<span class="designation"> <?php echo substr($rec['Occupation'], 0, 20) ?>                                   
				</span>  
				</a>  </h4>
				</div>   
				</div>
				
				
                </div>
            <?php } ?>
             
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
									   <li class='active' id="<?php echo $i;?>"><a  href='compabitlity_matches.php?page=<?php echo $i;?>'  class="active"><?php echo $i;?></a></li> 
										
										<?php else:?>
										<li id="<?php echo $i;?>" ><a href='compabitlity_matches.php?page=<?php echo $i;?>'  ><?php echo $i;?></a></li>
										
										
									<?php endif;?>  
								  
									<?php endfor;?>
									  <?php // Build Next Link 
									   if($page < $total_pages){ 
										$next = ($page + 1); 
										?>
								
								<li id="<?php echo $i;?>"><a href='compabitlity_matches.php?page=<?php echo $next;?>' target='_blank'><span class="icon fa fa-angle-right"></span></a></li>
							</a></li>
							<?php }  ?>
							<?php endif;?> 
							 </ul>
							 </div></div>
							 <?php } ?> 
		  
							</div>
						</section>
						  <?php } else { ?>
			<section class="mvv-section">
					<div class="anim-icons full-width">
						<span class="icon icon-circle-blue wow fadeIn"></span>
						<span class="icon icon-dots wow fadeInleft"></span>
						<span class="icon icon-line-1 wow zoomIn"></span>
						<span class="icon icon-circle-1 wow zoomIn"></span>
					</div>

					<div class="auto-container">
						<div class="error-title errtitle">OOP'S</div>
						<h4 class="errtitle">Sorry Result Not Found</h4>
						<div class="text">You have not yet connected profiles.</div>
						<a href="smart_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>
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
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</body>
</html>
