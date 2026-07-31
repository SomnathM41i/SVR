<?php
/**
 * console/photoprocess.php — Admin-side on-the-fly image resizer.
 *
 * SECURITY (fixes C5 local file disclosure / path traversal):
 * the image path is validated against the console base directory and an
 * image extension allow-list. Legacy params (type, percent, w/h,
 * maxim_size, square) are preserved, including the original square offsets.
 */
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'security.php');


require_once(__DIR__ . DIRECTORY_SEPARATOR . 'protect.php');

$filePath = svr_safe_image_path(isset($_GET['image']) ? $_GET['image'] : '', __DIR__);
if ($filePath === false) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

$image = $filePath;
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
$type = isset($_GET['type']) ? strtolower($_GET['type']) : '';


if ($type === 'jpg' || $type === 'jpeg') {
    header("Content-type: image/jpeg");
} elseif ($type === 'gif') {
    header("Content-type: image/gif");
} elseif ($type === 'png') {
    header("Content-type: image/png");
} else {
    if ($ext === 'jpg' || $ext === 'jpeg') { header("Content-type: image/jpeg"); }
    elseif ($ext === 'gif') { header("Content-type: image/gif"); }
    elseif ($ext === 'png') { header("Content-type: image/png"); }
    elseif ($ext === 'webp') { header("Content-type: image/webp"); }
}

$im = false;
if ($ext === 'jpg' || $ext === 'jpeg') { $im = @imagecreatefromjpeg($image); }
elseif ($ext === 'gif') { $im = @imagecreatefromgif($image); }
elseif ($ext === 'png') { $im = @imagecreatefrompng($image); }
elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) { $im = @imagecreatefromwebp($image); }

if (!$im) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

if (!empty($_GET['percent'])) {
    $x = round((imagesx($im) * (int)$_GET['percent']) / 100);
    $y = round((imagesy($im) * (int)$_GET['percent']) / 100);
    $yyy = 0;
    $xxx = 0;
    $imw = imagecreatetruecolor($x, $y);
} elseif (!empty($_GET['w']) && !empty($_GET['h'])) {
    $x = (int)$_GET['w'];
    $y = (int)$_GET['h'];
    $yyy = 0;
    $xxx = 0;
    $imw = imagecreatetruecolor($x, $y);
} elseif (!empty($_GET['maxim_size'])) {
    $maxim = (int)$_GET['maxim_size'];
    if (imagesy($im) >= $maxim || imagesx($im) >= $maxim) {
        if (imagesy($im) >= imagesx($im)) {
            $y = $maxim;
            $x = ($y * imagesx($im)) / imagesy($im);
        } else {
            $x = $maxim;
            $y = ($x * imagesy($im)) / imagesx($im);
        }
    } else {
        $x = imagesx($im);
        $y = imagesy($im);
    }
    $yyy = 0;
    $xxx = 0;
    $imw = imagecreatetruecolor($x, $y);
} elseif (!empty($_GET['square'])) {
    $square = (int)$_GET['square'];
    if (imagesy($im) >= $square || imagesx($im) >= $square) {
        if (imagesy($im) >= imagesx($im)) {
            $x = $square;
            $y = ($x * imagesy($im)) / imagesx($im);
            $yyy = -($y - $x) / 12;
            $xxx = 0;
        } else {
            $y = $square;
            $x = ($y * imagesx($im)) / imagesy($im);
            $xxx = -($x - $y) / 2;
            $yyy = 0;
        }
    } else {
        $x = imagesx($im);
        $y = imagesy($im);
        $yyy = 0;
        $xxx = 0;
    }
    $imw = imagecreatetruecolor($square, $square);
} else {
    $x = imagesx($im);
    $y = imagesy($im);
    $yyy = 0;
    $xxx = 0;
    $imw = imagecreatetruecolor($x, $y);
}

imagecopyresampled($imw, $im, $xxx, $yyy, 0, 0, $x, $y, imagesx($im), imagesy($im));

if ($type === 'jpg' || $type === 'jpeg') { imagejpeg($imw); }
elseif ($type === 'gif') { imagegif($imw); }
elseif ($type === 'png') { imagepng($imw); }
else {
    if ($ext === 'jpg' || $ext === 'jpeg') { imagejpeg($imw); }
    elseif ($ext === 'gif') { imagegif($imw); }
    elseif ($ext === 'png') { imagepng($imw); }
    elseif ($ext === 'webp' && function_exists('imagewebp')) { imagewebp($imw); }
}

imagedestroy($im);
imagedestroy($imw);
