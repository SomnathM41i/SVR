<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if($_GET['image']){  
$image = $_GET['image'];  

$fileextension = pathinfo($image, PATHINFO_EXTENSION);
$contenttype = mime_content_type($image);

if($fileextension=="jpg" || $fileextension=="JPG"){$im = imagecreatefromjpeg($image);}  
if($fileextension=="jpeg" || $fileextension=="JPEG"){$im = imagecreatefromjpeg($image);}
elseif($fileextension=="gif" || $fileextension=="GIF"){$im = imagecreatefromgif($image);}  
elseif($fileextension=="png" ||$fileextension=="PNG"){$im = imagecreatefrompng($image);}  

if(isset($_GET['percent']) && !empty($_GET['percent'])){  
        $x = round((imagesx($im)*$_GET['percent'])/100);  
        $y = round((imagesy($im)*$_GET['percent'])/100);  
        $yyy=0;  
        $xxx=0;  
        $imw = imagecreatetruecolor($x,$y);  
}elseif(isset($_GET['w']) && isset( $_GET['h'])){  
        $x = $_GET['w'];  
        $y = $_GET['h'];  
        $yyy=0;  
        $xxx=0;  
        $imw = imagecreatetruecolor($x,$y);  
}elseif(isset($_GET['maxim_size'])){  
		if(imagesy($im)>=$_GET['maxim_size'] || imagesx($im)>=$_GET['maxim_size']){  
			if(imagesy($im)>=imagesx($im)){  
				$y = $_GET['maxim_size'];  
				$x = ($y*imagesx($im))/imagesy($im);  
			}else{  
				$x = $_GET['maxim_size'];  
				$y = ($x*imagesy($im))/imagesx($im);  
			}  
		}else{  
				$x = imagesx($im);  
				$y = imagesy($im);  
		}  
		$yyy=0;  
		$xxx=0;  
		$imw = imagecreatetruecolor($x,$y);  
}elseif(isset($_GET['square']) && !empty($_GET['square'])){  
			if(imagesy($im)>=$_GET['square'] || imagesx($im)>=$_GET['square']){  
			if(imagesy($im)>=imagesx($im)){  
			$x = $_GET['square'];  
			$y = ($x*imagesy($im))/imagesx($im);  
			$yyy=-($y-$x)/12;  
			$xxx=0;  
			}else{  
			$y = $_GET['square'];  
			$x = ($y*imagesx($im))/imagesy($im);  
			$xxx=-($x-$y)/2;  
			$yyy=0;  
			}  
			}else{  
			$x = imagesx($im);  
			$y = imagesy($im);  
			$yyy=0;  
			$xxx=0;  
			}  
			$imw = imagecreatetruecolor($_GET['square'],$_GET['square']);  
}else{  
			$x = imagesx($im);  
			$y = imagesy($im);  
			$yyy=0;  
			$xxx=0;  
			$imw = imagecreatetruecolor($x,$y);  
}  

imagecopyresampled($imw, $im, $xxx,$yyy,0,0,$x,$y,imagesx($im), imagesy($im));  

if(isset($_GET['watermark_text']) && !empty($_GET['watermark_text'])){  
		if($_GET['watermark_color']){$watermark_color=$_GET['watermark_color'];  
		}else{  
		$watermark_color="FFFFFF";  
		}  
		$red=hexdec(substr($watermark_color,0,2));  
		$green=hexdec(substr($watermark_color,2,2));  
		$blue=hexdec(substr($watermark_color,4,2));  

		$text_col = imagecolorallocate($imw, $red,$green,$blue);  
		$font = "SFOldRepublicSCBold.ttf"; //this font(georgia.ttf) heave to be in the same directory as this script  
		$font_size = 18;  
		$angle = -90;  
		$box = imagettfbbox($font_size, $angle, $font, $_GET['watermark_text']);  
		$x = 5;  
		$y = 17;  
		imagettftext($imw, $font_size, $angle, $x, $y, $text_col, $font, $_GET['watermark_text']);  

}  

if($fileextension=="jpg"){imagejpeg($imw);}  
elseif($fileextension=="jpeg"){imagegif($imw);} 
elseif($fileextension=="gif"){imagegif($imw);}  
elseif($fileextension=="png"){imagepng($imw);}  
else{  
if($fileextension=="jpg" || $fileextension=="JPG"){imagejpeg($imw);}  
elseif($fileextension=="jpg" || $fileextension=="JPEG"){imagegif($imw);} 
elseif($fileextension=="gif" || $fileextension=="GIF"){imagegif($imw);}  
elseif($fileextension=="png" || $fileextension=="PNG"){imagepng($imw);}  
}  
header("Content-Type: $contenttype");


imagedestroy($imw);  
}  
?>
