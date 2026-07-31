<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
//session_start();
$id = $_SESSION['matriid'];


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Document</title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
    .mvv-page-hero h1 { text-transform:none; }
    .doc-item { margin-bottom:16px; }
    .doc-item a { font-size:0.9rem; }
  </style>
  <script>
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
xmlhttp.open("GET","delete_document.php?id="+id,true);
xmlhttp.send();
window.location='upload_document_proof?flag=9';}
  </script>
  <style>
.faio {
  margin-left: -12px;
  margin-right: 8px;
}
  </style>
</head>
<body>
<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Verification</div>
      <h1>Upload Document</h1>
      <p>तुमचे कागदपत्रे अपलोड करा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Upload Document Proof</span>
      </nav>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
    </div>
  </section>

  <?php
$id = $_SESSION['matriid'];
$sqlgal = mysqli_query($con, "select * from document where MatriID='$id' AND Name!='' ");
//echo "select * from gallary where matri_id='$id'";
$sqlreg = mysqli_query($con, "select * from document where MatriId='$id'");
$rowreg = mysqli_fetch_array($sqlreg);
//CHECKING STATUS OF DOC
$doc = mysqli_query($con, "select * from register where MatriId='$id'");
$doc_row = mysqli_fetch_array($doc);
?>

  <?php //}
 ?>
  <?php $gallaryfetch = mysqli_query($con, "select * from document where MatriID='$id'");
//if(mysqli_num_rows($gallaryfetch)>0){

?>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="content-column">
        <div class="sec-title">
          <?php $cnt = mysqli_num_rows($sqlgal); ?>
          <?php //while($row=mysqli_fetch_array($sqlgal))  {
$row = mysqli_fetch_array($sqlgal); ?>
          <?php //for($i=0;$i<$cnt;$i++){
 ?>

          <section class="newsletter-section">
            <div class="">
              <form method="post" action="upload_doc" enctype="multipart/form-data">
                <div class="row clearfix">

                  <div class="col-lg-12 col-md-12 col-sm-12 ">
<?php
if (($doc_row['docapprove'] == 'Rejected'))
{
    //echo "0";
    
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> Your Document Is Rejeted By Admin 
                      </div>
                    </div>
<?php
}
//}
// }
if($doc_row['docapprove'] == "Yes")
{
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Success:</b> Your Document Is Approved By Admin 
                      </div>
                    </div>
<?php
}

?>
<?php //if (defined('success8')) {
$check = $_GET['flag'];
switch ($check)
{
    case 1:

?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "File is an image"; ?>
                      </div>
                    </div>
<?php
    break;
    case 2:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "File is not an image."; ?>
                      </div>
                    </div>
<?php
    break;
    case 3:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "Sorry, file already exists."; ?>
                      </div>
                    </div>
<?php
    break;
    case 4:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "Sorry, your file is too large."; ?>
                      </div>
                    </div>
<?php
    break;
    case 5:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "Sorry, only JPG, JPEG, PDF and DOC/DOCX files are allowed."; ?>
                      </div>
                    </div>
<?php
    break;
    case 6:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Success:</b> <?php echo "Document Uploaded Successfully."; ?>
                      </div>
                    </div>
<?php
    break;
    case 7:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "Sorry, there was an error uploading your file."; ?>
                      </div>
                    </div>
<?php
    break;
    case 8:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Warning Alert:</b> <?php echo "Please Select at Least One Document For Upload."; ?>
                      </div>
                    </div>
<?php
    break;
    case 9:
?>
                    <div class="alert alert-info1" style="color:#fff;background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 100%);border-color:#fff;font-size:17px;margin-left:10px;margin-top:-50px;">
                      <div class="container">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#fff;opacity:20;">&times;</a>
                        <b>Success:</b> <?php echo "Document Deleted Successfully."; ?>
                      </div>
                    </div>
<?php
    break;
    //default:
    
?>
                                                                    
<?php
    //break;
    

        
}

?>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 " align="center">
                    <img src="" style="display:none" class="" id="thumbnil" width="300px" height="200px">                            
                  </div>

                  <!--SALARY SLIP -->
<?php
$result4 = mysqli_query($con, "SELECT * FROM document where MatriID='$id' and type='0' and docapprove != 'rejected' ");
//echo "SELECT * FROM document where MatriID='$id' and type='0'";
//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
$type0 = mysqli_fetch_assoc($result4);
if ($type0['type'] == "0")
{
?>
                  <span class="ml-2"><label>Employee</label> > Your Salary Slip</span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]" multiple  id="upload1" type="file" class="form-control ifile"  hidden />
                    <span class="mt-2" style="float:left">
                      <a href="document/<?php echo $type0['Name']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank"><i class="far fa-check-circle"></i> View </a> 
                      <a href="delete_document.php?id= <?php echo $type0['doc_id'] ?>" <?php /*onClick="deletephoto(<?php echo $type0['doc_id'] ?>)" */ ?>class="ml-3" style="color:red" ><i class="far fa-times-circle"></i> Delete </a>
                    </span>
                  </div>
<?PHP
}
else
{
?>
                  <span class="ml-2"><label>Employee</label> > Upload Your Salary Slip</span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]" multiple  id="upload1" type="file" class="form-control ifile"  />
                  </div>
<?php
}
?>

                  <!-- ITR-->
