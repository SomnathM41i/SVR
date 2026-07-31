<?php require_once('../includes/bootstrap.php');
include('protect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manpasand Jodidar — Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">

    <!-- Existing vendor CSS (unchanged) -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
    <link rel="stylesheet" href="assets/css/stylenew.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/popup.css">
    <link href="css/color-switcher-design.css" rel="stylesheet">

    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(window).load(function(){ $('#myModal').modal('show'); });
    </script>

    <style>
        /* =============================================
           PREMIUM MATRIMONY DASHBOARD — DESIGN SYSTEM
           ============================================= */

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8D5A3;
            --gold-dark:   #9A7230;
            --crimson:     #8B1A2F;
            --crimson-soft:#F5EAE9;
            --deep:        #1A1025;
            --deep-mid:    #2D1F3D;
            --surface:     #FDFAF5;
            --surface-2:   #F5EFE6;
            --text-main:   #2D1F3D;
            --text-muted:  #7A6E82;
            --border:      rgba(201,168,76,0.25);
            --shadow-gold: 0 4px 24px rgba(201,168,76,0.15);
            --shadow-card: 0 2px 20px rgba(45,31,61,0.08);
            --radius:      14px;
            --radius-sm:   8px;

            /* status colours */
            --c-free:    #6C63FF;
            --c-paid:    #C9A84C;
            --c-expired: #E05C6A;
            --c-banned:  #4AABB8;
            --c-online:  #3CB87A;
            --c-total:   #8B1A2F;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            color: var(--text-main);
        }

        /* ---- Section Labels ---- */
        .section-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin: 28px 0 12px 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--gold-light), transparent);
        }

        /* ---- Search Bar ---- */
        .premium-search-wrap {
            background: linear-gradient(135deg, var(--deep) 0%, var(--deep-mid) 100%);
            border-radius: var(--radius);
            padding: 28px 32px;
            margin: 20px 0 24px;
            position: relative;
            overflow: hidden;
        }
        .premium-search-wrap::before {
            content: '♦';
            position: absolute;
            right: 32px;
            top: 10%;
            transform: translateY(-50%);
            font-size: 80px;
            color: rgba(201,168,76,0.07);
            pointer-events: none;
        }
        .premium-search-wrap .search-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--gold-light);
            margin-bottom: 14px;
            letter-spacing: 0.03em;
        }
        .premium-search-wrap .input-group .input-group-text {
            background: rgba(201,168,76,0.15);
            border: 1px solid var(--gold-dark);
            color: var(--gold-light);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.05em;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            padding: 0 20px;
        }
        .premium-search-wrap .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid var(--gold-dark);
            border-left: none;
            color: #fff;
            font-size: 14px;
            height: 50px;
        }
        .premium-search-wrap .form-control::placeholder { color: rgba(255,255,255,0.35); }
        .premium-search-wrap .form-control:focus {
            background: rgba(255,255,255,0.1);
            border-color: var(--gold);
            box-shadow: none;
            outline: none;
        }
        .premium-search-wrap .btn-search {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            border: none;
            color: var(--deep);
            height: 50px;
            width: 56px;
            font-size: 16px;
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            transition: all 0.2s;
        }
        .premium-search-wrap .btn-search:hover {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            transform: scale(1.03);
        }

        /* ---- Gender Header Badges ---- */
        .gender-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 4px 10px;
        }
        .gender-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px 4px 8px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }
        .gender-badge.male   { background: rgba(139,26,47,0.1);  color: var(--crimson); }
        .gender-badge.female { background: rgba(201,168,76,0.12); color: var(--gold-dark); }
        .gender-badge i { font-size: 13px; }

        /* ---- Stat Cards ---- */
        .stat-row { display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; margin-bottom: 10px; }
        @media(max-width:1100px){ .stat-row { grid-template-columns: repeat(3,1fr); } }
        @media(max-width:680px) { .stat-row { grid-template-columns: repeat(2,1fr); } }

        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 16px 14px 14px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            text-decoration: none;
            display: block;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
            border-color: var(--gold);
            text-decoration: none;
        }
        .stat-card .sc-label {
            font-size: 10.5px;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .stat-card .sc-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-card .sc-icon {
            position: absolute;
            bottom: 10px; right: 12px;
            font-size: 22px;
            opacity: 0.12;
        }

        /* Colour variants */
        .sc--total   { --accent: var(--c-total);   } .sc--total::before   { background: var(--c-total);   }
        .sc--free    { --accent: var(--c-free);    } .sc--free::before    { background: var(--c-free);    }
        .sc--paid    { --accent: var(--c-paid);    } .sc--paid::before    { background: var(--c-paid);    }
        .sc--expired { --accent: var(--c-expired); } .sc--expired::before { background: var(--c-expired); }
        .sc--banned  { --accent: var(--c-banned);  } .sc--banned::before  { background: var(--c-banned);  }
        .sc--online  { --accent: var(--c-online);  } .sc--online::before  { background: var(--c-online);  }
        .stat-card .sc-value { color: var(--accent); }

        /* Online pulse dot */
        .online-dot {
            display: inline-block;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--c-online);
            margin-right: 5px;
            animation: pulse 1.8s infinite;
        }
        @keyframes pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(60,184,122,0.4); }
            50%      { box-shadow: 0 0 0 5px rgba(60,184,122,0); }
        }

        /* ---- Charts Panel ---- */
        .chart-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }
        .chart-card .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px 14px;
            border-bottom: 1px solid var(--border);
        }
        .chart-card .chart-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
        }
        .chart-card .chart-body { padding: 18px; }
        .chart-badge {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 100px;
            background: var(--surface-2);
            color: var(--gold-dark);
            border: 1px solid var(--gold-light);
        }

        /* ---- Notes / Tasks Panel ---- */
        .notes-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            height: 100%;
        }
        .notes-card .notes-header {
            background: linear-gradient(135deg, var(--deep) 0%, var(--deep-mid) 100%);
            padding: 18px 22px;
            border-radius: var(--radius) var(--radius) 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .notes-card .notes-header h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--gold-light);
            margin: 0;
        }
        .notes-card .notes-header .badge-count {
            background: var(--gold);
            color: var(--deep);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 100px;
        }
        .notes-scroll {
            height: 476px;
            overflow-y: auto;
            padding: 8px 0;
        }
        .notes-scroll::-webkit-scrollbar { width: 4px; }
        .notes-scroll::-webkit-scrollbar-track { background: transparent; }
        .notes-scroll::-webkit-scrollbar-thumb { background: var(--gold-light); border-radius: 4px; }

        .task-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid #F5EFE6;
            text-decoration: none;
            transition: background 0.15s;
        }
        .task-item:last-child { border-bottom: none; }
        .task-item:hover { background: var(--surface-2); text-decoration: none; }
        .task-icon {
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .task-icon.ti--photo   { background: rgba(139,26,47,0.1);  color: var(--crimson); }
        .task-icon.ti--gallery { background: rgba(224,92,106,0.1);  color: #E05C6A; }
        .task-icon.ti--id      { background: rgba(60,184,122,0.1);  color: var(--c-online); }
        .task-icon.ti--doc     { background: rgba(60,184,122,0.12); color: #2E9E6A; }
        .task-icon.ti--horo    { background: rgba(108,99,255,0.1);  color: var(--c-free); }
        .task-icon.ti--profile { background: rgba(201,168,76,0.12); color: var(--gold-dark); }
        .task-icon.ti--family  { background: rgba(139,26,47,0.08);  color: var(--crimson); }
        .task-icon.ti--partner { background: rgba(224,92,106,0.1);  color: #E05C6A; }

        .task-text {
            flex: 1;
            font-size: 12.5px;
            line-height: 1.45;
            color: var(--text-main);
        }
        .task-text b { color: var(--crimson); }
        .task-count {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--gold-dark);
            line-height: 1;
            flex-shrink: 0;
        }

        /* ---- Religion Pie Card ---- */
        .pie-outer {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            height: 100%;
        }
        .pie-outer .pie-header {
            padding: 18px 22px 12px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .pie-outer .pie-header h6 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            color: var(--text-main);
        }

        /* ---- Success Modal ---- */
        .modal-content { border: none; border-radius: var(--radius); overflow: hidden; }

        /* ---- Divider ornament ---- */
        .ornament {
            text-align: center;
            color: var(--gold);
            font-size: 16px;
            letter-spacing: 0.4em;
            margin: 20px 0 4px;
            opacity: 0.5;
        }

        /* ---- Existing overrides (preserve layout compatibility) ---- */
        .chart_wrap { position: relative; padding-bottom: 100%; height: 500; overflow: hidden; }
        .piechart   { position: absolute; top: 0; left: 0; height: 500px; }
        .note { height: 505px; position: relative; }
        @media(max-width:768px) {
            .note { height: 547px; }
            .task-item { padding: 10px 14px; }
        }

        /* ============================================================
           HEADER OFFSET FIX
           pc-header  (top bar)  ≈ 60px  fixed, z-index 1025
           topbar     (nav bar)  ≈ 48px  fixed, z-index 1024
           Total offset needed   ≈ 108px
           We also ensure both bars stack cleanly with correct z-index.
           ============================================================ */

        /* Force both bars to be truly fixed and non-overlapping */
        header.pc-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1025 !important;
            height: 60px !important;
        }

        nav.topbar {
            position: fixed !important;
            top: 60px !important;          /* sits directly below pc-header */
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1024 !important;
            height: 48px !important;
        }

        /* Mobile header — same treatment */
        .pc-mob-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1025 !important;
        }

        /* Push the page body below both bars */
        body.pc-horizontal .pc-container,
        body.pc-horizontal .pcoded-content {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        /* The outer container gets the full offset */
        body.pc-horizontal > .container {
            padding-top: 19px !important;   /* 60px header + 48px nav + 8px breathing room */
        }

        /* On mobile only top-header is visible */
        @media (max-width: 991px) {
            body.pc-horizontal > .container {
                padding-top: 70px !important;
            }
        }
    </style>
</head>
<body class="pc-horizontal">

    <!-- [ Pre-loader ] -->
    <div class="loader-bg">
        <div class="loader-track"><div class="loader-fill"></div></div>
    </div>

    <!-- Fixed headers sit OUTSIDE .container so they span full viewport width -->
    <?php include('topheader.php'); ?>
    <?php include('header.php'); ?>
    <?php include('notification.php'); ?>

<div class="container">

    <!-- [ Main Content ] -->
    <div class="pc-container">
        <div class="pcoded-content">

            <!-- ========================
                 SEARCH BAR
                 ======================== -->
            <div class="col-sm-12">
                <div class="premium-search-wrap">
                    <div class="search-title">Find a Member</div>
                    <form action="search_result" method="POST">
                        <div class="input-group col-md-10">
                            <div class="input-group-text">We're here to help</div>
                            <input type="text" class="form-control"
                                   placeholder="Enter Matrimonial ID, Email ID, Mobile No or Name"
                                   name="search" required>
                            <button type="submit" class="btn btn-search" name="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                /* =============================================
                   ALL ORIGINAL PHP LOGIC — UNCHANGED
                   ============================================= */
                $todaysdate = date('Y-m-d');

                $rsmale        = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Male'");
                $rowmale       = mysqli_fetch_array($rsmale);

                $rsmaleactive  = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Male' AND Status='Active'");
                $rowmaleactive = mysqli_fetch_array($rsmaleactive);

                $rsmalepaid    = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Male' AND Status='Paid'");
                $rowmalepaid   = mysqli_fetch_array($rsmalepaid);

                $rsmaleexpired = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Male' AND Status='Expired'");
                $rowmaleexpired= mysqli_fetch_array($rsmaleexpired);

                $rsmaleban     = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Male' AND Status='Banned'");
                $rowmaleban    = mysqli_fetch_array($rsmaleban);

                $rsfemale      = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Female'");
                $rowfemale     = mysqli_fetch_array($rsfemale);

                $rsfemaleactive= mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Female' AND Status='Active'");
                $rowfemaleactive=mysqli_fetch_array($rsfemaleactive);

                $rsfemalepaid  = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Female' AND Status='Paid'");
                $rowfemalepaid = mysqli_fetch_array($rsfemalepaid);

                $rsfemaleexpired=mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Female' AND Status='Expired'");
                $rowfemaleexpired=mysqli_fetch_array($rsfemaleexpired);

                $rsfemaleban   = mysqli_query($con,"SELECT count(*) AS tot FROM register WHERE Gender='Female' AND Status='Banned'");
                $rowfemaleban  = mysqli_fetch_array($rsfemaleban);

                date_default_timezone_set("Asia/Kolkata");
                $dt = date('Y-m-d h i s');
                $hr = date('h'); $min = date('i')-5; $sec = date('s'); $am = date('a');

                $sqlmatchtot = mysqli_query($con,"SELECT * FROM register WHERE Gender='Male'   AND TIMESTAMPDIFF(minute,LastLogin,NOW())<5");
                $count       = mysqli_num_rows($sqlmatchtot);
                $rowolmale   = mysqli_fetch_array($sqlmatchtot);

                $sqlmatchfe  = mysqli_query($con,"SELECT * FROM register WHERE Gender='Female' AND TIMESTAMPDIFF(minute,LastLogin,NOW())<5");
                $countf      = mysqli_num_rows($sqlmatchfe);
                $rowolfemale = mysqli_fetch_array($sqlmatchfe);
            ?>

            <!-- ========================
                 MALE STATS
                 ======================== -->
            <div class="col-sm-12">
                <div class="gender-header">
                    <span class="gender-badge male"><i class="fas fa-mars"></i> Male Members</span>
                </div>
                <div class="stat-row">
                    <a href="total_malemember"  class="stat-card sc--total">
                        <div class="sc-label">Total Male</div>
                        <div class="sc-value"><?= $rowmale['tot'] ?></div>
                        <i class="fas fa-users sc-icon"></i>
                    </a>
                    <a href="male_freemember"   class="stat-card sc--free">
                        <div class="sc-label">Free Members</div>
                        <div class="sc-value"><?= $rowmaleactive['tot'] ?></div>
                        <i class="fas fa-user sc-icon"></i>
                    </a>
                    <a href="paid_malemember"   class="stat-card sc--paid">
                        <div class="sc-label">Paid Members</div>
                        <div class="sc-value"><?= $rowmalepaid['tot'] ?></div>
                        <i class="fas fa-crown sc-icon"></i>
                    </a>
                    <a href="expire_malemember" class="stat-card sc--expired">
                        <div class="sc-label">Expired</div>
                        <div class="sc-value"><?= $rowmaleexpired['tot'] ?></div>
                        <i class="fas fa-clock sc-icon"></i>
                    </a>
                    <a href="ban_malemember"    class="stat-card sc--banned">
                        <div class="sc-label">Banned</div>
                        <div class="sc-value"><?= $rowmaleban['tot'] ?></div>
                        <i class="fas fa-ban sc-icon"></i>
                    </a>
                    <a href="ol_malemember"     class="stat-card sc--online">
                        <div class="sc-label"><span class="online-dot"></span>Online Now</div>
                        <div class="sc-value"><?= $count ?></div>
                        <i class="fas fa-circle sc-icon"></i>
                    </a>
                </div>
            </div>

            <!-- ========================
                 FEMALE STATS
                 ======================== -->
            <div class="col-sm-12">
                <div class="gender-header">
                    <span class="gender-badge female"><i class="fas fa-venus"></i> Female Members</span>
                </div>
                <div class="stat-row">
                    <a href="total_femalemember"  class="stat-card sc--total">
                        <div class="sc-label">Total Female</div>
                        <div class="sc-value"><?= $rowfemale['tot'] ?></div>
                        <i class="fas fa-users sc-icon"></i>
                    </a>
                    <a href="female_freemember"   class="stat-card sc--free">
                        <div class="sc-label">Free Members</div>
                        <div class="sc-value"><?= $rowfemaleactive['tot'] ?></div>
                        <i class="fas fa-user sc-icon"></i>
                    </a>
                    <a href="paid_femalemember"   class="stat-card sc--paid">
                        <div class="sc-label">Paid Members</div>
                        <div class="sc-value"><?= $rowfemalepaid['tot'] ?></div>
                        <i class="fas fa-crown sc-icon"></i>
                    </a>
                    <a href="expire_femalemember" class="stat-card sc--expired">
                        <div class="sc-label">Expired</div>
                        <div class="sc-value"><?= $rowfemaleexpired['tot'] ?></div>
                        <i class="fas fa-clock sc-icon"></i>
                    </a>
                    <a href="ban_femalemember"    class="stat-card sc--banned">
                        <div class="sc-label">Banned</div>
                        <div class="sc-value"><?= $rowfemaleban['tot'] ?></div>
                        <i class="fas fa-ban sc-icon"></i>
                    </a>
                    <a href="ol_femalemember"     class="stat-card sc--online">
                        <div class="sc-label"><span class="online-dot"></span>Online Now</div>
                        <div class="sc-value"><?= $countf ?></div>
                        <i class="fas fa-circle sc-icon"></i>
                    </a>
                </div>
            </div>

            <div class="ornament">✦ &nbsp; ✦ &nbsp; ✦</div>

            <!-- ========================
                 OVERVIEW CHART
                 ======================== -->
            <div class="col-sm-12" style="margin-top:16px;">
                <div class="chart-card">
                    <div class="chart-header">
                        <h6 class="chart-title">Overview Chart</h6>
                        <span class="chart-badge">All Members</span>
                    </div>
                    <div class="chart-body">
                        <div id="barchart_material" style="width:100%;height:150px;">
                            <?php include 'stacked_bar.php'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================
                 PIE CHART + TASKS
                 ======================== -->
            <div class="col-sm-12" style="margin-top:16px;">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="user1" role="tabpanel">
                        <div class="row">

                            <?php include "pie_chart.php"; ?>

            <!-- Tasks / Notes Panel -->
                            <div class="col-xl-5 col-md-6" style="margin-bottom:16px;">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================
                 YEARLY CHART
                 ======================== -->
            <div class="col-sm-12" style="margin:16px 0 24px;">
                <div class="chart-card">
                    <div class="chart-header">
                        <h6 class="chart-title">Yearly Registrations</h6>
                        <span class="chart-badge"><?= date('Y') ?></span>
                    </div>
                    <div class="chart-body">
                        <?php include 'chart.php'; ?>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end pc-container -->

</div><!-- end .container -->

<?php include('footer.php'); ?>

<?php if($_GET['msg'] == "success"): ?>
<div id="myModal" class="modal" role="dialog" style="margin-top:100px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modalb">
                <div class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display:flex;">
                    <div class="swal2-header">
                        <div class="swal2-icon swal2-success swal2-icon-show" style="display:flex;">
                            <div class="swal2-success-circular-line-left" style="background-color:rgb(255,255,255);"></div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color:rgb(255,255,255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color:rgb(255,255,255);"></div>
                        </div>
                        <h2 class="swal2-title" style="display:flex;">Member Deleted Successfully</h2>
                    </div>
                    <div class="swal2-actions">
                        <a href="index.php" data-target="#" class="swal2-confirm swal2-styled" style="display:inline-block;">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Required JS (unchanged) -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/%c3%a1%c2%b9%c2%adrack.html"></script>
<script src="assets/js/pages/dashboard-sale.js"></script>
</body>
</html>