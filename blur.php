<?php
/**
 * blur.php — Serves a blurred version of a profile photo.
 *
 * SECURITY (fixes C5 local file disclosure / path traversal):
 * the image path is validated against the application root and an image
 * extension allow-list. Blur behavior is unchanged.
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'security.php');

$file = svr_safe_image_path(isset($_GET['image']) ? $_GET['image'] : '', __DIR__);
if ($file === false) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

header('Content-Type: image/jpeg');

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$image = false;
if ($ext === 'jpg' || $ext === 'jpeg') { $image = @imagecreatefromjpeg($file); }
elseif ($ext === 'png') { $image = @imagecreatefrompng($file); }
elseif ($ext === 'gif') { $image = @imagecreatefromgif($file); }
elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) { $image = @imagecreatefromwebp($file); }

if (!$image) {
    header('HTTP/1.0 404 Not Found');
    exit;
}

    /* Get original image size */
    list($w, $h) = getimagesize($file);

    /* Create array with width and height of down sized images */
    $size = array('sm'=>array('w'=>intval($w/4), 'h'=>intval($h/4)),
                   'md'=>array('w'=>intval($w/2), 'h'=>intval($h/2))
                  );

    /* Scale by 25% and apply Gaussian blur */
    $sm = imagecreatetruecolor($size['sm']['w'],$size['sm']['h']);
    imagecopyresampled($sm, $image, 0, 0, 0, 0, $size['sm']['w'], $size['sm']['h'], $w, $h);

    for ($x=1; $x <=40; $x++){
        imagefilter($sm, IMG_FILTER_GAUSSIAN_BLUR, 999);
    }

    imagefilter($sm, IMG_FILTER_SMOOTH,99);
    imagefilter($sm, IMG_FILTER_BRIGHTNESS, 10);

    /* Scale result by 200% and blur again */
    $md = imagecreatetruecolor($size['md']['w'], $size['md']['h']);
    imagecopyresampled($md, $sm, 0, 0, 0, 0, $size['md']['w'], $size['md']['h'], $size['sm']['w'], $size['sm']['h']);
    imagedestroy($sm);

        for ($x=1; $x <=25; $x++){
            imagefilter($md, IMG_FILTER_GAUSSIAN_BLUR, 999);
        }

    imagefilter($md, IMG_FILTER_SMOOTH,99);
    imagefilter($md, IMG_FILTER_BRIGHTNESS, 10);

/* Scale result back to original size */
imagecopyresampled($image, $md, 0, 0, 0, 0, $w, $h, $size['md']['w'], $size['md']['h']);
imagedestroy($md);

imagejpeg($image);
imagedestroy($image);
