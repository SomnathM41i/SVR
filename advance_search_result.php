<?php require_once('includes/bootstrap.php');
include_once('memprotect.php'); 

//error_reporting(0);

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

/* SECURITY (H1): escape helper for IN-list values used in the dynamic SQL
   below. Prevents SQL injection via search filter arrays while preserving
   the legacy "a','b" list construction. */
function escFilterList($con, $arr) {
    $out = array();
    foreach ((array)$arr as $v) {
        $out[] = mysqli_real_escape_string($con, trim($v));
    }
    return $out;
}

$login=$_SESSION['MatriID'];
if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit = 8;
	$pageLimit = ($page * $setLimit) - $setLimit;
	   
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge']:$_GET['from'];
$to_age=$_POST['txtEAge']?$_POST['txtEAge']:$_GET['to'];
$with_photo=$_POST['with_photo']?$_POST['with_photo']:$_GET['with_photo'];
	 
if(is_array($_POST['ms']))	
{
foreach($_POST['ms'] as $value)
	$strms .="'". mysqli_real_escape_string($con,$value)."',"; /* SECURITY (H1): escaped */
	 $strms= rtrim($strms,',');
	 	 
}
else
{
	if(!isset($_SESSION['ms']))
	{
   $strms ="'Unmarried','Divorced','Widowed','Widower','Seperated'";
   $strms= rtrim($strms,',');

   }
	else
	{
		$strms=$_SESSION['ms'];
	} 
}
$_SESSION['ms']=$strms;
	 
	$height1=$_POST['height1'] ?$_POST['height1'] :$_GET['height1'];
	$height2= $_POST['height2'] ? $_POST['height2'] : $_GET['height2'];

if(isset($_POST['religion']))
	 $religion1=implode("','",escFilterList($con,$_POST['religion']));
	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : mysqli_real_escape_string($con,$rtrim_religion);
	 $religion123=array($religion);
	 
if(isset($_POST['caste']))
	 $cast1=implode("','",escFilterList($con,$_POST['caste']));
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : mysqli_real_escape_string($con,$rtrim_caste);
	 $cast123=array($cast);
	 
if(isset($_POST['education']))
	 $stredu1 =implode("','",escFilterList($con,$_POST['education']));
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : mysqli_real_escape_string($con,$rtrim_edu);
	 $stredu123=array($stredu);

	 
if(isset($_POST['occupation']))
	 $stroccu1 = implode("','",escFilterList($con,$_POST['occupation']));
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : mysqli_real_escape_string($con,$rtrim_occu);
	 $stroccu123=array($stroccu);
 
	 
if(isset($_POST['Country1']))
	 $country1 = implode("','",escFilterList($con,$_POST['Country1']));
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : mysqli_real_escape_string($con,$rtrim_country);
	 $country123=array($country);
	 	
		
if(isset($_POST['cbostate']))
	 $state1=implode("','",escFilterList($con,$_POST['cbostate']));
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : mysqli_real_escape_string($con,$rtrim_state);
	 $state123=array($state);
	 
if(isset($_POST['dist']))
	 $dist1=implode("','",escFilterList($con,$_POST['dist']));
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : mysqli_real_escape_string($con,$rtrim_dist);
	 $dist123=array($dist);

if(isset($_POST['taluka'])) {
	 $taluka=implode("','",escFilterList($con,$_POST['taluka']));
} else {
	 $talukaData=@unserialize($_GET['taluka'] ?? '');
	 $taluka=is_array($talukaData) ? (string)reset($talukaData) : '';
}

	 if(isset($_POST['city']) || isset($_POST['city2']))
	 $city1=implode("','",escFilterList($con,$_POST['city'] ?? $_POST['city2']));
	 $explode_city=explode("a:1:{i:0;s:",$_GET['city']);
	 $explode_city1=explode(":",$explode_city[1]);
	 $trim_city=trim($explode_city1[1],'"');
	 $rtrim_city=rtrim($trim_city,'";}');
     $city=$city1 ? $city1 : mysqli_real_escape_string($con,$rtrim_city);
	 $city123=array($city);


$with_photo=$_POST['with_photo'] ? $_POST['with_photo'] : $_GET['with_photo'];
$qry=mysqli_query($con,"select * from register where MatriID='$login'");
$qry1=mysqli_fetch_array($qry);
$status=$qry1['Status'];
if($qry1['Gender']=='Male')
{
	$txtgender="Female";
}else{
	$txtgender='Male';
}
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
$sql = "SELECT * FROM register where ";

$sql=$sql ." Gender ="."'".mysqli_real_escape_string($con,$txtgender)."'"." AND Maritalstatus IN ($strms)";

