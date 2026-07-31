<?php require_once('sys_dbconnection.php');
require_once('includes/partner_match.php');
/*include('dbconnectadmin.php');
session_start();*/

//error_reporting(0);
$data_config = $db->get_siteconfig();
$translator_on_off = $data_config-> translator_on_off;
$mvvLogo = 'css3/assets/manpasand-logo.png';
$smLogo = 'css3/assets/manpasand-logo.png';
$smLogoLocal = 'css3/assets/manpasand-logo.png';
?><style>
/* ══════════════════════════════════════════
   CRITICAL RESET — applied first to prevent any gap above header
   ══════════════════════════════════════════ */
* { margin: 0; padding: 0; }
html, body {
  margin: 0 !important;
  padding: 0 !important;
  top: 0 !important;
  position: static !important;
}
body > iframe.skiptranslate,
.goog-te-banner-frame,
.goog-te-banner-frame *,
iframe#goog-te-banner-frame,
.skiptranslate > iframe {
  display: none !important;
  height: 0 !important;
  min-height: 0 !important;
  max-height: 0 !important;
  visibility: hidden !important;
}
.goog-te-gadget {
    font-size: 10pt;
    transition: all 300ms ease;
    position: relative;
    text-align: center;
    font-family: arial;
    color: #666;
    white-space: nowrap;
}
.rowh { margin-right: 29px; }
</style>
<script>
document.addEventListener('keydown', function (e) {
    var keyCode = e.keyCode ? e.keyCode : e.which;
    if (keyCode == 44) { stopPrntScr(); }
});
function stopPrntScr() {
    var inpFld = document.createElement("input");
    inpFld.setAttribute("value", ".");
    inpFld.setAttribute("width", "0");
    inpFld.style.height = "0px";
    inpFld.style.width = "0px";
    inpFld.style.border = "0px";
    document.body.appendChild(inpFld);
    inpFld.select();
    document.execCommand("copy");
    inpFld.remove(inpFld);
}
function AccessClipboardData() {
    try { window.clipboardData.setData('text', "Access Restricted"); } catch (err) {}
}
setInterval("AccessClipboardData()", 300);
</script>

<?php
$id = $_GET['id'] ?? '';
$login = $_SESSION['MatriID'] ?? $_SESSION['matriid'] ?? null;
$me = [];
if($login) {
  $my_profile = mysqli_query($con,"SELECT *,date_format(DOB,'%d-%M-%Y') as DOB FROM register where matriid='$login'");
  $me = mysqli_fetch_array($my_profile) ?: [];
}
$regvar = $me['reg_step'] ?? '';
$partner100Count = 0;
if ($login && $regvar === '9') {
  $partnerCountCache = $_SESSION['_partner_100_count'][$login] ?? null;
  if (is_array($partnerCountCache) && ($partnerCountCache['time'] ?? 0) > time() - 60) {
    $partner100Count = (int)$partnerCountCache['count'];
  } else {
    $partner100Count = partner_match_count_100($con, $me);
    $_SESSION['_partner_100_count'][$login] = ['time'=>time(), 'count'=>$partner100Count];
  }
}
if ($id === '' && $login && $regvar != '9') {
  $id = $login;
}
?>

<!-- Bootstrap 5 + Google Fonts + Icons -->
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Manrope:wght@300;400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="css3/manpasand-design-system.css">

