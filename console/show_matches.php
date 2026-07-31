<?php require_once('../includes/bootstrap.php');
include('protect.php'); 
//CHECKING PROFILE ID
if($_REQUEST['flag'] == 1)
{
    //INVALID PROFILE ID
   header("location:invalid_id");
   exit;
}

$id = $_REQUEST['ID'];
$my_profile = mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$id'");
$me = mysqli_fetch_array($my_profile);

include 'get_count.php'; //FOR GETTING COUNT OF MUTUAL MATCHES
if (isset($_GET["page"])) $page = (int)$_GET["page"];
else $page = 1;
$setLimit = 6;
$pageLimit = ($page * $setLimit) - $setLimit;
//--------------------------- For My Matches ---------------------------------------//
$id = $_REQUEST['ID'];
$login = $id;
$my_profile = mysqli_query($con, "SELECT * from register where matriid='$id'");

$me = mysqli_fetch_array($my_profile);
$hobbies = explode(",", $me['Looking']);

$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion = $me['PE_Complexion'];
$PE_Education = $me['PE_Education'];
$PE_star = $me['PE_star'];
$Residencystatus = $me['Residencystatus'];
$pe_religion = $me['PE_Religion'];
$Country = $me['Country'];
$pe_caste = $me['PE_Caste'];

if ($me['Gender'] == 'Male') $match_sex = "Female";
if ($me['Gender'] == 'Female') $match_sex = "Male";

$check = mysqli_query($con, "select matriid from block_member where profile_id='$id '");
$data1 = array();
while ($check1 = mysqli_fetch_array($check))
{
    $data1[] = $check1['matriid'];
}
$matriid = implode("','", $data1);

$check2 = mysqli_query($con, "select profile_id from block_member where matriid='$id '");
$data = array();
while ($check3 = mysqli_fetch_array($check2))
{
    $data[] = $check3['profile_id'];
}
$profile = implode("','", $data);

$match_qry = "select DISTINCT * from register where visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$id' AND ";
if ($profile != "")
{
    $match_qry .= " MatriID NOT IN ('$profile') and ";
}
if ($matriid != "")
{
    $match_qry .= " MatriID NOT IN ('$matriid') and ";
}

if ($me['Looking'] != "" && $me['Looking'] != "Any")
{
    $PE_Religion_look = explode(" , ", $me['Looking']);
    $PE_Religion_look1 = array();
    foreach ($PE_Religion_look as $row => $value)
    {
        $PE_Religion_look1[] = "'$value'";
    }
    $PE_Religion_look12 = implode(',', $PE_Religion_look1);
    $match_qry .= "Maritalstatus IN($PE_Religion_look12) AND";
}
$match_qry .= " Gender='$match_sex' AND ";
$match_qry .= " Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$match_qry .= "
Age BETWEEN '$pe_fromage' AND '$pe_toage'";

if ($me['PE_Complexion'] != "" && $me['PE_Complexion'] != "Any")
{
    $PE_Complexion_exp = explode(",", $me['PE_Complexion']);
    $PE_Complexion_term = array();
    foreach ($PE_Complexion_exp as $row => $value)
    {
        $PE_Complexion_term[] = "'$value'";
    }
    $PE_Complexion_re = implode(',', $PE_Complexion_term);
    $match_qry .= " and Complexion IN($PE_Complexion_re) ";
}

