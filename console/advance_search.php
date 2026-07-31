<?php require_once('../includes/bootstrap.php');
include('protect.php'); 




$login=$_SESSION['MatriID'];
$page = 1;
if(isset($_GET["page"]) && empty($_POST["page"])){
	$page = (int)$_GET["page"];
}
if(isset($_POST["page"]) ){
	$page = (int)$_POST["page"];
}

	
$setLimit = 12;
$pageLimit = ($page * $setLimit) - $setLimit;
	   
$from_age=$_REQUEST['txtSAge'] ? $_REQUEST['txtSAge'] : $_REQUEST['from_age'];
$to_age=$_REQUEST['txtEAge'] ? $_REQUEST['txtEAge'] : $_REQUEST['to_age'];
$txtgender=$_REQUEST['gender'] ? $_REQUEST['gender'] : $_REQUEST['txtgender'];
$heightfrom=$_REQUEST['heightfrom'] ? $_REQUEST['heightfrom'] : $_REQUEST['heightfrom'];
$heightto=$_REQUEST['heightto'] ? $_REQUEST['heightto'] : $_REQUEST['heightto'];
$with_photo=$_REQUEST['with_photo'] ? $_REQUEST['with_photo'] : $_REQUEST['with_photo'];
$institute=$_REQUEST['institute'] ? $_REQUEST['institute'] : $_REQUEST['institute'];



if(isset($_POST['ms']) && $_POST['postfield'])
	 $ms1=implode("','",$_POST['ms']);
	 $explode_ms=explode("a:1:{i:0;s:",$_GET['ms']);
	 $explode_ms1=explode(":",$explode_ms[1]);
	 $trim_ms=trim($explode_ms1[1],'"');
	 $rtrim_ms=rtrim($trim_ms,'";}');
	 $ms=$ms1 ? $ms1 : $rtrim_ms;
	 $ms123=array($ms);
	 
	 
if(isset($_POST['status']) && $_POST['postfield'])
	 $status1=implode("','",$_POST['status']);
	 $explode_status=explode("a:1:{i:0;s:",$_GET['status']);
	 $explode_status1=explode(":",$explode_status[1]);
	 $trim_status=trim($explode_status1[1],'"');
	 $rtrim_status=rtrim($trim_status,'";}');
	 $status=$status1 ? $status1 : $rtrim_status;
	 $status123=array($status);	  
	 
if(isset($_POST['religion']) && $_POST['postfield'])
	 $religion1=implode("','",$_POST['religion']);
 	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : $rtrim_religion;
	 $religion123=array($religion);
	  	 
if(isset($_POST['caste']) && $_POST['postfield'])
	 $cast1=implode("','",$_POST['caste']);
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : $rtrim_caste;
	 $cast123=array($cast);
	  
	
	 
if(isset($_POST['education']) && $_POST['postfield'])
	 $stredu1 =implode("','",$_POST['education']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);

	 
