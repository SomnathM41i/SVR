<?php require_once('sys_dbconnection.php');
error_reporting(0);

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

$marital_status=$_POST['looking'] ? $_POST['looking'] : $_GET['looking'];
$txtgender=$_POST['gender'] ? $_POST['gender'] : $_GET['gender'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge'] : $_GET['txtSAge'];
$to_age=$_POST['txtEAge'] ? $_POST['txtEAge'] : $_GET['txtEAge'];
$religion=$_POST['religion'] ? $_POST['religion'] : $_GET['religion'];



if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit =8;
	$pageLimit = ($page * $setLimit) - $setLimit;

$sql = "SELECT * FROM register where Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' ";
if($religion!="" and $religion!="Any")
{
$sql=$sql." and Religion ='".$religion."'";
}
if($education!="" and $education!="Any")
{
$sql=$sql." and Education ='".$education."'";
}

if($occu!="" and $occu!="Any")
{
$sql=$sql." and Occupation ='".$occu."'";
}

if($marital_status!="" and $marital_status!="Any")
{
$sql=$sql." and Maritalstatus ='".$marital_status."'";
}


$sql=$sql." AND visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND Photo1!=''";
$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;
$rs_result = mysqli_query($con,$sql);


function displayPaginationBelow($con,$per_page,$page){
$marital_status=$_POST['looking'] ? $_POST['looking'] : $_GET['looking'];
$txtgender=$_POST['gender'] ? $_POST['gender'] : $_GET['gender'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge'] : $_GET['txtSAge'];
$to_age=$_POST['txtEAge'] ? $_POST['txtEAge'] : $_GET['txtEAge'];
$religion=$_POST['religion'] ? $_POST['religion'] : $_GET['religion'];
$education=$_POST['education'] ? $_POST['education'] : $_GET['education'];
$occu=$_POST['occu'] ? $_POST['occu'] : $_GET['occu'];
	 
	 
	   $page_url="?";
	   $sql1 = "SELECT COUNT(*) as totalCount from register where ";

		$sql1=$sql1 ." Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' " ;
		if($religion!="" and $religion!="Any")
		{
			$sql1=$sql1." and Religion ='".$religion."'";
		}
		if($education!="" and $education!="Any")
		{
			$sql1=$sql1." and Education ='".$education."'";
		}
		if($occu!="" and $occu!="Any")
		{
			$sql1=$sql1." and Occupation ='".$occu."'";
		}
		
		if($marital_status!="" and $marital_status!="Any")
		{
			$sql1=$sql1." and Maritalstatus ='".$marital_status."'";
		}
				
		$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND Photo1!=''";
		$sql1.=" ORDER BY ID DESC ";
		
    	$rec = mysqli_fetch_array(mysqli_query($con,$sql1));
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
    					$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$counter</a></li>";					
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
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$setLastpage</a></li>";		
				}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>..</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&txtSAge=$from_age&txtEAge=$to_age&religion=$religion&looking=$marital_status&gender=$txtgender'> <b> > </b></a></li>";
           
    		}else{
    			$setPaginate.= "<li><a class='active'><b> > </b></a></li>";
                
            }

    		$setPaginate.= "</ul>\n";		
    	}
        return $setPaginate;
    }
	

	
	?>
<!DOCTYPE html>
 <html lang="en">
<head>
<meta charset="utf-8">
<title>Search Result</title>
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
<link href="css/tooltip.css" rel="stylesheet">