<style>
/* =============================================
   SHIVRAJ MARATHA DESIGN SYSTEM — Header (merged)
   Inspired by both legacy & template
============================================= */
:root {
  --mvv-saffron:      #E94E77;
  --mvv-saffron-dark: #C43A60;
  --mvv-maroon:       #6A1037;
  --mvv-maroon-dark:  #4A0A25;
  --mvv-gold:         #C89B3C;
  --mvv-gold-light:   #E0BD6A;
  --mvv-cream:        #FFF9F6;
  --mvv-cream-2:      #FFF0EA;
  --mvv-ink:          #222222;
  --mvv-muted:        #666666;
  --mvv-white:        #FFFFFF;
  --mvv-line:         rgba(106,16,55,0.08);
  --mvv-shadow:       0 20px 60px rgba(106,16,55,0.12);
  --mvv-radius:       22px;
  --mvv-radius-sm:    12px;
  --mvv-font:         'Poppins', 'Inter', 'Noto Sans Devanagari', sans-serif;
  --mvv-display:      'Playfair Display', Georgia, serif;
  --mvv-deva:         'Noto Sans Devanagari', sans-serif;

  --saffron:        #E94E77;
  --saffron-light:  #F47B9A;
  --saffron-glow:   #F47B9A;
  --deep-maroon:    #6A1037;
  --maroon:         #8B1A4A;
  --cream:          #FFF9F6;
  --gold:           #C89B3C;
  --gold-light:     #E0BD6A;
  --dark:           #1A0A00;
  --text-main:      #222222;
  --text-muted:     #666666;
  --border-warm:    rgba(200,155,60,0.25);
  --gradient-hero:  linear-gradient(135deg, #6A1037 0%, #8B1A4A 40%, #E94E77 100%);
  --gradient-card:  linear-gradient(145deg, #FFF9F6 0%, #FFF0EA 100%);
  --shadow-warm:    0 8px 40px rgba(106,16,55,0.18);
  --shadow-card:    0 4px 24px rgba(200,155,60,0.12);
}

*, *::before, *::after { box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
  font-family: var(--mvv-font);
  background: var(--mvv-cream);
  color: var(--mvv-ink);
  line-height: 1.65;
  overflow-x: clip;
}

body.menu-open { overflow: hidden; }
body.mvv-padded-header { padding-top: 86px !important; }

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
.mvv-nav-btn-primary:hover { box-shadow: 0 6px 20px rgba(200,130,50,0.5); }

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
.mvv-nav-btn-gold:hover { box-shadow: 0 6px 20px rgba(200,130,50,0.5); }

/* ─── MOBILE TOGGLE ─── */
.mvv-menu-toggle {
  display: none;
  position: relative;
  z-index: 103;
  width: 36px;
  height: 36px;
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
.mvv-nav-backdrop { display: none; }

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

/* ─── NAVBAR OUTER (gradient wrapper) ─── */
.navbar-outer,
.mvv-navbar-outer {
  background: linear-gradient(135deg, var(--mvv-maroon-dark) 0%, var(--mvv-maroon) 40%, var(--mvv-saffron) 100%);
  position: relative;
  overflow: hidden;
  margin: 0 !important;
  padding-top: 0 !important;
}
.navbar-outer::before,
.mvv-navbar-outer::before {
  content: '';
  position: absolute; inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  pointer-events: none;
}
.navbar-outer::after,
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

/* ─── BADGE COUNTS ─── */
.nav-badge {
  display: inline-block;
  background: linear-gradient(135deg, var(--gold), var(--saffron-glow));
  color: var(--deep-maroon);
  font-weight: 700; font-size: 0.68rem;
  border-radius: 20px;
  padding: 1px 7px;
  margin-left: 4px;
  line-height: 1.5;
  vertical-align: middle;
}

/* ─── LEGACY CTA BUTTONS (keep for backward compat) ─── */
.btn-nav-primary {
  background: linear-gradient(135deg, var(--gold) 0%, var(--saffron-glow) 100%);
  color: var(--deep-maroon) !important;
  font-weight: 700; font-size: 0.84rem;
  border: none; border-radius: 24px;
  padding: 7px 20px;
  letter-spacing: 0.04em;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 3px 12px rgba(200,130,50,0.35);
  text-decoration: none;
  font-family: var(--mvv-font);
  white-space: nowrap;
}
.btn-nav-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(200,130,50,0.5);
  color: var(--deep-maroon) !important;
}
.btn-nav-outline {
  background: transparent;
  color: #fff !important;
  font-weight: 600; font-size: 0.84rem;
  border: 1.5px solid rgba(255,255,255,0.5);
  border-radius: 24px; padding: 6px 18px;
  letter-spacing: 0.04em;
  transition: all 0.2s;
  text-decoration: none;
  font-family: var(--mvv-font);
  white-space: nowrap;
}
.btn-nav-outline:hover {
  background: rgba(255,255,255,0.12);
  border-color: #fff;
  color: #fff !important;
}

/* ─── WELCOME STRIP (incomplete registration) ─── */
.welcome-strip {
  display: flex; align-items: center; gap: 12px;
  color: rgba(255,255,255,0.9);
  font-family: var(--mvv-font); font-size: 0.9rem;
}
.welcome-strip .welcome-label { color: var(--gold-light); font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; }
.welcome-strip .welcome-name { font-weight: 700; font-size: 1rem; color: #fff; }

/* ─── ID SEARCH POPUP ─── */

/* ══════════════════════════════════════════
   GLOBAL UI FIXES — applied site-wide
══════════════════════════════════════════ */

.header-span,
span.header-span {
  height: 0 !important;
  display: block !important;
  margin: 0 !important;
  padding: 0 !important;
  line-height: 0 !important;
  font-size: 0 !important;
  overflow: hidden !important;
}

.preloader { display: none !important; }

.navbar-outer .dropdown-menu,
nav .dropdown-menu,
.nav-item .dropdown-menu,
.mvv-dropdown-menu {
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  margin-top: 2px !important;
  z-index: 9999 !important;
}

.navbar-outer,
nav.navbar,
.navbar-collapse,
.nav-item {
  overflow: visible !important;
}

.nav-link-custom,
.nav-link,
.navbar-nav .nav-link {
  text-decoration: none !important;
}

.page-wrapper { overflow: visible !important; }

.mvv-breadcrumb {
  font-size: 0.88rem !important;
  padding: 8px 14px !important;
}

.mvv-page { padding-top: 0 !important; }
.navbar-outer + main.mvv-page,
main.mvv-page { padding-top: 0 !important; }
.navbar-outer + main.mvv-page > .mvv-section:first-child,
main.mvv-page > .mvv-section:first-child { padding-top: 0 !important; }

.contact-form select,
.contact-form .form-group select {
  width: 100%;
  min-height: 46px;
  border: 1px solid var(--mvv-border, #e0d5cb);
  border-radius: 9px;
  padding: 0 14px;
  font-size: 0.94rem;
  background: #fff;
  color: var(--mvv-text, #3A2A22);
  appearance: auto;
  -webkit-appearance: auto;
}
.contact-form select:focus,
.contact-form .form-group select:focus {
  border-color: var(--mvv-gold, #D4A437);
  outline: none;
  box-shadow: 0 0 0 4px rgba(212,164,55,0.13);
}

/* ─── RESPONSIVE ─── */
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

@media (max-width: 1000px) {
  body { padding-top: 74px !important; }
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

  .dropdown-menu { position: static !important; transform: none !important; background: rgba(255,255,255,0.06) !important; border: none !important; box-shadow: none !important; border-radius: 6px !important; padding: 2px 0 2px 12px !important; }
  .dropdown-item { font-size: 0.82rem !important; padding: 7px 12px !important; }
  .nav-actions { padding: 12px 0 6px; }
}

@media (max-width: 768px) {
  .mvv-breadcrumb { font-size: 0.82rem !important; padding: 6px 12px !important; }
  .mvv-page-hero { min-height: 300px !important; padding: 50px 0 !important; }
  .mvv-page-hero h1 { font-size: clamp(1.6rem, 5vw, 2.2rem) !important; }
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

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    scroll-behavior: auto !important;
    transition: none !important;
    animation: none !important;
  }
}

/* Header3 visual parity: cream navigation across every authentication state. */
.navbar-outer.mvv-navbar-outer {
  background: var(--mvv-cream) !important;
  overflow: visible;
  position: relative;
  z-index: 1030;
}
.navbar-outer.mvv-navbar-outer::before,
.navbar-outer.mvv-navbar-outer::after { display: none !important; }
.mvv-navbar-outer .mvv-header,
.mvv-navbar-outer .mvv-header.scrolled {
  background: rgba(255, 249, 240, 0.97) !important;
  -webkit-backdrop-filter: blur(16px);
  backdrop-filter: blur(16px);
  border-bottom-color: var(--mvv-line) !important;
}
.mvv-navbar-outer .mvv-header.scrolled {
  background: rgba(255, 255, 255, 0.98) !important;
}
.mvv-navbar-outer .mvv-brand-title { color: var(--mvv-maroon) !important; }
.mvv-navbar-outer .mvv-brand-subtitle { color: var(--mvv-muted) !important; }
.mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn),
.mvv-navbar-outer .mvv-nav-dropdown > button { color: #49393a !important; }
.mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn):hover,
.mvv-navbar-outer .mvv-nav-dropdown > button:hover,
.mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn).active { color: var(--mvv-saffron) !important; }
.mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn)::after,
.mvv-navbar-outer .mvv-nav-dropdown > button::after { background: var(--mvv-saffron) !important; }
.mvv-navbar-outer .mvv-menu-toggle {
  background: rgba(107, 26, 26, 0.08) !important;
}
.mvv-navbar-outer .mvv-menu-toggle span { background: var(--mvv-maroon) !important; }
.mvv-navbar-outer .welcome-strip .welcome-label { color: var(--mvv-saffron) !important; }
.mvv-navbar-outer .welcome-strip .welcome-name { color: var(--mvv-maroon) !important; }
.mvv-navbar-outer .mvv-nav-btn-light {
  background: transparent;
  color: var(--mvv-maroon) !important;
  border-color: rgba(107, 26, 26, 0.30);
}
.mvv-navbar-outer .mvv-nav-btn-light:hover {
  background: rgba(107, 26, 26, 0.06);
  border-color: var(--mvv-maroon);
}
@media (max-width: 1000px) {
  .mvv-navbar-outer .mvv-nav { background: #fff !important; }
  .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn),
  .mvv-navbar-outer .mvv-nav-dropdown > button {
    color: #49393a !important;
    border-bottom-color: var(--mvv-line) !important;
  }
  .mvv-navbar-outer .mvv-nav > a:not(.mvv-nav-btn).active {
    background: rgba(232, 97, 42, 0.08) !important;
    color: var(--mvv-saffron) !important;
  }
  .mvv-navbar-outer .mvv-nav-actions { border-top-color: var(--mvv-line) !important; }
  .mvv-navbar-outer .mvv-dropdown-menu { background: var(--mvv-cream) !important; }
  .mvv-navbar-outer .mvv-dropdown-menu a { color: var(--mvv-ink) !important; }
  .mvv-navbar-outer .mvv-dropdown-menu a:hover {
    background: var(--mvv-cream-2) !important;
    color: var(--mvv-saffron) !important;
  }
}

/* Desktop dropdown layer and presentation. */
@media (min-width: 1001px) {
  .mvv-header,
  .mvv-header-wrap,
  .mvv-nav { overflow: visible; }
  .mvv-header { position: relative; z-index: 2; }
  .mvv-nav-dropdown { position: relative; }
  .mvv-nav-dropdown .mvv-dropdown-menu {
    top: calc(100% + 2px);
    left: 50%;
    right: auto;
    width: max-content;
    min-width: 250px;
    max-width: 330px;
    max-height: calc(100vh - 150px);
    padding: 10px;
    overflow-x: hidden;
    overflow-y: auto;
    overscroll-behavior: contain;
    background: rgba(255,255,255,0.99) !important;
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
  .mvv-nav-dropdown:nth-last-child(2) .mvv-dropdown-menu {
    right: 0;
    left: auto;
    transform: translateY(-8px);
  }
  .mvv-nav-dropdown:nth-last-child(2):hover .mvv-dropdown-menu,
  .mvv-nav-dropdown:nth-last-child(2):focus-within .mvv-dropdown-menu,
  .mvv-nav-dropdown:nth-last-child(2).open .mvv-dropdown-menu {
    transform: translateY(0);
  }
  .mvv-dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 40px;
    padding: 9px 11px;
    color: var(--mvv-ink) !important;
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
    background: var(--mvv-cream) !important;
    color: var(--mvv-maroon) !important;
    outline: none;
  }
  .mvv-dropdown-menu hr {
    margin: 6px 8px !important;
    border: 0;
    border-top: 1px solid var(--mvv-line) !important;
    opacity: 1;
  }
  .mvv-dropdown-menu .nav-badge {
    min-width: 22px;
    height: 22px;
    margin-left: auto;
    padding: 0 6px;
    display: inline-grid;
    place-items: center;
    flex: 0 0 auto;
    border-radius: 999px;
    background: var(--mvv-gold);
    color: var(--mvv-maroon-dark);
    font-size: 11px;
    font-weight: 800;
  }
  .mvv-dropdown-menu::-webkit-scrollbar { width: 5px; }
  .mvv-dropdown-menu::-webkit-scrollbar-track { background: transparent; }
  .mvv-dropdown-menu::-webkit-scrollbar-thumb {
    background: rgba(107,26,26,0.25);
    border-radius: 999px;
  }
}

/* Shared About-style breadcrumb hero for legacy account/search pages. */
.mvv-page-hero {
  position: relative !important;
  isolation: auto !important;
  min-height: auto !important;
  display: block !important;
  padding: 72px 0 !important;
  overflow: hidden;
  color: var(--mvv-ink) !important;
  background:
    radial-gradient(circle at 80% 30%, rgba(232, 97, 42, 0.14), transparent 30%),
    var(--mvv-cream) !important;
  border-bottom: 1px solid var(--mvv-line);
}
.mvv-page-hero::before,
.mvv-page-hero::after { display: none !important; }
.mvv-page-hero .mvv-container {
  position: relative;
  z-index: 1;
  width: min(1180px, calc(100% - 40px));
  margin-inline: auto;
  padding-right: 0 !important;
  text-align: left !important;
}
.mvv-page-hero .mvv-eyebrow {
  display: inline-block;
  color: var(--mvv-saffron) !important;
  font-size: 11px;
  font-weight: 800;
  line-height: 1.4;
  letter-spacing: 0.15em;
  text-transform: uppercase;
}
.mvv-page-hero h1 {
  max-width: none !important;
  margin: 8px 0 !important;
  color: var(--mvv-maroon) !important;
  font: 700 clamp(36px, 5vw, 58px)/1.2 var(--mvv-deva) !important;
  text-align: left !important;
  opacity: 1 !important;
}
.mvv-page-hero p {
  max-width: 720px;
  margin: 6px 0 0 !important;
  color: var(--mvv-muted) !important;
  font-size: 15px;
  line-height: 1.65;
  text-align: left !important;
}
.mvv-page-hero .mvv-breadcrumb {
  display: flex !important;
  align-items: center;
  flex-wrap: wrap;
  gap: 9px;
  width: auto;
  margin: 10px 0 0 !important;
  padding: 0 !important;
  background: transparent !important;
  border: 0 !important;
  border-radius: 0 !important;
  color: var(--mvv-muted) !important;
  font-size: 13px;
  text-align: left !important;
}
.mvv-page-hero .mvv-breadcrumb a {
  display: inline-flex;
  align-items: center;
  color: var(--mvv-saffron) !important;
  text-decoration: none;
}
.mvv-page-hero .mvv-breadcrumb a::after {
  content: '›';
  margin-left: 9px;
  color: var(--mvv-muted);
}
.mvv-page-hero .mvv-breadcrumb span { color: var(--mvv-muted) !important; }
@media (max-width: 700px) {
  .mvv-page-hero { padding: 50px 0 !important; }
  .mvv-page-hero .mvv-container { width: min(100% - 28px, 1180px); }
  .mvv-page-hero h1 { font-size: clamp(32px, 10vw, 42px) !important; }
}
</style>

<?php if(isset($login) && $regvar=='9') { ?>

<?php /* ---- mutual matches count ---- */
$hobbies=explode(",",$me['Looking']);
$pe_from_height = $me['PE_from_Height'];
$pe_to_height = $me['PE_to_Height'];
$pe_toage = $me['PE_ToAge'];
$pe_fromage = $me['PE_FromAge'];
$PE_Complexion=$me['PE_Complexion'];
$PE_Education=$me['PE_Education'];
$PE_star=$me['PE_star'];
$Residencystatus=$me['Residencystatus'];
$pe_religion=$me['PE_Religion'];
$Country=$me['Country'];
$pe_caste = $me['PE_Caste'];
$PE_subcaste=$me['PE_subcaste'];
if($me['Gender']=='Male') $match_sex = "Female";
if($me['Gender']=='Female') $match_sex = "Male";
$check=mysqli_query($con,"select matriid from block_member where profile_id='".$_SESSION['matriid']."'");
$data1=array();
while($check1=mysqli_fetch_array($check)) { $data1[]=$check1['matriid']; }
$matriid=implode("','",$data1);
$check2=mysqli_query($con,"select profile_id from block_member where matriid='".$_SESSION['matriid']."'");
$data = array();
while($check3=mysqli_fetch_array($check2)) { $data[] = $check3['profile_id']; }
$profile=implode("','", $data);
$match_qry_count="select COUNT(*) as totalCount from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$login' AND ";
if($profile!="") { $match_qry_count.=" MatriID NOT IN ('$profile') and "; }
if($matriid!="") { $match_qry_count.=" MatriID NOT IN ('$matriid') and "; }
if($me['Looking']!="" && $me['Looking']!="Any") {
    $PE_Religion_look=explode(" , ", $me['Looking']);
    $PE_Religion_look1 = array();
    foreach($PE_Religion_look as $row => $value){ $PE_Religion_look1[] = "'$value'"; }
    $PE_Religion_look12 = implode(',', $PE_Religion_look1);
    $match_qry_count.="Maritalstatus IN($PE_Religion_look12) AND";
}
$match_qry_count.=" Gender='$match_sex' AND ";
$match_qry_count.=" Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$match_qry_count.=" Age BETWEEN '$pe_fromage' AND '$pe_toage'";
if($me['PE_MotherTongue']!="" && $me['PE_MotherTongue']!="Any") {
    $PE_mother=explode(",", $me['PE_MotherTongue']);
    $terms = array();
    foreach($PE_mother as $row => $value){ $terms[] = "'$value'"; }
    $term_str = implode(',', $terms);
    $mother_a=explode(",", $me['mother_tounge']);
    $terms_a = array();
    foreach($mother_a as $row => $value){ $terms_a[] = "'$value'"; }
    $match_qry_count.=" and '$terms_a' IN($term_str)";
}
if($me['PE_star']!="" && $me['PE_star']!="Any") {
    $PE_star_exp=explode(",", $me['PE_star']); $PE_star_term = array();
    foreach($PE_star_exp as $row => $value){ $PE_star_term[] = "'$value'"; }
    $PE_star_re = implode(',', $PE_star_term);
    $match_qry_count.=" and Star IN($PE_star_re) ";
}
if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any") {
    $PE_Complexion_exp=explode(",", $me['PE_Complexion']); $PE_Complexion_term = array();
    foreach($PE_Complexion_exp as $row => $value){ $PE_Complexion_term[] = "'$value'"; }
    $PE_Complexion_re = implode(',', $PE_Complexion_term);
    $match_qry_count.=" and Complexion IN($PE_Complexion_re) ";
}
if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any") {
    $PE_Residentstatus_exp=explode(",",$me['PE_Residentstatus']); $PE_Residentstatus_term=array();
    foreach($PE_Residentstatus_exp as $row=>$value){ $PE_Residentstatus_term[]="'$value'"; }
    $PE_Residentstatus_re=implode(',',$PE_Residentstatus_term);
    $match_qry_count.=" and Residencystatus IN($PE_Residentstatus_re)";
}
if($me['PE_Religion']!="" && $me['PE_Religion']!="Any") {
    $PE_Religion_exp=explode(",",$me['PE_Religion']); $PE_Religion_term=array();
    foreach($PE_Religion_exp as $row=>$value){ $PE_Religion_term[]="'$value'"; }
    $PE_Religion_re=implode(',',$PE_Religion_term);
    $match_qry_count.=" and Religion IN($PE_Religion_re)";
}
if($me['PE_Caste']!="" && $me['PE_Caste']!="Any") {
    $PE_Caste_exp=explode(",",$me['PE_Caste']); $PE_Caste_term=array();
    foreach($PE_Caste_exp as $row=>$value){ $PE_Caste_term[]="'$value'"; }
    $PE_Caste_re=implode(',',$PE_Caste_term);
    $match_qry_count.=" and Caste IN($PE_Caste_re)";
}
if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any") {
    $PE_Countrylivingin_exp=explode(",",$me['PE_Countrylivingin']); $PE_Countrylivingin_term=array();
    foreach($PE_Countrylivingin_exp as $row=>$value){ $PE_Countrylivingin_term[]="'$value'"; }
    $PE_Countrylivingin_re=implode(',',$PE_Countrylivingin_term);
    $match_qry_count.=" and Country IN($PE_Countrylivingin_re)";
}
if($me['PE_State']!="" && $me['PE_State']!="Any") {
    $PE_State_exp=explode(",",$me['PE_State']); $PE_State_term=array();
    foreach($PE_State_exp as $row=>$value){ $PE_State_term[]="'$value'"; }
    $PE_State_re=implode(',',$PE_State_term);
    $match_qry_count.=" and State IN($PE_State_re)";
}
if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any") {
    $PE_occu_exp=explode(",",$me['PE_Occupation']); $PE_occu_term=array();
    foreach($PE_occu_exp as $row=>$value){ $PE_occu_term[]="'$value'"; }
    $PE_occu_re=implode(',',$PE_occu_term);
    $match_qry_count.=" and Occupation IN($PE_occu_re)";
}
if($me['PE_Education']!="" && $me['PE_Education']!="Any") {
    $PE_Education_exp=explode(",",$me['PE_Education']); $PE_Education_term=array();
    foreach($PE_Education_exp as $row=>$value){ $PE_Education_term[]="'$value'"; }
    $PE_Education_re=implode(',',$PE_Education_term);
    $match_qry_count.=" and Education IN($PE_Education_re)";
}
$match_qry_count.="and Status Not LIKE'Banned' ORDER BY Regdate DESC";
$match_querysql=mysqli_query($con,$match_qry_count);
$match_queryfetch=mysqli_fetch_array($match_querysql);
/* ---- end mutual matches ---- */

