<?php require_once('sys_dbconnection.php');
$smLogo = 'css3/assets/manpasand-logo.png';
$smLogoLocal = 'css3/assets/manpasand-logo.png';
$currentHeaderPage = pathinfo($_SERVER['SCRIPT_NAME'] ?? '', PATHINFO_FILENAME);
$registrationHeaderPages = [
  'signup', 'signup1', 'nri_registration', 'step2', 'horoscope',
  'contact', 'education', 'family', 'upload_photo', 'upload_document',
  'upload_idproof', 'verify_otp', 'register_success', 'partner_prefrence'
];
$hideDashboardButton = in_array($currentHeaderPage, $registrationHeaderPages, true);
if(!isset($page_title)) $page_title = 'Manpasand Jodidar — Find Your Perfect Life Partner';
?><!doctype html>
<html lang="mr">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title><?php echo htmlspecialchars($page_title); ?></title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
      <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Manrope:wght@300;400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $smLogoLocal; ?>">
      <link rel="stylesheet" href="template/assets/css/style.css" />
      <link rel="stylesheet" href="css3/Style.css" />
      <link rel="stylesheet" href="css3/mvv-premium.css" />
      <link rel="stylesheet" href="css3/manpasand-design-system.css" />

      <style>
      /* ══════════════════════════════════════════
         MANPASAND JODIDAR — Header & Footer
      ══════════════════════════════════════════ */

      /* ─── TOP BAR ─── */
      .mj-topbar {
        background: var(--mj-primary-dark);
        color: rgba(255,255,255,0.8);
        font-size: 12.5px;
        letter-spacing: 0.02em;
      }
      .mj-topbar-inner {
        min-height: 38px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .mj-topbar-inner > div { display: flex; gap: 20px; }
      .mj-topbar a {
        color: rgba(255,255,255,0.75);
        transition: color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
      }
      .mj-topbar a:hover { color: var(--mj-accent-light); }
      .mj-topbar i { font-size: 13px; }

      /* ─── SITE HEADER ─── */
      .mj-header {
        height: 80px;
        z-index: 100;
        background: rgba(255,249,246,0.92);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid transparent;
        transition: all 0.35s var(--mj-ease);
        position: relative;
      }
      .mj-header.mvj-sticky {
        position: fixed;
        top: 0; left: 0; right: 0;
        width: 100%;
      }
      .mj-header.scrolled {
        height: 68px;
        background: rgba(255,255,255,0.97);
        border-color: var(--mj-divider);
        box-shadow: 0 4px 24px rgba(106,16,55,0.06);
      }
      .mj-header-wrap {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      /* ─── BRAND ─── */
      .mj-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
      }
      .mj-brand-img {
        width: 56px;
        height: 56px;
        object-fit: contain;
        border-radius: 12px;
        transition: transform 0.3s var(--mj-ease);
      }
      .mj-brand:hover .mj-brand-img { transform: scale(1.05); }
      .mj-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
      }
      .mj-brand-title {
        font-family: var(--mj-font-heading);
        color: var(--mj-primary);
        font-size: 18px;
        font-weight: 800;
        letter-spacing: -0.01em;
      }
      .mj-brand-subtitle {
        font-family: var(--mj-font-devanagari);
        font-size: 10px;
        color: var(--mj-text-secondary);
        letter-spacing: 0.04em;
        font-weight: 500;
      }

      /* ─── MAIN NAV ─── */
      .mj-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 500;
        flex-shrink: 1;
        min-width: 0;
      }
      .mj-nav > a,
      .mj-nav-dropdown > button {
        padding: 8px 14px;
        border: 0;
        background: none;
        color: var(--mj-text);
        cursor: pointer;
        font-weight: 500;
        font-size: 0.88rem;
        transition: all 0.2s;
        position: relative;
        font-family: var(--mj-font);
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border-radius: var(--mj-radius-sm);
      }
      .mj-nav > a:hover,
      .mj-nav-dropdown > button:hover {
        color: var(--mj-primary);
        background: rgba(106,16,55,0.05);
      }
      .mj-nav > a.active {
        color: var(--mj-primary);
        background: rgba(106,16,55,0.06);
        font-weight: 600;
      }

      .mj-nav-dropdown { position: relative; flex-shrink: 0; }
      .mj-drop-icon { font-size: 10px; transition: transform 0.2s; }
      .mj-nav-dropdown:hover .mj-drop-icon { transform: rotate(180deg); }

      .mj-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        background: rgba(255,255,255,0.99);
        padding: 8px;
        width: max-content;
        min-width: 240px;
        max-width: 320px;
        border: 1px solid var(--mj-divider);
        border-radius: var(--mj-radius);
        box-shadow: 0 20px 60px rgba(106,16,55,0.14);
        opacity: 0;
        visibility: hidden;
        transform: translate(-50%, -8px);
        transition: all 0.22s var(--mj-ease);
        z-index: var(--mj-z-dropdown);
      }
      .mj-nav-dropdown:hover .mj-dropdown-menu,
      .mj-nav-dropdown.open .mj-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0);
      }
      .mj-dropdown-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: var(--mj-radius-sm);
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--mj-text);
        transition: all 0.2s;
        white-space: nowrap;
        text-decoration: none;
      }
      .mj-dropdown-menu a i {
        width: 18px;
        flex: 0 0 18px;
        color: var(--mj-secondary);
        text-align: center;
        font-size: 0.85rem;
      }
      .mj-dropdown-menu a:hover {
        background: var(--mj-cream);
        color: var(--mj-primary);
      }

      .mj-nav-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 8px;
        flex-shrink: 0;
      }

      /* ─── NAV BUTTONS ─── */
      .mj-nav-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-weight: 600;
        font-size: 0.82rem;
        border: none;
        border-radius: var(--mj-radius-pill);
        padding: 9px 20px;
        letter-spacing: 0.02em;
        transition: all 0.3s var(--mj-ease);
        text-decoration: none;
        font-family: var(--mj-font);
        white-space: nowrap;
      }
      .mj-nav-btn:hover { transform: translateY(-2px); }

      .mj-nav-btn-primary {
        background: linear-gradient(135deg, var(--mj-primary) 0%, var(--mj-primary-light) 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(106,16,55,0.3);
      }
      .mj-nav-btn-primary:hover { box-shadow: 0 8px 24px rgba(106,16,55,0.4); }

      .mj-nav-btn-gold {
        background: linear-gradient(135deg, var(--mj-accent) 0%, var(--mj-accent-light) 100%);
        color: var(--mj-primary-dark) !important;
        box-shadow: 0 4px 16px rgba(200,155,60,0.35);
      }
      .mj-nav-btn-gold:hover { box-shadow: 0 8px 24px rgba(200,155,60,0.45); }

      .mj-nav-btn-outline {
        background: transparent;
        color: var(--mj-primary) !important;
        border: 1.5px solid rgba(106,16,55,0.25);
      }
      .mj-nav-btn-outline:hover {
        background: rgba(106,16,55,0.06);
        border-color: var(--mj-primary);
      }

      .mj-nav-btn-light {
        background: rgba(255,255,255,0.12);
        color: #fff !important;
        border: 1.5px solid rgba(255,255,255,0.4);
      }
      .mj-nav-btn-light:hover {
        background: rgba(255,255,255,0.2);
        border-color: #fff;
      }

      /* ─── LOGGED-IN USER BADGE ─── */
      .mj-user-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--mj-primary);
        padding: 5px 14px;
        background: rgba(106,16,55,0.06);
        border-radius: var(--mj-radius-pill);
      }

      /* ─── NAV COUNT BADGE ─── */
      .mj-nav-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: linear-gradient(135deg, var(--mj-secondary), var(--mj-primary));
        color: #fff;
        font-size: 0.65rem;
        font-weight: 800;
        border-radius: var(--mj-radius-pill);
        margin-left: 4px;
      }

      /* ─── MOBILE TOGGLE ─── */
      .mj-menu-toggle {
        display: none;
        position: relative;
        z-index: 103;
        width: 40px;
        height: 40px;
        border: none;
        background: rgba(106,16,55,0.06);
        border-radius: var(--mj-radius-sm);
        padding: 8px;
        cursor: pointer;
      }
      .mj-menu-toggle span {
        display: block;
        width: 100%;
        height: 2px;
        background: var(--mj-primary);
        border-radius: 2px;
        transition: transform 0.25s, opacity 0.25s;
      }
      .mj-menu-toggle span + span { margin-top: 5px; }
      .mj-menu-toggle[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
      .mj-menu-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
      .mj-menu-toggle[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

      /* ─── NAV BACKDROP ─── */
      .mj-nav-backdrop { display: none; }

      /* ─── RESPONSIVE ─── */
      @media (max-width: 1200px) {
        .mj-nav { gap: 4px; }
        .mj-nav > a, .mj-nav-dropdown > button { padding: 8px 10px; font-size: 0.84rem; }
        .mj-nav-actions { gap: 6px; margin-left: 4px; }
        .mj-nav-btn { font-size: 0.78rem; padding: 8px 16px; }
      }

      @media (max-width: 1050px) {
        body { padding-top: 68px !important; }
        .mj-topbar { display: none; }
        .mj-header, .mj-header.scrolled {
          position: fixed;
          top: 0; right: 0; left: 0;
          width: 100%;
          height: 68px;
          z-index: 1000;
        }
        .mj-header.scrolled { height: 68px; }
        .mj-brand-img { width: 46px; height: 46px; }
        .mj-brand-title { font-size: 15px; }
        .mj-brand-subtitle { font-size: 9px; }
        .mj-menu-toggle { display: flex; flex-direction: column; justify-content: center; }

        .mj-nav {
          position: absolute !important;
          inset: auto !important;
          top: 100% !important;
          right: auto !important;
          bottom: auto !important;
          left: 0 !important;
          width: 82vw !important;
          max-width: 380px;
          height: calc(100dvh - 68px) !important;
          background: var(--mj-white);
          display: flex;
          flex-direction: column;
          align-items: stretch;
          gap: 0;
          padding: 20px 16px;
          transform: translateX(-110%);
          transition: transform 0.35s var(--mj-ease);
          box-shadow: 20px 20px 60px rgba(106,16,55,0.10);
          overflow-y: auto;
          overscroll-behavior: contain;
          z-index: 2;
        }
        .mj-header.scrolled .mj-nav { height: calc(100dvh - 68px) !important; }
        .mj-nav.open { transform: translateX(0); }

        .mj-nav > a:not(.mj-nav-btn),
        .mj-nav-dropdown > button {
          display: block;
          width: 100%;
          text-align: left;
          padding: 14px 12px;
          border-bottom: 1px solid var(--mj-divider);
          font-size: 0.95rem;
          border-radius: 0;
        }
        .mj-nav > a:not(.mj-nav-btn).active {
          background: rgba(233,78,119,0.06);
          border-radius: var(--mj-radius-sm);
          color: var(--mj-primary);
        }

        .mj-nav-actions {
          flex-direction: column;
          gap: 8px;
          margin: 16px 0 0;
          padding: 16px 0 0;
          border-top: 1px solid var(--mj-divider);
        }
        .mj-nav-actions .mj-nav-btn {
          width: 100%;
          text-align: center;
          padding: 12px 18px;
        }

        .mj-dropdown-menu {
          position: static;
          width: 100%;
          opacity: 1;
          visibility: visible;
          transform: none;
          display: none;
          box-shadow: none;
          border: 0;
          border-radius: var(--mj-radius-sm);
          background: var(--mj-cream);
          margin: 0 0 4px;
          padding: 6px;
        }
        .mj-nav-dropdown.open .mj-dropdown-menu { display: block; }
        .mj-nav-dropdown.open .mj-drop-icon { transform: rotate(180deg); }

        .mj-nav-backdrop {
          display: block;
          position: absolute;
          inset: auto;
          top: 100%;
          right: auto;
          bottom: auto;
          left: 0;
          width: 100vw;
          height: calc(100dvh - 68px);
          z-index: 1;
          border: 0;
          background: rgba(106,16,55,0.35);
          opacity: 0;
          visibility: hidden;
          pointer-events: none;
          transition: opacity 0.3s, visibility 0.3s;
          backdrop-filter: blur(4px);
        }
        .mj-header.scrolled .mj-nav-backdrop { height: calc(100dvh - 68px); }
        .mj-nav-backdrop.open {
          opacity: 1;
          visibility: visible;
          pointer-events: auto;
        }
      }

      @media (max-width: 700px) {
        .mj-nav { width: 88vw !important; padding: 16px 12px; }
        .mj-brand-img { width: 42px; height: 42px; }
        .mj-brand-title { font-size: 14px; }
        .mj-brand-subtitle { font-size: 8px; }
      }

      @media (max-width: 360px) {
        .mj-brand-subtitle { display: none; }
      }

      @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
          scroll-behavior: auto !important;
          transition: none !important;
          animation: none !important;
        }
      }
      </style>
      <?php if (!empty($page_og_image)): ?><meta property="og:image" content="<?php echo htmlspecialchars($page_og_image, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
      <?php if (!empty($page_og_title)): ?><meta property="og:title" content="<?php echo htmlspecialchars($page_og_title, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
      <?php if (!empty($page_og_description)): ?><meta property="og:description" content="<?php echo htmlspecialchars($page_og_description, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
      <meta property="og:type" content="website">
      <meta property="og:url" content="<?php echo htmlspecialchars((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?'https':'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>">
   </head>
   <body>
      <!-- TOP BAR -->
      <div class="mj-topbar">
         <div class="container mj-topbar-inner">
            <span><i class="bi bi-geo-alt-fill"></i> Satara, Maharashtra, India</span>
            <div>
               <a href="tel:+919403550087"><i class="bi bi-telephone-fill"></i> +91 94035 50087</a>
               <a href="mailto:info@manpasandjodidar.com"><i class="bi bi-envelope-fill"></i> info@manpasandjodidar.com</a>
            </div>
         </div>
      </div>

      <!-- SITE HEADER -->
      <header class="mj-header" id="mjHeader">
         <div class="container mj-header-wrap">
            <a class="mj-brand" href="index" aria-label="Manpasand Jodidar Home">
               <img class="mj-brand-img" src="<?php echo $smLogo; ?>" alt="Manpasand Jodidar Logo">
               <span class="mj-brand-text">
                  <span class="mj-brand-title">Manpasand Jodidar</span>
                  <span class="mj-brand-subtitle">मनपसंद जोडीदार · वधू वर सूचक केंद्र</span>
               </span>
            </a>

            <button class="mj-menu-toggle" aria-expanded="false" aria-controls="mjMainNav" aria-label="Open menu">
               <span></span><span></span><span></span>
            </button>

             <nav class="mj-nav" id="mjMainNav" aria-label="Main navigation">
               <a class="nav-link" href="index">Home</a>
               <a class="nav-link" href="about-us">About Us</a>

               <?php if (empty($_SESSION['MatriID'])) { ?>
               <div class="mj-nav-dropdown">
                  <button type="button">Profiles <span class="mj-drop-icon">⌄</span></button>
                  <div class="mj-dropdown-menu">
                     <a href="public_profiles?gender=Male&amp;marital_status=Unmarried"><i class="fas fa-male"></i> Unmarried Grooms</a>
                     <a href="public_profiles?gender=Female&amp;marital_status=Unmarried"><i class="fas fa-female"></i> Unmarried Brides</a>
                     <a href="public_profiles?gender=Male&amp;marital_status=Divorced"><i class="fas fa-male"></i> Divorcee Grooms</a>
                     <a href="public_profiles?gender=Female&amp;marital_status=Divorced"><i class="fas fa-female"></i> Divorcee Brides</a>
                     <a href="public_profiles?gender=Male&amp;profile_type=NRI"><i class="fas fa-globe"></i> NRI Grooms</a>
                     <a href="public_profiles?gender=Female&amp;profile_type=NRI"><i class="fas fa-globe"></i> NRI Brides</a>
                  </div>
               </div>
               <?php } ?>

               <a class="nav-link" href="my_offer">Membership</a>
               <a class="nav-link" href="success_story">Success Stories</a>
               <a class="nav-link" href="contactus">Contact Us</a>

               <div class="mj-nav-actions">
               <?php
               $login = $_SESSION['MatriID'] ?? null;
               $me = [];
               if (!empty($login)) {
                 $safeLogin = mysqli_real_escape_string($con, (string)$login);
                 $my_profile = mysqli_query($con, "SELECT * FROM register where matriid='$safeLogin'");
                 $me = mysqli_fetch_array($my_profile) ?: [];
               }

               if (empty($login)) {
               ?>
                  <a class="mj-nav-btn mj-nav-btn-outline" href="login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                  <a class="mj-nav-btn mj-nav-btn-primary" href="signup"><i class="bi bi-person-plus"></i> Register Free</a>
               <?php } else { ?>
                  <span class="mj-user-badge"><i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($me['Name'] ?? ($_SESSION['Name'] ?? 'User')); ?></span>
                  <?php if (!$hideDashboardButton) { ?>
                  <a class="mj-nav-btn mj-nav-btn-primary" href="index_dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
                  <?php } ?>
                  <a class="mj-nav-btn mj-nav-btn-outline" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
               <?php } ?>
               </div>
            </nav>

            <button class="mj-nav-backdrop" type="button" aria-label="Close menu" tabindex="-1"></button>
         </div>
      </header>
