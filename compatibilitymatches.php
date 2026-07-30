<?php include_once('siteconfig.php');
require_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
/*include_once('dbconnectadmin.php');*/
error_reporting(0);
/*session_start();*/
if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit = 8;
	$pageLimit = ($page * $setLimit) - $setLimit;
//--------------------------- For latest Matches ---------------------------------------//



$login=$_SESSION['MatriID'];

$my_profile = mysqli_query($con,"SELECT * from register where matriid='$login'");
//echo "SELECT * from register where matriid='$login'";
$me = mysqli_fetch_array($my_profile);
$hobbies=explode(",",$me['Looking']);
//$mother=implode(",",$me['PE_MotherTongue']);
$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion=$me['PE_Complexion'];
$PE_Education=$me['PE_Education'];
$PE_star=$me['PE_star'];
$Residencystatus=$me['Residencystatus'];
$pe_religion=$me['PE_Religion'];
$Country=$me['Country'];	
$pe_caste = $me['PE_Caste'];
if($me['Gender']=='Male')
	$match_sex = "Female";
if($me['Gender']=='Female')
	$match_sex = "Male";

$check=mysqli_query($con,"select matriid from block_member where profile_id='".$_SESSION['matriid']."'"); 
$data1=array();
while($check1=mysqli_fetch_array($check))
{
	$data1[]=$check1['matriid'];
}
$matriid=implode("','",$data1);

$check2=mysqli_query($con,"select profile_id from block_member where matriid='".$_SESSION['matriid']."'"); 
$data = array();
while($check3=mysqli_fetch_array($check2))
{
	$data[] = $check3['profile_id'];
}
$profile=implode("','", $data);
	

$match_qry="select DISTINCT * from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$login' AND Regdate > DATE_SUB( NOW( ),INTERVAL 2 DAY) AND ";
if($profile!="")
{
	$match_qry.=" MatriID NOT IN ('$profile') and "; 
}
if($matriid!="")
{
	$match_qry.=" MatriID NOT IN ('$matriid') and ";  
}

if($me['Looking']!="" && $me['Looking']!="Any")
{
	$PE_Religion_look=explode(" , ", $me['Looking']);
	$PE_Religion_look1 = array();
	foreach($PE_Religion_look as $row => $value){
	$PE_Religion_look1[] = "'$value'";
}
$PE_Religion_look12 = implode(',', $PE_Religion_look1);
$match_qry.="Maritalstatus IN($PE_Religion_look12) AND";
}
$match_qry.=" Gender='$match_sex' AND ";
$match_qry.=" Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$match_qry.="
Age BETWEEN '$pe_fromage' AND '$pe_toage'";

//$match_qry.= " and '$mother_a[0]' FIND_IN_SET ('$mother','$mother[1]','$mother[2]','$mother[3]','$mother[4]')";
if($me['PE_MotherTongue']!="" && $me['PE_MotherTongue']!="Any")
{
$PE_mother=explode(",", $me['PE_MotherTongue']);
$terms = array();
foreach($PE_mother as $row => $value){
$terms[] = "'$value'";
}
$term_str = implode(',', $terms);

$mother_a=explode(",", $me['mother_tounge']);
$terms_a = array();
foreach($mother_a as $row => $value){
$terms_a[] = "'$value'";
}
$match_qry.=" and '$terms_a' IN($term_str)";
} 


if($me['PE_star']!="" && $me['PE_star']!="Any")
{ 
	$PE_star_exp=explode(",", $me['PE_star']);
	$PE_star_term = array();
	foreach($PE_star_exp as $row => $value){
	$PE_star_term[] = "'$value'";
}
$PE_star_re = implode(',', $PE_star_term);
$match_qry.=" and Star IN($PE_star_re) ";
}

if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any")
{ 
	$PE_Complexion_exp=explode(",", $me['PE_Complexion']);
	$PE_Complexion_term = array();
	foreach($PE_Complexion_exp as $row => $value){
	$PE_Complexion_term[] = "'$value'";
}
$PE_Complexion_re = implode(',', $PE_Complexion_term);
$match_qry.=" and Complexion IN($PE_Complexion_re) ";
}


