<?php /*include('dbconnectadmin.php');*/
require_once('sys_dbconnection.php');
require_once('includes/partner_match.php');
require_once('includes/annual_income.php');
error_reporting(0);
/*session_start();*/
include('memprotect.php');
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

function getHeightValue($h) {
    $map = [1=>'4Ft',2=>'4Ft 1 inch',3=>'4Ft 2 inch',4=>'4Ft 3 inch',5=>'4Ft 4 inch',6=>'4Ft 5 inch',7=>'4Ft 6 inch',8=>'4Ft 7 inch',9=>'4Ft 8 inch',10=>'4Ft 9 inch',11=>'4Ft 10 inch',12=>'4Ft 11 inch',13=>'5Ft',14=>'5Ft 1 inch',15=>'5Ft 2 inch',16=>'5Ft 3 inch',17=>'5Ft 4 inch',18=>'5Ft 5 inch',19=>'5Ft 6 inch',20=>'5Ft 7 inch',21=>'5Ft 8 inch',22=>'5Ft 9 inch',23=>'5Ft 10 inch',24=>'5Ft 11 inch',25=>'6Ft',26=>'6Ft 1 inch',27=>'6Ft 2 inch',28=>'6Ft 3 inch',29=>'6Ft 4 inch',30=>'6Ft 5 inch',31=>'6Ft 6 inch',32=>'6Ft 7 inch',33=>'6Ft 8 inch',34=>'6Ft 9 inch',35=>'6Ft 10 inch',36=>'6Ft 11 inch',37=>'7Ft'];
    return $map[(int)$h] ?? '';
}

$matchViewerId=$_SESSION['MatriID'] ?? $_SESSION['matriid'] ?? '';
$matchViewerResult=mysqli_query($con,"SELECT * FROM register WHERE MatriID='".mysqli_real_escape_string($con,$matchViewerId)."' LIMIT 1");
$matchViewer=mysqli_fetch_assoc($matchViewerResult) ?: [];
$looking=$_POST['looking'] ? $_POST['looking'] : $_GET['looking'];
$txtgender=$_POST['gender'] ? $_POST['gender'] : $_GET['gender'];
$from_age=$_POST['txtSAge'] ? $_POST['txtSAge'] : $_GET['txtSAge'];
$to_age=$_POST['txtEAge'] ? $_POST['txtEAge'] : $_GET['txtEAge'];
$religion=$_POST['religion'] ? $_POST['religion'] : $_GET['religion'];
$storedSearchFilters = $_SESSION['mvv_smart_search_filters'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$storedSearchFilters = [
		'height_from' => trim((string)($_POST['height_from'] ?? '')),
		'height_to' => trim((string)($_POST['height_to'] ?? '')),
		'working_taluka' => trim((string)($_POST['working_taluka'] ?? '')),
		'working_city' => trim((string)($_POST['working_city'] ?? '')),
		'native_taluka' => trim((string)($_POST['native_taluka'] ?? '')),
		'native_city' => trim((string)($_POST['native_city'] ?? '')),
		'income_from' => trim((string)($_POST['income_from'] ?? '')),
		'income_to' => trim((string)($_POST['income_to'] ?? ''))
	];
	$_SESSION['mvv_smart_search_filters'] = $storedSearchFilters;
}

$height_from = (int)($_POST['height_from'] ?? $_GET['height_from'] ?? $storedSearchFilters['height_from'] ?? 0);
$height_to = (int)($_POST['height_to'] ?? $_GET['height_to'] ?? $storedSearchFilters['height_to'] ?? 0);
$working_taluka = trim((string)($_POST['working_taluka'] ?? $_GET['working_taluka'] ?? $storedSearchFilters['working_taluka'] ?? ''));
$working_city = trim((string)($_POST['working_city'] ?? $_GET['working_city'] ?? $storedSearchFilters['working_city'] ?? ''));
$native_taluka = trim((string)($_POST['native_taluka'] ?? $_GET['native_taluka'] ?? $storedSearchFilters['native_taluka'] ?? ''));
$native_city = trim((string)($_POST['native_city'] ?? $_GET['native_city'] ?? $storedSearchFilters['native_city'] ?? ''));
$income_from = annual_income_normalize_value($_POST['income_from'] ?? $_GET['income_from'] ?? $storedSearchFilters['income_from'] ?? '');
$income_to = annual_income_normalize_value($_POST['income_to'] ?? $_GET['income_to'] ?? $storedSearchFilters['income_to'] ?? '');

