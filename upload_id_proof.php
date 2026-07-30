<?php /*include('dbconnectadmin.php');*/
	require_once('sys_dbconnection.php');
	error_reporting(0) ;
	include_once('memprotect.php');	
	include_once('siteconfig.php');
	

	$id=$_SESSION['matri_login'];                                                                             
	if(isset($_POST['submit']))
	{
	for($i=0;$i<count($_FILES["fileToUpload"]["name"]);$i++)
	{
		
		
	if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name'][$i])){
		
	$target_dir = "adhar/";
	$target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"][$i]));
	$sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"][$i]));
	//$target_file = $target_dir.time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"];
	$UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["fileToUpload"]["name"][$i];
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image

	if(isset($_POST["submit"]))
		{
			
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
	if($check !== false) {
	//print_r($_FILES["fileToUpload"]);	
	define("success","File is an image - " . $check["mime"] . ".");

	$uploadOk = 1;
	} else {
		
	define("success","File is not an image.");
	$uploadOk = 0;
	}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	define("success","Sorry, file already exists.");
	$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 8097152) {
	define("success","Sorry, your file is too large.");
	$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" ) {
	define("success","Sorry, only JPG, JPEG,  files are allowed.");
	$uploadOk = 0;
	}
	else {

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {

	mysqli_query($con,"UPDATE register SET adhar='$sav',idproof_approve='No' WHERE MatriID='$id'")or die(mysqli_error());
	//echo "insert into gallary(photo_name,matri_id,photo_approve) values('$sav','$id','Pending')";
	//exit;
	header('location:upload_id_proof?msg=success');
	} 
	else {
		header('location:upload_id_proof');	
	//define("success","Sorry, there was an error uploading your file.");
	}
	}
	}
	}
	}

	?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload ID Proof</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
    .gal-item { margin-bottom:24px; }
    .gal-item img, .gal-item iframe { width:100%; border-radius:8px; }
    .gal-actions { display:flex; gap:8px; margin-top:8px; }
  </style>
</head>
<body>
<?php include('header.php'); ?>

<script>
function preview_images() 
{
 var total_file=document.getElementById("upload").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
  document.getElementById("buttonupload").disabled = false; 
 }
}

function deletephoto(id)
{  
	var xmlhttp;
	if (id=="")
  	{
  		return;
  	}
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    				// document.getElementById("delete").innerHTML=xmlhttp.responseText;
    		}
  	}
	xmlhttp.open("GET","delete_idproof.php?id="+id,true);
	xmlhttp.send();
	window.location='upload_id_proof?msg=flag';
}
    function FileDetails() {

           var numFiles = $("input:file")[0].files.length;
          document.getElementById ("fp").innerHTML = numFiles;
			document.getElementById("display").style.display='block';
			document.getElementById("butt").style.display='none';
			document.getElementById("buttonupload").style.display='block';

	}

