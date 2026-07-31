<?php
$pageTitle = $pageTitle ?? 'Manpasand Jodidar - Vadhu Var Suchak Kendra';
$activePage = $activePage ?? '';
require_once __DIR__ . '/data.php';
function active(string $name, string $current): string { return $name === $current ? ' active' : ''; }
?>
<!doctype html>
<html lang="mr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Manpasand Jodidar - trusted Maratha matrimonial service in Satara, Maharashtra. Rishta Dil Se, Saath Zindagi Bhar.">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <!-- MPJ: brand icons & identity -->
  <link rel="icon" type="image/png" sizes="32x32" href="../branding/favicons/icon-32.png">
  <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
  <link rel="manifest" href="../branding/site.webmanifest">
  <meta name="theme-color" content="#5E1426">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=DM+Sans:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../branding/branding.css">
  <script defer src="assets/js/app.js?v=<?= filemtime(__DIR__ . '/../assets/js/app.js') ?>"></script>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<div class="topbar"><div class="container topbar-inner"><span>📍 Satara, Maharashtra, India</span><div><a href="tel:+919403550087">☎ +91 94035 50087</a><a href="mailto:info@shivrajmaratha.com">✉ info@shivrajmaratha.com</a></div></div></div>
<header class="site-header" id="siteHeader">
  <div class="container nav-wrap">
    <a class="brand" href="index.php" aria-label="Manpasand Jodidar Home">
      <img src="../../branding/logos/emblem.png" alt="Manpasand Jodidar logo" width="76" height="76">
      <span><b>मनपसंद जोडीदार</b><small>वधू वर सूचक केंद्र ®</small></span>
    </a>
    <button class="menu-toggle" aria-expanded="false" aria-controls="mainNav" aria-label="Open menu"><span></span><span></span><span></span></button>
    <nav class="main-nav" id="mainNav" aria-label="Main navigation">
      <a class="<?= active('home',$activePage) ?>" href="index.php">Home</a>
      <a class="<?= active('about',$activePage) ?>" href="aboutus.php">About Us</a>
      <div class="nav-dropdown"><button type="button">Profiles <span>⌄</span></button><div class="dropdown-menu">
        <a href="umgrooms.php">Unmarried Grooms</a><a href="umbrides.php">Unmarried Brides</a><a href="dgrooms.php">Divorcee Grooms</a><a href="dbrides.php">Divorcee Brides</a>
      </div></div>
      <a class="<?= active('stories',$activePage) ?>" href="sstories.php">Success Stories</a>
      <a href="#search">Search</a><a class="nav-login" href="#login">Login</a><a class="btn btn-sm" href="#enroll">Enroll Bio-data</a>
    </nav>
    <button class="nav-backdrop" type="button" aria-label="Close menu" tabindex="-1"></button>
  </div>
</header>
<main id="main">
