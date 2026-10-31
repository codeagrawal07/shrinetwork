<?php
$siteConfig = [];
$configPath = __DIR__ . '/../config/plans.json';
if (file_exists($configPath)) {
    $decoded = json_decode(file_get_contents($configPath), true);
    if (is_array($decoded)) $siteConfig = $decoded;
}
$siteName = $siteConfig['site']['company_name'] ?? 'SHRI NETWORK';
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
function nav_active($file, $currentPage) { return $file === $currentPage ? 'active' : ''; }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Discover SHRI NETWORK product plans and get in touch with our team.">
  <title><?= htmlspecialchars($pageTitle ?? $siteName) ?> | <?= htmlspecialchars($siteName) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">SN</span><span><?= htmlspecialchars($siteName) ?></span></a>
    <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
    <nav class="nav-links" aria-label="Main navigation">
      <a class="<?= nav_active('index.php',$currentPage) ?>" href="index.php">Home</a>
      <a class="<?= nav_active('about.php',$currentPage) ?>" href="about.php">About</a>
      <a class="<?= nav_active('plans.php',$currentPage) ?>" href="plans.php">Plans</a>
      <a class="<?= nav_active('contact.php',$currentPage) ?>" href="contact.php">Contact</a>
    </nav>
  </div>
</header>
<main>