/* ---- latest matches count ---- */
$latestmatchesqry="select COUNT(*) as totalCountlatestmatch from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$login' AND Regdate > DATE_SUB( NOW( ),INTERVAL 2 DAY) AND ";
if($profile!="") { $latestmatchesqry.=" MatriID NOT IN ('$profile') and "; }
if($login!="") { $latestmatchesqry.=" MatriID NOT IN ('$login') and "; }
if($me['Looking']!="" && $me['Looking']!="Any") {
    $PE_Religion_look=explode(" , ", $me['Looking']); $PE_Religion_look1 = array();
    foreach($PE_Religion_look as $row => $value){ $PE_Religion_look1[] = "'$value'"; }
    $PE_Religion_look12 = implode(',', $PE_Religion_look1);
    $latestmatchesqry.="Maritalstatus IN($PE_Religion_look12) AND";
}
$latestmatchesqry.=" Gender='$match_sex' AND ";
$latestmatchesqry.=" Height BETWEEN '$pe_from_height'AND'$pe_to_height' AND ";
$latestmatchesqry.=" Age BETWEEN '$pe_fromage' AND '$pe_toage'";
if($me['PE_Religion']!="" && $me['PE_Religion']!="Any") {
    $PE_Religion_exp=explode(",", $me['PE_Religion']); $PE_Religion_term = array();
    foreach($PE_Religion_exp as $row => $value){ $PE_Religion_term[] = "'$value'"; }
    $PE_Religion_re = implode(',', $PE_Religion_term);
    $latestmatchesqry.=" and Religion IN($PE_Religion_re) ";
}
if($me['PE_Complexion']!="" && $me['PE_Complexion']!="Any") {
    $PE_Complexion_exp=explode(",", $me['PE_Complexion']); $PE_Complexion_term = array();
    foreach($PE_Complexion_exp as $row => $value){ $PE_Complexion_term[] = "'$value'"; }
    $PE_Complexion_re = implode(',', $PE_Complexion_term);
    $latestmatchesqry.=" and Complexion IN($PE_Complexion_re) ";
}
if($me['PE_star']!="" && $me['PE_star']!="Any") {
    $PE_star_exp=explode(",", $me['PE_star']); $PE_star_term = array();
    foreach($PE_star_exp as $row => $value){ $PE_star_term[] = "'$value'"; }
    $PE_star_re = implode(',', $PE_star_term);
    $latestmatchesqry.=" and Star IN($PE_star_re) ";
}
if($me['PE_Caste']!="" && $me['PE_Caste']!="Any") {
    $PE_Caste_exp=explode(",",$me['PE_Caste']); $PE_Caste_term=array();
    foreach($PE_Caste_exp as $row=>$value){ $PE_Caste_term[]="'$value'"; }
    $PE_Caste_re=implode(',',$PE_Caste_term);
    $latestmatchesqry.=" and Caste IN ($PE_Caste_re)";
}
if($me['PE_subcaste']!="" && $me['PE_subcaste']!="Any") {
    $PE_subCaste_exp=explode(",",$me['PE_subcaste']); $PE_subCaste_term=array();
    foreach($PE_subCaste_exp as $row=>$value){ $PE_subCaste_term[]="'$value'"; }
    $PE_subCaste_re=implode(',',$PE_subCaste_term);
    $latestmatchesqry.=" and Subcaste IN ($PE_subCaste_re)";
}
if($me['PE_Residentstatus']!="" && $me['PE_Residentstatus']!="Any") {
    $PE_Residentstatus_exp=explode(",",$me['PE_Residentstatus']); $PE_Residentstatus_term=array();
    foreach($PE_Residentstatus_exp as $row=>$value){ $PE_Residentstatus_term[]="'$value'"; }
    $PE_Residentstatus_re=implode(',',$PE_Residentstatus_term);
    $latestmatchesqry.=" and Residencystatus IN($PE_Residentstatus_re)";
}
if($me['PE_MotherTongue']!="" && $me['PE_MotherTongue']!="Any") {
    $array=explode(",", $me['PE_MotherTongue']); $terms = array();
    foreach($array as $row => $value){ $terms[] = "'$value'"; }
    $term_str = implode(',', $terms);
    $latestmatchesqry.=" and mother_tounge IN($term_str)";
}
if($me['PE_Countrylivingin']!="" && $me['PE_Countrylivingin']!="Any") {
    $PE_Countrylivingin_exp=explode(",",$me['PE_Countrylivingin']); $PE_Countrylivingin_term=array();
    foreach($PE_Countrylivingin_exp as $row=>$value){ $PE_Countrylivingin_term[]="'$value'"; }
    $PE_Countrylivingin_re=implode(',',$PE_Countrylivingin_term);
    $latestmatchesqry.=" and Country IN($PE_Countrylivingin_re)";
}
if($me['PE_State']!="" && $me['PE_State']!="Any") {
    $PE_State_exp=explode(",",$me['PE_State']); $PE_State_term=array();
    foreach($PE_State_exp as $row=>$value){ $PE_State_term[]="'$value'"; }
    $PE_State_re=implode(',',$PE_State_term);
    $latestmatchesqry.=" and State IN($PE_State_re)";
}
if($me['PE_Occupation']!="" && $me['PE_Occupation']!="Any") {
    $PE_occu_exp=explode(",",$me['PE_Occupation']); $PE_occu_term=array();
    foreach($PE_occu_exp as $row=>$value){ $PE_occu_term[]="'$value'"; }
    $PE_occu_re=implode(',',$PE_occu_term);
    $latestmatchesqry.=" and Occupation IN($PE_occu_re)";
}
if($me['PE_Education']!="" && $me['PE_Education']!="Any") {
    $PE_Education_exp=explode(",",$me['PE_Education']); $PE_Education_term=array();
    foreach($PE_Education_exp as $row=>$value){ $PE_Education_term[]="'$value'"; }
    $PE_Education_re=implode(',',$PE_Education_term);
    $latestmatchesqry.=" and Education IN($PE_Education_re)";
}
$latestmatchesqry.="and Status Not LIKE'Banned' ORDER BY Regdate DESC";
$latestmatchesquery=mysqli_query($con,$latestmatchesqry);
$latestmatchesfetch=mysqli_fetch_array($latestmatchesquery);
/* ---- end latest matches ---- */