if($me['PE_Religion']!="" && $me['PE_Religion']!="Any")
{ 
	$PE_Religion_exp=explode(",", $me['PE_Religion']);
	$PE_Religion_term = array();
	foreach($PE_Religion_exp as $row => $value){
	$PE_Religion_term[] = "'$value'";
}
$PE_Religion_re = implode(',', $PE_Religion_term);
$match_qry.=" and Religion IN($PE_Religion_re) ";
}
if($me['PE_Caste']!="" && $me['PE_Caste']!="Any")
{
$PE_Caste_exp=explode(",",$me['PE_Caste']);
$PE_Caste_term=array();
foreach($PE_Caste_exp as $row=>$value)
{
	$PE_Caste_term[]="'$value'";
}
$PE_Caste_re=implode(',',$PE_Caste_term);
$match_qry.=" and Caste IN ($PE_Caste_re)";
}

if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any")
{
$PE_Residentstatus_exp=explode(",",$me['PE_Residentstatus']);
$PE_Residentstatus_term=array();
foreach($PE_Residentstatus_exp as $row=>$value)
{
$PE_Residentstatus_term[]="'$value'";
}
$PE_Residentstatus_re=implode(',',$PE_Residentstatus_term);
$match_qry.=" and Residencystatus IN($PE_Residentstatus_re)";
}

if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any")
{
$PE_Countrylivingin_exp=explode(",",$me['PE_Countrylivingin']);
$PE_Countrylivingin_term=array();
foreach($PE_Countrylivingin_exp as $row=>$value)
{
	$PE_Countrylivingin_term[]="'$value'";
}
$PE_Countrylivingin_re=implode(',',$PE_Countrylivingin_term);
$match_qry.=" and Country IN($PE_Countrylivingin_re)";
}
if($me['PE_State']!="" && $me['PE_State']!="Any")
{
$PE_State_exp=explode(",",$me['PE_State']);
$PE_State_term=array();
foreach($PE_State_exp as $row=>$value)
{
	$PE_State_term[]="'$value'";
}
$PE_State_re=implode(',',$PE_State_term);
$match_qry.=" and State IN($PE_State_re)";	
}
if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any")
{
$PE_occu_exp=explode(",",$me['PE_Occupation']);
$PE_occu_term=array();
foreach($PE_occu_exp as $row=>$value)
{
	$PE_occu_term[]="'$value'";
}
$PE_occu_re=implode(',',$PE_occu_term);
$match_qry.=" and Occupation IN($PE_occu_re)";	
}
if($me['PE_Education']!="" && $me['PE_Education']!="Any")
{
$PE_Education_exp=explode(",",$me['PE_Education']);
$PE_Education_term=array();
foreach($PE_Education_exp as $row=>$value)
{
	$PE_Education_term[]="'$value'";
}
$PE_Education_re=implode(',',$PE_Education_term);
$match_qry.=" and Education IN($PE_Education_re)";	
}


$match_qry.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;

