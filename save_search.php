<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Save Search</title>
  <link rel="icon" type="image/png" sizes="32x32" href="css3/assets/shivraj-logo.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>.mvv-page-hero h1 { text-transform:none; }</style>
</head>
<body>
<?php include('header.php'); ?>
<main>
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <p class="mvv-eyebrow">Matrimony</p>
      <h1>Save Search</h1>
      <p>Manage your saved searches</p>
      <nav class="mvv-breadcrumb">
        <a href="index_dashboard">Home</a>
        <span>Save Search</span>
      </nav>
    </div>
  </section>

  <?php $countbasic=mysqli_query($con,"select * from basic_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
        $countadvance=mysqli_query($con,"select * from  advance_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
        $totalsave=mysqli_num_rows($countbasic)+mysqli_num_rows($countadvance);
        if($totalsave!=0) {
    ?>
  <section class="mvv-section">
    <div class="mvv-container">
      <?php
        if( $_GET['msg'] == 'delete')
        {
      ?>
      <div style="background:rgba(106,27,27,0.08);border:1px solid rgba(106,27,27,0.2);border-radius:8px;padding:12px 16px;margin-bottom:18px;color:var(--mvv-maroon);font-size:0.9rem;" align="center">
        Saved Search Result Deleted Successfully.
      </div>
      <?php
        }
      ?>

      <div class="row">
        <div class="sidebar-side col-lg-12 col-md-12 col-sm-12">
          <aside class="sidebar padding-left">
            <div class="sidebar-widget popular-tags">
              <form class="form-horizontal" action="regular_search_result?page=1&id=<?php echo $_GET['id'];?>" method="post">
                <?php $ty=mysqli_query($con,"select * from basic_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
                  if(mysqli_num_rows($ty)!=0) { ?>
                  <h4 class="sidebar-title">Smart Search</h4>
                  <?php 
                    while($tyhm=mysqli_fetch_array($ty))
                    {?> 
                    <div class="widget-content">
                      <a href="regular_search_result?page=1&id=<?php echo $tyhm['id'] ?>" ><?php echo $tyhm['search_name'] ?></a>
                      <a href="#"  style="border-bottom:none">-</a>
                      <a href="delete_savesearch?id=<?php echo $tyhm['id'] ?>" style="border-bottom:none;" ><i class="fas fa-trash" style="color:#f20487"></i></a>
                    </div>
                  <?php } ?>
                </form>
              </div>
            </aside>
          <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <section class="mvv-section">
      <div class="mvv-container" style="margin-top:-80px;">
        <div class="row">
          <div class="sidebar-side col-lg-12 col-md-12 col-sm-12">
            <aside class="sidebar padding-left">
              <div class="sidebar-widget popular-tags">
                <form class="form-horizontal" action="advance_search_result?page=1&id=<?php echo $_GET['id'];?>" method="post">
                  <?php $ty1=mysqli_query($con,"select * from advance_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
                    if(mysqli_num_rows($ty1)!=0) { ?>
                    <h4 class="sidebar-title">Advance Search</h4>
                    <?php 
                      while($tyhm1=mysqli_fetch_array($ty1))
                      {?> 
                      <div class="widget-content">
                        <a href="advance_result?page=1&id=<?php echo $tyhm1['id'] ?>" ><?php echo $tyhm1['nameofsearch'] ?></a>
                        <a href="#"  style="border-bottom:none" >-</a>
                        <a href="delete_advancesearch?id=<?php echo $tyhm1['id'] ?>" style="border-bottom:none" ><i class="fas fa-trash" style="color:#f20487"></i></a>
                      </div>
                    <?php } ?>
                  </form>
                </div>
              </aside>
            <?php } ?>
            </div>
          </div>
        </div>
      </section>
    <?php } else { ?>
    <section class="mvv-section">
      <div class="mvv-container">
        <div style="text-align:center;padding:60px 0;">
          <h2 style="color:var(--mvv-maroon);font-size:3rem;margin-bottom:1rem;">OOP'S</h2>
          <h4>Sorry Result Not Found</h4>
          <p>You have not yet any save search.</p>
          <a href="smart_search" class="mvv-btn mvv-btn-primary">Search</a>
        </div>
      </div>
    </section>
    <?php } ?>
</main>

<?php include('footer3.php');?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'modalup_readmore.php',
            data :  'rowid='+ rowid,
            success : function(data){
            $('.modal-content').html(data);
            }
        });
     });
});
</script>
<style>
.close { color:#fff; opacity:20; }
.sidebar .popular-tags a { color:#6c757d; }
@media screen and (max-width: 768px) {
  .sidebar .popular-tags a { float:none !important; text-align:center; }
  .alert.alert-info { margin-left:0px; }
}
@media screen and (max-width: 568px) {
  .sidebar .popular-tags a { float:none !important; text-align:center; }
  .alert.alert-info { margin-left:0px; }
}
</style>
</body>
</html>