/* ---- premium members count ---- */
$religion=$me['Religion']; $caste=$me['Caste']; $Subcaste=$me['Subcaste']; $Maritalstatus=$me['Maritalstatus'];
if($me['Gender']=='Male') $match_sex = "Female";
if($me['Gender']=='Female') $match_sex = "Male";
$check=mysqli_query($con,"select matriid from block_member where profile_id='".$_SESSION['matriid']."'");
$data1=array();
while($check1=mysqli_fetch_array($check)){ $data1[]=$check1['matriid']; }
$matriid=implode("','",$data1);
$check2=mysqli_query($con,"select profile_id from block_member where matriid='".$_SESSION['matriid']."'");
$data = array();
while($check3=mysqli_fetch_array($check2)){ $data[] = $check3['profile_id']; }
$profile=implode("','", $data);
$premiummembersquery="select COUNT(*) as totalCountpremiummembers from register where visibility NOT LIKE 'hidden' AND MatriID NOT LIKE '$login' AND Status LIKE 'Paid' AND";
$premiummembersquery.=" Gender='$match_sex' AND ";
if($profile!="") { $premiummembersquery.=" MatriID NOT IN ('$profile') AND "; }
if($matriid!="") { $premiummembersquery.=" MatriID NOT IN ('$matriid') AND "; }
if($religion!="") { $premiummembersquery.=" Religion='$religion' AND "; }
if($caste!="") { $premiummembersquery.=" Caste='$caste' and "; }
if($Maritalstatus!="") { $premiummembersquery.=" Maritalstatus='$Maritalstatus'"; }
$premiummembersquery.=" ORDER BY Regdate DESC";
$premium_membersqry=mysqli_query($con,$premiummembersquery);
$premium_membersfetch=mysqli_fetch_array($premium_membersqry);
/* ---- end premium members ---- */