//echo $match_qry;
 function displayPaginationBelow($con,$per_page,$page){
$login=$_SESSION['MatriID'];
$page_url="?";
$my_profile = mysqli_query($con,"SELECT * from register where matriid='$login'");

$me = mysqli_fetch_array($my_profile);
$hobbies=explode(",",$me['Looking']);
$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion=$me['PE_Complexion'];
$PE_star=$me['PE_star'];
$PE_Education=$me['PE_Education'];
$Residencystatus=$me['Residencystatus'];
$pe_religion=$me['PE_Religion'];
$Country=$me['Country'];	
$pe_caste = $me['PE_Caste'];
if($me['Gender']=='Male')
	$match_sex = "Female";
if($me['Gender']=='Female')
	$match_sex = "Male";

$check=mysqli_query($con,"select matriid from block_member where profile_id='".$_SESSION['matriid']."'"); 
$data1=array();
while($check1=mysqli_fetch_array($check))
{
	$data1[]=$check1['matriid'];
}
$matriid=implode("','",$data1);

$check2=mysqli_query($con,"select profile_id from block_member where matriid='".$_SESSION['matriid']."'"); 
$data = array();
while($check3=mysqli_fetch_array($check2))
{
	$data[] = $check3['profile_id'];
}
$profile=implode("','", $data);
	

$count="select COUNT(*) as totalCount from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$login' AND Regdate > DATE_SUB( NOW( ),INTERVAL 2 DAY) AND ";
if($profile!="")
{
$count.=" MatriID NOT IN ('$profile') and "; 
}
if($matriid!="")
{ 
	$count.=" MatriID NOT IN ('$matriid') and ";  
}
if($me['Looking']!="" && $me['Looking']!="Any")
{
	$PE_Religion_look=explode(" , ", $me['Looking']);
	$PE_Religion_look1 = array();
	foreach($PE_Religion_look as $row => $value){
	$PE_Religion_look1[] = "'$value'";
}
$PE_Religion_look12 = implode(',', $PE_Religion_look1);
$count.="Maritalstatus IN($PE_Religion_look12) AND";
}
//$count.= "Maritalstatus IN('$hobbies[0]','$hobbies[1]','$hobbies[2]','$hobbies[3]','$hobbies[4]') AND";
$count.=" Gender='$match_sex' AND ";
$count.=" Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$count.="
Age BETWEEN '$pe_fromage' AND '$pe_toage'";

if($me['PE_Religion']!="" && $me['PE_Religion']!="Any")
{
	$PE_Religion_exp=explode(",", $me['PE_Religion']);
	$PE_Religion_term = array();
	foreach($PE_Religion_exp as $row => $value){
	$PE_Religion_term[] = "'$value'";
}
$PE_Religion_re = implode(',', $PE_Religion_term);
$count.=" and Religion IN($PE_Religion_re) ";
}

if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any")
{ 
	$PE_Complexion_exp=explode(",", $me['PE_Complexion']);
	$PE_Complexion_term = array();
	foreach($PE_Complexion_exp as $row => $value){
	$PE_Complexion_term[] = "'$value'";
}
$PE_Complexion_re = implode(',', $PE_Complexion_term);
$count.=" and Complexion IN($PE_Complexion_re) ";
}

if($me['PE_star']!="" && $me['PE_star']!="Any")
{ 
	$PE_star_exp=explode(",", $me['PE_star']);
	$PE_star_term = array();
	foreach($PE_star_exp as $row => $value){
	$PE_star_term[] = "'$value'";
}
$PE_star_re = implode(',', $PE_star_term);
$count.=" and Star IN($PE_star_re) ";
}

if($me['PE_Caste']!="" && $me['PE_Caste']!="Any")
{
$PE_Caste_exp=explode(",",$me['PE_Caste']);
$PE_Caste_term=array();
foreach($PE_Caste_exp as $row=>$value)
{
	$PE_Caste_term[]="'$value'";
}
$PE_Caste_re=implode(',',$PE_Caste_term);
$count.=" and Caste IN ($PE_Caste_re)";
}
if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any")
{
$PE_Residentstatus_exp=explode(",",$me['PE_Residentstatus']);
$PE_Residentstatus_term=array();
foreach($PE_Residentstatus_exp as $row=>$value)
{
$PE_Residentstatus_term[]="'$value'";
}
$PE_Residentstatus_re=implode(',',$PE_Residentstatus_term);
$count.=" and Residencystatus IN($PE_Residentstatus_re)";
}
if($me['PE_MotherTongue']!="" && $me['PE_MotherTongue']!="Any")
{
$array=explode(",", $me['PE_MotherTongue']);
$terms = array();
foreach($array as $row => $value){
$terms[] = "'$value'";
}
$term_str = implode(',', $terms);
$count.=" and mother_tounge IN($term_str)";
}
if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any")
{
$PE_Countrylivingin_exp=explode(",",$me['PE_Countrylivingin']);
$PE_Countrylivingin_term=array();
foreach($PE_Countrylivingin_exp as $row=>$value)
{
	$PE_Countrylivingin_term[]="'$value'";
}
$PE_Countrylivingin_re=implode(',',$PE_Countrylivingin_term);
$count.=" and Country IN($PE_Countrylivingin_re)";
}
if($me['PE_State']!="" && $me['PE_State']!="Any")
{
$PE_State_exp=explode(",",$me['PE_State']);
$PE_State_term=array();
foreach($PE_State_exp as $row=>$value)
{
	$PE_State_term[]="'$value'";
}
$PE_State_re=implode(',',$PE_State_term);
$count.=" and State IN($PE_State_re)";	
}

if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any")
{
$PE_occu_exp=explode(",",$me['PE_Occupation']);
$PE_occu_term=array();
foreach($PE_occu_exp as $row=>$value)
{
	$PE_occu_term[]="'$value'";
}
$PE_occu_re=implode(',',$PE_occu_term);
$count.=" and Occupation IN($PE_occu_re)";	
}
if($me['PE_Education']!="" && $me['PE_Education']!="Any")
{
$PE_Education_exp=explode(",",$me['PE_Education']);
$PE_Education_term=array();
foreach($PE_Education_exp as $row=>$value)
{
	$PE_Education_term[]="'$value'";
}
$PE_Education_re=implode(',',$PE_Education_term);
$count.=" and Education IN($PE_Education_re)";	
}
echo $count;
	$rec = mysqli_fetch_array(mysqli_query($con,$count));
    	$total = $rec['totalCount'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $setLastpage = ceil($total/$per_page);
    	$lpm1 = $setLastpage - 1;
		
    	$setPaginate = "";
    	if($setLastpage > 1)
    	{	
    		$setPaginate .= "<ul class='setPaginate'>"; 
                    $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li><a class='active'>$counter</a></li>";
    				else
    					$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($setLastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
    			}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>..</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next'>><b>></b></a></li>";
             
    		}else{
    			$setPaginate.= "<li><a class='active'><b>></b></a></li>";
                
            }

    		$setPaginate.= "</ul>\n";		
    	}
    
    
        return $setPaginate;
    } 

