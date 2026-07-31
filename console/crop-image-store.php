<?php
require_once(dirname(__FILE__).'/protect.php');

move_uploaded_file($_FILES["croppedImage"]["tmp_name"], "Cropped image.jpg");
echo "Image has been uploaded";