if(isset($_POST['occupation']) && $_POST['postfield'])
	 $stroccu1 = implode("','",$_POST['occupation']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
 
	 
if(isset($_POST['country']) && $_POST['postfield'])
	 $country1 = implode("','",$_POST['country']);
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : $rtrim_country;
	 $country123=array($country);
	 	
if(isset($_POST['state']) && $_POST['postfield'])
	 $state1=implode("','",$_POST['state']);
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : $rtrim_state;
	 $state123=array($state);
	 
if(isset($_POST['dist']) && $_POST['postfield'])
	 $dist1=implode("','",$_POST['dist']);
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : $rtrim_dist;
	 $dist123=array($dist);
	 
$sql = "SELECT * FROM register where ";

if($txtgender!="All")
{
$sql .=" Gender ="."'".$txtgender."' and";
} 
if($from_age!="Any" and $to_age!="Any")
{
$sql=$sql."  Age BETWEEN '".$from_age."' AND '".$to_age."' ";
} 

if($heightfrom!="Any" and $heightto!="Any")
{
$sql=$sql." and Height BETWEEN '".$heightfrom."' AND '".$heightto."' ";
} 
if($ms!="Any" and $ms!="")
{
$sql=$sql." and Maritalstatus  IN('".$ms."')";
}
if($status!="Any" and $status!="")
{
$sql=$sql." and Status  IN('".$status."')";
}

if($religion!="Any" and $religion!="")
{
$sql=$sql." and Religion IN('".$religion."')";
}
if($cast!="Any" and $cast!="")
{
$sql=$sql." and Caste IN('".$cast."')";
}
if($subcaste!="Any" and $subcaste!="")
{
$sql=$sql." and Subcaste IN('".$subcaste."')";
}
if($stredu!="Any" and $stredu!="")
{
$sql=$sql." and Education IN('".$stredu."')";
}
if($stroccu!="Any" and $stroccu!="")
{
$sql=$sql." and Occupation IN('".$stroccu."')";
}
if($country!="Any" and $country!="")
{
$sql=$sql." and Country IN('".$country."')";
} 
if($state!="Any" and $state!="")
{
$sql=$sql." and State IN('".$state."')";
}
if($dist!="Any" and $dist!="")
{
$sql=$sql." and Dist IN('".$dist."')";
} 
if($city!="Any" and $city!="")
{
$sql=$sql." and City IN('".$city."')";
}
  
if($with_photo!='withoutphoto')
{
$sql=$sql." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
$sql=$sql." and Photo1  LIKE 'nophoto.jpg' ";
}
if($institute!="Any" and $institute!="")
{
$sql=$sql." and instu IN('".$institute."') ";
}

$sql=$sql." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' ";
$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;


function displayPaginationBelow($con,$per_page,$page){
	   
$from_age=$_REQUEST['txtSAge'] ? $_REQUEST['txtSAge'] : $_REQUEST['from_age'];
$to_age=$_REQUEST['txtEAge'] ? $_REQUEST['txtEAge'] : $_REQUEST['to_age'];
$txtgender=$_REQUEST['gender'] ? $_REQUEST['gender'] : $_REQUEST['txtgender'];
$heightfrom=$_REQUEST['heightfrom'] ? $_REQUEST['heightfrom'] : $_REQUEST['heightfrom'];
$heightto=$_REQUEST['heightto'] ? $_REQUEST['heightto'] : $_REQUEST['heightto'];
$with_photo=$_REQUEST['with_photo'] ? $_REQUEST['with_photo'] : $_REQUEST['with_photo'];
$institute=$_REQUEST['institute'] ? $_REQUEST['institute'] : $_REQUEST['institute'];


if(isset($_POST['ms']) && $_POST['postfield'])
	 $ms1=implode("','",$_POST['ms']);
	 $explode_ms=explode("a:1:{i:0;s:",$_GET['ms']);
	 $explode_ms1=explode(":",$explode_ms[1]);
	 $trim_ms=trim($explode_ms1[1],'"');
	 $rtrim_ms=rtrim($trim_ms,'";}');
	 $ms=$ms1 ? $ms1 : $rtrim_ms;
	 $ms123=array($ms);
	 $msurl=urlencode(serialize($ms123)); 		
  
if(isset($_POST['status']) && $_POST['postfield'])
	 $status1=implode("','",$_POST['status']);
	 $explode_status=explode("a:1:{i:0;s:",$_GET['status']);
	 $explode_status1=explode(":",$explode_status[1]);
	 $trim_status=trim($explode_status1[1],'"');
	 $rtrim_status=rtrim($trim_status,'";}');
	 $status=$status1 ? $status1 : $rtrim_status;
	 $status123=array($status);
	 $statusurl=urlencode(serialize($status123)); 	  
	  
if(isset($_POST['religion']) && $_POST['postfield'])
	 $religion1=implode("','",$_POST['religion']);
 	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : $rtrim_religion;
	 $religion123=array($religion);
	 $religionurl=urlencode(serialize($religion123)); 
	  	 
if(isset($_POST['caste']) && $_POST['postfield'])
	 $cast1=implode("','",$_POST['caste']);
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : $rtrim_caste;
	 $cast123=array($cast);
	 $casturl=urlencode(serialize($cast123)); 
	
	 
if(isset($_POST['education']) && $_POST['postfield'])
	 $stredu1 =implode("','",$_POST['education']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);
	 $eduurl=urlencode(serialize($edu123)); 

	 
if(isset($_POST['occupation']) && $_POST['postfield'])
	 $stroccu1 = implode("','",$_POST['occupation']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
	 $occuurl=urlencode(serialize($occu123)); 
	 
	 
if(isset($_POST['country']) && $_POST['postfield'])
	 $country1 = implode("','",$_POST['country']);
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : $rtrim_country;
	 $country123=array($country);
	 $countryurl=urlencode(serialize($country123)); 
	 	
if(isset($_POST['state']) && $_POST['postfield'])
	 $state1=implode("','",$_POST['state']);
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : $rtrim_state;
	 $state123=array($state);
	 $stateurl=urlencode(serialize($state123)); 
	 
if(isset($_POST['dist']) && $_POST['postfield'])
	 $dist1=implode("','",$_POST['dist']);
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : $rtrim_dist;
	 $dist123=array($dist);
	 $disturl=urlencode(serialize($dist123)); 


$page_url="?";

$sql1 = "SELECT COUNT(*) as totalCount FROM register where";

if($txtgender!="All")
{
$sql1 .=" Gender ="."'".$txtgender."' and";
} 
if($from_age!="Any" and $to_age!="Any")
{
$sql1=$sql1."  Age BETWEEN '".$from_age."' AND '".$to_age."' ";
} 
if($heightfrom!="Any" and $heightto!="Any")
{
$sql1=$sql1." and Height BETWEEN '".$heightfrom."' AND '".$heightto."' ";
} 
if($ms!="Any" and $ms!="")
{
$sql1=$sql1." and Maritalstatus  IN('".$ms."')";
}

if($status!="Any" and $status!="")
{
$sql1=$sql1." and Status  IN('".$status."')";
}

if($religion!="Any" and $religion!="")
{
$sql1=$sql1." and Religion IN('".$religion."')";
}
if($cast!="Any" and $cast!="")
{
$sql1=$sql1." and Caste IN('".$cast."')";
}
if($subcaste!="Any" and $subcaste!="")
{
$sql1=$sql1." and Subcaste IN('".$subcaste."')";
}
if($stredu!="Any" and $stredu!="")
{
$sql1=$sql1." and Education IN('".$stredu."')";
}
if($stroccu!="Any" and $stroccu!="")
{
$sql1=$sql1." and Occupation IN('".$stroccu."')";
}
if($country!="Any" and $country!="")
{
$sql1=$sql1." and Country IN('".$country."')";
} 
if($state!="Any" and $state!="")
{
$sql1=$sql1." and State IN('".$state."')";
}
if($dist!="Any" and $dist!="")
{
$sql1=$sql1." and Dist IN('".$dist."')";
} 
if($city!="Any" and $city!="")
{
$sql1=$sql1." and City IN('".$city."')";
}
  


if($with_photo!='withoutphoto')
{
$sql1=$sql1." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
$sql1=$sql1." and Photo1  LIKE 'nophoto.jpg' ";
}

if($institute!="Any" and $institute!="")
{
$sql1=$sql1." and instu IN ('".$institute."')";
}


$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' ";
$sql1.=" ORDER BY Regdate DESC ";



		
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
    		$setPaginate .= "<ul class='pagination  Pagiadvance' align='Center'>"; 
			$setPaginate .= "<li class='page-item mt-1 mr-5'>Page $page of $setLastpage</li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li  ><a class='page-link active' >$counter</a></li>";
    				else
     					$setPaginate.= "<li><a class='page-link' href='{$page_url}page=$counter&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$counter</a></li>";					
       			}
          	}
    		elseif($setLastpage > 5 + ($adjacents * 2))
    		 {
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
    		    			else
    						$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$counter&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a class='page-link' href='{$page_url}page=$lpm1&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$lpm1</a></li>";
    				$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$setLastpage&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$setLastpage</a></li>";		
				 }
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			 {
    				$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=1&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>1</a></li>";
    				$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=2&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    			    	{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$counter&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$counter</a></li>";					
    				  }
    				        $setPaginate.= "<li class='dot'>..</li>";
    			        	$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$lpm1&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$lpm1</a></li>";
    				        $setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$setLastpage&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$setLastpage</a></li>";		
    			     }
    		        	else
    		      	{
    				$setPaginate.= "<li><a class='page-link' href='{$page_url}page=1&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>1</a></li>";
    				$setPaginate.= "<li><a class='page-link' href='{$page_url}page=2&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='page-link active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$counter&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a  class='page-link' href='{$page_url}page=$next&from_age=$from_age&to_age=$to_age&txtgender=$txtgender&ms=$msurl&status=$statusurl&religion=$religionurl&caste=$casturl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&heightfrom=$heightfrom&heightto=$heightto&instu=$institute'><b>Next</b></a></li>";
    		}else{
    			$setPaginate.= "<li><a class='page-link  active'><b>Next</b></a></li>";
            }

    		$setPaginate.= "</ul>\n";		
    	}
       return $setPaginate;
    }
	
	

	
	?>


