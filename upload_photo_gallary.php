<?php /*include('dbconnectadmin.php');
error_reporting(0) ;*/
require_once('sys_dbconnection.php');
include_once('memprotect.php');
///include_once('siteconfig.php');
//error_reporting(0);
$cnt = "";
$id = $_SESSION['matriid'] ?? $_SESSION['MatriID'] ?? '';

if (isset($_POST['submit'])) {
  $files = $_FILES['fileToUpload'] ?? null;
  $selectedFiles = $files ? array_filter($files['name'] ?? []) : [];
  $existingPhotos = (int)(mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM gallary WHERE matri_id='" . mysqli_real_escape_string($con, $id) . "'"))['total'] ?? 0);

  if (!$id || !$selectedFiles) {
    header('Location: upload_photo_gallary?msg=no-file');
    exit;
  }
  if (count($selectedFiles) > (5 - $existingPhotos)) {
    header('Location: upload_photo_gallary?msg=limit');
    exit;
  }

  $targetDir = __DIR__ . DIRECTORY_SEPARATOR . 'gallary' . DIRECTORY_SEPARATOR;
  $allowedMimeTypes = ['image/jpeg' => 'jpg', 'image/pjpeg' => 'jpg'];
  $uploaded = 0;

  foreach ($files['name'] as $index => $originalName) {
    if (!$originalName) continue;
    if (($files['error'][$index] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || ($files['size'][$index] ?? 0) > 8 * 1024 * 1024) {
      header('Location: upload_photo_gallary?msg=invalid-file');
      exit;
    }

    $imageInfo = @getimagesize($files['tmp_name'][$index]);
    $mimeType = $imageInfo['mime'] ?? '';
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!$imageInfo || !isset($allowedMimeTypes[$mimeType]) || !in_array($extension, ['jpg', 'jpeg'], true)) {
      header('Location: upload_photo_gallary?msg=invalid-file');
      exit;
    }

    $filename = date('Y_m_d_H_i_s') . '_' . bin2hex(random_bytes(5)) . '.' . $allowedMimeTypes[$mimeType];
    if (!move_uploaded_file($files['tmp_name'][$index], $targetDir . $filename)) {
      header('Location: upload_photo_gallary?msg=upload-error');
      exit;
    }

    $safeFilename = mysqli_real_escape_string($con, $filename);
    $safeId = mysqli_real_escape_string($con, $id);
    mysqli_query($con, "INSERT INTO gallary(photo_name, matri_id, photo_approve) VALUES('$safeFilename', '$safeId', 'Pending')");
    $uploaded++;
  }

  if ($uploaded) {
    $safeId = mysqli_real_escape_string($con, $id);
    mysqli_query($con, "UPDATE register SET Photo2Approve='No' WHERE MatriID='$safeId'");
    header('Location: upload_photo_gallary?msg=success');
    exit;
  }
  header('Location: upload_photo_gallary?msg=no-file');
  exit;
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Photo</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/manpasand-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
    .gal-item { margin-bottom:24px; }
    .gal-item img { width:100%; border-radius:8px; }
    .gal-actions { display:flex; gap:8px; margin-top:8px; }
    .gal-actions a { font-size:0.85rem; }
    .close { color: #fff; opacity: 20; }
    .textlabel { font-size:16px; color: #555; }
    .textlabel1 { font-size:16px; color: #555; text-align:center; }
    .faio { margin-left: -12px; margin-right: 8px; }
    .ml-4, .mx-4 { margin-left: 3.5rem!important; }
    .mvv-upload-card{max-width:760px;margin:0 auto 28px;padding:28px;background:#fff;border:1px solid var(--mvv-border);border-radius:16px;box-shadow:0 10px 28px rgba(58,42,34,.08);text-align:center;}
    .mvv-upload-card h3{margin:0 0 8px;color:var(--mvv-maroon);font-size:1.3rem;}
    .mvv-upload-card p{margin:0;color:var(--mvv-muted);font-size:.92rem;}
    .mvv-file-input{position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;}
    .mvv-file-picker{display:inline-flex;align-items:center;gap:8px;margin:22px 0 12px;padding:11px 20px;border:1px dashed var(--mvv-maroon);border-radius:9px;background:var(--mvv-cream);color:var(--mvv-maroon);font-weight:700;cursor:pointer;}
    .mvv-file-picker:hover{background:#fff0e5;}
    .mvv-file-count{display:block;min-height:22px;color:var(--mvv-muted);font-size:.88rem;}
    .mvv-preview-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(110px,1fr));gap:12px;margin:18px 0;text-align:left;}
    .mvv-preview-grid img{display:block;width:100%;aspect-ratio:1;object-fit:cover;border-radius:8px;border:1px solid var(--mvv-border);}
    .mvv-preview-item{position:relative;}
    .mvv-preview-item button{position:absolute;right:6px;bottom:6px;padding:6px 9px;border:0;border-radius:7px;background:rgba(107,26,26,.92);color:#fff;font-size:.74rem;font-weight:700;cursor:pointer;}
    .mvv-upload-submit{min-width:190px;}
    .mvv-upload-submit:disabled{opacity:.55;cursor:not-allowed;}
    .mvv-gallery-actions{display:flex;gap:8px;margin-top:10px;}
    .mvv-gallery-actions a,.mvv-selected-photo{display:inline-flex;align-items:center;justify-content:center;padding:7px 10px;border-radius:7px;font-size:.82rem;text-decoration:none;}
    .mvv-gallery-actions a:first-child{background:var(--mvv-maroon);color:#fff;}
    .mvv-gallery-actions a:last-child{border:1px solid #c0392b;color:#c0392b;}
    .mvv-selected-photo{background:rgba(201,146,26,.12);color:#805a00;font-weight:700;}
    .gallery-item{margin-bottom:24px;}
    .gallery-item .image{margin:0;overflow:hidden;border-radius:12px;border:1px solid var(--mvv-border);background:#fff;}
    .gallery-item .image img{display:block;width:100%;aspect-ratio:1;object-fit:cover;border:0!important;}
    .mvv-crop-modal{position:fixed;inset:0;z-index:2200;display:none;align-items:center;justify-content:center;padding:18px;background:rgba(31,20,18,.76);backdrop-filter:blur(5px);}
    .mvv-crop-modal.open{display:flex;}
    .mvv-crop-dialog{width:min(94vw,590px);max-height:94vh;overflow:auto;padding:22px;border-radius:16px;background:#fff;box-shadow:0 24px 80px rgba(0,0,0,.35);}
    .mvv-crop-head{display:flex;align-items:flex-start;justify-content:space-between;gap:14px;margin-bottom:15px;text-align:left;}
    .mvv-crop-head h3{margin:0 0 4px;color:var(--mvv-maroon);font-size:1.22rem;}
    .mvv-crop-head p{margin:0;color:var(--mvv-muted);font-size:.84rem;}
    .mvv-crop-close{width:34px;height:34px;border:0;border-radius:50%;background:#f5ece6;color:var(--mvv-maroon);font-size:1.25rem;cursor:pointer;}
    .mvv-crop-stage{position:relative;width:min(100%,460px);aspect-ratio:1;margin:0 auto;overflow:hidden;border-radius:10px;background:#27211f;touch-action:none;cursor:grab;user-select:none;}
    .mvv-crop-stage:active{cursor:grabbing;}
    .mvv-crop-stage canvas{display:block;width:100%;height:100%;}
    .mvv-crop-frame{position:absolute;inset:0;pointer-events:none;border:2px solid rgba(255,255,255,.95);box-shadow:inset 0 0 0 1px rgba(0,0,0,.15);}
    .mvv-crop-frame:before,.mvv-crop-frame:after{content:'';position:absolute;background:rgba(255,255,255,.55);}
    .mvv-crop-frame:before{left:33.333%;top:0;width:1px;height:100%;box-shadow:calc(33.333vw - 1px) 0 0 rgba(255,255,255,.55);}
    .mvv-crop-frame:after{top:33.333%;left:0;height:1px;width:100%;box-shadow:0 calc(33.333vw - 1px) 0 rgba(255,255,255,.55);}
    .mvv-crop-controls{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:10px;margin:17px auto 0;max-width:460px;}
    .mvv-crop-controls input{width:100%;accent-color:var(--mvv-maroon);}
    .mvv-crop-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:18px;}
    .mvv-crop-actions button{border:0;}
    .mvv-crop-counter{margin-right:auto;align-self:center;color:var(--mvv-muted);font-size:.84rem;}
    @media(max-width:575.98px){.mvv-upload-card{padding:20px 16px;}.mvv-preview-grid{grid-template-columns:repeat(2,1fr);}}
  </style>
</head>
<body>
<?php include('header.php'); ?>
<script>
function showdiv()
{
	document.getElementById("mydiv").style.visibility="visible";
}
setTimeout("showdiv()",1000);
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
	xmlhttp.open("GET","delete_photo.php?id="+id,true);
	xmlhttp.send();
	window.location='upload_photo_gallary?msg=flag';
}
var cropFiles = [];
var cropIndex = 0;
var cropSingleEdit = false;
var cropImage = new Image();
var cropState = { baseScale:1, zoom:1, x:0, y:0, dragging:false, startX:0, startY:0, originX:0, originY:0 };

function previewImages(input) {
  var selected = Array.from(input.files || []).filter(function(file) { return file.type === 'image/jpeg'; });
  if (!selected.length) { resetCropSelection(); return; }
  cropFiles = selected.map(function(file) { return { original:file, cropped:null, preview:'' }; });
  cropIndex = 0;
  openCropEditor(0);
}

function openCropEditor(index, singleEdit) {
  if (!cropFiles[index]) return;
  cropIndex = index;
  cropSingleEdit = singleEdit === true;
  var modal = document.getElementById('cropModal');
  var url = URL.createObjectURL(cropFiles[index].original);
  cropImage = new Image();
  cropImage.onload = function() {
    URL.revokeObjectURL(url);
    var canvas = document.getElementById('cropCanvas');
    cropState.baseScale = Math.max(canvas.width / cropImage.naturalWidth, canvas.height / cropImage.naturalHeight);
    cropState.zoom = 1;
    cropState.x = (canvas.width - cropImage.naturalWidth * cropState.baseScale) / 2;
    cropState.y = (canvas.height - cropImage.naturalHeight * cropState.baseScale) / 2;
    document.getElementById('cropZoom').value = 1;
    document.getElementById('cropCounter').textContent = 'Photo ' + (index + 1) + ' of ' + cropFiles.length;
    constrainCrop();
    drawCrop();
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };
  cropImage.src = url;
}

function drawCrop() {
  if (!cropImage.naturalWidth) return;
  var canvas = document.getElementById('cropCanvas');
  var ctx = canvas.getContext('2d');
  var scale = cropState.baseScale * cropState.zoom;
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.imageSmoothingEnabled = true;
  ctx.imageSmoothingQuality = 'high';
  ctx.drawImage(cropImage, cropState.x, cropState.y, cropImage.naturalWidth * scale, cropImage.naturalHeight * scale);
}

function constrainCrop() {
  if (!cropImage.naturalWidth) return;
  var canvas = document.getElementById('cropCanvas');
  var scale = cropState.baseScale * cropState.zoom;
  var width = cropImage.naturalWidth * scale;
  var height = cropImage.naturalHeight * scale;
  cropState.x = Math.min(0, Math.max(canvas.width - width, cropState.x));
  cropState.y = Math.min(0, Math.max(canvas.height - height, cropState.y));
}

function updateCropZoom(value) {
  if (!cropImage.naturalWidth) return;
  var canvas = document.getElementById('cropCanvas');
  var oldScale = cropState.baseScale * cropState.zoom;
  var imageCenterX = (canvas.width / 2 - cropState.x) / oldScale;
  var imageCenterY = (canvas.height / 2 - cropState.y) / oldScale;
  cropState.zoom = parseFloat(value);
  var newScale = cropState.baseScale * cropState.zoom;
  cropState.x = canvas.width / 2 - imageCenterX * newScale;
  cropState.y = canvas.height / 2 - imageCenterY * newScale;
  constrainCrop(); drawCrop();
}

function saveCrop() {
  var output = document.createElement('canvas');
  output.width = 1200; output.height = 1200;
  var outputContext = output.getContext('2d');
  var outputScale = 3;
  var imageScale = cropState.baseScale * cropState.zoom * outputScale;
  outputContext.imageSmoothingEnabled = true;
  outputContext.imageSmoothingQuality = 'high';
  outputContext.drawImage(cropImage, cropState.x * outputScale, cropState.y * outputScale, cropImage.naturalWidth * imageScale, cropImage.naturalHeight * imageScale);
  output.toBlob(function(blob) {
    if (!blob) return;
    var name = cropFiles[cropIndex].original.name.replace(/\.(jpe?g)$/i, '') + '_cropped.jpg';
    cropFiles[cropIndex].cropped = new File([blob], name, { type:'image/jpeg', lastModified:Date.now() });
    if (cropFiles[cropIndex].preview) URL.revokeObjectURL(cropFiles[cropIndex].preview);
    cropFiles[cropIndex].preview = URL.createObjectURL(blob);
    if (!cropSingleEdit && cropIndex < cropFiles.length - 1) openCropEditor(cropIndex + 1, false);
    else { closeCropEditor(); applyCroppedFiles(); }
  }, 'image/jpeg', 0.9);
}

function applyCroppedFiles() {
  var transfer = new DataTransfer();
  cropFiles.forEach(function(item) { if (item.cropped) transfer.items.add(item.cropped); });
  document.getElementById('upload').files = transfer.files;
  renderCropPreviews();
}

function renderCropPreviews() {
  var preview = document.getElementById('image_preview');
  preview.innerHTML = '';
  cropFiles.forEach(function(item, index) {
    if (!item.cropped) return;
    var wrap = document.createElement('div'); wrap.className = 'mvv-preview-item';
    var image = document.createElement('img'); image.src = item.preview;
    var edit = document.createElement('button'); edit.type = 'button'; edit.innerHTML = '<i class="fas fa-crop-alt"></i> Re-crop';
    edit.addEventListener('click', function() { openCropEditor(index, true); });
    wrap.appendChild(image); wrap.appendChild(edit); preview.appendChild(wrap);
  });
  var ready = cropFiles.filter(function(item) { return item.cropped; }).length;
  document.getElementById('file_count').textContent = ready + (ready === 1 ? ' cropped photo ready' : ' cropped photos ready');
  document.getElementById('buttonupload').disabled = ready !== cropFiles.length || !ready;
}

function closeCropEditor() {
  var modal = document.getElementById('cropModal');
  modal.classList.remove('open'); modal.setAttribute('aria-hidden', 'true'); document.body.style.overflow = '';
}

function cancelCropSelection() {
  closeCropEditor();
  if (!cropSingleEdit || !cropFiles[cropIndex] || !cropFiles[cropIndex].cropped) resetCropSelection();
}
function resetCropSelection() {
  cropFiles.forEach(function(item) { if (item.preview) URL.revokeObjectURL(item.preview); });
  cropFiles = [];
  document.getElementById('upload').value = '';
  document.getElementById('image_preview').innerHTML = '';
  document.getElementById('file_count').textContent = '';
  document.getElementById('buttonupload').disabled = true;
}

document.addEventListener('DOMContentLoaded', function() {
  var stage = document.getElementById('cropStage');
  function point(event) { var p = event.touches ? event.touches[0] : event; return {x:p.clientX,y:p.clientY}; }
  function start(event) { if (!cropImage.naturalWidth) return; var p=point(event); cropState.dragging=true; cropState.startX=p.x; cropState.startY=p.y; cropState.originX=cropState.x; cropState.originY=cropState.y; event.preventDefault(); }
  function move(event) { if (!cropState.dragging) return; var p=point(event); var rect=stage.getBoundingClientRect(); var factor=400/rect.width; cropState.x=cropState.originX+(p.x-cropState.startX)*factor; cropState.y=cropState.originY+(p.y-cropState.startY)*factor; constrainCrop(); drawCrop(); event.preventDefault(); }
  function end() { cropState.dragging=false; }
  stage.addEventListener('mousedown',start); stage.addEventListener('touchstart',start,{passive:false});
  window.addEventListener('mousemove',move); window.addEventListener('touchmove',move,{passive:false});
  window.addEventListener('mouseup',end); window.addEventListener('touchend',end);
  document.addEventListener('keydown',function(event){if(event.key==='Escape'&&document.getElementById('cropModal').classList.contains('open'))cancelCropSelection();});
});
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

function dp(id)
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
			document.getElementById("dpchange"+id).innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","setdp.php?id="+id,true);
	xmlhttp.send();
	window.location='upload_photo_gallary?msg=set';
}
</script>

<?php 
//FROM GALLARY PAGE
$id=$_SESSION['matriid'];
$sqlgal=mysqli_query($con,"select * from gallary where matri_id='$id'");
$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
//END OF GALLARY PAGE
?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Gallery</div>
      <h1>Upload Photo</h1>
      <p>तुमचे फोटो अपलोड करा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Photo Gallery</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

<?php $gallaryfetch=mysqli_query($con,"select * from gallary where matri_id='$id'");

if(mysqli_num_rows($gallaryfetch)>=0){?>

<?php 
$id=$_SESSION['matriid'];
$sqlgal=mysqli_query($con,"select * from gallary where matri_id='$id'");
$sqlreg=mysqli_query($con,"select * from register where MatriId='$id'");
$rowreg=mysqli_fetch_array($sqlreg);
?>

<?php 
if(mysqli_num_rows($sqlgal)<5){ ?>
<section class="mvv-section">
  <div class="mvv-container">
    <div id="mydiv" style="visibility:hidden;">
      <?php if (defined('success')) {?>
      <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
        <b>Alert:</b> <?php echo constant('success'); ?> 
      </div><?php }?>
      <?php
      $check = $_GET['msg'] ?? '';
      if($check == "success")
      {
      ?>
      <div style="background:rgba(27,106,27,0.08);border:1px solid rgba(27,106,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
        <b>Success:</b> Photo Uploaded Successfully.
      </div>
      <?php
      }
      elseif($check == "flag")
      {
      ?>
      <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
        <b>Success:</b> Photo Deleted Successfully.
      </div>
      <?php
      }
      elseif($check == "set")
      {
      ?>
      <div style="background:rgba(27,106,27,0.08);border:1px solid rgba(27,106,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
        <b>Success:</b> Your Profile Picture Changed Successfully.
      </div>
      <?php
      }
      elseif(in_array($check, ['no-file', 'invalid-file', 'upload-error', 'limit'], true))
      {
        $uploadErrors = [
          'no-file' => 'Please select at least one photo to upload.',
          'invalid-file' => 'Only valid JPG or JPEG images up to 8 MB are allowed.',
          'upload-error' => 'We could not upload your photo. Please try again.',
          'limit' => 'You can keep a maximum of five photos in your gallery.'
        ];
      ?>
      <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" role="alert">
        <b>Alert:</b> <?php echo $uploadErrors[$check]; ?>
      </div>
      <?php
      }
      else
      {
        if(($rowreg['Photo1Approve'] ?? '') == 'Rejected')
        {
        ?>
        <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
          <b>Alert:</b> Your Profile Picture Is Rejetecd By Admin. 
        </div>
        <?php
        }
        if(($rowreg['Photo2Approve'] ?? '') == 'Rejected')
        {
        ?>
        <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
          <b>Alert:</b> Your Photo Is Rejetecd By Admin. 
        </div>
        <?php
        }
        if(($rowreg['Photo1Approve'] ?? '') == 'Yes')
        {
        ?>
        <div style="background:rgba(27,106,27,0.08);border:1px solid rgba(27,106,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
          <b>Success:</b> Your Profile Photo Is Approved By Admin. 
        </div>
        <?php
        }
      }
      ?>
    </div>

    <div style="margin-bottom:24px;">
      <i class="fa fa-check-square" aria-hidden="true"></i> All photos uploaded are screened as per Photo Guidelines and 98% of those get activated within an hour.<br>
      <i class="fa fa-check-square" aria-hidden="true"></i> Other ways to upload your photos. E-mail your photos to <?php echo $siteinfo['FeedbackEmail'] ?> Mention your Profile ID and Name in the mail.
    </div>

    <form method="post" action="" enctype="multipart/form-data" class="mvv-upload-card">
      <h3>Add photos to your profile</h3>
      <p>Upload up to five clear JPG or JPEG photos. Each file can be up to 8 MB.</p>
      <label for="upload" class="mvv-file-picker"><i class="fa fa-image"></i> Choose photos</label>
      <input name="fileToUpload[]" id="upload" class="mvv-file-input" type="file" accept="image/jpeg,.jpg,.jpeg" onchange="previewImages(this)" multiple>
      <span class="mvv-file-count" id="file_count" aria-live="polite"></span>
      <div class="mvv-preview-grid" id="image_preview" aria-live="polite"></div>
      <button class="mvv-btn primary mvv-upload-submit" type="submit" name="submit" id="buttonupload" disabled><i class="fa fa-upload"></i> Upload photos</button>
    </form>

    <div class="mvv-crop-modal" id="cropModal" role="dialog" aria-modal="true" aria-labelledby="cropTitle" aria-hidden="true">
      <div class="mvv-crop-dialog">
        <div class="mvv-crop-head">
          <div><h3 id="cropTitle"><i class="fas fa-crop-alt"></i> Crop your photo</h3><p>Drag the image to position it inside the square. Use zoom if needed.</p></div>
          <button class="mvv-crop-close" type="button" onclick="cancelCropSelection()" aria-label="Close crop editor">&times;</button>
        </div>
        <div class="mvv-crop-stage" id="cropStage">
          <canvas id="cropCanvas" width="400" height="400"></canvas>
          <div class="mvv-crop-frame"></div>
        </div>
        <div class="mvv-crop-controls">
          <i class="fas fa-search-minus" aria-hidden="true"></i>
          <input id="cropZoom" type="range" min="1" max="3" step="0.01" value="1" oninput="updateCropZoom(this.value)" aria-label="Photo zoom">
          <i class="fas fa-search-plus" aria-hidden="true"></i>
        </div>
        <div class="mvv-crop-actions">
          <span class="mvv-crop-counter" id="cropCounter"></span>
          <button class="mvv-btn" type="button" onclick="cancelCropSelection()">Cancel</button>
          <button class="mvv-btn primary" type="button" onclick="saveCrop()"><i class="fas fa-check"></i> Apply Crop</button>
        </div>
      </div>
    </div>

    <?php if(!isset($_GET['msg'])) {  ?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="imgpreview" style="display:none"> <img src="" class="img-responsive thumbnail" id="blah"> </div>
    <?php }  ?>
  </div>
</section>
<?php } ?>

<section class="mvv-section">
  <div class="mvv-container">
    <?php if(mysqli_num_rows($sqlgal) == 5){ ?>
    <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.3);border-radius:6px;padding:12px 16px;margin-bottom:16px;text-align:center;" align="center" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <b>Alert:</b> Already You have Posted 5 Photos. 
    </div>
    <?php } ?>

    <?php $cnt=mysqli_num_rows($sqlgal);?>
    <?php if($cnt > 0) { ?>
    <div class="auto-container">
      <div class="row">
      <?php while($row=mysqli_fetch_array($sqlgal)) { ?>
        <div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeIn">
          <div class="image-box">
            <figure class="image"> <a href="gallary/<?php echo $row['photo_name'];?>" data-sub-html="Demo Description">
              <div class=""></div>
             <img src="gallary/<?php echo htmlspecialchars($row['photo_name'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" alt="Gallery photo" loading="lazy" onerror="this.onerror=null;this.src='images/nophoto.jpg';"></a> </figure>
          </div>
          <?php
          if($row['photo_name']!=$rowreg['Photo1'])
          {
          ?>
          <div class="mvv-gallery-actions">
              <a href="setdp.php?id=<?php echo $row['photo_id']?>"><i class="fas fa-user-check"></i>&nbsp; Set as profile photo</a>
              <a href="delete_photo.php?id=<?php echo $row['photo_id']?>" onclick="return confirm('Delete this photo?');"><i class="fas fa-trash"></i>&nbsp; Delete</a>
          </div>
          <?php 
          $is_protected =$row['photo_protect'];
          if($is_protected=="No")
          {
          ?>

          <?php
          }
          else if($is_protected=="Yes")
          {?>

          <?php }?>
          <?php }
          else
          { 
          ?>
          <div class="mvv-gallery-actions">
            <span class="mvv-selected-photo"><i class="fas fa-check-circle"></i>&nbsp; Profile photo</span>
          </div>
          <?php 
          $is_protected =$row['photo_protect'];
          $reg_photo = $rowreg['PhotoProtect'];

          if($is_protected=="No"&&$reg_photo=="No"||$reg_photo=="")
          {?>

          <?php
          }
          else if($is_protected=="Yes"||$reg_photo=="Yes")
          {?>

          <?php }?>
          <?php } ?>
        </div>
      <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
</section>
<?php } ?>

<?php
if($gallaryfetch == 0)
{
?>
<section class="mvv-section">
  <div class="mvv-container">
    <div class="error-title">OOP'S</div>
    <h4>Sorry Result Not Found</h4>
    <div class="text">You have not yet any photos.</div>
    <div class="col-lg-12 col-md-12 col-sm-12 form-group page-title mt-3">
      <a href="upload_photo_gallary"><button class="theme-btn btn-style-one" type="submit" name="submit"><span class="btn-title">Upload Photos</span></button></a>
    </div>
  </div>
</section>
<?php 
}
?>
</main>

<?php include('footer3.php'); ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin faio"></i><span class="btn-title">Loading</span> ';
    if ($this.html() !== loadingText) {
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