if ($me['PE_Religion'] != "" && $me['PE_Religion'] != "Any")
{
    $PE_Religion_exp = explode(",", $me['PE_Religion']);
    $PE_Religion_term = array();
    foreach ($PE_Religion_exp as $row => $value)
    {
        $PE_Religion_term[] = "'$value'";
    }
    $PE_Religion_re = implode(',', $PE_Religion_term);
    $match_qry .= " and Religion IN($PE_Religion_re) ";
}
if ($me['PE_Caste'] != "" && $me['PE_Caste'] != "Any")
{
    $PE_Caste_exp = explode(",", $me['PE_Caste']);

    $PE_Caste_term = array();

    foreach ($PE_Caste_exp as $row => $value)
    {
        $PE_Caste_term[] = "'$value'";
    }
    $PE_Caste_re = implode(',', $PE_Caste_term);
    $match_qry .= " and Caste IN ($PE_Caste_re)";
}
if ($me['PE_Residentstatus'] != "" && $me['PE_Residentstatus'] != "Any")
{
    $PE_Residentstatus_exp = explode(",", $me['PE_Residentstatus']);
    $PE_Residentstatus_term = array();
    foreach ($PE_Residentstatus_exp as $row => $value)
    {
        $PE_Residentstatus_term[] = "'$value'";
    }
    $PE_Residentstatus_re = implode(',', $PE_Residentstatus_term);
    $match_qry .= " and Residencystatus IN($PE_Residentstatus_re)";
}
if ($me['PE_Countrylivingin'] != "" && $me['PE_Countrylivingin'] != "Any")
{
    $PE_Countrylivingin_exp = explode(",", $me['PE_Countrylivingin']);
    $PE_Countrylivingin_term = array();
    foreach ($PE_Countrylivingin_exp as $row => $value)
    {
        $PE_Countrylivingin_term[] = "'$value'";
    }
    $PE_Countrylivingin_re = implode(',', $PE_Countrylivingin_term);
    $match_qry .= " and Country IN($PE_Countrylivingin_re)";
}
if ($me['PE_State'] != "" && $me['PE_State'] != "Any")
{
    $PE_State_exp = explode(",", $me['PE_State']);
    $PE_State_term = array();
    foreach ($PE_State_exp as $row => $value)
    {
        $PE_State_term[] = "'$value'";
    }
    $PE_State_re = implode(',', $PE_State_term);
    $match_qry .= " and State IN($PE_State_re)";
}
if ($me['PE_Occupation'] != "" && $me['PE_Occupation'] != "Any")
{
    $PE_occu_exp = explode(",", $me['PE_Occupation']);
    $PE_occu_term = array();
    foreach ($PE_occu_exp as $row => $value)
    {
        $PE_occu_term[] = "'$value'";
    }
    $PE_occu_re = implode(',', $PE_occu_term);
    $match_qry .= " and Occupation IN($PE_occu_re)";
}
if ($me['PE_Education'] != "" && $me['PE_Education'] != "Any")
{
    $PE_Education_exp = explode(",", $me['PE_Education']);
    $PE_Education_term = array();
    foreach ($PE_Education_exp as $row => $value)
    {
        $PE_Education_term[] = "'$value'";
    }
    $PE_Education_re = implode(',', $PE_Education_term);
    $match_qry .= " and Education IN($PE_Education_re)";
}
$match_qry .= " ORDER BY Regdate DESC LIMIT " . $pageLimit . " , " . $setLimit;
function displayPaginationBelow($con, $per_page, $page,$id) //PAGINATION
{
    $login = $id;
    $page_url = "?ID=".$id.'&';
    $my_profile = mysqli_query($con, "SELECT * from register where matriid='$login'");

    $me = mysqli_fetch_array($my_profile);
    $hobbies = explode(",", $me['Looking']);
    $pe_from_height = $me['PE_from_Height'];
    $pe_to_height = $me['PE_to_Height'];
    $pe_toage = $me['PE_ToAge'];
    $pe_fromage = $me['PE_FromAge'];
    $PE_Complexion = $me['PE_Complexion'];
    $PE_star = $me['PE_star'];
    $PE_Education = $me['PE_Education'];
    $Residencystatus = $me['Residencystatus'];
    $pe_religion = $me['PE_Religion'];
    $Country = $me['Country'];
    $pe_caste = $me['PE_Caste'];
    if ($me['Gender'] == 'Male') $match_sex = "Female";
    if ($me['Gender'] == 'Female') $match_sex = "Male";

    $check = mysqli_query($con, "select matriid from block_member where profile_id='" . $_SESSION['matriid'] . "'");
    $data1 = array();
    while ($check1 = mysqli_fetch_array($check))
    {
        $data1[] = $check1['matriid'];
    }
    $matriid = implode("','", $data1);

    $check2 = mysqli_query($con, "select profile_id from block_member where matriid='" . $_SESSION['matriid'] . "'");
    $data = array();
    while ($check3 = mysqli_fetch_array($check2))
    {
        $data[] = $check3['profile_id'];
    }
    $profile = implode("','", $data);

    $count = "select COUNT(*) as totalCount from register where visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$login' AND ";
    if ($profile != "")
    {
        $count .= " MatriID NOT IN ('$profile') and ";
    }
    if ($matriid != "")
    {
        $count .= " MatriID NOT IN ('$matriid') and ";
    }
    if ($me['Looking'] != "" && $me['Looking'] != "Any")
    {
        $PE_Religion_look = explode(" , ", $me['Looking']);
        $PE_Religion_look1 = array();
        foreach ($PE_Religion_look as $row => $value)
        {
            $PE_Religion_look1[] = "'$value'";
        }
        $PE_Religion_look12 = implode(',', $PE_Religion_look1);
        $count .= "Maritalstatus IN($PE_Religion_look12) AND";
    }
    $count .= " Gender='$match_sex' AND ";
    $count .= " Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
    $count .= "
Age BETWEEN '$pe_fromage' AND '$pe_toage'";

    if ($me['PE_Religion'] != "" && $me['PE_Religion'] != "Any")
    {
        $PE_Religion_exp = explode(",", $me['PE_Religion']);
        $PE_Religion_term = array();
        foreach ($PE_Religion_exp as $row => $value)
        {
            $PE_Religion_term[] = "'$value'";
        }
        $PE_Religion_re = implode(',', $PE_Religion_term);
        $count .= " and Religion IN($PE_Religion_re) ";
    }

    if ($me['PE_Complexion'] != "" && $me['PE_Complexion'] != "Any")
    {
        $PE_Complexion_exp = explode(",", $me['PE_Complexion']);
        $PE_Complexion_term = array();
        foreach ($PE_Complexion_exp as $row => $value)
        {
            $PE_Complexion_term[] = "'$value'";
        }
        $PE_Complexion_re = implode(',', $PE_Complexion_term);
        $count .= " and Complexion IN($PE_Complexion_re) ";
    }

    if ($me['PE_star'] != "" && $me['PE_star'] != "Any")
    {
        $PE_star_exp = explode(",", $me['PE_star']);
        $PE_star_term = array();
        foreach ($PE_star_exp as $row => $value)
        {
            $PE_star_term[] = "'$value'";
        }
        $PE_star_re = implode(',', $PE_star_term);
        $count .= " and Star IN($PE_star_re) ";
    }

    if ($me['PE_Caste'] != "" && $me['PE_Caste'] != "Any")
    {
        $PE_Caste_exp = explode(",", $me['PE_Caste']);
        $PE_Caste_term = array();
        foreach ($PE_Caste_exp as $row => $value)
        {
            $PE_Caste_term[] = "'$value'";
        }
        $PE_Caste_re = implode(',', $PE_Caste_term);
        $count .= " and Caste IN ($PE_Caste_re)";
    }
    if ($me['PE_Residentstatus'] != "" && $me['PE_Residentstatus'] != "Any")
    {
        $PE_Residentstatus_exp = explode(",", $me['PE_Residentstatus']);
        $PE_Residentstatus_term = array();
        foreach ($PE_Residentstatus_exp as $row => $value)
        {
            $PE_Residentstatus_term[] = "'$value'";
        }
        $PE_Residentstatus_re = implode(',', $PE_Residentstatus_term);
        $count .= " and Residencystatus IN($PE_Residentstatus_re)";
    }
    if ($me['PE_MotherTongue'] != "" && $me['PE_MotherTongue'] != "Any")
    {
        $array = explode(",", $me['PE_MotherTongue']);
        $terms = array();
        foreach ($array as $row => $value)
        {
            $terms[] = "'$value'";
        }
        $term_str = implode(',', $terms);
        $count .= " and mother_tounge IN($term_str)";
    }
    if ($me['PE_Countrylivingin'] != "" && $me['PE_Countrylivingin'] != "Any")
    {
        $PE_Countrylivingin_exp = explode(",", $me['PE_Countrylivingin']);
        $PE_Countrylivingin_term = array();
        foreach ($PE_Countrylivingin_exp as $row => $value)
        {
            $PE_Countrylivingin_term[] = "'$value'";
        }
        $PE_Countrylivingin_re = implode(',', $PE_Countrylivingin_term);
        $count .= " and Country IN($PE_Countrylivingin_re)";
    }
    if ($me['PE_State'] != "" && $me['PE_State'] != "Any")
    {
        $PE_State_exp = explode(",", $me['PE_State']);
        $PE_State_term = array();
        foreach ($PE_State_exp as $row => $value)
        {
            $PE_State_term[] = "'$value'";
        }
        $PE_State_re = implode(',', $PE_State_term);
        $count .= " and State IN($PE_State_re)";
    }

    if ($me['PE_Occupation'] != "" && $me['PE_Occupation'] != "Any")
    {
        $PE_occu_exp = explode(",", $me['PE_Occupation']);
        $PE_occu_term = array();
        foreach ($PE_occu_exp as $row => $value)
        {
            $PE_occu_term[] = "'$value'";
        }
        $PE_occu_re = implode(',', $PE_occu_term);
        $count .= " and Occupation IN($PE_occu_re)";
    }
    if ($me['PE_Education'] != "" && $me['PE_Education'] != "Any")
    {
        $PE_Education_exp = explode(",", $me['PE_Education']);
        $PE_Education_term = array();
        foreach ($PE_Education_exp as $row => $value)
        {
            $PE_Education_term[] = "'$value'";
        }
        $PE_Education_re = implode(',', $PE_Education_term);
        $count .= " and Education IN($PE_Education_re)";
    }

    $rec = mysqli_fetch_array(mysqli_query($con, $count));
    $total = $rec['totalCount'];
    $adjacents = "2";

    $page = ($page == 0 ? 1 : $page);
    $start = ($page - 1) * $per_page;

    $prev = $page - 1;
    $next = $page + 1;
    $setLastpage = ceil($total / $per_page);
    $lpm1 = $setLastpage - 1;

    $setPaginate = "";
    if ($setLastpage > 1)
    {
        $setPaginate .= "<ul class='pagination  Pagiadvance' align='Center'>";
        $setPaginate .= "<li class='page-item mt-1 mr-5'>Page $page of $setLastpage</li>";
        if ($setLastpage < 7 + ($adjacents * 2))
        {
            for ($counter = 1;$counter <= $setLastpage;$counter++)
            {
                if ($counter == $page) $setPaginate .= "<li><a class='page-link active'>$counter</a></li>";
                else $setPaginate .= "<li ><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";
            }
        }
        elseif ($setLastpage > 5 + ($adjacents * 2))
        {
            if ($page < 1 + ($adjacents * 2))
            {
                for ($counter = 1;$counter < 4 + ($adjacents * 2);$counter++)
                {
                    if ($counter == $page) $setPaginate .= "<li><a class='page-link'>$counter</a></li>";
                    else $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";
                }
                $setPaginate .= "<li class='dot'>...</li>";
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
            }
            elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=1'>1</a></li>";
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=2'>2</a></li>";
                $setPaginate .= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents;$counter <= $page + $adjacents;$counter++)
                {
                    if ($counter == $page) $setPaginate .= "<li><a class='page-link active>$counter</a></li>";
                    else $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";
                }
                $setPaginate .= "<li class='dot'>..</li>";
                $setPaginate .= "<li><a class='page-link' class='page-link' href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
            }
            else
            {
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=1'>1</a></li>";
                $setPaginate .= "<li><a class='page-link' href='{$page_url}page=2'>2</a></li>";
                $setPaginate .= "<li class='dot'>..</li>";
                for ($counter = $setLastpage - (2 + ($adjacents * 2));$counter <= $setLastpage;$counter++)
                {
                    if ($counter == $page) $setPaginate .= "<li><a class='page-link active'>$counter</a></li>";
                    else $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$counter'>$counter</a></li>";
                }
            }
        }

        if ($page < $counter - 1)
        {
            $setPaginate .= "<li><a class='page-link' href='{$page_url}page=$next'><b>></b></a></li>";

        }
        else
        {
            $setPaginate .= "<li><a class='page-link active'><b>></b></a></li>";
        }

        $setPaginate .= "</ul>\n";
    }

    return $setPaginate;
}
	


	
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <title>Matches</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
    <meta name="author" content="DashboardKit" />

    <!-- Favicon icon -->
    <?php //<link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">?>
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
    
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
	<link href="../css/style.css?v=505020.0" rel="stylesheet">
 
        <style>
        .change{
            font-size: 16px;
            line-height: 30px;
            color: #2bd40f;
        }
        .form-control{
            width: 107% !important;
        }
        .input-group .btn {
        	margin-left: -14px;
        }
        .faic {
            margin-left: -3px;
            margin-right: -4px;
        }
        .mt-3 {
            margin-top: 2rem !important;
        }
        .alert-info {
            color: #257980;
            background-color: #dce9ff;
            border-color: #dce9ff;
        }
        .card {
            box-shadow: 0 2px 6px -1px rgb(16 16 16 / 23%);
            margin-bottom: 24px;
            transition: box-shadow 0.2s ease-in-out;
        }
        .card1 {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #dce9ff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0.125);
            border-radius: 4px;
        }
        * {
            margin: 0px;
            padding: 0px;
            border: none;
            outline: none;
        }
          
        .fa-check-circle:before {
            content: "\f058";
        }
        .gallery-item1 {
            position: relative;
            /* margin-bottom: 30px; */
        }
        .fancybox-navigation .fancybox-button--arrow_right {
            display: none;
        }
        .fancybox-navigation .fancybox-button--arrow_left {
            display: none;
        }
        .fancybox-is-sliding
        {
        	display:none;
        }
        .card-body {
            flex: 1 1 auto;
            padding: 24px 17px;
        }
        .gallery-item1 .overlay-box {
            position: absolute;
            left: 0;
            top: 0;
            height: 99%;
            width: 39%;
            text-align: center;
            content: "";
            opacity: 0;
            background-color: transparent;
            margin-left: 14%;
        }
        .gallery-item1 .overlay-box a {
            position: absolute;
            left: 8%;
            top: 161px;
            margin-top: -15px;
            margin-left: 84px;
        }
        .gallery-item1 .image-box .image img {
            display: block;
            width: 100%;
            height: 459px;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            color: #f20487;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        .search-popup1 {
            position: fixed;
            left: 0px;
            bottom: -100%;
            width: 100%;
            height: 100%;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            overflow: auto;
            background: rgba(0,0,0,0.80);
            transition: all 700ms ease;
            -moz-transition: all 700ms ease;
            -webkit-transition: all 700ms ease;
            -ms-transition: all 700ms ease;
            -o-transition: all 700ms ease;
        }
        * {
            margin: 0px;
            padding: 0px;
            border: none;
            outline: none;
        }
        .ticks{
            font-size: 16px;
            line-height: 30px;
             color: #777777;
        }
        .table.table-xs td, .table.table-xs th {
            padding: 0.1rem 0.1rem;
        }
        .tick {
            font-size: 16px;
            line-height: 30px;
            color: #2bd40f;
        }
		body{
			margin: 0;
			font-family: var(--bs-font-sans-serif);
			font-size: 0.875rem;
			font-weight: 400;
			line-height: 1.5;
			color: #293240;
			background-color: #f0f2f8;
			-webkit-text-size-adjust: 100%;
			-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
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
                <div class="card1 e-comm-card">
                    <div class="card-body py-3">
                        <div class="show" id="ecommfilstatus">
                            <div class="form-check ">
                                <b>User Profile | <?php echo $me['MatriID']; ?></b>
                            </div>
                            <div class="card-body pb-0">
                                <div class="gallery-item1  wow fadeIn">
    							    <div class="image-box ">
                                        <a href="../photoprocess.php?image=gallary/<?php echo $me['Photo1'];?>&square=500" class="lightbox-image"  data-fancybox='gallery'>
                                            <figure class="">
                                                <img src="../photoprocess.php?image=gallary/<?php echo $me['Photo1']; ?>&square=500" alt="prod img" class="img-fluid" >
                                            </figure>
                                        </a>
                                    </div>
							    </div>
							</div>
                            <div class="form-check mb-2">
                                <b>We found <span class='change_color'><?php echo $match_queryfetch['totalCount']; ?> Mutual Matches For This Profile.</b>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <b>Profile Expectation | <a href='profile_view?ID=<?php echo $me['MatriID']; ?>'><u>Modify</u></a> </b>
                            </div>
                            <div class="form-check mb-2">
                                <table class="table table-xs w-auto table-borderless m-0">
                                    <tbody>
                                        <?php include 'self_preferences.php';?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="input-group mb-3 mt-3 col-md-12">
                    <form action="get_id" method="POST" >
						<div class="row">
						    <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Enter Profile ID" aria-label="Input group example" aria-describedby="btnGroupAddon2" name="search" id ="search" required="" />
			                </div>
			                <div class="col-md-3">
						        <button type="submit" class="btn  btn-icon btn-secondary" name="submit" >
                                <i class="fas fa-search faic"></i>
                                </button>
                            </div>
                        </div>
                   </form>
                </div>
			</div>
			<!-- [ task-board-left ] end -->
            
            <!-- [ task-board-right ] start -->
            <?php 
                if($match_queryfetch['totalCount'] != 0)
                {

                    
            ?>
            <div class="col-xl-9 col-lg-8">
                
                <div class="tab-content filter-data" id="myTabContent">
                    <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                        <div class="row row-cols-lg-3 row-cols-sm-6">
                           <?php 
                            
                               	$sqlmatch = mysqli_query($con, $match_qry) or svr_db_fail($con);
            					$cnt = 0;
            					if (mysqli_num_rows($sqlmatch) > 0)
            					{
                           ?>
        					<?php while($rowC = mysqli_fetch_array($sqlmatch)){ 
        						  $cnt++;
        					?>
                            
                            <div class="col">
                                <div class="card e-comm-card">
                                    <div class="card-body position-absolute end-0 top-0">
                                        <div class="form-check prod-likes">
                                            <input type="checkbox" class="form-check-input">
                                            <i data-feather="heart" class="prod-likes-icon"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="gallery-item1  wow fadeIn">
            							    <div class="image-box ">
                                                <a href="../photoprocess.php?image=gallary/<?php echo $rowC['Photo1'];?>&square=500" class="lightbox-image"  data-fancybox='gallery'>
                								    <figure class="">
                                                        <img src="../photoprocess.php?image=gallary/<?php echo $rowC['Photo1']; ?>&square=500" alt="prod img" class="img-fluid" >
                                                    </figure>
                                                </a>
                                            </div>
							            </div>
                                        <div class="text-truncat"><?php echo $rowC['MatriID']; ?>
                                        </div>
                                        <?php 
                                            $encrypt = urlencode( base64_encode( $rowC['MatriID'] ) );
                                        ?>
                                        
                                            <div class="text-truncate w-100 h5"><?php echo $rowC['Name']; ?></div>
                                        <!-- </a> -->
                                        <div>
                                           <div class="text-truncat"><?php echo $rowC['Age']; ?> Yrs, <?php  echo   get_height($rowC['Height']) ?>
                                           </div>

                                        </div>
                                        <div class="h-data">
                                            <table class="table table-xs w-auto table-borderless m-0" >
                                                <tbody>
                                                    <?php include 'partner_matches.php' ?>  
                                                </tbody>
                                            </table>
                                            <a class= "change" href="User_Profile.php?id=<?php echo $encrypt ?>">Share on &nbsp;<i class="fab fa-whatsapp "></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
										   <?php }
                                            ?>
                        </div>
                        
                     <div  class="col-lg-12 ml-5" align="center">
                        
                         <?php echo displayPaginationBelow($con,$setLimit,$page,$id);?>
                         <br>
            
                     </div>
                      </div>
                      <?php } //<i class="fas fa-share-alt-square"></i> ?>
		  
					</div>
						  
				</div>
            <?php 
                }
                else
                {
            ?>
            <div class="col-xl-9 col-lg-8">
                <div class="alert alert-info alert-dismissible" role="alert" >
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <h5 class="alert-heading " style="color:Black"><i class="fas fa-heart"></i> We Found 0 Mutual Matches For This Profile
                    </h5>                                
                 </div>
            </div>
            <?php 
                }
            ?>
		</div>

	</div>
</div>
	 <!--  -->          
  
</div>
<script>  


</script>  


<script>
    
    
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
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




<!-- Latest compiled and minified CSS -->

<script src="../js/jquery.fancybox.js"></script>



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
            $('.m-header > .b-brand > .logo-lg').attr('src', 'http://localhost/SVR/css3/assets/shivraj-logo.png');
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
