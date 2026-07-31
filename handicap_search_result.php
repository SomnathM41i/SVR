<?php 
 require_once('includes/bootstrap.php');
error_reporting(0);

include('memprotect.php');

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

$looking=$_POST['looking'] ? $_POST['looking'] : $_GET['looking'];
$txtgender=$_POST['gender'] ? $_POST['gender'] : $_GET['gender'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge'] : $_GET['txtSAge'];
$to_age=$_POST['txtEAge'] ? $_POST['txtEAge'] : $_GET['txtEAge'];
$religion=$_POST['religion'] ? $_POST['religion'] : $_GET['religion'];
$hadnicap_status = $_POST['handicap'] ? $_POST['handicap'] : $_GET['handicap'];





$matriid=mysqli_real_escape_string($con,$_POST['matriid'] ? $_POST['matriid'] : $_GET['matriid']);

if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit = 8;
	$pageLimit = ($page * $setLimit) - $setLimit;
	 if(isset($_POST['religion']))
	 $religion1=implode("','",$_POST['religion']);
	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : $rtrim_religion;
	 $religion123=array($religion);

	 if(isset($_POST['handicap']))
	 $handicap1=implode("','",$_POST['handicap']);
	 $explode_handicap=explode("a:1:{i:0;s:",$_GET['handicap']);
	 $explode_handicap1=explode(":",$explode_handicap[1]);
	 $trim_handicap=trim($explode_handicap1[1],'"');
	 $rtrim_handicap=rtrim($trim_handicap,'";}');
	 $hadnicap_status=$handicap1 ? $handicap1 : $rtrim_handicap;
	 $handicap123=array($hadnicap_status);
	 /**/

	 
	if(isset($_POST['looking']))
	 $looking1=implode("','",$_POST['looking']);
	 $explode_looking=explode("a:1:{i:0;s:",$_GET['looking']);
	 $explode_looking1=explode(":",$explode_looking[1]);
	 $trim_looking=trim($explode_looking1[1],'"');
	 $rtrim_looking=rtrim($trim_looking,'";}');
	 $looking=$looking1 ? $looking1 : $rtrim_looking;
	 $looking123=array($looking);
	 
	
	
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
$sql = "SELECT * FROM register where Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' ";

if($profile!="")
{
	$sql.=" and MatriID NOT IN ('$profile')"; 
}

if($matriid!="")
{
    $sql.=" and MatriID NOT IN ('$matriid')";  
}

if($religion!="Any" and $religion!="")
{
	$sql=$sql." and Religion IN('".$religion."')";
}
if($hadnicap_status!="Any" and $hadnicap_status!="")
{
	$sql=$sql." and spe_cases IN('".$hadnicap_status."')";
}

$sql1 = $sql." and spe_cases NOT IN('None','')";




if($looking!="Any" and $looking!="")
{

$sql=$sql." and Maritalstatus IN('".$looking."')";
}


$sql=$sql." AND visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive'  AND MatriID NOT LIKE '".$_SESSION['matri_login']."'";
$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;
$rs_result = mysqli_query($con,$sql);

function displayPaginationBelow($con,$per_page,$page){

$looking=$_POST['looking'] ? $_POST['looking'] : $_GET['looking'];
$txtgender=$_POST['gender'] ? $_POST['gender'] : $_GET['gender'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge'] : $_GET['txtSAge'];
$to_age=$_POST['txtEAge'] ? $_POST['txtEAge'] : $_GET['txtEAge'];
$religion=$_POST['religion'] ? $_POST['religion'] : $_GET['religion'];
$hadnicap_status=$_POST['handicap'] ? $_POST['handicap'] : $_GET['handicap'];






if(isset($_POST['religion']))
	 $religion1=implode("','",$_POST['religion']);
 	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : $rtrim_religion;
	 $religion123=array($religion);
	 $religionurl=urlencode(serialize($religion123));

if(isset($_POST['handicap']))
	 $handicap1=implode("','",$_POST['handicap']);
 	 $explode_handicap=explode("a:1:{i:0;s:",$_GET['handicap']);
	 $explode_handicap1=explode(":",$explode_handicap[1]);
	 $trim_religion=trim($explode_handicap1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $handicap=$handicap1 ? $handicap1 : $rtrim_religion;
	 $handicap123=array($handicap);
	 $handicapurl=urlencode(serialize($handicap123));

if(isset($_POST['looking']))
	 $looking1=implode("','",$_POST['looking']);
	 $explode_looking=explode("a:1:{i:0;s:",$_GET['looking']);
	 $explode_looking1=explode(":",$explode_looking[1]);
	 $trim_looking=trim($explode_looking1[1],'"');
	 $rtrim_looking=rtrim($trim_looking,'";}');
	 $looking=$looking1 ? $looking1 : $rtrim_looking;
	 $looking123=array($looking);
	 $lookingurl=urlencode(serialize($looking123));

if(isset($_POST['edu']))
	 $stredu1 =implode("','",$_POST['edu']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['edu']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);
	 $eduurl=urlencode(serialize($stredu123));
	 
	 
if(isset($_POST['occu']))
	 $stroccu1 = implode("','",$_POST['occu']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occu']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
	 $occuurl=urlencode(serialize($stroccu123));
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

	   $page_url="?";
	   $sql1 = "SELECT COUNT(*) as totalCount from register where ";

		$sql1=$sql1 ." Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' " ;
		if($profile!="")
		{
		$sql1=$sql1.=" and MatriID NOT IN ('$profile')"; 
		}
        
		if($matriid!="")
		{
		$sql1.=" and MatriID NOT IN ('$matriid')";  
		}
		
		if($religion!="Any" and $religion!="")
		{
			$sql1=$sql1." and Religion IN('".$religion."')";
		}
		if($handicap!="Any" and $handicap!="")
		{
			$sql1=$sql1." and spe_cases IN('".$handicap."')";
		}
		$sql1=$sql1." and spe_cases NOT IN('None','')";

		
		
		
		
		if($looking!="Any" and $looking!="")
		{
		$sql1=$sql1." and Maritalstatus IN('".$looking."')";
		}

				 
		$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND MatriID NOT LIKE '".$_SESSION['matri_login']."'";
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
    					$setPaginate.= "<li  ><a class='active' >$counter</a></li>";
    				else
     					$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$counter</a></li>";					
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
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$setLastpage</a></li>";		
				 }
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			 {
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    			    	{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$counter</a></li>";					
    				  }
    				        $setPaginate.= "<li class='dot'>..</li>";
    			        	$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$lpm1</a></li>";
    				        $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$setLastpage</a></li>";		
    			     }
    		        	else
    		      	{
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&handicap=$handicapurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender&with_photo=$with_photo'><b>></b></a></li>";
    		}else{
    			$setPaginate.= "<li><a class='active'><b>></b></a></li>";
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
<title>Handicap Search Result</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/tooltip.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">

<link href="css/responsive.css" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<!-- MPJ: brand icons -->
<link rel="apple-touch-icon" href="branding/favicons/apple-touch-icon.png">
<link rel="manifest" href="branding/site.webmanifest">
<meta name="theme-color" content="#5E1426">


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

</style>
<style>
.page-title {
      padding: 20px 0;
}
.blur
{
filter: blur(8px);
-webkit-filter: blur(8px);
}
</style>

</head>
<body  oncontextmenu="return false">
<div class="page-wrapper">
<!-- Preloader -->
<div class="preloader"></div>
<!-- Header span -->
<!-- Header Span -->
<span class="header-span"></span>


<?php include('header.php')?>
<?php 
	if( $me['spe_cases'] == "None")
    {
        print "<script>";
		print "self.location='index_dashboard'"; 
		print "</script>";
		exit;
	}
?>

    <?php if(!(isset($login)==0)){ ?>
   <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block"> Handicap Search Result</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Handicap Search</li>
            </ul>
        </div>
    </section>
	<?php }else{?>
           <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block"> Handicap Search Result</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index">Home</a></li>
                <li>Handicap Search Result</li>
            </ul>
        </div>
    </section>
	<?php } ?>
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
					 		
						   <?php  
						   	 $encrypt = urlencode( base64_encode( $fetch['MatriID'] ) );
						   	if(isset($login))
							{?>
						 <a href="full_profile?id=<?php echo $encrypt?>" target="_blank"> 
						 <figure class="image">
						  
                            <?php
							//paid member photo 
							 if($fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($fetch['Photo1']!='nophoto.jpg' ) {
														 ?>
								 <img src="photoprocess.php?image=gallary/<?php echo $fetch['Photo1'];?>&square=500">

												  <?php  } else   {   ?>
								
								 <img src="blur.php?image=gallary/<?php echo $fetch['Photo1'];?>">


										  <?php } } else { ?>
								 <img src="blur.php?image=gallary/<?php echo $fetch['Photo1'];?>">

										 
										 <?php  } } 
		 
							     elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' ) 
							     	{ 
							     		if($fetch['Photo1']!='nophoto.jpg' )
							     		{
							    ?>
								 <img src="photoprocess.php?image=gallary/<?php echo $fetch['Photo1'];?>&square=500">
								 
								<?php 
										}
										else
										{
								?>
								<img src="gallary/<?php echo $fetch['Photo1'];?>">
								<?php			
										}
								
								
											} else {?>
					            <img src="images/nophoto.jpg">
										   <?php }?>
										</a>
							</figure> </a>
							<?php }  else { ?>
							<a href="login" target="_blank"> 
						 <figure class="image">
						  
                            <?php
							//paid member photo 
							 if($fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($fetch['Photo1']!='nophoto.jpg' ) {
														 ?>
								 <img src="photoprocess.php?image=gallary/<?php echo $fetch['Photo1'];?>">
												  <?php  } else   {   ?>
								 <img src="blur.php?image=gallary/<?php echo $fetch['Photo1'];?>">

										  <?php } } else { ?>
								 <img src="blur.php?image=gallary/<?php echo $fetch['Photo1'];?>">

										 
										 <?php  } } 
		 
							     elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' ) 
							     	{ 
							     		if($fetch['Photo1']!='nophoto.jpg' ) 
							     		{	
							     ?>
										
								 <img src="photoprocess.php?image=gallary/<?php echo $fetch['Photo1'];?>&square=500">
								<?php 
										}
										else
										{
								?>
								<img src="gallary/<?php echo $fetch['Photo1'];?>">
								<?php	
										} 
									} else {?>
								<img src="images/nophoto.jpg">
 
										   <?php }?>
										</a>
							</figure> </a>
							<?php } ?>
                      </div>
					  
                      <div class="info-box">
						<h4 class="name">
						<?php if(!isset($login)) { ?>
						<a href="login" target="_blank">	
						<?php echo $fetch['MatriID']?></h4>
						<span class="designation">
							<?php 
								if( $fetch['Education'] == '')
								{
									echo "Not Set";
								}
								else
								{
									echo substr($fetch['Education'],0,20);		
								}
							

							?>
							
						</span>
						<span class="designation">
							<?php 
								if( $fetch['Occupation'] == '')
								{
									echo "Not Set";
								}
								else
								{
									echo substr($fetch['Occupation'],0,20);	
								}
								
							?>
							
						</span>
						<span class="designation">
							<?php 
							if($fetch['Age'] == '')
							{
								echo "Not Set";
							}
							else
							{
								echo $fetch['Age'] 	;
							}
							
							?> Yrs,
							<?php 
							if($fetch['Height'] == '')
							{
								echo "Not Set";
							}
							else
							{
								echo get_height($fetch['Height']);	
							}
							
							?>
						</span>
                      </div>
					  </a>
				  <?php }else {?> 
					  <a href="full_profile?id=<?php echo $encrypt?>" target="_blank">	
						<?php echo $fetch['MatriID']?></h4>
						<span class="designation">
							<?php 
								if( $fetch['Education'] == '')
								{
									echo "Not Set";
								}
								else
								{
									echo substr($fetch['Education'],0,20);		
								}
							

							?>
						</span>
						<span class="designation">
							<?php 
								if( $fetch['Occupation'] == '')
								{
									echo "Not Set";
								}
								else
								{
									echo substr($fetch['Occupation'],0,20);	
								}
								
							?>
								
						</span>
						<span class="designation">
						<?php 
							if($fetch['Age'] == '')
							{
								echo "Not Set";
							}
							else
							{
								echo $fetch['Age'] 	;
							}
							
						?> Yrs,
						<?php 
							if($fetch['Height'] == '')
							{
								echo "Not Set";
							}
							else
							{
								echo get_height($fetch['Height']);	
							}
							
						?>
							
						</span>
                      </div>
					  </a>
					  <?php } ?>
					  <?php
                $waHL = $fetch['Height'] ? getHeightValue($fetch['Height']) : '';
                $waLL = implode(', ', array_filter([$fetch['City'] ?? '', $fetch['Dist'] ?? '']));
                $waLA = [];
                $waLA[] = "\u{1F496} Check out this profile on Manpasand Jodidar!";
                $waLA[] = '';
                $waLA[] = "\u{1F194} Profile ID: {$fetch['MatriID']}";
                $waLA[] = "\u{1F382} Age: {$fetch['Age']} years";
                if (!empty($fetch['Religion'])) $waLA[] = "\u{1F54A} Religion: {$fetch['Religion']}";
                if (!empty($fetch['Maritalstatus'])) $waLA[] = "\u{1F48D} Marital Status: {$fetch['Maritalstatus']}";
                if (!empty($fetch['Education'])) $waLA[] = "\u{1F393} Education: {$fetch['Education']}";
                if (!empty($fetch['Occupation'])) $waLA[] = "\u{1F4BC} Occupation: {$fetch['Occupation']}";
                if (!empty($waHL)) $waLA[] = "\u{1F4CF} Height: $waHL";
                if (!empty($waLL)) $waLA[] = "\u{1F4CD} Location: $waLL";
                $waLA[] = '';
                $waLA[] = "\u{1F517} View Full Profile:";
                $waLA[] = $baseUrl . 'public_profile?id=' . urlencode(base64_encode($fetch['MatriID']));
                $waLA[] = '';
                $waLA[] = "Find your perfect match on Manpasand Jodidar — Rishta Dil Se, Saath Zindagi Bhar \u{2764}\u{FE0F}";
                $waUR = 'https://api.whatsapp.com/send?text=' . rawurlencode(implode("\n", $waLA));
              ?><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" style="margin-top:8px;display:inline-block"><i class="fab fa-whatsapp"></i> Share</a>
			 <div class="social-box">                            
			 <ul class="social-links social-icon-colored">
			<?php  if(isset($login)&& $regvar=='9') { ?>
            <div class="wrapper">
			 <li><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-user fa-skype"></i></a></li>
             <div class="tooltip"> Profile </div>
				</div>
			<div class="wrapper">
		     <li><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-heart fa-google-plus"></i></a></li>
             <div class="tooltip"> Shortlist</div>
			</div>
			<div class="wrapper">
			<li><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-comment-dots fa-bitbucket"></i></a></li>
             <div class="tooltip"> Message</div>
			</div>
			 <div class="wrapper">
			<li><a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><i class="fas fa-user-plus fa-bitcoin"></i></a></li>
             <div class="tooltip"> Connect</div>
			</div>
				
			 <?php }else{?>
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
					   <?php } ?>

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
						<a href="handicap_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>
						<!--<a href="contact.html" class="theme-btn btn-style-two"><span class="btn-title">Contact Us</span></a>-->
					</div>
				</section>
					   <?php } ?>
    <!-- End Speakers Section -->

    <!-- Main Footer -->
   	<script src="js/whatsapp-share.js?v=2"></script>
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