<?php //include('dbconnectadmin.php');
//error_reporting(0);
require_once('sys_dbconnection.php');
/*include_once('memprotect.php');*/



$religion=$_GET['religion'] ? $_GET['religion'] : $_GET['religion'];
$matriid=$_SESSION['MatriID'];
if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit =8;
	$pageLimit = ($page * $setLimit) - $setLimit;
$my_profile = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
$mes = mysqli_fetch_array($my_profile);
$me = $mes;
if($mes['Gender']=='Male')
$match_sex = "Female";
if($mes['Gender']=='Female')
$match_sex = "Male";

$sql = "SELECT * FROM register where visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND Photo1!='' ";

if($match_sex!="Any" and $match_sex!="")
{
$sql=$sql." and Gender ='".$match_sex."'";
}

if($religion!="Any" and $religion!="")
{
$sql=$sql." and Religion ='".$religion."'";
}



$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;

$rs_result = mysqli_query($con,$sql);

$heightMap = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];

function displayPaginationBelow($con,$per_page,$page){
	$matriid=$_SESSION['MatriID'];
	$my_profile = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
	$mes = mysqli_fetch_array($my_profile);
	if($mes['Gender']=='Male')
	$match_sex = "Female";
	if($mes['Gender']=='Female')
	$match_sex = "Male";
	$religion=$_GET['religion'] ? $_GET['religion'] : $_GET['religion'];
	
	   $page_url="?";
	   $sql1 = "SELECT COUNT(*) as totalCount FROM register where visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND Photo1!='' ";

		if($match_sex!="Any" and $match_sex!="")
		{
		$sql1=$sql1." and Gender ='".$match_sex."'";
		}

		if($religion!="Any" and $religion!="")
		{
		$sql1=$sql1." and Religion ='".$religion."'";
		}

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
    		$setPaginate .= "<ul class='mvv-pagination'>"; 
			$setPaginate .= "<li class='mvv-page-info'>Page $page of $setLastpage</li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li class='active'><span>$counter</span></li>";
    				else
    					$setPaginate.= "<li><a href='{$page_url}page=$counter&religion=$religion'>$counter</a></li>";					
    			}
    		}
    		elseif($setLastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&religion=$religion'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='mvv-dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&religion=$religion'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&religion=$religion'>$setLastpage</a></li>";		
				}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&religion'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&religion=$religion'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&religion=$religion'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='mvv-dot'>..</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&religion=$religion'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&religion=$religion'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&religion=$religion'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&religion=$religion'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&religion=$religion'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&religion=$religion'><b>></b></a></li>";
                
    		}else{
    			$setPaginate.= "<li><a class='active'><b>></b></a></li>";
            }

    		$setPaginate.= "</ul>\n";		
    	}
        return $setPaginate;
    }
	
