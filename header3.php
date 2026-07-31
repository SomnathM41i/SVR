<?php require_once('includes/bootstrap.php');
$smLogo = 'branding/logos/emblem.png';
$smLogoLocal = 'branding/favicons/icon-32.png';
$currentHeaderPage = pathinfo($_SERVER['SCRIPT_NAME'] ?? '', PATHINFO_FILENAME);
$registrationHeaderPages = [
  'signup', 'signup1', 'nri_registration', 'step2', 'horoscope',
  'contact', 'education', 'family', 'upload_photo', 'upload_document',
  'upload_idproof', 'verify_otp', 'register_success', 'partner_prefrence'
];
$hideDashboardButton = in_array($currentHeaderPage, $registrationHeaderPages, true);
if(!isset($page_title)) $page_title = 'Manpasand Jodidar - वधू वर सूचक केंद्र';
?><!doctype html>
<html lang="mr">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title><?php echo htmlspecialchars($page_title); ?></title>
      <!-- Google Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
      <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
      <!-- Bootstrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <!-- Favicon -->
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $smLogoLocal; ?>">
      <!-- Template Styles -->
      <link rel="stylesheet" href="template/assets/css/style.css" />
      <!-- Custom CSS -->
      <link rel="stylesheet" href="css3/Style.css" />
      <link rel="stylesheet" href="css3/mvv-premium.css" />

      <style>
      /* ══════════════════════════════════════════
         MANPASAND JODIDAR DESIGN SYSTEM — Header & Footer
         Inspired by template's modern aesthetic
      ══════════════════════════════════════════ */
      :root {
        --mvv-saffron:      #E8612A;
        --mvv-saffron-dark: #C94D1A;
        --mvv-maroon:       #6B1A1A;
        --mvv-maroon-dark:  #4A0E0E;
        --mvv-gold:         #C9921A;
        --mvv-gold-light:   #F0C04A;
        --mvv-cream:        #FFF8F0;
        --mvv-cream-2:      #F7ECDD;
        --mvv-ink:          #271A1B;
        --mvv-muted:        #7A5C4A;
        --mvv-white:        #FFFFFF;
        --mvv-line:         rgba(107,26,26,0.12);
        --mvv-shadow:       0 20px 60px rgba(79,35,25,0.12);
        --mvv-radius:       22px;
        --mvv-radius-sm:    12px;
        --mvv-font:         'DM Sans', 'Noto Sans Devanagari', sans-serif;
        --mvv-display:      'Playfair Display', Georgia, serif;
        --mvv-deva:         'Noto Sans Devanagari', sans-serif;
      }

      *, *::before, *::after { box-sizing: border-box; }

      html {
        scroll-behavior: smooth;
      }

      body {
        margin: 0 !important;
        padding: 0 !important;
        font-family: var(--mvv-font);
        background: var(--mvv-cream);
        color: var(--mvv-ink);
        line-height: 1.65;
        top: 0 !important;
        overflow-x: clip;
      }

      body.menu-open { overflow: hidden; }
      body.mvv-padded-header { padding-top: 86px !important; }

      body > iframe.skiptranslate,
      .goog-te-banner-frame { display: none !important; }

      img { max-width: 100%; display: block; }
      a { color: inherit; text-decoration: none; }
      button { font: inherit; cursor: pointer; }

      ::-webkit-scrollbar { width: 6px; }
      ::-webkit-scrollbar-track { background: var(--mvv-cream); }
      ::-webkit-scrollbar-thumb { background: var(--mvv-saffron); border-radius: 3px; }

      /* ─── TOP BAR ─── */
      .mvv-topbar {
        background: var(--mvv-maroon-dark);
        color: #f8e8d0;
        font-size: 13px;
      }
      .mvv-topbar-inner {
        min-height: 36px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .mvv-topbar-inner > div {
        display: flex;
        gap: 24px;
      }
      .mvv-topbar a {
        color: #f8e8d0;
        transition: color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
      }
      .mvv-topbar a:hover { color: var(--mvv-gold-light); }
      .mvv-topbar i { font-size: 14px; }

      /* ─── SITE HEADER ─── */
      .mvv-header {
        height: 86px;
        z-index: 100;
        background: rgba(255,249,240,0.9);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid transparent;
        transition: 0.3s;
      }
      .mvv-header.mvv-sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
      }
      .mvv-header.scrolled {
        height: 74px;
        background: rgba(255,255,255,0.96);
        border-color: var(--mvv-line);
        box-shadow: 0 10px 40px rgba(61,25,17,0.08);
      }
      .mvv-header-wrap {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      /* ─── BRAND ─── */
      .mvv-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
        flex-shrink: 0;
      }
      .mvv-brand-img {
        width: 65px;
        height: 65px;
        object-fit: contain;
      }
      .mvv-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.25;
      }
      .mvv-brand-title {
        font-family: var(--mvv-deva);
        color: var(--mvv-maroon);
        font-size: 20px;
        font-weight: 700;
      }
      .mvv-brand-subtitle {
        font-size: 11px;
        color: var(--mvv-muted);
        letter-spacing: 0.02em;
      }

      /* ─── MAIN NAV ─── */
      .mvv-nav {
        display: flex;
        align-items: center;
        gap: 25px;
        font-size: 14px;
        font-weight: 600;
        flex-shrink: 1;
        min-width: 0;
      }
      .mvv-nav > a,
      .mvv-nav-dropdown > button {
        padding: 30px 0;
        border: 0;
        background: none;
        color: #49393a;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: color 0.2s;
        position: relative;
        font-family: var(--mvv-font);
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
      }
      .mvv-nav > a::after,
      .mvv-nav-dropdown > button::after {
        content: '';
        position: absolute;
        bottom: 18px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--mvv-saffron);
        border-radius: 2px;
        transform: scaleX(0);
        transition: transform 0.25s;
      }
      .mvv-nav > a:hover::after,
      .mvv-nav-dropdown > button:hover::after,
      .mvv-nav > a.active::after { transform: scaleX(1); }
      .mvv-nav > a:hover,
      .mvv-nav-dropdown > button:hover { color: var(--mvv-saffron); }
      .mvv-nav > a.active { color: var(--mvv-saffron); }

      .mvv-nav-dropdown { position: relative; flex-shrink: 0; }
      .mvv-drop-icon { font-size: 10px; transition: transform 0.2s; }
      .mvv-nav-dropdown:hover .mvv-drop-icon { transform: rotate(180deg); }

      .mvv-dropdown-menu {
        position: absolute;
        top: 70px;
        left: -18px;
        background: #fff;
        padding: 10px;
        width: 220px;
        border: 1px solid var(--mvv-line);
        border-radius: 14px;
        box-shadow: var(--mvv-shadow);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px);
        transition: 0.22s;
        z-index: 50;
      }
      .mvv-nav-dropdown:hover .mvv-dropdown-menu,
      .mvv-nav-dropdown.open .mvv-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
      }
      .mvv-dropdown-menu a {
        display: block;
        padding: 9px 12px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        color: var(--mvv-ink);
        transition: background 0.2s, color 0.2s;
        white-space: nowrap;
        text-decoration: none;
      }
      .mvv-dropdown-menu a:hover {
        background: var(--mvv-cream);
        color: var(--mvv-saffron);
      }

      /* Override any Bootstrap nav-link interference */
      .mvv-nav > a.nav-link {
        color: #49393a;
        padding: 30px 0;
        font-size: 14px;
      }
      .mvv-nav > a.nav-link:hover { color: var(--mvv-saffron); }
      .mvv-nav > a.nav-link.active { color: var(--mvv-saffron); }
      .mvv-nav-actions { display: flex; align-items: center; gap: 6px; margin-left: 6px; flex-shrink: 0; }

      /* ─── NAV BUTTONS ─── */
      .mvv-nav-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-weight: 700;
        font-size: 13px;
        border: none;
        border-radius: 999px;
        padding: 8px 18px;
        letter-spacing: 0.03em;
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
        text-decoration: none;
        font-family: var(--mvv-font);
      }
      .mvv-nav-btn:hover { transform: translateY(-2px); }

      .mvv-nav-btn-primary {
        background: linear-gradient(135deg, var(--mvv-gold) 0%, var(--mvv-gold-light) 100%);
        color: var(--mvv-maroon-dark) !important;
        box-shadow: 0 3px 12px rgba(200,130,50,0.35);
      }
      .mvv-nav-btn-primary:hover {
        box-shadow: 0 6px 20px rgba(200,130,50,0.5);
      }

      .mvv-nav-btn-outline {
        background: transparent;
        color: var(--mvv-maroon) !important;
        border: 1.5px solid rgba(107,26,26,0.3);
      }
      .mvv-nav-btn-outline:hover {
        background: rgba(107,26,26,0.06);
        border-color: var(--mvv-maroon);
      }

      .mvv-nav-btn-light {
        background: rgba(255,255,255,0.12);
        color: #fff !important;
        border: 1.5px solid rgba(255,255,255,0.4);
      }
      .mvv-nav-btn-light:hover {
        background: rgba(255,255,255,0.2);
        border-color: #fff;
      }

      .mvv-nav-btn-gold {
        background: linear-gradient(135deg, var(--mvv-gold) 0%, var(--mvv-gold-light) 100%);
        color: var(--mvv-maroon-dark) !important;
        box-shadow: 0 3px 12px rgba(200,130,50,0.35);
      }
      .mvv-nav-btn-gold:hover {
        box-shadow: 0 6px 20px rgba(200,130,50,0.5);
      }

      /* ─── MOBILE TOGGLE ─── */
      .mvv-menu-toggle {
        display: none;
        position: relative;
        z-index: 103;
        width: 44px;
        height: 44px;
        border: none;
        background: rgba(107,26,26,0.08);
        border-radius: 8px;
        padding: 8px;
        cursor: pointer;
      }
      .mvv-menu-toggle span {
        display: block;
        width: 100%;
        height: 2px;
        background: var(--mvv-maroon);
        border-radius: 2px;
        transition: transform 0.25s, opacity 0.25s;
      }
      .mvv-menu-toggle span + span { margin-top: 5px; }
      .mvv-menu-toggle[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
      .mvv-menu-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
      .mvv-menu-toggle[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

      /* ─── MOBILE NAV DRAWER ─── */
      .mvv-nav-backdrop {
        display: none;
      }

      /* ─── LOGGED-IN USER INDICATOR ─── */
      .mvv-user-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--mvv-maroon);
        padding: 4px 12px;
        background: rgba(107,26,26,0.06);
        border-radius: 999px;
      }

      /* ─── NAVBAR OUTER (for gradient pages) ─── */
      .mvv-navbar-outer {
        background: linear-gradient(135deg, var(--mvv-maroon-dark) 0%, var(--mvv-maroon) 40%, var(--mvv-saffron) 100%);
        position: relative;
        overflow: hidden;
        margin: 0 !important;
        padding-top: 0 !important;
      }
      .mvv-navbar-outer::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
      }
      .mvv-navbar-outer::after {
        content: 'ॐ';
        position: absolute;
        right: -20px; top: -20px;
        font-size: 120px;
        color: rgba(255,255,255,0.04);
        font-family: var(--mvv-deva);
        pointer-events: none;
      }
      .mvv-navbar-outer .mvv-header {
        background: transparent;
        backdrop-filter: none;
        border-bottom-color: rgba(255,255,255,0.1);
      }
      .mvv-navbar-outer .mvv-header.scrolled {
        background: rgba(74,14,14,0.97);
        backdrop-filter: blur(16px);
        border-bottom-color: rgba(255,255,255,0.06);
      }
      .mvv-navbar-outer .mvv-brand-title { color: #fff; }
      .mvv-navbar-outer .mvv-brand-subtitle { color: var(--mvv-gold-light); }
      .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn),
      .mvv-navbar-outer .mvv-nav-dropdown > button { color: rgba(255,255,255,0.88); }
      .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn):hover,
      .mvv-navbar-outer .mvv-nav-dropdown > button:hover { color: #fff; }
      .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn)::after,
      .mvv-navbar-outer .mvv-nav-dropdown > button::after { background: var(--mvv-gold-light); }
      .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn).active { color: var(--mvv-gold-light); }
      .mvv-navbar-outer .mvv-menu-toggle span { background: #fff; }
      .mvv-navbar-outer .mvv-menu-toggle { background: rgba(255,255,255,0.1); }

      /* ─── RESPONSIVE ─── */

      /* ─── Smaller desktop: tighter spacing ─── */
      @media (max-width: 1200px) {
        .mvv-nav { gap: 18px; }
        .mvv-nav > a, .mvv-nav-dropdown > button { padding: 30px 0; font-size: 13px; }
        .mvv-nav > a.nav-link { padding: 30px 0; font-size: 13px; }
        .mvv-nav-actions { gap: 4px; margin-left: 4px; }
        .mvv-nav-btn { font-size: 12px; padding: 7px 14px; }
      }

      @media (max-width: 1100px) {
        .mvv-brand-img { width: 52px; height: 52px; }
        .mvv-brand-title { font-size: 17px; }
        .mvv-brand-subtitle { font-size: 9px; }
        .mvv-nav { gap: 12px; }
        .mvv-nav > a, .mvv-nav-dropdown > button { padding: 30px 0; font-size: 12px; }
        .mvv-nav > a.nav-link { padding: 30px 0; font-size: 12px; }
        .mvv-header { height: 80px; }
      }

      @media (max-width: 1050px) {
        body { padding-top: 74px; }
        .mvv-topbar { display: none; }
        .mvv-header,
        .mvv-header.scrolled {
          position: fixed;
          top: 0; right: 0; left: 0;
          width: 100%;
          height: 74px;
          z-index: 1000;
        }
        .mvv-header.scrolled { height: 74px; }
        .mvv-brand-img { width: 55px; height: 55px; }
        .mvv-brand-title { font-size: 17px; }
        .mvv-brand-subtitle { font-size: 10px; }
        .mvv-menu-toggle { display: flex; flex-direction: column; justify-content: center; }

        .mvv-nav {
          position: absolute !important;
          inset: auto !important;
          top: 100% !important;
          right: auto !important;
          bottom: auto !important;
          left: 0 !important;
          width: 80vw !important;
          max-width: 360px;
          height: calc(100dvh - 74px) !important;
          background: #fff;
          display: flex;
          flex-direction: column;
          align-items: stretch;
          gap: 0;
          padding: 20px 16px;
          transform: translateX(-110%);
          transition: transform 0.3s;
          box-shadow: 20px 20px 60px rgba(0,0,0,0.12);
          overflow-y: auto;
          overscroll-behavior: contain;
          z-index: 2;
        }
        .mvv-header.scrolled .mvv-nav { height: calc(100dvh - 74px) !important; }
        .mvv-nav.open { transform: translateX(0); }

        .mvv-nav > a:not(.mvv-nav-btn),
        .mvv-nav-dropdown > button {
          display: block;
          width: 100%;
          text-align: left;
          padding: 14px 12px;
          border-bottom: 1px solid var(--mvv-line);
          font-size: 15px;
        }
        .mvv-nav > a:not(.mvv-nav-btn)::after,
        .mvv-nav-dropdown > button::after { display: none; }
        .mvv-nav > a:not(.mvv-nav-btn).active {
          background: rgba(232,97,42,0.08);
          border-radius: 8px;
          color: var(--mvv-saffron);
        }

        .mvv-nav-actions {
          flex-direction: column;
          gap: 8px;
          margin: 16px 0 0;
          padding: 16px 0 0;
          border-top: 1px solid var(--mvv-line);
        }
        .mvv-nav-actions .mvv-nav-btn {
          width: 100%;
          text-align: center;
          padding: 12px 18px;
        }

        .mvv-dropdown-menu {
          position: static;
          width: 100%;
          opacity: 1;
          visibility: visible;
          transform: none;
          display: none;
          box-shadow: none;
          border: 0;
          border-radius: 10px;
          background: var(--mvv-cream);
          margin: 0 0 4px;
        }
        .mvv-nav-dropdown.open .mvv-dropdown-menu { display: block; }
        .mvv-nav-dropdown.open .mvv-drop-icon { transform: rotate(180deg); }

        .mvv-nav-backdrop {
          display: block;
          position: absolute;
          inset: auto;
          top: 100%;
          right: auto;
          bottom: auto;
          left: 0;
          width: 100vw;
          height: calc(100dvh - 74px);
          z-index: 1;
          border: 0;
          background: rgba(39,26,27,0.48);
          opacity: 0;
          visibility: hidden;
          pointer-events: none;
          transition: opacity 0.3s, visibility 0.3s;
        }
        .mvv-header.scrolled .mvv-nav-backdrop { height: calc(100dvh - 74px); }
        .mvv-nav-backdrop.open {
          opacity: 1;
          visibility: visible;
          pointer-events: auto;
        }

        .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn).active {
          background: rgba(255,255,255,0.1);
          color: var(--mvv-gold-light);
        }
        .mvv-navbar-outer .mvv-nav { background: rgba(74,14,14,0.98); }
        .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn),
        .mvv-navbar-outer .mvv-nav-dropdown > button { color: rgba(255,255,255,0.85); border-bottom-color: rgba(255,255,255,0.08); }
        .mvv-navbar-outer .mvv-nav-actions { border-top-color: rgba(255,255,255,0.1); }
        .mvv-navbar-outer .mvv-dropdown-menu { background: rgba(0,0,0,0.25); }
        .mvv-navbar-outer .mvv-dropdown-menu a { color: rgba(255,255,255,0.85); }
        .mvv-navbar-outer .mvv-dropdown-menu a:hover { background: rgba(255,255,255,0.08); color: var(--mvv-gold-light); }
      }

      @media (max-width: 700px) {
        .mvv-nav { width: 85vw !important; padding: 16px 12px; }
        .mvv-brand-img { width: 48px; height: 48px; }
        .mvv-brand-title { font-size: 15px; }
        .mvv-brand-subtitle { font-size: 9px; }
      }

      @media (max-width: 360px) {
        .mvv-brand-subtitle { display: none; }
      }

      /* ─── HERO ─── */
      .hero {
        min-height: 700px;
        display: flex;
        align-items: center;
        position: relative;
        background: linear-gradient(90deg,
            rgba(255,249,240,.98) 0%,
            rgba(255,249,240,.91) 39%,
            rgba(255,249,240,.05) 68%),
          url('template/assets/images/maratha-wedding-hero.jpg') 67% center / cover no-repeat;
        overflow: hidden;
      }
      .hero:before,
      .hero:after {
        content: '';
        position: absolute;
        border: 1px solid rgba(200,154,75,.27);
        border-radius: 50%;
      }
      .hero:before { width:360px; height:360px; left:-210px; top:30px; }
      .hero:after  { width:510px; height:510px; left:-300px; top:-40px; }

      /* ─── ABOUT EMBLEM LOGO ─── */
      .about-art { background: none !important; border: 2px solid rgba(200,154,75,0.4); box-shadow: 0 15px 50px rgba(79,35,25,0.15); }
      .about-art::before { display: none !important; }
      .about-emblem img { width: 200px; height: 200px; border-radius: 50%; object-fit: contain; background: #fff; padding: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
      .about-photo-card .about-emblem { inset: 0; border: 0; border-radius: inherit; overflow: hidden; }
      .about-photo-card .about-emblem img { width: 100%; height: 100%; border-radius: 0; object-fit: cover; object-position: center 20%; background: #fff; padding: 0; box-shadow: none; }

      /* ─── PREV STYLES SAFE KEEP ─── */
      .preloader { display: none !important; }
      .header-span { height: 0 !important; display: block !important; margin: 0 !important; padding: 0 !important; line-height: 0 !important; font-size: 0 !important; overflow: hidden !important; }
      .page-wrapper { overflow: visible !important; }
      .mvv-page { padding-top: 0 !important; }

      @media (max-width: 1050px) {
        .hero { min-height: 640px; background-position: 62% center; }
        .hero-content { width: 62%; }
      }
      @media (max-width: 700px) {
        .hero {
          min-height: 720px;
          align-items: flex-start;
          background:
            linear-gradient(180deg,
              rgba(255,249,240,.98) 0%,
              rgba(255,249,240,.9) 56%,
              rgba(255,249,240,.25) 100%),
            url('template/assets/images/maratha-wedding-hero.jpg') 72% bottom / auto 52% no-repeat,
            #fff9f0;
        }
        .hero-content { width: 100%; padding: 65px 0 280px; }
        .hero h1 { font-size: 42px; }
        .hero p { font-size: 16px; }
        .hero-trust { gap: 17px; }
        .hero-trust strong { font-size: 18px; }
      }
      @media (max-width: 768px) {
        .mvv-page-hero { min-height: 300px !important; padding: 50px 0 !important; }
        .mvv-page-hero h1 { font-size: clamp(1.6rem, 5vw, 2.2rem) !important; }
      }

      /* Keep desktop dropdowns above the hero and give them a complete menu surface. */
      @media (min-width: 1051px) {
        .mvv-header {
          position: relative;
          z-index: 1030;
          overflow: visible;
        }
        .mvv-header-wrap,
        .mvv-nav { overflow: visible; }
        .mvv-nav-dropdown .mvv-dropdown-menu {
          top: calc(100% + 2px);
          left: 50%;
          right: auto;
          width: max-content;
          min-width: 250px;
          max-width: 320px;
          max-height: calc(100vh - 150px);
          padding: 10px;
          overflow-x: hidden;
          overflow-y: auto;
          overscroll-behavior: contain;
          background: rgba(255,255,255,0.99);
          border: 1px solid var(--mvv-line);
          border-radius: 16px;
          box-shadow: 0 22px 65px rgba(79,35,25,0.20);
          transform: translate(-50%, -8px);
          z-index: 2100;
        }
        .mvv-nav-dropdown:hover .mvv-dropdown-menu,
        .mvv-nav-dropdown:focus-within .mvv-dropdown-menu,
        .mvv-nav-dropdown.open .mvv-dropdown-menu {
          opacity: 1;
          visibility: visible;
          transform: translate(-50%, 0);
        }
        .mvv-dropdown-menu a {
          display: flex;
          align-items: center;
          gap: 10px;
          min-height: 40px;
          padding: 9px 11px;
          color: var(--mvv-ink);
          line-height: 1.35;
          white-space: normal;
        }
        .mvv-dropdown-menu a i {
          width: 18px;
          flex: 0 0 18px;
          color: var(--mvv-saffron);
          text-align: center;
        }
        .mvv-dropdown-menu a:hover,
        .mvv-dropdown-menu a:focus-visible {
          background: var(--mvv-cream);
          color: var(--mvv-maroon);
          outline: none;
        }
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
      <div class="mvv-topbar">
         <div class="container mvv-topbar-inner">
            <span><i class="bi bi-geo-alt"></i> Satara, Maharashtra, India</span>
            <div>
               <a href="tel:+919403550087"><i class="bi bi-telephone"></i> +91 94035 50087</a>
               <a href="mailto:info@shivrajmaratha.com"><i class="bi bi-envelope"></i> info@shivrajmaratha.com</a>
            </div>
         </div>
      </div>

      <!-- SITE HEADER -->
      <header class="mvv-header" id="mvvHeader">
         <div class="container mvv-header-wrap">
            <a class="mvv-brand" href="index" aria-label="Manpasand Jodidar Home">
               <img class="mvv-brand-img" src="<?php echo $smLogo; ?>" alt="Manpasand Jodidar Logo">
               <span class="mvv-brand-text">
                  <span class="mvv-brand-title">मनपसंद जोडीदार</span>
                  <span class="mvv-brand-subtitle">वधू वर सूचक केंद्र ®</span>
               </span>
            </a>

            <button class="mvv-menu-toggle" aria-expanded="false" aria-controls="mvvMainNav" aria-label="Open menu">
               <span></span><span></span><span></span>
            </button>

             <nav class="mvv-nav" id="mvvMainNav" aria-label="Main navigation">
               <a class="nav-link" href="index">Home</a>
               <a class="nav-link" href="about-us">About Us</a>

               <?php if (empty($_SESSION['MatriID'])) { ?>
               <div class="mvv-nav-dropdown">
                  <button type="button">Profiles <span class="mvv-drop-icon">⌄</span></button>
                  <div class="mvv-dropdown-menu">
                     <a href="public_profiles?gender=Male&amp;marital_status=Unmarried">Unmarried Grooms</a>
                     <a href="public_profiles?gender=Female&amp;marital_status=Unmarried">Unmarried Brides</a>
                     <a href="public_profiles?gender=Male&amp;marital_status=Divorced">Divorcee Grooms</a>
                     <a href="public_profiles?gender=Female&amp;marital_status=Divorced">Divorcee Brides</a>
                     <a href="public_profiles?gender=Male&amp;profile_type=NRI">NRI Grooms</a>
                     <a href="public_profiles?gender=Female&amp;profile_type=NRI">NRI Brides</a>
                  </div>
               </div>
               <?php } ?>

               <a class="nav-link" href="my_offer">Membership</a>
               <a class="nav-link" href="success_story">Success Stories</a>
               <a class="nav-link" href="contactus">Contact Us</a>

               <div class="mvv-nav-actions">
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
                  <a class="mvv-nav-btn mvv-nav-btn-outline" href="login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                  <a class="mvv-nav-btn mvv-nav-btn-primary" href="signup"><i class="bi bi-person-plus"></i> Register</a>
               <?php } else { ?>
                  <span class="mvv-user-badge"><i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($me['Name'] ?? ($_SESSION['Name'] ?? 'User')); ?></span>
                  <?php if (!$hideDashboardButton) { ?>
                  <a class="mvv-nav-btn mvv-nav-btn-primary" href="index_dashboard"><i class="bi bi-speedometer2"></i> My Dashboard</a>
                  <?php } ?>
                  <a class="mvv-nav-btn mvv-nav-btn-outline" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
               <?php } ?>
               </div>
            </nav>

            <button class="mvv-nav-backdrop" type="button" aria-label="Close menu" tabindex="-1"></button>
         </div>
      </header>
