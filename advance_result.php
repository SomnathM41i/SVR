<?php include_once('siteconfig.php');?>
<?php require_once('sys_dbconnection.php');?>
<?php include_once('memprotect.php');
/*include('dbconnectadmin.php');*/
error_reporting(0);
/*session_start();*/
$login=$_SESSION['MatriID'];
if(isset($_POST['basicsaveandsearch']))
{
$up=mysqli_query($con,"update advance_saveandsearch set nameofsearch='".$_POST['search_name']."' where id='".$_GET['id']."'");
}
$id=$_GET['id'];
$edu_search=mysqli_query($con,"select * from  advance_saveandsearch where id=".$_GET['id']." and MatriID='$login'");
//echo "select * from  advance_saveandsearch where id=".$_GET['id']." and MatriID='$login'";
//exit;
$edu_search_fetch=mysqli_fetch_array($edu_search);

$from_age=$edu_search_fetch['fromage'] ? $edu_search_fetch['fromage'] : $_GET['from'];
$to_age=$edu_search_fetch['toage'] ? $edu_search_fetch['toage'] : $_GET['to'];
$with_photo=$edu_search_fetch['withphoto']?$edu_search_fetch['withphoto']:$_GET['withphoto'];
$religion=$edu_search_fetch['religion'] ? $edu_search_fetch['religion'] : $_GET['religion'];
$height1=$edu_search_fetch['fromheight'] ? $edu_search_fetch['fromheight'] : $_GET['height1'];
$height2=$edu_search_fetch['toheight'] ? $edu_search_fetch['toheight'] : $_GET['toheight'];
if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;
	$setLimit = 8;
	$pageLimit = ($page * $setLimit) - $setLimit;
 	
	if(isset($_POST['caste']))
	 $cast1=implode("','",$_POST['caste']);
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : $rtrim_caste;
	 $cast123=array($cast);
	 
	 
	if(isset($_POST['caste']))
	 $cast1=implode("','",$_POST['caste']);
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : $rtrim_caste;
	 $cast123=array($cast); 
	 
	if(isset($_POST['subcaste']))
	 $subcaste1=implode("','",$_POST['subcaste']);
	 $explode_subcaste=explode("a:1:{i:0;s:",$_GET['subcaste']);
	 $explode_subcaste1=explode(":",$explode_subcaste[1]);
	 $trim_subcaste=trim($explode_subcaste1[1],'"');
	 $rtrim_subcaste=rtrim($trim_subcaste,'";}');
	 $subcaste=$subcaste1 ? $subcaste1 : $rtrim_subcaste;
	 $subcaste123=array($subcaste);
	 
if(isset($_POST['education']))
	 $stredu1 =implode("','",$_POST['education']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);
	 
	 