<style>
.speaker-block-three .info-box:before 
{   
right: -43px;
}
.speakers-section-three 
{
padding: 36px 0 90px
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
<!-- <div class="preloader"></div> -->
<!-- Header span -->
<!-- Header Span -->
<span class="header-span"></span>


<?php include('header.php')?>
<?php	

	   $sql1 = "SELECT COUNT(*) as totalCount from register where ";

		$sql1=$sql1 ." Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' " ;
		if($religion!="" and $religion!="Any")
		{
			$sql1=$sql1." and Religion ='".$religion."'";
		}
		if($education!="" and $education!="Any")
		{
			$sql1=$sql1." and Education ='".$education."'";
		}
		if($occu!="" and $occu!="Any")
		{
			$sql1=$sql1." and Occupation ='".$occu."'";
		}
		
		if($marital_status!="" and $marital_status!="Any")
		{
			$sql1=$sql1." and Maritalstatus ='".$marital_status."'";
		}
				
		$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND Photo1!=''";
		$sql1.=" ORDER BY ID DESC ";
		$query=mysqli_query($con,$sql1);
    	$rec = mysqli_fetch_array($query);
    	$total = $rec['totalCount'];?>
	<section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block"> Search Result</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>  Search Result</li>
            </ul>
        </div>
    </section>

<!-- Speakers Section -->
<?php  if(mysqli_num_rows($rs_result)>0)
					   {?>
    <section class="speakers-section-three">
        <div class="auto-container">
            
             
            <div class="row">
			    
                  <?php while($fetch=mysqli_fetch_array($rs_result)) {  ?>  
				
                <!-- Speaker Block -->
                <div class="speaker-block-three col-xl-3 col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
				     
                    <div class="inner-box">
                     <div class="image-box">
					 
                            <figure class="image"><a href="login" target="_blank">
							<?php
							$frontImg='images/nophoto.jpg';
							if($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' && $fetch['Photo1']!='nophoto.jpg')
							    $frontImg='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=200';
							?>
							<img src="<?php echo $frontImg; ?>">
							</a></figure> 
                      </div>
					  
                      <div class="info-box">
						<h4 class="name"><a href="login" target="_blank">	
						<?php echo $fetch['MatriID']?></h4>
						<span class="designation"><?php echo substr($fetch['Maritalstatus'],0,20) ?></span>
						<span class="designation"><?php echo substr($fetch['Religion'],0,20) ?></span>
						<span class="designation"><?php echo $fetch['Age'] ?> Yrs<?php 
                      </div>
					  </a>
                      <div class="social-box">                            
					  <ul class="social-links social-icon-colored">
							 <div class="wrapper">
			 <li><a href="login" target="_blank"><i class="fas fa-user fa-skype"></i></a></li>
             <div class="tooltip"> Profile </div>
				</div>
			<div class="wrapper">
		     <li><a href="login" target="_blank"><i class="fas fa-heart fa-google-plus"></i></a></li>
             <div class="tooltip"> Shortlist</div>
			</div>
			<div class="wrapper">
			<li><a href="login" target="_blank"><i class="fas fa-comment-dots fa-bitbucket"></i></a></li>
             <div class="tooltip"> Message</div>
			</div>
			 <div class="wrapper">
			<li><a href="login" target="_blank"><i class="fas fa-user-plus fa-bitcoin"></i></a></li>
             <div class="tooltip"> Connect</div>
			</div>
			<div class="wrapper">
			<li><?php
			    $waHL = $fetch['Height'] ? getHeightValue($fetch['Height']) : '';
			    $waLL = implode(', ', array_filter([$fetch['City'] ?? '', $fetch['Dist'] ?? '']));
			    $waImg = ($frontImg !== 'images/nophoto.jpg') ? $baseUrl . $frontImg : '';
                $waLA = [];
                $waLA[] = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($fetch['MatriID']));
                $waLA[] = '';
                $waLA[] = "\u{1F496} Check out this Matrimony Profile!";
                $waLA[] = "\u{1F194} Profile ID: {$fetch['MatriID']}";
                $waLA[] = "\u{1F382} Age: {$fetch['Age']} years";
                if (!empty($fetch['Religion'])) $waLA[] = "\u{1F54A} Religion: {$fetch['Religion']}";
                if (!empty($fetch['Maritalstatus'])) $waLA[] = "\u{1F48D} Marital Status: {$fetch['Maritalstatus']}";
                if (!empty($fetch['Education'])) $waLA[] = "\u{1F393} Education: {$fetch['Education']}";
                if (!empty($fetch['Occupation'])) $waLA[] = "\u{1F4BC} Occupation: {$fetch['Occupation']}";
                if (!empty($waHL)) $waLA[] = "\u{1F4CF} Height: $waHL";
                if (!empty($waLL)) $waLA[] = "\u{1F4CD} Location: $waLL";
                $waLA[] = '';
                $waLA[] = "Find your perfect life partner today \u{2764}\u{FE0F}";
			    $waUR = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLA));
			?><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a></li>
             <div class="tooltip"> Share</div>
			</div>
						</ul>
                     </div>
                  </div>
               </div>
			  <?php } ?>
           </div>
			<div align="center" class="col-lg-12">
							<ul class='styled-pagination' id="pagination" >
		      <?php echo displayPaginationBelow($con,$setLimit,$page);?>
			  </ul>		   
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
						<div class="text">Sorry Result Not Found.Search Again.</div>
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
<script src="js/whatsapp-share.js?v=2"></script>
</body>
</html>