<!DOCTYPE html>
<html lang="en">


<head>
    <title>Advance Search</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Manpasand Jodidar - Admin Panel"/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="../branding/favicons/favicon.ico" type="image/x-icon">?>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
    
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
	<link rel="stylesheet" href="assets/css/stylnew.css" id="main-style-link">
	<link rel="stylesheet" href="assets/css/advance.css" id="main-style-link">

	<!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/customizer.css">
<script language="javascript">
function fillstate(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("state").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("state").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_state.php?q="+str,true);
xmlhttp.send();
}


function filldist(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("dist").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dist").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_dist.php?q="+str,true);
xmlhttp.send();
}



</script>
<script>
function fillage(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("toage").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("toage").innerHTML=xmlhttp.responseText;
    }
  }
  //alert(str);
xmlhttp.open("GET","../filltoage.php?q="+str,true);
xmlhttp.send();
}
</script>
<script language="javascript">
function fillcaste(str)
{

	
var xmlhttp;
if (str=="")
  {
   
  document.getElementById("caste").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("caste").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fillcaste.php?q="+str,true);
xmlhttp.send();
}

  </script> 
  <style>
  .card-body {
    flex: 1 1 auto;
    padding: 24px 17px;
}
@media screen and (max-width: 568px) { 
			.Pagiadvance {
					display: flex;
					padding-left: 10px !important;
				}
}
@media screen and (max-width: 768px) { 
				.Pagiadvance {
					display: flex;
					padding-left: 10px !important;
				}
}
  </style>
  <style>
  .table.table-xs td, .table.table-xs th {
    padding: 0.1rem 0.1rem;
}


 </style>
</head>
<body class="pc-horizontal">
	<div class="container">
		<!-- [ Pre-loader ] start -->
		<div class="loader-bg">
			<div class="loader-track">
				<div class="loader-fill"></div>
			</div>
		</div>
		<!-- [ Pre-loader ] End -->
		<!-- [ Mobile header ] start -->
	
		
		<?php include('topheader.php');?>
		<?php include('header.php');?>
		
		<?php include('notification.php');?>
	

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
       
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ task-board-left ] start -->
            <div class="col-xl-3 col-lg-4">
                <div class="card e-comm-filter">
				  <form action="#" method="post">
                    <div class="card-header">
                        <h5><i class="material-icons-two-tone f-18 text-primary">filter_alt</i> Filter</h5>
                    </div>
					 <div class="card-body py-3 border-bottom">
                       <!-- <a data-bs-toggle="collapse" href="#" data-bs-target="#ecommfilstatus" class="link-dark" aria-expanded="false" aria-controls="ecommfilstatus">-->
                            <div class="h6 mb-0">Gender <i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!--</a>-->
                        <div class="collapse border-top show pt-3 mt-3" id="ecommfilstatus">

                        	<input type="hidden" name="postfield" value="formfield">
                        	<input type="hidden" name="page" value="1">
                            <select class="" name="gender" id="gender">
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							  <option value="All">Both</option>
							
							</select>
						
							<?php /* <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" value="Male"  name="gender" id="Male">
                                <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" value="Female" name="gender" id="Female">
                                <label class="form-check-label" for="Female">Female</label>
                            </div>
							<div class="form-check mb-2">
                                <input class="form-check-input" type="radio" value="All" name="gender" id="All" checked>
                                <label class="form-check-label" for="All">Both</label>
                            </div> */ ?>
                          
                           
                        </div>
                    </div>
					<div class="card-body py-3 border-bottom">
					<!--<a data-bs-toggle="collapse" href="#" data-bs-target="#Marital" class="link-dark" aria-expanded="false" aria-controls="Marital">-->
					 <div class="h6 mb-0">Marital Status<i  class="float-end me-1 wid-15 hei-15"></i></div> 
					<!--</a>-->
					<div class="collapse border-top show pt-3 mt-3" id="Marital">
					  <select id="ms" name="ms[]" multiple="multiple">
					 
									<option value="Unmarried"  >Unmarried</option>
										<option value="Separated">Separated</option>
										<option value="Widowed">Widowed</option>
										<option value="Divorced">Divorced</option>
										<option value="Any">Any</option>
					  </select>
					 </div>
                      <?php ?>
                    </div>
					 <div class="card-body py-3 border-bottom">
                       <!-- <a data-bs-toggle="collapse" href="#" data-bs-target="#Membership" class="link-dark" aria-expanded="false" aria-controls="Membership">-->
                            <div class="h6 mb-0">Membership Status	 <i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!--</a>-->
                        <div class="collapse border-top show pt-3 mt-3" id="Membership" multiple>
						  <select  name="status[]"  id="status" multiple>
								<option value="Active"> Active </option>
								<option value="Paid"> Paid</option>
								<option value="Expired"> Expired</option>
						   </select>
						   <?php /* <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="Active" name="status[]" id="Active">
                                <label class="form-check-label" for="Active">Active</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="Paid"  name="status[]" id="Paid">
                                <label class="form-check-label" for="Paid">Paid </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="Expired" name="status[]"  id="Expired">
                                <label class="form-check-label" for="Expired">Expired </label>
                            </div>*/ ?>
							
                        </div>
                    </div>
                    <div class="card-body py-3 border-bottom">
                         <!-- <a data-bs-toggle="collapse" href="#" data-bs-target="#ecommprice" class="link-dark" aria-expanded="false" aria-controls="ecommprice">-->
                            <div class="h6 mb-0">Age <i  class="float-end me-1 wid-15 hei-15"></i></div>
                         <!-- </a>-->
						 
                        <div class="collapse border-top show pt-3 mt-3" id="ecommprice">
                            <div class="">
                                <select class="custom-select-box"  id="fromage" name="txtSAge" required onChange="fillage(this.value)">
                                   <option value="18" selected> 18</option>				
									<?php 
										$rrsfromage=mysqli_query($con,"SELECT * FROM fromage");
										while($rrowfromage=mysqli_fetch_array($rrsfromage))
										{
										?>
									<option value="<?php echo $rrowfromage['fromage'];?>"><?php echo $rrowfromage['fromage'];?></option>
										<?php } ?>
                                </select>
                                <label class="bakcolou ">To</label>
                                <select class="custom-select-box" name="txtEAge" id="toage" required>
										<option value="35" selected> 35</option>				
									<?php 
										$rrstoage=mysqli_query($con,"SELECT * FROM toage");
										while($rrowtoage=mysqli_fetch_array($rrstoage))
										{
										?>
									<option value="<?php echo $rrowtoage['toage'];?>"><?php echo $rrowtoage['toage'];?></option>
										<?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
					<div class="card-body py-3 border-bottom">
                        <!--<a data-bs-toggle="collapse" href="#" data-bs-target="#height" class="link-dark" aria-expanded="false" aria-controls="height">-->
                            <div class="h6 mb-0">Height <i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!--</a>-->
						 
                        <div class="collapse border-top show pt-3 mt-3" id="height">
                            <div class="">
                                <select class="custom-select-box"  id="heightfrom" name="heightfrom" required>
                                  <option value="1" selected>4Ft </option>
									<option value="2" >4Ft 1 inch </option>
									<option value="3" >4Ft 2 inch </option>
									<option value="4" >4Ft 3 inch </option>
									<option value="5" >4Ft 4 inch </option>
									<option value="6" >4Ft 5 inch </option>
									<option value="7" >4Ft 6 inch </option>
									<option value="8" >4Ft 7 inch </option>
									<option value="9" >4Ft 8 inch </option>
									<option value="10" >4Ft 9 inch </option>
									<option value="11" >4Ft 10 inch </option>
									<option value="12" >4Ft 11 inch </option>
									<option value="13" >5Ft </option>
									<option value="14" >5Ft 1 inch </option>
									<option value="15" >5Ft 2 inch </option>
									<option value="16" >5Ft 3 inch </option>
									<option value="17" >5Ft 4 inch </option>
									<option value="18" >5Ft 5 inch </option>
									<option value="19" >5Ft 6 inch </option>
									<option value="20" >5Ft 7 inch </option>
									<option value="21" >5Ft 8 inch </option>
									<option value="22" >5Ft 9 inch </option>
									<option value="23" >5Ft 10 inch </option>
									<option value="24" >5Ft 11 inch </option>
									<option value="25" >6Ft </option>
									<option value="26" >6Ft 1 inch </option>
									<option value="27" >6Ft 2 inch </option>
									<option value="28" >6Ft 3 inch </option>
									<option value="29" >6Ft 4 inch </option>
									<option value="30" >6Ft 5 inch </option>
									<option value="31" >6Ft 6 inch </option>
									<option value="32" >6Ft 7 inch </option>
									<option value="33" >6Ft 8 inch </option>
									<option value="34" >6Ft 9 inch </option>
									<option value="35" >6Ft 10 inch </option>
									<option value="36" >6Ft 11 inch </option>
									<option value="37" >7Ft </option>
                                </select>
                                <label class="bakcolou ml-2 mr-2">To</label>
                                <select class="custom-select-box" name="heightto" id="heightto" required>
									<option value="" selected> To Height</option>
										<option value="1" >4Ft </option>
									<option value="2" >4Ft 1 inch </option>
									<option value="3" >4Ft 2 inch </option>
									<option value="4" >4Ft 3 inch </option>
									<option value="5" >4Ft 4 inch </option>
									<option value="6" >4Ft 5 inch </option>
									<option value="7" >4Ft 6 inch </option>
									<option value="8" >4Ft 7 inch </option>
									<option value="9" >4Ft 8 inch </option>
									<option value="10" >4Ft 9 inch </option>
									<option value="11" >4Ft 10 inch </option>
									<option value="12" >4Ft 11 inch </option>
									<option value="13" >5Ft </option>
									<option value="14" >5Ft 1 inch </option>
									<option value="15" >5Ft 2 inch </option>
									<option value="16" >5Ft 3 inch </option>
									<option value="17" >5Ft 4 inch </option>
									<option value="18" >5Ft 5 inch </option>
									<option value="19" >5Ft 6 inch </option>
									<option value="20" >5Ft 7 inch </option>
									<option value="21" >5Ft 8 inch </option>
									<option value="22" >5Ft 9 inch </option>
									<option value="23" >5Ft 10 inch </option>
									<option value="24" selected >5Ft 11 inch </option>
									<option value="25" >6Ft </option>
									<option value="26" >6Ft 1 inch </option>
									<option value="27" >6Ft 2 inch </option>
									<option value="28" >6Ft 3 inch </option>
									<option value="29" >6Ft 4 inch </option>
									<option value="30" >6Ft 5 inch </option>
									<option value="31" >6Ft 6 inch </option>
									<option value="32" >6Ft 7 inch </option>
									<option value="33" >6Ft 8 inch </option>
									<option value="34" >6Ft 9 inch </option>
									<option value="35" >6Ft 10 inch </option>
									<option value="36" >6Ft 11 inch </option>
									<option value="37" >7Ft </option>
                                </select>
                            </div>
                        </div>
                    </div>
				 <div class="card-body py-3 border-bottom">
				       <!--<a data-bs-toggle="collapse" href="#" data-bs-target="#Religion" class="link-dark" aria-expanded="false" aria-controls="Religion">-->
                            <div class="h6 mb-0">Religion<i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!-- </a>-->
						
						<div class="collapse border-top show pt-3 mt-3" id="Religion">
						<select   title='Select Religion' name="religion[]" id="religion" multiple>
							 <?php 
							$rrs=mysqli_query($con,"SELECT * FROM religion WHERE status='enable' ORDER BY Religion ASC");

							while($rrow=mysqli_fetch_array($rrs))
							{
							?>
							<option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
							<?php }
							
							?>
								 </select>
				 
				 <?php ?>
                  </div> 
				  </div>
				    
				  				  
				  
				   <div class="card-body py-3 border-bottom">
				    <div class="h6 mb-0">Caste <i  class="float-end me-1 wid-15 hei-15"></i></div>
				    
					 <div class="collapse border-top show pt-3 mt-3" id="Caste">
					<select  id="caste" name="caste[]" multiple >
					 </select>
				   
				   
                        <?php ?>
                    </div>
					</div>
				  <div class="card-body py-3 border-bottom">
                       <!-- <a data-bs-toggle="collapse" href="#" data-bs-target="#Education" class="link-dark" aria-expanded="false" aria-controls="Education">-->
                            <div class="h6 mb-0">Education <i  class="float-end me-1 wid-15 hei-15"></i></div>
                       <!-- </a>-->
						  
                           <div class="collapse border-top show pt-3 mt-3" id="Education">
						     <select id="education" name="education[]" multiple >
							 <?php $rrs=mysqli_query($con,"select * from education where status='enable'");
							 ?> 
									<?php while($edurow=mysqli_fetch_array($rrs))
									{ ?>
								  <option value="<?php echo $edurow['edu']; ?>"><?php echo $edurow['edu']; ?></option>
								   
									<?php } ?>
							 </select>
							 
                               <?php  ?>
					
					</div>
                  </div> 
				    
				  <div class="card-body py-3 border-bottom">
                       <!-- <a data-bs-toggle="collapse" href="#" data-bs-target="#Occupation" class="link-dark" aria-expanded="false" aria-controls="Occupation">-->
                            <div class="h6 mb-0">Occupation <i  class="float-end me-1 wid-15 hei-15"></i></div>
                       <!-- </a>-->
						 
                       <div class="collapse border-top show pt-3 mt-3" id="Occupation">
                           <?php $rrs=mysqli_query($con,"select * from occupation where status='enable'");
							 ?>  
                               <select name="occupation[]" id="occupation" multiple>
									<?php  while($rrow=mysqli_fetch_array($rrs)){ ?>
									<option value="<?php echo $rrow['occu'] ?>"><?php echo $rrow['occu'] ?></option>
									
									<?php } ?>
								   </select>
                           <?php ?>
               
                    
                    </div>
                  </div> 
				 
				  <div class="card-body py-3 border-bottom">
                        <!--<a data-bs-toggle="collapse" href="#" data-bs-target="#Country" class="link-dark" aria-expanded="false" aria-controls="Country">-->
                            <div class="h6 mb-0">Country <i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!--</a>-->
						<?php $q="select * from e_country where status='enable'";
						  	  $country_rec=mysqli_query($con,$q);
							  
						<div class="collapse border-top show pt-3 mt-3" id="Country" >
                            <select id="country" name="country[]" multiple>
                               <?php while($rrow=mysqli_fetch_array($country_rec)) { ?>
							            
									<option value="<?php echo $rrow['country']?>"><?php echo $rrow['country']?></option>
								     
								<?php }  ?>
								   </select>
						   <?php ?>
              
                    </div>
				
                  </div> 
				   <div class="card-body py-3 border-bottom">
                        <!--<a data-bs-toggle="collapse" href="#" data-bs-target="#State" class="link-dark" aria-expanded="false" aria-controls="State">-->
                            <div class="h6 mb-0">State <i  class="float-end me-1 wid-15 hei-15"></i></div>
                        <!--</a>-->
						<?php $state="select * from e_state where status='enable'";
							  $state_rec=mysqli_query($con,$state);
							  

				   <div class="collapse border-top show pt-3 mt-3 " id="State">
                          <select name="state[]" id="cbostate" multiple>
                               
							</select>    
                           <?php ?>
              
                    </div>
				  </div>
				  <div class="card-body py-3 border-bottom">
                        <!--<a data-bs-toggle="collapse" href="#" data-bs-target="#Distict" class="link-dark" aria-expanded="false" aria-controls="Distict">-->
                            <div class="h6 mb-0">District <i  class="float-end me-1 wid-15 hei-15"></i></div>
                       <!-- </a>-->
						 
				 <?php $dist="select * from e_dist where status='enable'";
									$dist_rec=mysqli_query($con,$dist);
									
			
			        <div class="collapse border-top show pt-3 mt-3" id="Distict">
                          <select id="dist" name="dist[]" multiple>
						  
						  
						  </select>
                        
						
						
						<?php ?>
              
                    </div>
				  </div>
				  <div class="card-body py-3 border-bottom">
                        <a data-bs-toggle="collapse" href="#" data-bs-target="#Distict" class="link-dark" aria-expanded="false" aria-controls="Distict">
                            <div class="h6 mb-0">Photo<i  class="float-end me-1 wid-15 hei-15"></i></div>
                        </a>
			        <div class="collapse border-top show pt-3 mt-3" id="Distict">
                          <select id="wphoto" name="with_photo" >
						  <option value="withphoto" selected > With Photo</option>	
							    <option value="withoutphoto"> Without Photo</option>
						  
						  </select>
                       
              
                    </div>
				  </div>
				  <div class="card-body py-3 border-bottom">
                        <a data-bs-toggle="collapse" href="#" data-bs-target="#Distict" class="link-dark" aria-expanded="false" aria-controls="Distict">
                            <div class="h6 mb-0">Institute IIT/NIT/IIM<i  class="float-end me-1 wid-15 hei-15"></i></div>
                        </a>
			        <div class="collapse border-top show pt-3 mt-3" id="Distict">
                          <select id="institute" name="institute">
						  <option value="" selected>Any</option>
						  <?php $sql12=mysqli_query($con,"select * from iit");
								while($sqIns=mysqli_fetch_array($sql12)) { ?>
						  <option value="<?php echo $sqIns['Inst_nm']?>"><?php echo $sqIns['Inst_nm']?></option>
								<?php } ?>
						  </select>
                       
              
                    </div>
				  </div>
				  
				  <button class="btn btn-primary mb-3 mt-3" name="submit" type="submit" style="margin-left:80px;" onclick="test()">Search</button>
				</form>
                </div>
				
            </div>
			
			
			
			
			
            <!-- [ task-board-left ] end -->
            <!-- [ task-board-right ] start -->
          
 


	<div class="col-xl-9 col-lg-8">

                <div class="tab-content filter-data" id="myTabContent">
                    <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                        <div class="row row-cols-lg-3 row-cols-sm-6">
                   <?php 
					// //{
					$rs_result = mysqli_query($con,$sql); 
					
					
					// }?>
					<?php while($rowC=mysqli_fetch_array($rs_result)){ ?>
                            
                            <div class="col">
                                <div class="card e-comm-card">
                                    <div class="card-body position-absolute end-0 top-0">
                                        <div class="form-check prod-likes">
                                            <input type="checkbox" class="form-check-input">
                                            <i data-feather="heart" class="prod-likes-icon"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <img src="../photoprocess.php?image=gallary/<?php echo $rowC['Photo1']; ?>&square=500" alt="prod img" class="img-fluid" >
                                    </div>
                                    <div class="card-body prod-content">
                                        <a href="profile_view?ID=<?php echo $rowC['MatriID']; ?>" target="_blank"><small class="text-truncat"><?php echo $rowC['MatriID']; ?></small></a>
                                        <a href="#">
                                            <div class="text-truncate w-100 h5"><?php echo $rowC['Name']; ?></div>
                                        </a>
                                        <div>
										   <div class="text-truncat"><?php echo $rowC['Age']; ?> Yrs, <?php  echo   get_height($rowC['Height']) ?></div>

                                        </div>
                                        <div class="h-data">
                                            <table class="table table-xs w-auto table-borderless m-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0 f-w-500 pb-0 aligntone">Religion :</td>
                                                        <td class="pb-0"> <?php echo $rowC['Religion']; ?>,<?php echo $rowC['Caste']; ?></td>
                                                    </tr>
                                                   
													<tr>
                                                        <td class="pl-0 f-w-500 pb-0 aligntone"> Education:</td>
                                                        <td class="pb-0"> <?php echo $rowC['Education']; ?></td>
														
                                                    </tr>
													<tr>
                                                        <td class="pl-0 f-w-500 pb-0 aligntone"> Occupation: </td>
                                                        <td class="pb-0">  <?php echo $rowC['Occupation']; ?></td>
														
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
										   <?php } ?>
                        </div>
						
					 <div  class="col-lg-12 ml-5" align="center">
			 
		                 <?php echo displayPaginationBelow($con,$setLimit,$page);?>
			
					 </div>
					  </div>

		  
					</div>
						  
				</div>
			</div>
		</div>
	  </div>
	  
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
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
 <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<script>
    $('.e-comm-filter .form-check-input').change(function() {
        $('.filter-data').append('<div class="overlay-div"><div class="spinner-border text-primary" role="status"></div></div>');
        setTimeout(function() {
            $('.filter-data .overlay-div').fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>
<!-- plugin-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="../css2/bootstrap.bundle.min.js"></script>

<script src="../css/bootstrap.css"></script>


<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css" type="text/css"/>

<script>
$(document).ready(function(){

 $('#ms').multiselect({
  nonSelectedText:'Marital Status',
  buttonWidth:'220px',
  
 });
});

$(document).ready(function(){

 $('#gender').multiselect({
  nonSelectedText:'Select Gender',
  buttonWidth:'220px',
  
 });
});

$(document).ready(function(){

 $('#status').multiselect({
  nonSelectedText:'Membership Status',
  buttonWidth:'220px',
  
 });
});
$(document).ready(function(){

 $('#education').multiselect({
  nonSelectedText:'Select Education',
  buttonWidth:'220px',
  
 });
});
$(document).ready(function(){

 $('#occupation').multiselect({
  nonSelectedText:'Select occupation',
  buttonWidth:'220px',
  
 });
});
$(document).ready(function(){

 $('#wphoto').multiselect({
  nonSelectedText:'Select Photo ',
  buttonWidth:'220px',
  
 });
});
$(document).ready(function(){

 $('#institute').multiselect({
  nonSelectedText:'Select Photo ',
  buttonWidth:'220px',
  
 });
});
</script>
<script>
$(document).ready(function(){

 $('#religion').multiselect({
  nonSelectedText:'Select Religion',
  buttonWidth:'220px',
  
  onChange:function(option, checked){
	 
   $('#caste').html('');
   $('#caste').multiselect('rebuild');
   $('#caste').html('');
   $('#caste').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../castonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#caste').html(data);
      $('#caste').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#caste').multiselect({
  nonSelectedText: 'Select Caste',
  buttonWidth:'220px',
 });
});
</script>
<script>
$(document).ready(function(){

 $('#country').multiselect({
  nonSelectedText:'Select Country',
  buttonWidth:'220px',
  
  onChange:function(option, checked){
	 
   $('#cbostate').html('');
   $('#cbostate').multiselect('rebuild');
   $('#cbostate').html('');
   $('#cbostate').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../stateonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#cbostate').html(data);
      $('#cbostate').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#cbostate').multiselect({
  nonSelectedText: 'Select State',
  buttonWidth:'220px',
onChange:function(option, checked){
	 
   $('#dist').html('');
   $('#dist').multiselect('rebuild');
   $('#dist').html('');
   $('#dist').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../distonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#dist').html(data);
      $('#dist').multiselect('rebuild');
     }
    })
   }
  }
 });


$('#dist').multiselect({
  nonSelectedText: 'Select District',
  buttonWidth:'220px',
 onChange:function(option, checked){
	 
   $('#city').html('');
   $('#city').multiselect('rebuild');
   $('#city').html('');
   $('#city').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../cityonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#city').html(data);
      $('#city').multiselect('rebuild');
     }
    })
   }
  }
 });
$('#city').multiselect({
  nonSelectedText: 'Select City',
  buttonWidth:'220px',  
 });
});
</script>