if(isset($_POST['occupation']))
	 $stroccu1 = implode("','",$_POST['occupation']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
	 
	 
if(isset($_POST['Country1']))
	 $country1 = implode("','",$_POST['Country1']);
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : $rtrim_country;
	 $country123=array($country);
	 
if(isset($_POST['cbostate']))
	 $state1=implode("','",$_POST['cbostate']);
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : $rtrim_state;
	 $state123=array($state);
	 
if(isset($_POST['dist']))
	 $dist1=implode("','",$_POST['dist']);
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : $rtrim_dist;
	 $dist123=array($dist);
	 
	 if(isset($_POST['city2']))
	 $city1=implode("','",$_POST['city2']);
	 $explode_city=explode("a:1:{i:0;s:",$_GET['city']);
	 $explode_city1=explode(":",$explode_city[1]);
	 $trim_city=trim($explode_city1[1],'"');
	 $rtrim_city=rtrim($trim_city,'";}');
     $city=$city1 ? $city1 : $rtrim_city;
	 $city123=array($city);
	 
	 if(isset($_POST['subcaste']))
	 $subcaste1=implode("','",$_POST['subcaste']);
	 $explode_subcaste=explode("a:1:{i:0;s:",$_GET['subcaste']);
	 $explode_subcaste1=explode(":",$explode_subcaste[1]);
	 $trim_subcaste=trim($explode_subcaste1[1],'"');
	 $rtrim_subcaste=rtrim($trim_subcaste,'";}');
	 $subcaste=$subcaste1 ? $subcaste1 : $rtrim_subcaste;
	 $subcaste123=array($subcaste);
	  
	 
	 
	//Looking

if(is_array($edu_search_fetch['maritialstatus']))	
{
foreach($edu_search_fetch['maritialstatus'] as $value)
	$strms .="'". $value."',";
	 $strms= rtrim($strms,',');
}
else
{
	if(!isset($_SESSION['ms']))
	{
$strms ="'Unmarried','Divorced','Widowed','Widower'";
   $strms= rtrim($strms,',');
   }
	else
	{
		$strms=$_SESSION['ms'];
	} 
}
$_SESSION['ms']=$strms;

	
	
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

$sql = "SELECT * FROM register where Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."' AND Maritalstatus IN ($strms) And  Height BETWEEN '".$height1."' AND '".$height2."'  ";
if($profile!="")
{
$sql.=" and MatriID NOT IN ('$profile')"; 
}
if($matriid!="")
{
	$sql.=" and MatriID NOT IN ('$matriid')";  
}

//RELIGION
if($edu_search_fetch['religion']!="" && $edu_search_fetch['religion']!="Any")
{
$PE_religion_exp=explode(",",$edu_search_fetch['religion']);
$PE_religion_term=array();
foreach($PE_religion_exp as $row=>$value)
{
	$PE_religion_term[]="'$value'";
}
$PE_religion_re=implode(',',$PE_religion_term);
$sql.=" and Religion IN ($PE_religion_re)";
}
//Caste
if($edu_search_fetch['caste']!="" && $edu_search_fetch['caste']!="Any")
{
$PE_caste_exp=explode(",",$edu_search_fetch['caste']);
$PE_caste_term=array();
foreach($PE_caste_exp as $row=>$value)
{
	$PE_caste_term[]="'$value'";
}
$PE_caste_re=implode(',',$PE_caste_term);
$sql.=" and Caste IN ($PE_caste_re)";
}
//Subaste
//subcaste
if($edu_search_fetch['subcaste']!="" && $edu_search_fetch['subcaste']!="Any")
{
$PE_subcaste_exp=explode(",",$edu_search_fetch['subcaste']);
$PE_subcaste_term=array();
foreach($PE_subcaste_exp as $row=>$value)
{
	$PE_subcaste_term[]="'$value'";
}
$PE_subcaste_re=implode(',',$PE_subcaste_term);
$sql.=" and Subcaste IN ($PE_subcaste_re)";
}

//EDUCATION
if($edu_search_fetch['education']!="" && $edu_search_fetch['education']!="Any")
{
$PE_edu_exp=explode(",",$edu_search_fetch['education']);
$PE_edu_term=array();
foreach($PE_edu_exp as $row=>$value)
{
	$PE_edu_term[]="'$value'";
}
$PE_edu_re=implode(',',$PE_edu_term);
$sql.=" and Education IN ($PE_edu_re)";
}
//occupation
if($edu_search_fetch['occupation']!="" && $edu_search_fetch['occupation']!="Any")
{
$PE_occu_exp=explode(",",$edu_search_fetch['occupation']);
$PE_occu_term=array();
foreach($PE_occu_exp as $row=>$value)
{
	$PE_occu_term[]="'$value'";
}
$PE_occu_re=implode(',',$PE_occu_term);
$sql.=" and Occupation IN ($PE_occu_re)";
}
//Country
if($edu_search_fetch['country']!="" && $edu_search_fetch['country']!="Any")
{
$PE_country_exp=explode(",",$edu_search_fetch['country']);
$PE_country_term=array();
foreach($PE_country_exp as $row=>$value)
{
	$PE_country_term[]="'$value'";
}
$PE_country_re=implode(',',$PE_country_term);
$sql.=" and Country IN ($PE_country_re)";
}
//State
if($edu_search_fetch['state']!="" && $edu_search_fetch['state']!="Any")
{
$PE_state_exp=explode(",",$edu_search_fetch['state']);
$PE_state_term=array();
foreach($PE_state_exp as $row=>$value)
{
	$PE_state_term[]="'$value'";
}
$PE_state_re=implode(',',$PE_state_term);
$sql.=" and State IN ($PE_state_re)";
}


//District
if($edu_search_fetch['district']!="" && $edu_search_fetch['district']!="Any")
{
$PE_dist_exp=explode(",",$edu_search_fetch['district']);
$PE_dist_term=array();
foreach($PE_dist_exp as $row=>$value)
{
	$PE_dist_term[]="'$value'";
}
$PE_dist_re=implode(',',$PE_dist_term);
$sql.=" and Dist IN ($PE_dist_re)";
}

//Taluka
if(($edu_search_fetch['taluka'] ?? "")!="" && ($edu_search_fetch['taluka'] ?? "")!="Any")
{
$PE_taluka_exp=explode(",",$edu_search_fetch['taluka']);
$PE_taluka_term=array();
foreach($PE_taluka_exp as $row=>$value)
{
	$PE_taluka_term[]="'$value'";
}
$PE_taluka_re=implode(',',$PE_taluka_term);
$sql.=" and Taluka IN ($PE_taluka_re)";
}

//City
if($edu_search_fetch['city']!="" && $edu_search_fetch['city']!="Any")
{
$PE_city_exp=explode(",",$edu_search_fetch['city']);
$PE_city_term=array();
foreach($PE_city_exp as $row=>$value)
{
	$PE_city_term[]="'$value'";
}
$PE_city_re=implode(',',$PE_city_term);
$sql.=" and City IN ($PE_city_re)";
}

//echo $with_photo;
if($with_photo != 'withoutphoto')
{
	$sql=$sql." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
	$sql=$sql." and Photo1  LIKE 'nophoto.jpg' ";
}


$sql=$sql." AND visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' AND MatriID NOT LIKE '".$_SESSION['matri_login']."'";
$sql.=" ORDER BY Regdate DESC LIMIT ".$pageLimit." , ".$setLimit;
$rs_result = mysqli_query($con,$sql);

//echo $sql;
function displayPaginationBelow($con,$per_page,$page){
$id=$_GET['id'];
$edu_search=mysqli_query($con,"select * from  advance_saveandsearch where id=".$_GET['id']." and MatriID='".$_SESSION['matri_login']."'");
$edu_search_fetch=mysqli_fetch_array($edu_search);
$height1=$edu_search_fetch['fromheight'] ? $edu_search_fetch['fromheight'] : $_GET['height1'];
$height2=$edu_search_fetch['toheight'] ? $edu_search_fetch['toheight'] : $_GET['toheight'];	
$withphoto=$edu_search_fetch['withphoto']?$edu_search_fetch['withphoto']:$_GET['withphoto'];

$from_age=$edu_search_fetch['fromage'] ? $edu_search_fetch['fromage'] : $_GET['from'];
$to_age=$edu_search_fetch['toage'] ? $edu_search_fetch['toage'] : $_GET['to'];

$marital_status=$edu_search_fetch['looking'] ? $edu_search_fetch['looking'] : $_GET['looking'];
$religion=$edu_search_fetch['religion'] ? $edu_search_fetch['religion'] : $_GET['religion'];
	if(isset($_POST['caste']))
	 $cast1=implode("','",$_POST['caste']);
	 $explode_caste=explode("a:1:{i:0;s:",$_GET['caste']);
	 $explode_caste1=explode(":",$explode_caste[1]);
	 $trim_caste=trim($explode_caste1[1],'"');
	 $rtrim_caste=rtrim($trim_caste,'";}');
	 $cast=$cast1 ? $cast1 : $rtrim_caste;
	 $cast123=array($cast);
	 $casteurl=urlencode(serialize($cast123));
	
if(isset($_POST['education']))
	 $stredu1 =implode("','",$_POST['education']);
	 $explode_edu=explode("a:1:{i:0;s:",$_GET['education']);
	 $explode_edu1=explode(":",$explode_edu[1]);
	 $trim_edu=trim($explode_edu1[1],'"');
	 $rtrim_edu=rtrim($trim_edu,'";}');
     $stredu=$stredu1 ?$stredu1 : $rtrim_edu;
	 $stredu123=array($stredu);
	 $eduurl=urlencode(serialize($stredu123));
	  
if(isset($_POST['occupation']))
	 $stroccu1 = implode("','",$_POST['occupation']);
	 $explode_occu=explode("a:1:{i:0;s:",$_GET['occupation']);
	 $explode_occu1=explode(":",$explode_occu[1]);
	 $trim_occu=trim($explode_occu1[1],'"');
	 $rtrim_occu=rtrim($trim_occu,'";}');
	 $stroccu=$stroccu1 ? $stroccu1 : $rtrim_occu;
	 $stroccu123=array($stroccu);
	 $occuurl=urlencode(serialize($stroccu123));
	 
	
if(isset($_POST['Country1']))
	 $country1 = implode("','",$_POST['Country1']);
	 $explode_country=explode("a:1:{i:0;s:",$_GET['country']);
	 $explode_country1=explode(":",$explode_country[1]);
	 $trim_country=trim($explode_country1[1],'"');
	 $rtrim_country=rtrim($trim_country,'";}');
	 $country=$country1 ? $country1 : $rtrim_country;
	 $country123=array($country);
	 $countryurl=urlencode(serialize($country123));
	 
if(isset($_POST['cbostate']))
	 $state1=implode("','",$_POST['cbostate']);
	 $explode_state=explode("a:1:{i:0;s:",$_GET['state']);
	 $explode_state1=explode(":",$explode_state[1]);
	 $trim_state=trim($explode_state1[1],'"');
	 $rtrim_state=rtrim($trim_state,'";}');
	 $state=$state1 ? $state1 : $rtrim_state;
	 $state123=array($state);
	 $stateurl=urlencode(serialize($state123));
	
if(isset($_POST['dist']))
	 $dist1=implode("','",$_POST['dist']);
	 $explode_dist=explode("a:1:{i:0;s:",$_GET['dist']);
	 $explode_dist1=explode(":",$explode_dist[1]);
	 $trim_dist=trim($explode_dist1[1],'"');
	 $rtrim_dist=rtrim($trim_dist,'";}');
	 $dist=$dist1 ? $dist1 : $rtrim_dist;
	 $dist123=array($dist);
	 $disturl=urlencode(serialize($dist123));	

	 if(isset($_POST['city2']))
	 $city1=implode("','",$_POST['city2']);
	 $explode_city=explode("a:1:{i:0;s:",$_GET['city']);
	 $explode_city1=explode(":",$explode_city[1]);
	 $trim_city=trim($explode_city1[1],'"');
	 $rtrim_city=rtrim($trim_city,'";}');
     $city=$city1 ? $city1 : $rtrim_city;
	 $city123=array($city);
	 $cityurl=urlencode(serialize($city123));	
	 
	 if(isset($_POST['subcaste']))
	 $subcaste1=implode("','",$_POST['subcaste']);
	 $explode_subcaste=explode("a:1:{i:0;s:",$_GET['subcaste']);
	 $explode_subcaste1=explode(":",$explode_subcaste[1]);
	 $trim_subcaste=trim($explode_subcaste1[1],'"');
	 $rtrim_subcaste=rtrim($trim_subcaste,'";}');
	 $subcaste=$subcaste1 ? $subcaste1 : $rtrim_subcaste;
	 $subcaste123=array($subcaste);
	 $subcasteurl=urlencode(serialize($subcaste123));
	 

if(is_array($edu_search_fetch['maritialstatus']))	
{
foreach($edu_search_fetch['maritialstatus'] as $value)
	$strms .="'". $value."',";
	 $strms= rtrim($strms,',');
}
else
{
	if(!isset($_SESSION['ms']))
	{
$strms ="'Unmarried','Divorced','Widowed','Widower'";
   $strms= rtrim($strms,',');
   }
	else
	{
		$strms=$_SESSION['ms'];
	} 
}
$_SESSION['ms']=$strms;

	

$qry=mysqli_query($con,"select * from register where MatriID='".$_SESSION['matri_login']."'");
$qry1=mysqli_fetch_array($qry);
if($qry1['Gender']=='Male')
{
	$txtgender="Female";
}else{
	$txtgender='Male';
}
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
$sql1 = "SELECT COUNT(*) as totalCount FROM register where ";
$sql1.=" Gender='$txtgender' AND Age Between" ."'".$from_age."'". " AND " ."'".$to_age."'  AND Maritalstatus IN ($strms) AND  Height BETWEEN '".$height1."' AND '".$height2."'  ";
if($profile!="")
{
$sql1=$sql1.=" and MatriID NOT IN ('$profile')"; 
}
if($matriid!="")
{
$sql1=$sql1." and MatriID NOT IN ('$matriid')";  
}

//RELIGION
if($edu_search_fetch['religion']!="" && $edu_search_fetch['religion']!="Any")
{
$PE_religion_exp=explode(",",$edu_search_fetch['religion']);
$PE_religion_term=array();
foreach($PE_religion_exp as $row=>$value)
{
	$PE_religion_term[]="'$value'";
}
$PE_religion_re=implode(',',$PE_religion_term);
$sql1.=" and Religion IN ($PE_religion_re)";
}
//Caste
if($edu_search_fetch['caste']!="" && $edu_search_fetch['caste']!="Any")
{
$PE_caste_exp=explode(",",$edu_search_fetch['caste']);
$PE_caste_term=array();
foreach($PE_caste_exp as $row=>$value)
{
	$PE_caste_term[]="'$value'";
}
$PE_caste_re=implode(',',$PE_caste_term);
$sql1.=" and Caste IN ($PE_caste_re)";
}
//EDUCATION
if($edu_search_fetch['education']!="" && $edu_search_fetch['education']!="Any")
{
$PE_edu_exp=explode(",",$edu_search_fetch['education']);
$PE_edu_term=array();
foreach($PE_edu_exp as $row=>$value)
{
	$PE_edu_term[]="'$value'";
}
$PE_edu_re=implode(',',$PE_edu_term);
$sql1.=" and Education IN ($PE_edu_re)";
}
//occupation
if($edu_search_fetch['occupation']!="" && $edu_search_fetch['occupation']!="Any")
{
$PE_occu_exp=explode(",",$edu_search_fetch['occupation']);
$PE_occu_term=array();
foreach($PE_occu_exp as $row=>$value)
{
	$PE_occu_term[]="'$value'";
}
$PE_occu_re=implode(',',$PE_occu_term);
$sql1.=" and Occupation IN ($PE_occu_re)";
}
//Country
if($edu_search_fetch['country']!="" && $edu_search_fetch['country']!="Any")
{
$PE_country_exp=explode(",",$edu_search_fetch['country']);
$PE_country_term=array();
foreach($PE_country_exp as $row=>$value)
{
	$PE_country_term[]="'$value'";
}
$PE_country_re=implode(',',$PE_country_term);
$sql1.=" and Country IN ($PE_country_re)";
}
//State
if($edu_search_fetch['state']!="" && $edu_search_fetch['state']!="Any")
{
$PE_state_exp=explode(",",$edu_search_fetch['state']);
$PE_state_term=array();
foreach($PE_state_exp as $row=>$value)
{
	$PE_state_term[]="'$value'";
}
$PE_state_re=implode(',',$PE_state_term);
$sql1.=" and State IN ($PE_state_re)";
}
//District
if($edu_search_fetch['district']!="" && $edu_search_fetch['district']!="Any")
{
$PE_dist_exp=explode(",",$edu_search_fetch['district']);
$PE_dist_term=array();
foreach($PE_dist_exp as $row=>$value)
{
	$PE_dist_term[]="'$value'";
}
$PE_dist_re=implode(',',$PE_dist_term);
$sql1.=" and Dist IN ($PE_dist_re)";
}
//Taluka
if(($edu_search_fetch['taluka'] ?? "")!="" && ($edu_search_fetch['taluka'] ?? "")!="Any")
{
$PE_taluka_exp=explode(",",$edu_search_fetch['taluka']);
$PE_taluka_term=array();
foreach($PE_taluka_exp as $row=>$value)
{
	$PE_taluka_term[]="'$value'";
}
$PE_taluka_re=implode(',',$PE_taluka_term);
$sql1.=" and Taluka IN ($PE_taluka_re)";
}
//subcaste
if($edu_search_fetch['subcaste']!="" && $edu_search_fetch['subcaste']!="Any")
{
$PE_subcaste_exp=explode(",",$edu_search_fetch['subcaste']);
$PE_subcaste_term=array();
foreach($PE_subcaste_exp as $row=>$value)
{
	$PE_subcaste_term[]="'$value'";
}
$PE_subcaste_re=implode(',',$PE_subcaste_term);
$sql1.=" and Subcaste IN ($PE_subcaste_re)";
}
//City
if($edu_search_fetch['city']!="" && $edu_search_fetch['city']!="Any")
{
$PE_city_exp=explode(",",$edu_search_fetch['city']);
$PE_city_term=array();
foreach($PE_city_exp as $row=>$value)
{
	$PE_city_term[]="'$value'";
}
$PE_city_re=implode(',',$PE_city_term);
$sql1.=" and City IN ($PE_city_re)";
}

//echo $with_photo;
if($with_photo != 'withoutphoto')
{
	$sql1=$sql1." and Photo1 NOT LIKE 'nophoto.jpg' AND Photo1Approve='Yes'";
}else{
	$sql1=$sql1." and Photo1  LIKE 'nophoto.jpg' ";
}

$sql1=$sql1." and visibility NOT LIKE 'hidden' and Status<>'Banned' AND Status NOT LIKE 'InActive' and MatriID NOT LIKE '".$_SESSION['matri_login']."'";



		$sql1.=" ORDER BY Regdate DESC ";
		//echo $sql1;
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
    					$setPaginate.= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";					
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
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>...</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&id=$id'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a></li>";		
    			}
    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&id=$id'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&id=$id'>2</a></li>";
    				$setPaginate.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";					
    				}
    				$setPaginate.= "<li class='dot'>..</li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&id=$id'>$lpm1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a></li>";		
    			}
    			else
    			{
    				$setPaginate.= "<li><a href='{$page_url}page=1&id=$id'>1</a></li>";
    				$setPaginate.= "<li><a href='{$page_url}page=2&id=$id'>2</a></li>";
    				$setPaginate.= "<li class='dot'>..</li>";
    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
    				{
    					if ($counter == $page)
    						$setPaginate.= "<li><a class='active'>$counter</a></li>";
    					else
    						$setPaginate.= "<li><a href='{$page_url}page=$counter&id=$id'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$setPaginate.= "<li><a href='{$page_url}page=$next&id=$id'><b>></b></a></li>";
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
<title>Advance Save Search Result</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">

<!--Color Switcher Mockup-->
<link href="css/color-switcher-design.css" rel="stylesheet">
<link rel="shortcut icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
<link rel="icon" href="http://localhost/SVR/css3/assets/manpasand-logo.png" type="image/x-icon">
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
.blur
{
filter: blur(8px);
-webkit-filter: blur(8px);
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

   <section class="page-title" style="background-image:url(images/background/5.jpg);">
        <div class="auto-container">
            <h1 class="d-none d-lg-block d-xl-block d-md-block"> Search Result</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index_dashboard">Home</a></li>
                <li>Search Result</li>
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
                     			<?php 
                                $encrypt = urlencode( base64_encode( $fetch['MatriID'] ) );
                            	?>
                            <a href="full_profile?id=<?php echo $encrypt?>" target="_blank"><figure class="image">
						  
                            <?php
							//paid member photo 
							 if($fetch['photo_visibility']=="paidphoto")
								   { ?>
									   
								   <?php if($fetch['Photo1Approve']=='Yes'&& $me['Status']=='Paid')
													 {
								   if($fetch['Photo1']!='nophoto.jpg' ) {
														 ?>			
								<img src="photoprocess.php?image=gallary/<?php echo $fetch['Photo1'];?>&square=500" > 
								
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
										
								<img src="photoprocess.php?image=gallary/<?php echo  $fetch['Photo1'];?>&square=500"> 
								
								<?php 
										}
										else
										{
								?>
								<img src="gallary/<?php echo  $fetch['Photo1'];?>">
								<?php
										}
									} 
									else 
									{
								?>
										<img src="images/nophoto.jpg" > 
										   <?php }?>
															
							</figure> </a>
                      </div>
                      <div class="info-box">
						<h4 class="name"><a href="full_profile?id=<?php echo $encrypt?>" target="_blank">
						<?php echo $fetch['MatriID']?></a></h4>
						<span class="designation">
							<?php 
								if( $fetch['Education'] == '')
								{
									echo "Null";
								}
								else
								{
									echo substr($fetch['Education'],0,20);		
								}
							

							?>
						</span>
						<span class="designation">
							<?php 
                                    if($fetch['Occupation'] == '')
                                    {
                                        echo substr('Null', 0, 20);
                                    }
                                    else
                                    {
                                        echo substr($fetch['Occupation'], 0, 20);   
                                    }
                                     
                     ?>
						</span>
						<span class="designation">
							<?php
								if($fetch['Age'] == '')
								{
									echo "Null";
								}
								else
								{
									echo $fetch['Age'];	
								}
								
							?> Yrs,
							<?php 
								if($fetch['Height'] == '')
								{
									echo "Null";
								}
								else
								{
									echo get_height($fetch['Height']);	
								}
								
							?>
						</span>
                      </div>
                      <div class="social-box">                            
					  <ul class="social-links social-icon-colored">
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
						<a href="advance_search" class="theme-btn btn-style-three"><span class="btn-title">Search</span></a>
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