if($from_age!="Any" and $to_age!="Any")
{
$sql=$sql." and Age BETWEEN '".mysqli_real_escape_string($con,$from_age)."' AND '".mysqli_real_escape_string($con,$to_age)."' ";
} 

if($height1!="" and $height2!="")
{
$sql=$sql." and Height BETWEEN '".mysqli_real_escape_string($con,$height1)."' AND '".mysqli_real_escape_string($con,$height2)."' ";
}
 
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
if($taluka!="Any" and $taluka!="")
{
$sql=$sql." and Taluka IN('".mysqli_real_escape_string($con,$taluka)."')";
}
if($city!="Any" and $city!="")
{
$sql=$sql." and City IN('".$city."')";
}
if( $with_photo != 'withoutphoto' )
{
	$sql=$sql." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
	$sql=$sql." and Photo1  LIKE 'nophoto.jpg' ";
}

$sql=$sql." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' and MatriID NOT LIKE '".$_SESSION['matri_login']."'";
$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;
$rs_result = mysqli_query($con,$sql); 
 
function displayPaginationBelow($con,$per_page,$page){
$login=$_SESSION['MatriID'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge']:$_GET['from'];
$to_age=$_POST['txtEAge']?$_POST['txtEAge']:$_GET['to'];
$with_photo=$_POST['with_photo']?$_POST['with_photo']:$_GET['with_photo'];
 
if(is_array($_POST['ms']))	
{
foreach($_POST['ms'] as $value)
	$strms .="'". mysqli_real_escape_string($con,$value)."',"; /* SECURITY (H1): escaped */
	 $strms= rtrim($strms,',');
	 	 
}
else
{
	if(!isset($_SESSION['ms']))
	{
   $strms ="'Unmarried','Divorced','Widowed','Widower','Seperated'";
   $strms= rtrim($strms,',');

   }
	else
	{
		$strms=$_SESSION['ms'];
	} 
}
$_SESSION['ms']=$strms;
	 
	$height1=$_POST['height1'] ?$_POST['height1'] :$_GET['height1'];
	$height2= $_POST['height2'] ? $_POST['height2'] : $_GET['height2'];

if(isset($_POST['religion']))
	 $religion1=implode("','",escFilterList($con,$_POST['religion']));
	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : mysqli_real_escape_string($con,$rtrim_religion);
	 $religion123=array($religion);	 
if(isset($_POST['caste']))
	 $cast1=implode("','",escFilterList($con,$_POST['caste']));
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : mysqli_real_escape_string($con,$rtrim_caste);
	 $cast123=array($cast);
	 $casturl=urlencode(serialize($cast123));
	  
	
	 
if(isset($_POST['education']))
	 $stredu1 =implode("','",escFilterList($con,$_POST['education']));
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : mysqli_real_escape_string($con,$rtrim_edu);
	 $stredu123=array($stredu);
	 $streduurl=urlencode(serialize($stredu123));

	  
if(isset($_POST['occupation']))
	 $stroccu1 = implode("','",escFilterList($con,$_POST['occupation']));
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : mysqli_real_escape_string($con,$rtrim_occu);
	 $stroccu123=array($stroccu);
	 $stroccuurl=urlencode(serialize($stroccu123));
 
	 
if(isset($_POST['Country1']))
	 $country1 = implode("','",escFilterList($con,$_POST['Country1']));
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : mysqli_real_escape_string($con,$rtrim_country);
	 $country123=array($country);
	 $countryurl=urlencode(serialize($country123));

	 	
		
if(isset($_POST['cbostate']))
	 $state1=implode("','",escFilterList($con,$_POST['cbostate']));
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : mysqli_real_escape_string($con,$rtrim_state);
	 $state123=array($state);
	 $stateurl=urlencode(serialize($state123));
	 
if(isset($_POST['dist']))
	 $dist1=implode("','",escFilterList($con,$_POST['dist']));
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : mysqli_real_escape_string($con,$rtrim_dist);
	 $dist123=array($dist);
     $disturl=urlencode(serialize($dist123));
	 
if(isset($_POST['taluka'])) {
	 $taluka=implode("','",escFilterList($con,$_POST['taluka']));
} else {
	 $talukaData=@unserialize($_GET['taluka'] ?? '');
	 $taluka=is_array($talukaData) ? (string)reset($talukaData) : '';
}
$taluka123=array($taluka);
$talukaurl=urlencode(serialize($taluka123));

	 if(isset($_POST['city']) || isset($_POST['city2']))
	 $city1=implode("','",escFilterList($con,$_POST['city'] ?? $_POST['city2']));
	 $explode_city=explode("a:1:{i:0;s:",$_GET['city']);
	 $explode_city1=explode(":",$explode_city[1]);
	 $trim_city=trim($explode_city1[1],'"');
	 $rtrim_city=rtrim($trim_city,'";}');
     $city=$city1 ? $city1 : mysqli_real_escape_string($con,$rtrim_city);
	 $city123=array($city);
	 $cityurl=urlencode(serialize($city123)); 



$with_photo=$_POST['with_photo']?$_POST['with_photo']:$_GET['with_photo'];
$qry=mysqli_query($con,"select * from register where MatriID='$login'");
$qry1=mysqli_fetch_array($qry);
	
if($qry1['Gender']=='Male')
{
	$txtgender="Female";
}else{
	$txtgender='Male';
}
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


	   $page_url="?";
	   $sql1 = "SELECT COUNT(*) as totalCount from register where ";

		$sql1=$sql1 ." Gender ="."'".mysqli_real_escape_string($con,$txtgender)."'"." AND Maritalstatus IN ($strms)";

if($from_age!="Any" and $to_age!="Any")
{
$sql1=$sql1." and Age BETWEEN '".mysqli_real_escape_string($con,$from_age)."' AND '".mysqli_real_escape_string($con,$to_age)."' ";
} 

if($height1!="" and $height2!="")
{
$sql1=$sql1." and Height BETWEEN '".mysqli_real_escape_string($con,$height1)."' AND '".mysqli_real_escape_string($con,$height2)."' ";
}
 
if($profile!="")
{
$sql1.=" and MatriID NOT IN ('$profile')"; 
}
if($matriid!="")
{
	$sql1.=" and MatriID NOT IN ('$matriid')";  
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
if($taluka!="Any" and $taluka!="")
{
$sql1=$sql1." and Taluka IN('".mysqli_real_escape_string($con,$taluka)."')";
}
if($city!="Any" and $city!="")
{
$sql1=$sql1." and City IN('".$city."')";
}

if($with_photo != 'withoutphoto')
{
	$sql1=$sql1." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
	$sql1=$sql1." and Photo1  LIKE 'nophoto.jpg' ";
}

$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' and MatriID NOT LIKE '".$_SESSION['matri_login']."' ";

		
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
    		$setPaginate .= "<ul class='mvv-pagination'>"; 
            $setPaginate .= "<li class='mvv-page-info'>Page $page of $setLastpage</li>";
			if($page>1) $setPaginate.="<li><a href='{$page_url}page=".($page-1)."&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'><i class='bi bi-chevron-left'></i></a></li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li class='active'><span>$counter</span></li>";
    				else
    					$setPaginate.= "<li><a href='{$page_url}page=$counter&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$counter</a></li>";					
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
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$setLastpage</a></li>";		
    			}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&from=$from_age&to=$to_age&height1=$height1&height2=$height2&religion=$religionurl&caste=$casteurl&education=$eduurl&occupation=$occuurl&country=$countryurl&state=$stateurl&dist=$disturl&taluka=$talukaurl&city=$cityurl&with_photo=$with_photo'><i class='bi bi-chevron-right'></i></a></li>";
    		}else{
    			$setPaginate.= "<li class='active'><span><i class='bi bi-chevron-right'></i></span></li>";
            }

    		$setPaginate.= "</ul>\n";		
    	}
       return $setPaginate;
    } 