/* ---- compatibility matches count ---- */
$matriid=$_SESSION['MatriID'];
$logincom=mysqli_query($con,"select * from compatibility where MatriID ='$matriid'");
$mecom=mysqli_fetch_array($logincom);
$login_profile=mysqli_query($con,"select * from compatibility where MatriID NOT LIKE '$matriid'");
while($compatibilityProfile=mysqli_fetch_array($login_profile)){
    $matid=$compatibilityProfile['MatriID'];
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que1']!="" && $mecom['que1']!="NULL"){ $answer1=$mecom['que1']; }
    $looking.=" and que1='$answer1'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot1=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que2']!="" && $mecom['que2']!="NULL"){ $answer2=$mecom['que2']; }
    $looking.=" and que2='$answer2'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot2=mysqli_num_rows($lokingcheck)>=1) {} else {}
    if($mecom['que3']!="" && $mecom['que3']!="NULL"){
        $looking="select * from compatibility where MatriID='$matid'";
        $PE_star_exp=explode(",", $mecom['que3']); $PE_star_term = array();
        $query = mysqli_query($con,"SELECT que3 ,MatriID FROM compatibility ");
        while($row = mysqli_fetch_assoc($query)){
            $look=explode(",",$row['que3']);
            $result1 = array_intersect($PE_star_exp, $look);
            if(count($result1)>0){ $getMatchMembersarray[] = $row['MatriID']; }
        }
        $lookingmembers=implode("','",$getMatchMembersarray);
        $looking.="AND MatriID IN('$lookingmembers') ";
    }
    $lokingcheck=mysqli_query($con,$looking);
    if($tot3=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que4']!="" && $mecom['que4']!="NULL"){ $answer4=$mecom['que4']; }
    $looking.=" and que4='$answer4'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot4=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que5']!="" && $mecom['que5']!="NULL"){ $answer5=$mecom['que5']; }
    $looking.=" and que5='$answer5'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot5=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que6']!="" && $mecom['que6']!="NULL"){ $answer6=$mecom['que6']; }
    $looking.=" and que6='$answer6'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot6=mysqli_num_rows($lokingcheck)>=1) {} else {}
    if($mecom['que7']!="" && $mecom['que7']!="NULL"){
        $looking="select * from compatibility where MatriID='$matid'";
        $PE_star_exp=explode(",", $mecom['que7']); $PE_star_term = array();
        $query = mysqli_query($con,"SELECT que7 ,MatriID FROM compatibility ");
        while($row = mysqli_fetch_assoc($query)){
            $look=explode(",",$row['que7']);
            $result1 = array_intersect($PE_star_exp, $look);
            if(count($result1)>0){ $getMatchMembersarray[] = $row['MatriID']; }
        }
        $lookingmembers=implode("','",$getMatchMembersarray);
        $looking.="AND MatriID IN('$lookingmembers') ";
    }
    $lokingcheck=mysqli_query($con,$looking);
    if($tot7=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que8']!="" && $mecom['que8']!="NULL"){ $answer8=$mecom['que8']; }
    $looking.=" and que8='$answer8'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot8=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que9']!="" && $mecom['que9']!="NULL"){ $answer9=$mecom['que9']; }
    $looking.=" and que9='$answer9'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot9=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $looking="select * from compatibility where MatriID = '$matid' ";
    if($mecom['que10']!="" && $mecom['que10']!="NULL"){ $answer10=$mecom['que10']; }
    $looking.=" and que10='$answer10'";
    $lokingcheck=mysqli_query($con,$looking);
    if($tot10=mysqli_num_rows($lokingcheck)>=1) {} else {}
    $totcount=$tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10;
    if($totcount>=5){
        $matriid=$_SESSION['MatriID'];
        $my_profilec = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
        $mec = mysqli_fetch_array($my_profilec);
        $religion=$mec['Religion']; $caste = $mec['Caste']; $age = $mec['Age']; $height = $mec['Height'];
        if($mec['Gender']=='Male') $match_sex = "Female";
        if($mec['Gender']=='Female') $match_sex = "Male";
        $items[] = $matid;
        $item=implode("','",$items);
    }
}
$limit = 8;
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;
$matriid=$_SESSION['MatriID'];
$my_profilec = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
$meco = mysqli_fetch_array($my_profilec);
$religion=$meco['Religion']; $caste = $meco['Caste']; $age = $meco['Age']; $height = $meco['Height'];
if($meco['Gender']=='Male') $match_sex = "Female";
if($meco['Gender']=='Female') $match_sex = "Male";
$check=mysqli_query($con,"select matriid from block_member where profile_id='$matriid'");
$data1=array(); while($check1=mysqli_fetch_array($check)){ $data1[]=$check1['matriid']; }
$matriid1=implode("','",$data1);
$check2=mysqli_query($con,"select profile_id from block_member where matriid='$matriid'");
$data = array(); while($check3=mysqli_fetch_array($check2)){ $data[] = $check3['profile_id']; }
$profile=implode("','", $data);
$final="Select * from register where MatriID In ('".$item."') and visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$matriid' and ";
if($profile!="") { $final.=" MatriID NOT IN ('$profile') and "; }
if($matriid1!="") { $final.=" MatriID NOT IN ('$matriid1') and "; }
$final.=" Gender='$match_sex' AND ";
$final.=" Religion='$religion' AND ";
$final.=" Caste='$caste' AND ";
if($me['Gender']=='Male'){ $final.=" age<='$age' and Height<='$height' "; } else { $final.=" age>='$age' and Height>='$height' "; }
$final.="ORDER BY Regdate DESC LIMIT $start_from,$limit";
$sqlview=mysqli_query($con,$final);
$matriid=$_SESSION['MatriID'];
$my_profilecom = mysqli_query($con,"SELECT * from register where matriid='$matriid'");
$mecomp = mysqli_fetch_array($my_profilecom);
$religion=$mecomp['Religion']; $caste = $mecomp['Caste']; $age = $mecomp['Age']; $height = $mecomp['Height'];
if($mecomp['Gender']=='Male') $match_sex = "Female";
if($mecomp['Gender']=='Female') $match_sex = "Male";
$check=mysqli_query($con,"select matriid from block_member where profile_id='$matriid'");
$data1=array(); while($check1=mysqli_fetch_array($check)){ $data1[]=$check1['matriid']; }
$matriid1=implode("','",$data1);
$check2=mysqli_query($con,"select profile_id from block_member where matriid='$matriid'");
$data = array(); while($check3=mysqli_fetch_array($check2)){ $data[] = $check3['profile_id']; }
$profile=implode("','", $data);
$countcomp="Select COUNT(*) as totalCountcomp from register where MatriID In ('".$item."') and visibility NOT LIKE 'hidden' AND Status NOT LIKE 'Banned' AND MatriID NOT LIKE '$matriid' and ";
if($profile!="") { $count.=" MatriID NOT IN ('$profile') and "; }
if($matriid1!="") { $count.=" MatriID NOT IN ('$matriid1') and "; }
$countcomp.=" Gender='$match_sex' AND ";
$countcomp.=" Religion='$religion' AND ";
$countcomp.=" Caste='$caste' AND ";
if($me['Gender']=='Male'){ $countcomp.=" age<='$age' and Height<='$height' "; } else { $countcomp.=" age>='$age' and Height>='$height' "; }
$query_comp=mysqli_query($con,$countcomp);
$query_compfetch=mysqli_fetch_array($query_comp);
/* ---- end compatibility matches ---- */
?>

<?php } ?>

<!-- ─── TOP BAR (all variants) ─── -->
<div class="mvv-topbar">
  <div class="container mvv-topbar-inner">
    <span><i class="bi bi-geo-alt"></i> Satara, Maharashtra, India</span>
    <div>
      <a href="tel:+919422524060"><i class="bi bi-telephone"></i> +91-9422524060</a>
      <a href="mailto:info@manpasandjodidar.com"><i class="bi bi-envelope"></i> info@manpasandjodidar.com</a>
    </div>
  </div>
</div>

<?php if(isset($login) && $regvar=='9') { ?>

<!-- ===================== LOGGED IN (full reg) HEADER ===================== -->
<div class="navbar-outer mvv-navbar-outer">
  <header class="mvv-header" id="mvvHeader">
    <div class="container mvv-header-wrap">
      <!-- Brand -->
      <a class="mvv-brand" href="index_dashboard" aria-label="Dashboard">
        <img class="mvv-brand-img" src="<?php echo $smLogo; ?>" alt="Manpasand Jodidar">
        <span class="mvv-brand-text">
          <span class="mvv-brand-title">Manpasand Jodidar</span>
          <span class="mvv-brand-subtitle">मनपसंद जोडीदार · वधू वर सूचक केंद्र</span>
        </span>
      </a>

      <!-- Mobile Toggle -->
      <button class="mvv-menu-toggle" aria-expanded="false" aria-controls="mvvMainNav" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>

      <!-- Nav Menu -->
      <nav class="mvv-nav" id="mvvMainNav" aria-label="Main navigation">
        <!-- Profile Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-person-circle me-1" style="font-size:0.85rem;"></i> Profile <span class="mvv-drop-icon">⌄</span></button>
          <div class="mvv-dropdown-menu">
            <a href="index_dashboard"><i class="fas fa-user"></i> Your Profile</a>
            <a href="basic"><i class="fas fa-info-circle"></i> Basic</a>
            <a href="horoscope"><i class="fas fa-yin-yang"></i> Horoscope</a>
            <a href="contact"><i class="fas fa-mobile-alt"></i> Contact Details</a>
            <a href="education"><i class="fas fa-graduation-cap"></i> Educational &amp; Professional</a>
            <a href="family?flag=1"><i class="fas fa-users"></i> Family Details</a>
            <a href="partner_prefrence"><i class="fas fa-venus-mars"></i> Partner Preference</a>
            <a href="compability"><i class="far fa-address-book"></i> My Compatibility</a>
            <hr style="border-color:var(--mvv-line);margin:4px 0;">
            <a href="settings"><i class="fas fa-cog"></i> My Setting</a>
            <a href="upload_photo_gallary"><i class="fas fa-camera"></i> Your Photo's</a>
            <a href="upload_id_proof"><i class="fas fa-id-card"></i> Upload ID Proof</a>
            <a href="upload_document_proof"><i class="fas fa-file-upload"></i> Upload Document</a>
            <a href="change_pswd"><i class="fas fa-lock"></i> Change Password</a>
          </div>
        </div>

        <!-- Matches Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-heart me-1" style="font-size:0.85rem;"></i> Matches <span class="mvv-drop-icon">⌄</span></button>
          <div class="mvv-dropdown-menu">
            <a href="latest_matches"><i class="fas fa-star"></i> Latest Matches<?php if(isset($latestmatchesfetch) && $latestmatchesfetch['totalCountlatestmatch']>0){ ?><span class="nav-badge"><?php echo $latestmatchesfetch['totalCountlatestmatch']; ?></span><?php } ?></a>
            <a href="mutual_matches"><i class="fas fa-sync-alt"></i> Mutual Matches<?php if(isset($match_queryfetch) && $match_queryfetch['totalCount']>0){ ?><span class="nav-badge"><?php echo $match_queryfetch['totalCount']; ?></span><?php } ?></a>
            <a href="partner_matches_100"><i class="fas fa-bullseye"></i> 100% Partner Matches<?php if($partner100Count>0){ ?><span class="nav-badge"><?php echo $partner100Count; ?></span><?php } ?></a>
            <a href="compabitlity_matches"><i class="fas fa-puzzle-piece"></i> Compatibility Matches<?php if(isset($query_compfetch) && ($query_compfetch['totalCountcomp'] ?? 0)>0){ ?><span class="nav-badge"><?php echo (int)$query_compfetch['totalCountcomp']; ?></span><?php } ?></a>
          </div>
        </div>

        <!-- Search Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-search me-1" style="font-size:0.85rem;"></i> Search <span class="mvv-drop-icon">⌄</span></button>
          <div class="mvv-dropdown-menu">
            <a href="smart_search"><i class="fas fa-filter"></i> Regular Search</a>
            <a href="rashi_search"><i class="fas fa-moon"></i> Horoscope Search</a>
          </div>
        </div>

        <!-- My Activities Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-activity me-1" style="font-size:0.85rem;"></i> Activities <span class="mvv-drop-icon">⌄</span></button>
          <?php
          /* ── consolidate block lists once ── */
          $headerCountCache = $_SESSION['_shivraj_header_counts'][$login] ?? null;
          if (is_array($headerCountCache) && isset($headerCountCache['time'], $headerCountCache['activities']) && $headerCountCache['time'] > time() - 60) {
            $c = $headerCountCache['activities'];
          } else {
          $q1=mysqli_query($con,"select matriid from block_member where profile_id='$login'");
          $bl=array(); while($r=mysqli_fetch_array($q1))$bl[]=$r['matriid'];
          $bm=implode("','",$bl);
          $q2=mysqli_query($con,"select profile_id from block_member where matriid='$login'");
          $b2=array(); while($r=mysqli_fetch_array($q2))$b2[]=$r['profile_id'];
          $bp=implode("','",$b2);

          $allExcludeIds=array_unique(array_merge($bl,$b2));
          $excl= $allExcludeIds ? "'".implode("','",$allExcludeIds)."'" : '';

          $c = array();
          $exEirec  = $excl ? " AND eireceiver NOT IN($excl)" : '';
          $exEisen  = $excl ? " AND eisender NOT IN($excl)" : '';
          $exMatId  = $excl ? " AND mat_id NOT IN($excl)" : '';
          $exProfId = $excl ? " AND profile_id NOT IN($excl)" : '';
          $exWho1   = $excl ? " AND who1 NOT IN($excl)" : '';
          $exWhom1  = $excl ? " AND whom1 NOT IN($excl)" : '';
          $exWho    = $excl ? " AND who NOT IN($excl)" : '';

          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM expressinterest WHERE eisender='$login' AND status='Accept' AND banstatus!='1'$exEirec"));
          $c['connected']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM expressinterest WHERE eireceiver='$login' AND status='Accept' AND banstatus!='1'$exEisen"));
          $c['whoconnected']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM expressinterest WHERE eireceiver='$login' AND status='Pending' AND banstatus!='1'$exEisen"));
          $c['interest_recv']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM expressinterest WHERE eisender='$login' AND status='Pending' AND banstatus!='1'$exEirec"));
          $c['req_pending']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM shortlist_profile WHERE mat_id='$login' AND banstatus!='1'$exProfId"));
          $c['shortlisted']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM shortlist_profile WHERE profile_id='$login' AND banstatus!='1'$exMatId"));
          $c['whoshortlisted']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM viewedaddress WHERE who1='$login' AND banstatus!='1'$exWhom1"));
          $c['viewed_contact']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM viewedaddress WHERE whom1='$login' AND banstatus!='1'$exWho1"));
          $c['who_viewed_contact']=$r['c'];
          $r=mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) as c FROM block_member WHERE matriid='$login' AND banstatus!='1'"));
          $c['blocked']=$r['c'];
          $_SESSION['_shivraj_header_counts'][$login] = [
            'time' => time(),
            'activities' => $c,
            'messages' => $_SESSION['_shivraj_header_counts'][$login]['messages'] ?? null,
          ];
          }
          ?>
          <div class="mvv-dropdown-menu">
            <a href="my_connected_members"><i class="fas fa-link"></i> Connected Members<?php if($c['connected']>0){ ?><span class="nav-badge"><?php echo $c['connected']; ?></span><?php } ?></a>
            <a href="who_connected_me"><i class="fas fa-handshake"></i> Who Connected Me<?php if($c['whoconnected']>0){ ?><span class="nav-badge"><?php echo $c['whoconnected']; ?></span><?php } ?></a>
            <hr style="border-color:var(--mvv-line);margin:4px 0;">
            <a href="interest_received"><i class="fas fa-heart"></i> Interest Received<?php if($c['interest_recv']>0){ ?><span class="nav-badge"><?php echo $c['interest_recv']; ?></span><?php } ?></a>
            <a href="interest_send"><i class="fas fa-paper-plane"></i> Request Pending<?php if($c['req_pending']>0){ ?><span class="nav-badge"><?php echo $c['req_pending']; ?></span><?php } ?></a>
            <a href="Profile_shortlisted"><i class="fas fa-star"></i> Shortlisted By Me<?php if($c['shortlisted']>0){ ?><span class="nav-badge"><?php echo $c['shortlisted']; ?></span><?php } ?></a>
            <a href="who_shortlisted_me"><i class="far fa-star"></i> Who Shortlisted Me<?php if($c['whoshortlisted']>0){ ?><span class="nav-badge"><?php echo $c['whoshortlisted']; ?></span><?php } ?></a>
            <hr style="border-color:var(--mvv-line);margin:4px 0;">
            <a href="viewed_address"><i class="fas fa-address-book"></i> Viewed Contact List<?php if($c['viewed_contact']>0){ ?><span class="nav-badge"><?php echo $c['viewed_contact']; ?></span><?php } ?></a>
            <a href="who_viewed_addreess_list"><i class="fas fa-phone"></i> Who Viewed My Contact<?php if($c['who_viewed_contact']>0){ ?><span class="nav-badge"><?php echo $c['who_viewed_contact']; ?></span><?php } ?></a>
            <hr style="border-color:var(--mvv-line);margin:4px 0;">
            <a href="block_profile"><i class="fas fa-user-slash"></i> Profile I Have Block<?php if($c['blocked']>0){ ?><span class="nav-badge"><?php echo $c['blocked']; ?></span><?php } ?></a>
          </div>
        </div>

        <!-- Message Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-chat-dots me-1" style="font-size:0.85rem;"></i> Message <span class="mvv-drop-icon">⌄</span></button>
          <?php
          $messageCache = $_SESSION['_shivraj_header_counts'][$login]['messages'] ?? null;
          if (is_array($messageCache) && isset($messageCache['time']) && $messageCache['time'] > time() - 60) {
            $messagesendcnt = (int)$messageCache['sent'];
            $messagereceivecnt = (int)$messageCache['received'];
          } else {
            $messagesendsql = mysqli_query($con,"SELECT COUNT(DISTINCT ToID) as messagesendcount from receivemessage where FromID='$login' and banstatus!='1'");
            $messagesendsql_fetch=mysqli_fetch_array($messagesendsql);
            $messagesendcnt=(int)$messagesendsql_fetch['messagesendcount'];
            $messagereceivesql = mysqli_query($con,"SELECT COUNT(DISTINCT FromID) as messagereceivecount from receivemessage where ToID='$login' and banstatus!='1'");
            $messagereceivesql_fetch=mysqli_fetch_array($messagereceivesql);
            $messagereceivecnt=(int)$messagereceivesql_fetch['messagereceivecount'];
            $_SESSION['_shivraj_header_counts'][$login]['messages'] = [
              'time' => time(), 'sent' => $messagesendcnt, 'received' => $messagereceivecnt,
            ];
          }
          ?>
          <div class="mvv-dropdown-menu">
            <a href="message_send"><i class="fas fa-paper-plane"></i> Send Message<?php if($messagesendcnt>0){ ?><span class="nav-badge"><?php echo $messagesendcnt; ?></span><?php } ?></a>
            <a href="message_received"><i class="fas fa-inbox"></i> Received Message<?php if($messagereceivecnt>0){ ?><span class="nav-badge"><?php echo $messagereceivecnt; ?></span><?php } ?></a>
          </div>
        </div>

        <!-- Upgrade Dropdown -->
        <div class="mvv-nav-dropdown">
          <button type="button"><i class="bi bi-gem me-1" style="font-size:0.85rem;"></i> Upgrade <span class="mvv-drop-icon">⌄</span></button>
          <div class="mvv-dropdown-menu">
            <a href="my_offer"><i class="fas fa-tag"></i> My Offer</a>
            <a href="invoice"><i class="fas fa-file-invoice"></i> Invoice</a>
            <a href="#"><i class="fas fa-circle" style="color:<?php echo ($me['Status']=='Paid')?'#4CAF50':'#FFB347';?>;font-size:0.6rem;"></i> Status: <?php echo $me['Status']; ?></a>
          </div>
        </div>

        <!-- Auth Buttons -->
        <div class="mvv-nav-actions">
          <a class="mvv-nav-btn mvv-nav-btn-primary" href="index_dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
          <a class="mvv-nav-btn mvv-nav-btn-outline" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
      </nav>

      <button class="mvv-nav-backdrop" type="button" aria-label="Close menu" tabindex="-1"></button>
    </div>
  </header>
</div>
<!-- ===================== END LOGGED IN HEADER ===================== -->

<?php } elseif($id!="") { ?>

<!-- ===================== INCOMPLETE REGISTRATION HEADER ===================== -->
<div class="navbar-outer mvv-navbar-outer">
  <header class="mvv-header" id="mvvHeader">
    <div class="container mvv-header-wrap">
      <!-- Brand -->
      <a class="mvv-brand" href="#">
        <img class="mvv-brand-img" src="<?php echo $smLogo; ?>" alt="Manpasand Jodidar">
        <span class="mvv-brand-text">
          <span class="mvv-brand-title">Manpasand Jodidar</span>
          <span class="mvv-brand-subtitle">मनपसंद जोडीदार · वधू वर सूचक केंद्र</span>
        </span>
      </a>

      <?php
      $my_profile = mysqli_query($con,"SELECT * FROM register where matriid='$id'");
      $me = mysqli_fetch_array($my_profile);
      ?>

      <div class="ms-auto d-flex align-items-center gap-3">
        <div class="welcome-strip">
          <div>
            <div class="welcome-label">Welcome</div>
            <div class="welcome-name"><?php $explodename=explode(" ", $me['Name'] ?? 'User'); echo $explodename[0] ?: 'User'; ?></div>
          </div>
        </div>
        <a class="mvv-nav-btn mvv-nav-btn-light" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </div>
    </div>
  </header>
</div>
<!-- ===================== END INCOMPLETE REGISTRATION HEADER ===================== -->

<?php } else { ?>

<!-- ===================== PUBLIC HEADER ===================== -->
<div class="navbar-outer mvv-navbar-outer">
  <header class="mvv-header" id="mvvHeader">
    <div class="container mvv-header-wrap">
      <!-- Brand -->
      <a class="mvv-brand" href="index" aria-label="Home">
        <img class="mvv-brand-img" src="<?php echo $smLogo; ?>" alt="Manpasand Jodidar">
        <span class="mvv-brand-text">
          <span class="mvv-brand-title">Manpasand Jodidar</span>
          <span class="mvv-brand-subtitle">मनपसंद जोडीदार · वधू वर सूचक केंद्र</span>
        </span>
      </a>

      <!-- Mobile Toggle -->
      <button class="mvv-menu-toggle" aria-expanded="false" aria-controls="mvvMainNav" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>

      <!-- Nav Menu -->
      <nav class="mvv-nav" id="mvvMainNav" aria-label="Main navigation">
        <a class="nav-link" href="index">Home</a>

        <div class="mvv-nav-dropdown">
          <button type="button">About <span class="mvv-drop-icon">⌄</span></button>
          <div class="mvv-dropdown-menu">
            <a href="about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="terms-conditions"><i class="fas fa-file-contract"></i> Terms &amp; Conditions</a>
            <a href="faqs"><i class="fas fa-question-circle"></i> FAQ's</a>
            <a href="privacy-policy"><i class="fas fa-shield-alt"></i> Privacy Policy</a>
            <a href="returns-and-cancellation"><i class="fas fa-undo"></i> Refund Policy</a>
            <a href="disclaimer"><i class="fas fa-exclamation-circle"></i> Disclaimer</a>
            <a href="safematrimony"><i class="fas fa-heart"></i> Safe Matrimony</a>
          </div>
        </div>

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

        <a class="nav-link" href="my_offer">Membership</a>
        <a class="nav-link" href="success_story">Success Stories</a>
        <a class="nav-link" href="contactus">Contact Us</a>

        <div class="mvv-nav-actions">
          <a class="mvv-nav-btn mvv-nav-btn-outline" href="signup"><i class="bi bi-person-plus"></i> Sign Up</a>
          <a class="mvv-nav-btn mvv-nav-btn-primary" href="login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
        </div>
      </nav>

      <button class="mvv-nav-backdrop" type="button" aria-label="Close menu" tabindex="-1"></button>
    </div>
  </header>
</div>
<!-- ===================== END PUBLIC HEADER ===================== -->

<?php } ?>