echo $match_qry;
 
?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>latest Matches</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/tooltip.css" rel="stylesheet">

<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<style>
.speaker-block-three .info-box:before 
{   
right: -43px;
}
.speakers-section-three 
{
padding: 36px 0 90px
}
.speakers-section:before 
{   
 background-color: #ffffff;
}

</style>
<style>
.page-title {
      padding: 20px 0;
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

<?php include('header.php')?>

		
<?php $sqlmatch=mysqli_query($con,$match_qry)or die(mysqli_error($con));
	  $cnt=0;
					
		if(mysqli_num_rows($sqlmatch)>0)
			 {  ?>
    <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1>Latest Matches</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Latest Matches</li>
            </ul>
        </div>
    </section>
	<section class="speakers-section">
	
      <div class="auto-container">
        <div class="row">
                
			 <?php
			    $sqlmatch=mysqli_query($con,$match_qry)or die(mysqli_error($con));
				$cnt=0;
				while($fetch=mysqli_fetch_array($sqlmatch))
				{
					$cnt++;
					$path="";
					$is_block = mysqli_query($con,"select * from block_member where matriid ='".$login."' AND profile_id = '".$fetch['MatriID']."'");
					
					if(mysqli_num_rows($is_block)==1)
					continue;
				?>
                <!-- Speaker Block -->
                <div class="speaker-block col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                            <a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank">
							<figure class="image">
						  
                            <?php
							//paid member photo 
							 if($fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($fetch['Photo1']!='nophoto.jpg' ) {
														 ?>			
								<img src="gallary/<?php echo $fetch['Photo1'];?>" > 
												  <?php  } else   {   ?>
								<img src="images/nophoto.jpg"> 
										  <?php } } else { ?>
								<img src="images/nophoto.jpg" > 
										 
										 <?php  } } 
		 
							     elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' ) { ?>
										
								<img src="gallary/<?php echo  $fetch['Photo1'];?>" > 
											 <?php } else {?>
										<img src="images/nophoto.jpg" > 
										   <?php }?>
									</a>
							</figure> 
 
					   </div>
                        <div class="info-box">
                            <div class="inner">
                                <h4 class="name"><a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank">
								<?php echo $fetch['MatriID']?></h4>
                                <span class="designation"><?php echo substr($fetch['Education'],0,20) ?>
								<?php echo substr($fetch['Occupation'],0,20) ?>
								<?php echo $fetch['Age'] ?> Yrs,<?php echo get_height($fetch['Height']);?></span>
                              <ul class="social-links social-icon-colored">
						 <div class="row">
					 <div class="wrapper">
                      <li class="spces"><a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank"><i class="fas fa-user fa-skype"></i></a></li>
             <div class="tooltip spces "> Profile </div>
				</div>
				 <div class="wrapper">
                      <li class="spce"><a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank"><i class="fas fa-heart fa-google-plus "></i></a></li>
             <div class="tooltip "> Shortlist </div>
				</div>
				 <div class="wrapper">
                      <li class="spce"><a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank"><i class="fas fa-comment-dots fa-bitbucket"></i></a></li>
             <div class="tooltip "> Message </div>
				</div>
				 <div class="wrapper">
                      <li class="spce"><a href="full_profile?id=<?php echo $fetch['MatriID']?>" target="_blank"><i class="fas fa-user-plus fa-bitcoin"></i></a></li>
             <div class="tooltip "> Connect </div>
				</div>
				</div>
                    </ul>
                            </div>
							</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
             
            </div>
				
             <div align="center" class="col-lg-12">
							<ul class='styled-pagination' id="pagination" >
		      <?php echo displayPaginationBelow($con,$setLimit,$page);?>
			  </ul>		   
				  </div>        </div>
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
						<div class="text">You have not any Latest Matches</div>
						<a href="smart_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>
						<!--<a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>-->
					</div>
				</section>
					   <?php } ?>
			
    <!-- End Speakers Section -->

    <!-- Main Footer -->
   	<?php include('footer.php')?>

</div>
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

<!--End pagewrapper-->
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