                    
<?php require_once('includes/bootstrap.php'); 

$matriid=$_POST['matid'];

if(isset($_POST['submit']))
{


$i=0;

for($i=0;$i<count($_FILES["uploaded_file1"]["name"]);$i++)
{



if(isset($_FILES['uploaded_file1']['name']) && !empty($_FILES['uploaded_file1']['name'][$i])){



$target_dir = "../document/";
$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
$sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));

$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"][$i];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST["submit"]))
	{
		
$check = getimagesize($_FILES["uploaded_file1"]["tmp_name"][$i]);
if($check !== false) {

define("success8","File is an image - " . $check["mime"] . ".");
header('location:profile_view.php?msg1=suc1&ID='. $matriid );
$uploadOk = 1;
} else {
	
define("success8","File is not an image.");
$uploadOk = 0;
header('location:profile_view.php?msg1=suc2&ID='. $matriid );
}
}

// Check if file already exists
if (file_exists($target_file)) {
define("success8","Sorry, file already exists.");
header('location:profile_view.php?msg1=suc3&ID='. $matriid );
$uploadOk = 0;
}
// Check file size
if ($_FILES["uploaded_file1"]["size"] > 8097152) {
define("success8","Sorry, your file is too large.");
header('location:profile_view.php?msg1=suc7&ID='. $matriid );
$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc") {
define("success8","Sorry, only JPG, JPEG   files are allowed.");
header('location:profile_view.php?msg1=suc4&ID='. $matriid );
$uploadOk = 0;
}
else {

if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"][$i], $target_file)) {
$date=date('Y-m-d');

mysqli_query($con,"insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$matriid','$date','$i','Yes')");


header('location:profile_view.php?ID='. $matriid );
header('location:profile_view.php?msg1=suc5&ID='. $matriid );
}

else {
define("success8","Sorry, there was an error uploading your file.");
header('location:profile_view.php?msg1=suc6&ID='. $matriid );
}
}
}

}

}

?>
						
										