<!-- Bootstrap 5 JS -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Mobile menu toggle
(function() {
  var header = document.getElementById('mvvHeader');
  var toggle = document.querySelector('.mvv-menu-toggle');
  var nav = document.getElementById('mvvMainNav');
  var backdrop = document.querySelector('.mvv-nav-backdrop');

  if (toggle && nav) {
    // Toggle mobile menu
    toggle.addEventListener('click', function() {
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', !expanded);
      nav.classList.toggle('open');
      if (backdrop) backdrop.classList.toggle('open');
      document.body.classList.toggle('menu-open');
    });

    // Close on backdrop click
    if (backdrop) {
      backdrop.addEventListener('click', function() {
        toggle.setAttribute('aria-expanded', 'false');
        nav.classList.remove('open');
        backdrop.classList.remove('open');
        document.body.classList.remove('menu-open');
      });
    }

    // Close on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && nav.classList.contains('open')) {
        toggle.setAttribute('aria-expanded', 'false');
        nav.classList.remove('open');
        if (backdrop) backdrop.classList.remove('open');
        document.body.classList.remove('menu-open');
      }
    });

    // Mobile dropdown toggle (touch-friendly)
    nav.querySelectorAll('.mvv-nav-dropdown > button').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        if (window.innerWidth <= 1000) {
          e.preventDefault();
          var dd = this.closest('.mvv-nav-dropdown');
          dd.classList.toggle('open');
        }
      });
    });
  }

  // Sticky header: add scrolled class on scroll
  if (header) {
    function updateSticky() {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }
    window.addEventListener('scroll', updateSticky, { passive: true });
    updateSticky();
  }

  // Close mobile nav on window resize above breakpoint
  window.addEventListener('resize', function() {
    if (window.innerWidth > 1000 && nav && nav.classList.contains('open')) {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('open');
      if (backdrop) backdrop.classList.remove('open');
      document.body.classList.remove('menu-open');
    }
  });
})();

</script>