<?php
$result1 = mysqli_query($con, "SELECT * FROM document where MatriID='$id' and type='1' and docapprove != 'rejected' ");
//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
$type1 = mysqli_fetch_assoc($result1);
if ($type1['type'] == "1")
{
?>
                  <span class="ml-2 mt-2"><label> Business </label> >Your Last Year Income Tax Returns  </span>
                  <div class="col-lg-12 col-md-12 col-sm-12  mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]"  id="upload1" multiple type="file" class="form-control ifile" hidden />
                    <span class="mt-2" style="float:left">
                      <a href="document/<?php echo $type1['Name']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank"><i class="far fa-check-circle"></i>View </a> 
                      <a href="delete_document.php?id=<?php echo $type1['doc_id'] ?>" class="ml-3" style="color:red" <?PHP /*onClick="deletephoto(<?php echo $type1['doc_id'] ?>)" */ ?>><i class="far fa-times-circle"></i> Delete </a>
                    </span>  
                  </div><br>
<?PHP
}
else
{
?>
                  <span class="ml-2 mt-2"><label> Business </label> > Upload Your Last Year Income Tax Returns  </span>
                  <div class="col-lg-12 col-md-12 col-sm-12  mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]"  id="upload1" multiple type="file" class="form-control ifile"  />
                  </div>
<?php
}
?>

                  <!-- GRADUATION CERTIFICATE-->
<?php
$result2 = mysqli_query($con, "SELECT * FROM document where MatriID='$id' and type='2' and docapprove != 'rejected' ");
//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
$type2 = mysqli_fetch_assoc($result2);
if ($type2['type'] == "2")
{
?>
                  <span class="ml-2 mt-2"><label>Graduation</label> > Your Graduation Certificate</span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 " align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file"class="form-control ifile" hidden />
                    <span class="mt-2" style="float:left">
                      <a href="document/<?php echo $type2['Name']; ?>" data-sub-html="Demo Description" target="_blank" style="color:green"><i class="far fa-check-circle"></i> View </a> 
                      <a href="delete_document.php?id=<?php echo $type2['doc_id'] ?>" class="ml-3" style="color:red" <?php /*onClick="deletephoto(<?php echo $type2['doc_id'] ?>)"*/ ?> ><i class="far fa-times-circle"></i> Delete </a>
                    </span>
                  </div>
<?php
}
else
{
?>
                  <span class="ml-2 mt-2"><label>Graduation</label> > Upload Your Graduation Certificate</span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 " align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file"class="form-control ifile" />
                  </div>
<?php
}
?>

                  <!--POST GRADUATION -->
<?php
$result3 = mysqli_query($con, "SELECT * FROM document where MatriID='$id' and type='3' and docapprove != 'rejected' ");
//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
$type3 = mysqli_fetch_assoc($result3);
if ($type3['type'] == "3")
{
?>
                  <span class="ml-2 mt-2"><label>Post Graduation</label> > Your Post Graduation Certificate </span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 " align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file" class="form-control ifile" hidden  />
                    <span class="mt-2" style="float:left">
                      <a href="document/<?php echo $type3['Name']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank" ><i class="far fa-check-circle"></i> View </a> 
                      <a href="delete_document.php?id=<?php echo $type3['doc_id'] ?>" class="ml-3" style="color:red" <?php /* onClick="deletephoto(<?php echo $type3['doc_id'] ?>)"*/ ?> ><i class="far fa-times-circle"></i> Delete </a>
                    </span>
                  </div>
<?php
}
else
{
?>
                  <span class="ml-2 mt-2"><label>Post Graduation</label> > Upload Your Post Graduation Certificate </span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2 " align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file" class="form-control ifile"  />
                  </div>
<?php
}
?>

                  <!--ANY OTHER DEGREE -->
<?php
$res3 = mysqli_query($con, "SELECT * FROM document where MatriID='$id' and type='4' and docapprove != 'rejected' ");
//echo "SELECT * FROM `document` where MatriID='$strmid' where type='0'";
$type4 = mysqli_fetch_assoc($res3);
if ($type4['type'] == "4")
{
?>
                  <span class="ml-2 mt-2"><label>Any Other Degree</label> > Your Other Degree Certificate </span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file" class="form-control ifile" hidden />
                    <span class="mt-2" style="float:left">
                      <a href="document/<?php echo $type4['Name']; ?>" data-sub-html="Demo Description" style="color:green" target="_blank"><i class="far fa-check-circle"></i> View </a> 
                      <a href="delete_document.php?id=<?php echo $type4['doc_id'] ?>" class="ml-3" style="color:red" <?php /*onClick="deletephoto(<?php echo $type4['doc_id'] ?>)" */ ?> ><i class="far fa-times-circle"></i> Delete </a>
                    </span>
                  </div>
<?php
}
else
{
?>
                  <span class="ml-2 mt-2"><label>Any Other Degree</label> > Upload Any Other Degree Certificate </span>
                  <div class="col-lg-12 col-md-12 col-sm-12 mt-2 mb-2" align="center">
                    <input name="uploaded_file1[]"  id="upload1"  multiple type="file" class="form-control ifile"  />
                  </div>
<?php
}
?>

<?php if (mysqli_num_rows($sqlgal) < 5)
{ ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <input name="matid" type="hidden" id="id1"  required="required" value="<?php echo $id ?>">
<?php //echo $_GET['id'];
     ?>
                    <a><button class="theme-btn btn btn-style-one mt-4" type="submit" name="Continue" style="width:100%;" onClick="<script>alert('Select Image')</script>"><span class="btn-title">Upload Document</span></button></a>
                  </div>
<?PHP
} ?>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin  faio"></i><span class="btn-title">Loading</span> ';
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