$heightMap = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Advance Search Result</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<link rel="icon" href="branding/favicons/favicon.ico" type="image/x-icon">
<!-- MPJ: brand icons -->
<link rel="apple-touch-icon" href="branding/favicons/apple-touch-icon.png">
<link rel="manifest" href="branding/site.webmanifest">
<meta name="theme-color" content="#5E1426">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--mvv-maroon:#5E1426;--mvv-saffron:#C9556A;--mvv-gold:#BA9350;--mvv-cream:#FFFDFB;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:30px;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-page-hero{background:linear-gradient(135deg,var(--mvv-maroon),#7A1F39);padding:40px 0 30px;margin-bottom:32px;}
.mvv-page-hero h1{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:4px 0;text-align:center;}
.mvv-page-hero .mvv-eyebrow{text-align:center;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:2px;font-size:.8rem;font-weight:600;}
.mvv-page-hero p{text-align:center;color:rgba(255,255,255,.7);margin:0 0 8px;}
.mvv-breadcrumb{text-align:center;font-size:.85rem;}
.mvv-breadcrumb a{color:rgba(255,255,255,.7);text-decoration:none;}
.mvv-breadcrumb a:hover{color:#fff;}
.mvv-breadcrumb span{color:var(--mvv-gold);}
.mvv-section{padding:0 0 40px;}
.mvv-match-card{background:#fff;border-radius:14px;overflow:hidden;border:1px solid var(--mvv-border);transition:box-shadow .25s;height:100%;}
.mvv-match-card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.1);}
.mvv-match-card .mvv-card-img{width:100%;height:260px;object-fit:cover;background:var(--mvv-cream);}
.mvv-match-card .mvv-card-body{padding:16px;}
.mvv-match-card h5{margin:0 0 4px;font-weight:700;font-size:1.05rem;}
.mvv-match-card h5 a{color:var(--mvv-maroon);text-decoration:none;}
.mvv-match-card .mvv-card-meta{font-size:0.85rem;color:#666;margin-bottom:10px;}
.mvv-match-card .mvv-card-actions{display:flex;gap:6px;flex-wrap:wrap;border-top:1px solid var(--mvv-border);padding:10px 16px;background:var(--mvv-cream);}
.mvv-match-card .mvv-card-actions a{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:#fff;border:1px solid var(--mvv-border);color:var(--mvv-maroon);text-decoration:none;transition:.2s;}
.mvv-match-card .mvv-card-actions a:hover{background:var(--mvv-maroon);color:#fff;border-color:var(--mvv-maroon);}
.mvv-pagination{display:flex;align-items:center;gap:6px;flex-wrap:wrap;justify-content:center;padding:0;margin:24px 0 0;list-style:none;}
.mvv-pagination li a,.mvv-pagination li span,.mvv-pagination li.active span{display:inline-flex;align-items:center;justify-content:center;min-width:38px;height:38px;padding:0 8px;border:1px solid var(--mvv-border);border-radius:8px;background:#fff;color:#333;font-size:0.9rem;text-decoration:none;transition:.2s;}
.mvv-pagination li a:hover{background:var(--mvv-cream);border-color:var(--mvv-maroon);color:var(--mvv-maroon);}
.mvv-pagination li.active span{background:var(--mvv-maroon);border-color:var(--mvv-maroon);color:#fff;font-weight:700;}
.mvv-pagination .mvv-page-info{border:none;color:var(--mvv-muted);font-size:0.85rem;padding:0 8px;}
.mvv-pagination .mvv-dot{border:none;font-size:1.1rem;color:#999;padding:0 4px;}
.mvv-btn{display:inline-block;padding:10px 24px;border-radius:8px;font-weight:600;font-size:.9rem;border:none;cursor:pointer;text-decoration:none;transition:.2s;}
.mvv-btn.primary{background:var(--mvv-maroon);color:#fff;}
.mvv-btn.primary:hover{background:#7A1F39;}
</style>
</head>
<body>

<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Search</div>
      <h1>Advance Search Result</h1>
      <p>Profiles matching your advance search criteria</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Advance Search Result</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(mysqli_num_rows($rs_result)>0){ ?>
      <div class="row g-4">
        <?php while($fetch=mysqli_fetch_array($rs_result)){
          $encrypt=urlencode(base64_encode($fetch['MatriID']));
          $imgSrc='images/nophoto.jpg';
          if($fetch['photo_visibility']=='paidphoto' && $fetch['Photo1Approve']=='Yes' && $qry1['Status']=='Paid' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
          elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
        ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
          <div class="mvv-match-card">
            <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank">
              <img class="mvv-card-img" src="<?php echo $imgSrc ?>" alt="" loading="lazy">
            </a>
            <div class="mvv-card-body">
              <h5><a href="full_profile?id=<?php echo $encrypt ?>" target="_blank"><?php echo $fetch['MatriID'] ?></a></h5>
              <div class="mvv-card-meta">
                <?php echo $fetch['Education'] ? substr($fetch['Education'],0,20) : 'Not Set' ?><br>
                <?php echo $fetch['Occupation'] ? substr($fetch['Occupation'],0,20) : 'Not Set' ?><br>
                <?php echo $fetch['Age'] ? $fetch['Age'] : 'NA' ?> Yrs, <?php echo $heightMap[$fetch['Height']]??''; ?>
              </div>
            </div>
            <div class="mvv-card-actions">
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Profile"><i class="fas fa-user"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Shortlist"><i class="fas fa-heart"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Message"><i class="fas fa-comment-dots"></i></a>
              <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank" title="Connect"><i class="fas fa-user-plus"></i></a>
            </div>
            <?php
                $waHL = $fetch['Height'] ? getHeightValue($fetch['Height']) : '';
                $waLL = implode(', ', array_filter([$fetch['City'] ?? '', $fetch['Dist'] ?? '']));
                $waImg = ($imgSrc !== 'images/nophoto.jpg') ? $baseUrl . $imgSrc : '';
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
              ?><div style="padding:8px 16px 14px;background:var(--mvv-cream,#FFFDFB)"><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Share</a></div>
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
        <p style="color:#999;">No profiles match your advance search criteria.</p>
        <a href="advance_search" class="mvv-btn primary" style="margin-top:10px;">Search Again</a>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</body>
</html>