function showMyImage(fileInput) {
	var oFile = document.getElementById("upload1").files[0];
	            if (oFile.size > 3145728 ) // 3 mb for bytes.
	            {
	                document.getElementById('thumbnil1').style.display='block'; 
	                return;
	            }
		
	  document.getElementById('thumbnil').style.display='block';
	  document.getElementById('continue123').style.display='block';
	  document.getElementById('skip1').style.display='none';
	  
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
				document.getElementById('thumbnil1').style.display='block';
				document.getElementById('thumbnil').style.display='none';
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
	
</script>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Verification</div>
      <h1>Upload ID Proof</h1>
      <p>तुमचा ओळखपत्र पुरावा अपलोड करा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Upload ID Proof</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

<?php 
	$id=$_SESSION['matriid'];
	$sqlgal = mysqli_query($con,"select * from register where MatriID='$id' AND adhar!='' ");
	$check = mysqli_query($con,"select * from register where MatriID='$id'");

	$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
	$rowreg=mysqli_fetch_array($sqlreg);
	$check=$_GET['msg'];
?>

<?php if(mysqli_num_rows($sqlgal)<1){ ?>
  <section class="mvv-section">
    <div class="mvv-container">

		<?php if( $rowreg['idproof_approve'] == 'No' ) { ?>
		<div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;" align="center">
			<a href="upload_id_proof" style="float:right;color:var(--mvv-maroon);text-decoration:none;font-size:1.2rem;">&times;</a>
			Your ID Proof is Rejected By Admin.
		</div>
		<?php } if($check == "flag") { ?>
		<div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;" align="center">
			<a href="upload_id_proof" style="float:right;color:var(--mvv-maroon);text-decoration:none;font-size:1.2rem;">&times;</a>
			Your ID Proof Deleted Successfully.
		</div>
		<?php } ?>

        <div class="subscribe-form wow fadeInUp" data-wow-delay="500ms">
            <div class="envelope-image"></div>
            <div class="form-inner">
                <div class="upper-box">
                    <div class="sec-title text-center">
                        <div class="text col-lg-12 col-md-12 col-sm-12">
                            <i class="fa fa-check-square" aria-hidden="true"></i> All photos uploaded are screened as per Photo Guidelines and 98% of those get activated within an hour.<br style="display: block;">
                            <i class="fa fa-check-square" aria-hidden="true"></i> Other ways to upload your photos. E-mail your photos to <?php echo $siteinfo['FeedbackEmail'] ?> Mention your Profile ID and Name in the mail.
                        </div>
                    </div>
                </div>
                <div class="">
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php if (defined('success')) {?>
                                <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;" align="center">
                                    <a href="upload_id_proof" style="float:right;color:var(--mvv-maroon);text-decoration:none;font-size:1.2rem;">&times;</a>
                                    <b>Warning Alert:</b> <?php echo constant('success'); ?>
                                </div>
                                <?php }?>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 align="center">
                                <label for="upload" class="theme-btn btn btn-style-three" id="butt"><span class="btn-title">Select From your device</span></label>
                            </h4>
                            <input name="fileToUpload[]" style="visibility:hidden;" id="upload" type="file" onchange="preview_images(); FileDetails();" multiple />
                        </div>

                        <?php $ty=mysqli_query($con,"select * from register where MatriID='$id'"); if(mysqli_num_rows($ty)>1) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="#dialog_send_message" data-toggle="modal">
                                <span id="buttonupload" style="display:none">
                                    <button class="theme-btn btn btn-style-one" type="submit" value="Submit" name="submit" style="width:100%;" id="buttonupload"><span class="btn-title">Continue</span></button>
                                </span>
                                <br>
                            </a>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <span id="buttonupload" style="display:none">
                                <button class="theme-btn btn btn-style-one" type="submit" name="submit" value="Continue" id="buttonupload" style="width:100%;" onClick="alert('Select Image')"><span class="btn-title">Continue</span></button>
                            </span>
                        </div>
                        <?php } ?>

                        <span id="display" style="display:none;text-align:center">You Have Selected <span id="fp"></span> Files</span>
                    </form>

                    <?php if(!isset($_GET['msg'])) { ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="imgpreview" style="display:none"> <img src="" class="img-responsive thumbnail" id="blah"> </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  </section>
<?php }else{ ?>
  <section class="mvv-section">
    <div class="mvv-container">
        <?php if($rowreg['idproof_approve'] == "Yes") { ?>
        <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;" align="center">
            Your ID Proof Is Approved By Admin.
        </div>
        <?php } ?>

        <div class="row">
            <?php $cnt=mysqli_num_rows($sqlgal);?>
            <?php for($i=0;$i<$cnt;$i++) { ?>
            <?php while($row=mysqli_fetch_array($sqlgal)) { ?>
            <div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
                <div class="image-box">
                    <?php
                        function endsWith($img, $ext){
                            $extLength = strlen($ext);
                            if(substr($img, -$extLength) == $ext){
                                return true;
                            }
                            return false;
                        }
                        if(endsWith($row['adhar'], ".pdf")){
                    ?>
                    <iframe src="adhar/<?php echo $row['adhar']?>"></iframe><p>
                    <?php } else { ?>
                    <figure class="image"><a href="adhar/<?php echo $row['adhar']?>"><img src="adhar/<?php echo $row['adhar']?>"/></a></figure>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="jsdemo-notification-button12">
                        <a href="delete_idproof?id=<?php echo $id?>">
                            <button type="button" id="delete" class="btn btn-default disabled btndel ml-3"><i class="fas fa-trash"></i></button>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
  </section>
<?php } ?>
</main>

<?php include('footer3.php');?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin faio "></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>

</body>
</html>