//echo $sql;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Religion Search Result</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:30px;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-page-hero{background:linear-gradient(135deg,var(--mvv-maroon),#8B1A1A);padding:40px 0 30px;margin-bottom:32px;}
.mvv-page-hero h1{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:4px 0;text-align:center;}
.mvv-page-hero .mvv-eyebrow{text-align:center;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:2px;font-size:.8rem;font-weight:600;}
.mvv-page-hero p{text-align:center;color:rgba(255,255,255,.7);margin:0 0 8px;}
.mvv-breadcrumb{text-align:center;font-size:.85rem;}
.mvv-breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none;}
.mvv-breadcrumb a:hover{color:#fff;}
.mvv-breadcrumb span{color:var(--mvv-gold);}
.mvv-section{padding:0 0 40px;}
.mvv-match-card { background:#fff; border-radius:14px; overflow:hidden; border:1px solid var(--mvv-border); transition:box-shadow .25s; height:100%; }
.mvv-match-card:hover { box-shadow:0 8px 30px rgba(0,0,0,0.1); }
.mvv-match-card .mvv-card-img { width:100%; height:260px; object-fit:cover; background:var(--mvv-cream); }
.mvv-match-card .mvv-card-body { padding:16px; }
.mvv-match-card h5 { margin:0 0 4px; font-weight:700; font-size:1.05rem; }
.mvv-match-card h5 a { color:var(--mvv-maroon); text-decoration:none; }
.mvv-match-card .mvv-card-meta { font-size:0.85rem; color:#666; margin-bottom:10px; }
.mvv-match-card .mvv-card-actions { display:flex; gap:6px; flex-wrap:wrap; border-top:1px solid var(--mvv-border); padding:10px 16px; background:var(--mvv-cream); }
.mvv-match-card .mvv-card-actions a { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:#fff; border:1px solid var(--mvv-border); color:var(--mvv-maroon); text-decoration:none; transition:.2s; }
.mvv-match-card .mvv-card-actions a:hover { background:var(--mvv-maroon); color:#fff; border-color:var(--mvv-maroon); }
.mvv-pagination { display:flex; align-items:center; gap:6px; flex-wrap:wrap; justify-content:center; padding:0; margin:24px 0 0; list-style:none; }
.mvv-pagination li a, .mvv-pagination li span, .mvv-pagination li.active span { display:inline-flex; align-items:center; justify-content:center; min-width:38px; height:38px; padding:0 8px; border:1px solid var(--mvv-border); border-radius:8px; background:#fff; color:#333; font-size:0.9rem; text-decoration:none; transition:.2s; }
.mvv-pagination li a:hover { background:var(--mvv-cream); border-color:var(--mvv-maroon); color:var(--mvv-maroon); }
.mvv-pagination li.active span { background:var(--mvv-maroon); border-color:var(--mvv-maroon); color:#fff; font-weight:700; }
.mvv-pagination .mvv-page-info { border:none; color:var(--mvv-muted); font-size:0.85rem; padding:0 8px; }
.mvv-pagination .mvv-dot { border:none; font-size:1.1rem; color:#999; padding:0 4px; }
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#8B1A1A;}
</style>
</head>
<body>

<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Search</div>
      <h1>Religion Search Result</h1>
      <p>Profiles matching your religion preference</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Religion Search Results</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(mysqli_num_rows($rs_result)>0) { ?>
      <div class="row g-4">
        <?php while($fetch=mysqli_fetch_array($rs_result)) {
          $encrypt=urlencode(base64_encode($fetch['MatriID']));
          $imgSrc='images/nophoto.jpg';
          if($fetch['photo_visibility']=='paidphoto' && $fetch['Photo1Approve']=='Yes' && $me['Status']=='Paid' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
          elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
        ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
          <div class="mvv-match-card">
            <?php if(isset($login)) { ?>
            <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank">
              <img class="mvv-card-img" src="<?php echo $imgSrc ?>" alt="" loading="lazy">
            </a>
            <?php } else { ?>
            <a href="login" target="_blank">
              <img class="mvv-card-img" src="<?php echo $imgSrc ?>" alt="" loading="lazy">
            </a>
            <?php } ?>
            <div class="mvv-card-body">
              <?php if(isset($login)) { ?>
              <h5><a href="full_profile?id=<?php echo $encrypt ?>" target="_blank"><?php echo $fetch['MatriID'] ?></a></h5>
              <?php } else { ?>
              <h5><a href="login" target="_blank"><?php echo $fetch['MatriID'] ?></a></h5>
              <?php } ?>
              <div class="mvv-card-meta">
                <?php echo substr($fetch['Education'],0,20) ?><br>
                <?php echo substr($fetch['Occupation'],0,20) ?><br>
                <?php echo $fetch['Age'] ?> Yrs, <?php echo $heightMap[$fetch['Height']]??''; ?>
              </div>
            </div>
            <div class="mvv-card-actions">
              <?php if(isset($login)) { ?>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
              <?php } else { ?>
              <a href="login" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
              <a href="login" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
              <a href="login" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
              <a href="login" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div style="text-align:center;margin-top:30px;">
        <?php echo displayPaginationBelow($con,$setLimit,$page); ?>
      </div>
      <?php } else { ?>
      <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:3rem;font-weight:900;color:var(--mvv-maroon);opacity:0.3;margin-bottom:10px;">OOP'S</div>
        <h3 style="color:var(--mvv-muted);">Sorry Result Not Found</h3>
        <p style="color:#999;">No profiles found matching your religion preference.</p>
        <a href="smart_search" class="mvv-btn primary" style="margin-top:10px;">Go Back</a>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

</body>
</html>