<script>
    $('#pct-toggler').on('click', function() {
        $('.pct-customizer').toggleClass('active');
    });
    $('#cust-sidebrand').change(function() {
        if ($(this).is(":checked")) {
            $('.theme-color.brand-color').removeClass('d-none');
            $('.m-header').addClass('bg-dark');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            $('.theme-color.brand-color').addClass('d-none');
        }
    });
    $('.brand-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.m-header').removeClassPrefix('bg-');
        } else {
            $('.m-header').removeClassPrefix('bg-');
            $('.m-header > .b-brand > .logo-lg').attr('src', '../branding/logos/emblem.png');
            $('.m-header').addClass(temp);
        }
    });
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-value');
        if (temp == "bg-default") {
            $('.pc-header').removeClassPrefix('bg-');
        } else {
            $('.pc-header').removeClassPrefix('bg-');
            $('.pc-header').addClass(temp);
        }
    });
    $('#cust-sidebar').change(function() {
        if ($(this).is(":checked")) {
            $('.pc-sidebar').addClass('light-sidebar');
            $('.pc-horizontal .topbar').addClass('light-sidebar');
        } else {
            $('.pc-sidebar').removeClass('light-sidebar');
            $('.pc-horizontal .topbar').removeClass('light-sidebar');
        }
    });
    $('#cust-darklayout').change(function() {
        if ($(this).is(":checked")) {
            $("#main-style-link").attr("href", "assets/css/style-dark.css");
        } else {
            $("#main-style-link").attr("href", "assets/css/style.css");
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-Q8H86P6FK7');
</script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<?php include('footer.php')?>


</body>


<!-- Mirrored from dashboardkit.io/bootstrap/demo-horizontal-1/ecom-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jan 2021 05:55:05 GMT -->
</html>