if ($height_from < 1 || $height_from > 37) $height_from = 0;
if ($height_to < 1 || $height_to > 37) $height_to = 0;
if ($income_from !== '' && !annual_income_is_valid($income_from, true)) $income_from = '';
if ($income_to !== '' && !annual_income_is_valid($income_to, true)) $income_to = '';
if ($income_from !== '' && $income_to !== '' && (int)$income_from > (int)$income_to) {
	[$income_from, $income_to] = [$income_to, $income_from];
}

$working_taluka_sql = mysqli_real_escape_string($con, $working_taluka);
$working_city_sql = mysqli_real_escape_string($con, $working_city);
$native_taluka_sql = mysqli_real_escape_string($con, $native_taluka);
$native_city_sql = mysqli_real_escape_string($con, $native_city);
//$education=$_POST['education'] ? $_POST['education'] : $_GET['education'];
//$occu=$_POST['occu'] ? $_POST['occu'] : $_GET['occu'];
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
	 
	if(isset($_POST['looking']))
	 $looking1=implode("','",$_POST['looking']);
	 $explode_looking=explode("a:1:{i:0;s:",$_GET['looking']);
	 $explode_looking1=explode(":",$explode_looking[1]);
	 $trim_looking=trim($explode_looking1[1],'"');
	 $rtrim_looking=rtrim($trim_looking,'";}');
	 $looking=$looking1 ? $looking1 : $rtrim_looking;
	 $looking123=array($looking);
	 
	if(isset($_POST['edu']))
	 $stredu1 =implode("','",$_POST['edu']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['edu']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);	 
	
	 if(isset($_POST['occu']))
	 $stroccu1 = implode("','",$_POST['occu']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occu']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
	
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

if($height_from && $height_to)
{
	$minimum_height = min($height_from, $height_to);
	$maximum_height = max($height_from, $height_to);
	$sql.=" and Height BETWEEN '$minimum_height' AND '$maximum_height'";
}
else if($height_from)
{
	$sql.=" and Height >= '$height_from'";
}
else if($height_to)
{
	$sql.=" and Height <= '$height_to'";
}

if($working_taluka_sql!="")
{
	$sql.=" and working_taluka='$working_taluka_sql'";
}

if($working_city_sql!="")
{
	$sql.=" and (working_city='$working_city_sql' or (working_city='' and workinglocation='$working_city_sql'))";
}

if($native_taluka_sql!="")
{
	$sql.=" and Taluka='$native_taluka_sql'";
}

if($native_city_sql!="")
{
	$sql.=" and City='$native_city_sql'";
}

if($income_from !== '')
{
	$sql.=" and CAST(Annualincome AS UNSIGNED) >= ".(int)$income_from;
}

if($income_to !== '')
{
	$sql.=" and CAST(Annualincome AS UNSIGNED) <= ".(int)$income_to;
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

if($stredu!="Any" and $stredu!="")
{
$sql=$sql." and Education IN('".$stredu."')";
}

if($stroccu!="Any" and $stroccu!="")
{
$sql=$sql." and Occupation IN('".$stroccu."')";
}

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
$storedSearchFilters = $_SESSION['mvv_smart_search_filters'] ?? [];
$height_from = (int)($_GET['height_from'] ?? $storedSearchFilters['height_from'] ?? 0);
$height_to = (int)($_GET['height_to'] ?? $storedSearchFilters['height_to'] ?? 0);
$working_taluka = trim((string)($_GET['working_taluka'] ?? $storedSearchFilters['working_taluka'] ?? ''));
$working_city = trim((string)($_GET['working_city'] ?? $storedSearchFilters['working_city'] ?? ''));
$native_taluka = trim((string)($_GET['native_taluka'] ?? $storedSearchFilters['native_taluka'] ?? ''));
$native_city = trim((string)($_GET['native_city'] ?? $storedSearchFilters['native_city'] ?? ''));
$income_from = annual_income_normalize_value($_GET['income_from'] ?? $storedSearchFilters['income_from'] ?? '');
$income_to = annual_income_normalize_value($_GET['income_to'] ?? $storedSearchFilters['income_to'] ?? '');

if ($height_from < 1 || $height_from > 37) $height_from = 0;
if ($height_to < 1 || $height_to > 37) $height_to = 0;
if ($income_from !== '' && !annual_income_is_valid($income_from, true)) $income_from = '';
if ($income_to !== '' && !annual_income_is_valid($income_to, true)) $income_to = '';
if ($income_from !== '' && $income_to !== '' && (int)$income_from > (int)$income_to) {
	[$income_from, $income_to] = [$income_to, $income_from];
}

$working_taluka_sql = mysqli_real_escape_string($con, $working_taluka);
$working_city_sql = mysqli_real_escape_string($con, $working_city);
$native_taluka_sql = mysqli_real_escape_string($con, $native_taluka);
$native_city_sql = mysqli_real_escape_string($con, $native_city);

if(isset($_POST['religion']))
	 $religion1=implode("','",$_POST['religion']);
 	 $explode_religion=explode("a:1:{i:0;s:",$_GET['religion']);
	 $explode_religion1=explode(":",$explode_religion[1]);
	 $trim_religion=trim($explode_religion1[1],'"');
	 $rtrim_religion=rtrim($trim_religion,'";}');
	 $religion=$religion1 ? $religion1 : $rtrim_religion;
	 $religion123=array($religion);
	 $religionurl=urlencode(serialize($religion123));
	 
	 
	 
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

	   $page_url='?'.http_build_query([
		   'height_from' => $height_from,
		   'height_to' => $height_to,
		   'working_taluka' => $working_taluka,
		   'working_city' => $working_city,
		   'native_taluka' => $native_taluka,
		   'native_city' => $native_city,
		   'income_from' => $income_from,
		   'income_to' => $income_to
	   ]).'&';
	   $sql1 = "SELECT COUNT(*) as totalCount from register where ";

		$sql1=$sql1 ." Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' " ;

		if($height_from && $height_to)
		{
			$minimum_height = min($height_from, $height_to);
			$maximum_height = max($height_from, $height_to);
			$sql1.=" and Height BETWEEN '$minimum_height' AND '$maximum_height'";
		}
		else if($height_from)
		{
			$sql1.=" and Height >= '$height_from'";
		}
		else if($height_to)
		{
			$sql1.=" and Height <= '$height_to'";
		}

		if($working_taluka_sql!="")
		{
			$sql1.=" and working_taluka='$working_taluka_sql'";
		}

		if($working_city_sql!="")
		{
			$sql1.=" and (working_city='$working_city_sql' or (working_city='' and workinglocation='$working_city_sql'))";
		}

		if($native_taluka_sql!="")
		{
			$sql1.=" and Taluka='$native_taluka_sql'";
		}

		if($native_city_sql!="")
		{
			$sql1.=" and City='$native_city_sql'";
		}

		if($income_from !== '')
		{
			$sql1.=" and CAST(Annualincome AS UNSIGNED) >= ".(int)$income_from;
		}

		if($income_to !== '')
		{
			$sql1.=" and CAST(Annualincome AS UNSIGNED) <= ".(int)$income_to;
		}
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
		
		if($stredu!="Any" and $stredu!="")
		{
		$sql1=$sql1." and Education IN('".$stredu."')";
		}
		
		if($stroccu!="Any" and $stroccu!="")
		{
		$sql1=$sql1." and Occupation IN('".$stroccu."')";
		}
		
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
    		$setPaginate .= "<ul class='mvv-pagination'>"; 
			$setPaginate .= "<li class='mvv-page-info'>Page $page of $setLastpage</li>";
			if($page>1) $setPaginate.="<li><a href='{$page_url}page=".($page-1)."&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'><i class='bi bi-chevron-left'></i></a></li>";
    		if ($setLastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $setLastpage; $counter++)
    			{
    				if ($counter == $page)
    					$setPaginate.= "<li class='active'><span>$counter</span></li>";
    				else
      					$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$counter</a></li>";					
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
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$setLastpage</a></li>";		
				 }
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			 {
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    			    	{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$counter</a></li>";					
    				  }
    				        $setPaginate.= "<li class='mvv-dot'>…</li>";
    			        	$setPaginate.= "<li><a href='{$page_url}page=$lpm1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$lpm1</a></li>";
    				        $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$setLastpage</a></li>";		
    			     }
    		        	else
    		      	{
    				$setPaginate.= "<li><a href='{$page_url}page=1&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>2</a></li>";
    				$setPaginate.= "<li class='mvv-dot'>…</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li class='active'><span>$counter</span></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&txtSAge=$from_age&txtEAge=$to_age&religion=$religionurl&edu=$eduurl&occu=occuurl&looking=$lookingurl&gender=$txtgender'><b><i class='bi bi-chevron-right'></i></b></a></li>";
    		}else{
    			$setPaginate.= "<li class='active'><span><b><i class='bi bi-chevron-right'></i></b></span></li>";
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
<title>Smart Search Result</title>
<link href="css3/Style.css" rel="stylesheet">
<link href="css3/mvv-premium.css" rel="stylesheet">
<link rel="shortcut icon" href="css3/assets/shivraj-logo.png" type="image/x-icon">
<link rel="icon" href="css3/assets/shivraj-logo.png" type="image/x-icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--mvv-maroon:#6B1A1A;--mvv-saffron:#E8612A;--mvv-gold:#C9921A;--mvv-cream:#FFF8F0;--mvv-border:#e0d5cb;--mvv-muted:#888;}
.mvv-page{min-height:60vh;padding-top:0;padding-bottom:60px;}
.mvv-container{max-width:1200px;margin:0 auto;padding:0 16px;}
.mvv-section{padding:48px 0 40px;}
.mvv-match-card{background:#fff;border-radius:14px;overflow:hidden;border:1px solid var(--mvv-border);transition:box-shadow .25s;height:100%;}
.mvv-match-card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.1);}
.mvv-match-card .mvv-card-img{width:100%;height:260px;object-fit:cover;background:var(--mvv-cream);}
.mvv-match-card .mvv-card-body{padding:16px;}
.mvv-match-score{display:inline-flex;align-items:center;margin-bottom:9px;padding:5px 9px;border-radius:999px;background:#fff0e0;color:var(--mvv-maroon);font-size:.75rem;font-weight:800}.mvv-match-score.perfect{background:#e8f7ed;color:#24653a}
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
.mvv-btn.primary:hover{background:#8B1A1A;}
</style>
</head>
<body>

<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Search</div>
      <h1>Smart Search Result</h1>
      <p>Profiles matching your smart search criteria</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Smart Search Result</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(mysqli_num_rows($rs_result)>0){ ?>
      <div class="row g-4">
        <?php while($fetch=mysqli_fetch_array($rs_result)){
          $partnerScore=partner_match_score($matchViewer,$fetch);
          $encrypt=urlencode(base64_encode($fetch['MatriID']));
          $imgSrc='images/nophoto.jpg';
          if($fetch['photo_visibility']=='paidphoto' && $fetch['Photo1Approve']=='Yes' && $matchViewer['Status']=='Paid' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
          elseif($fetch['photo_visibility']=='allphoto' && $fetch['Photo1Approve']=='Yes' && $fetch['Photo1']!='nophoto.jpg') $imgSrc='photoprocess.php?image=gallary/'.$fetch['Photo1'].'&square=500';
        ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
          <div class="mvv-match-card">
            <a href="full_profile?id=<?php echo $encrypt ?>" target="_blank">
              <img class="mvv-card-img" src="<?php echo $imgSrc ?>" alt="" loading="lazy" onerror="this.onerror=null;this.src='images/nophoto.jpg';">
            </a>
            <div class="mvv-card-body">
              <div class="mvv-match-score <?php echo $partnerScore['is_100']?'perfect':''; ?>" title="<?php echo $partnerScore['matched']; ?> of 10 preference points matched"><?php echo partner_match_badge($partnerScore); ?></div>
              <h5><a href="full_profile?id=<?php echo $encrypt ?>" target="_blank"><?php echo $fetch['MatriID'] ?></a></h5>
              <div class="mvv-card-meta">
                <?php echo $fetch['Education'] ? substr($fetch['Education'],0,20) : 'Not Set' ?><br>
                <?php echo $fetch['Occupation'] ? substr($fetch['Occupation'],0,20) : 'Not Set' ?><br>
                Annual Income: <?php echo htmlspecialchars(annual_income_format($fetch['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?><br>
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
              ?><div style="padding:8px 16px 14px;background:var(--mvv-cream,#FFF8F0)"><a class="wa-share-btn wa-share-btn-sm" href="<?php echo htmlspecialchars($waUR, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Share</a></div>
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
        <p style="color:#999;">No profiles match your smart search criteria. Try adjusting your filters.</p>
        <a href="smart_search" class="mvv-btn primary" style="margin-top:10px;">Search Again</a>
      </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</body>
</html>
