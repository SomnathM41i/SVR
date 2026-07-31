<?php
/**
 * photoprocess.php — On-the-fly image resize/letterbox endpoint.
 *
 * SECURITY (fixes C5 local file disclosure / path traversal):
 * the image path is validated against the application root and an image
 * extension allow-list; arbitrary local files can no longer be read.
 * All legacy query params (square, w/h, percent, maxim_size) are preserved.
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'security.php');

$filePath = svr_safe_image_path(isset($_GET['image']) ? $_GET['image'] : '', __DIR__);
if ($filePath === false) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
$mimeMap = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png', 'webp' => 'image/webp');
$contentType = $mimeMap[$ext];

if (!extension_loaded('gd')) {
    header("Content-Type: $contentType");
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: public, max-age=86400');
    readfile($filePath);
    exit;
}

$funcMap = array('jpg' => 'imagecreatefromjpeg', 'jpeg' => 'imagecreatefromjpeg', 'gif' => 'imagecreatefromgif', 'png' => 'imagecreatefrompng', 'webp' => 'imagecreatefromwebp');
$createFunc = $funcMap[$ext];

$src = @$createFunc($filePath);
if (!$src) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$sw = imagesx($src);
$sh = imagesy($src);

if (isset($_GET['square']) && $_GET['square'] > 0) {
    $size = (int)$_GET['square'];
    if ($sw >= $size || $sh >= $size) {
        $ratio = max($sw, $sh) / $size;
        $dw = (int)($sw / $ratio);
        $dh = (int)($sh / $ratio);
        $dst = imagecreatetruecolor($size, $size);
        $ox = (int)(($size - $dw) / 2);
        $oy = (int)(($size - $dh) / 2);
    } else {
        $dst = imagecreatetruecolor($size, $size);
        $ox = (int)(($size - $sw) / 2);
        $oy = (int)(($size - $sh) / 2);
        $dw = $sw; $dh = $sh;
    }
    imagecopyresampled($dst, $src, $ox, $oy, 0, 0, $dw, $dh, $sw, $sh);
} elseif (isset($_GET['w']) && isset($_GET['h'])) {
    $w = (int)$_GET['w']; $h = (int)$_GET['h'];
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $sw, $sh);
} elseif (isset($_GET['percent']) && $_GET['percent'] > 0) {
    $pct = (int)$_GET['percent'];
    $w = (int)($sw * $pct / 100);
    $h = (int)($sh * $pct / 100);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $sw, $sh);
} elseif (isset($_GET['maxim_size']) && $_GET['maxim_size'] > 0) {
    $max = (int)$_GET['maxim_size'];
    if ($sw > $max || $sh > $max) {
        $ratio = max($sw, $sh) / $max;
        $w = (int)($sw / $ratio);
        $h = (int)($sh / $ratio);
    } else {
        $w = $sw; $h = $sh;
    }
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $sw, $sh);
} else {
    $dst = imagecreatetruecolor($sw, $sh);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $sw, $sh, $sw, $sh);
}

header("Content-Type: $contentType");
header('Cache-Control: public, max-age=86400');
$outMap = array('jpg' => 'imagejpeg', 'jpeg' => 'imagejpeg', 'gif' => 'imagegif', 'png' => 'imagepng', 'webp' => 'imagewebp');
$outFunc = $outMap[$ext];
$outFunc($dst);
imagedestroy($src);
imagedestroy($dst);
