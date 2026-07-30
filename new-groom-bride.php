<?php require_once('includes/annual_income.php'); ?>
<link href="search-profiles-style/mystyle.css" rel="stylesheet">
<div class="auto-container new-profiles">
  <div class="sec-title text-center">
        <span class="title">Introducing Profile </span>
        <h2>Our Groom & Bride</h2>
  </div>
<div class="skew-container">
    <?php $qry_new=mysqli_query($con,"select * from register where Photo1 NOT LIKE 'nophoto.jpg' and Gender='Male' and Photo1Approve='Yes'  ORDER BY ID DESC limit 8");   ?>
        <?php  while($row=mysqli_fetch_array($qry_new))
        {?>
<div class="skew module" id="skew11">
  <p class="bdate"><?php echo $row['MatriID'] ?> &nbsp; 
    <span class="mat-id"><a href="login" class="mat-id" ><?php echo $row['Caste'] ?> </a></span></p>
  <div class="skew-image">
    <a href="login">
        <img src="photoprocess.php?image=gallary/<?php echo $row['Photo1'];?>&square=500" alt="">
    </a>
  </div>
  <div class="info">
    <div class="left-info">
      <p><?php $explodename=explode(" ",$row['Name']);if($explodename!=""){echo $explodename[0];}else{ echo"Null"; }?></p>
      <p><?php echo $row['Age']."YRS";?>, <?php                                       
                        $strheight = $row['Height'];
                         if($strheight =="1") { echo "4Ft "; }
                         else if($strheight =="") { echo "Null"; }
                         else if($strheight =="2") { echo "4Ft 1 inch "; }
                         else if($strheight =="3") { echo "4Ft 2 inch "; }
                         else if($strheight =="4") { echo "4Ft 3 inch "; }
                         else if($strheight =="5") { echo "4Ft 4 inch "; }
                         else if($strheight =="6") { echo "4Ft 5 inch "; }
                         else if($strheight =="7") { echo "4Ft 6 inch "; }
                         else if($strheight =="8") { echo "4Ft 7 inch "; }
                         else if($strheight =="9") { echo "4Ft 8 inch "; }
                         else if($strheight =="10") { echo "4Ft 9 inch "; }
                         else if($strheight =="11") { echo "4Ft 10 inch "; }
                         else if($strheight =="12") { echo "4Ft 11 inch "; }
                         else if($strheight =="13") { echo "5Ft "; }
                         else if($strheight =="14") { echo "5Ft 1 inch "; }
                         else if($strheight =="15") { echo "5Ft 2 inch "; }
                         else if($strheight =="16") { echo "5Ft 3 inch "; }
                         else if($strheight =="17") { echo "5Ft 4 inch "; }
                         else if($strheight =="18") { echo "5Ft 5 inch "; }
                         else if($strheight =="19") { echo "5Ft 6 inch "; }
                         else if($strheight =="20") { echo "5Ft 7 inch "; }
                         else if($strheight =="21") { echo "5Ft 8 inch "; }
                         else if($strheight =="22") { echo "5Ft 9 inch "; }
                         else if($strheight =="23") { echo "5Ft 10 inch "; }
                         else if($strheight =="24") { echo "5Ft 11 inch "; }
                         else if($strheight =="25") { echo "6Ft "; }
                         else if($strheight =="26") { echo "6Ft 1 inch "; }
                         else if($strheight =="27") { echo "6Ft 2 inch "; }
                         else if($strheight =="28") { echo "6Ft 3 inch "; }
                         else if($strheight =="29") { echo "6Ft 4 inch "; }
                         else if($strheight =="30") { echo "6Ft 5 inch "; }
                         else if($strheight =="31") { echo "6Ft 6 inch "; }
                         else if($strheight =="32") { echo "6Ft 7 inch "; }
                         else if($strheight =="33") { echo "6Ft 8 inch "; }
                         else if($strheight =="34") { echo "6Ft 9 inch "; }
                         else if($strheight =="35") { echo "6Ft 10 inch "; }
                         else if($strheight =="36") { echo "6Ft 11 inch "; }
                         else if($strheight =="37") { echo "7Ft "; } 
                                        ?></p>
      <p><?php echo htmlspecialchars(annual_income_format($row['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
      <p><?php if($row['working_city'] > 0) 
        { 
          echo $row['working_city'];
        }
        else
        {
          echo "Not Set";
        }
       ?></p>
    </div>
    <div class="right-info">
      <p><?php if($row['Maritalstatus'] > 0) 
        {
          echo $row['Maritalstatus'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
      </p>
      <p><?php if($row['Education'] > 0) 
        {
          echo $row['Education'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
       </p>
      <p><?php if($row['Occupation'] > 0) 
        {
          echo $row['Occupation'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
      </p>
    </div>
  </div>
</div>
 <?php  } ?> 
</div>

<div class="secondskew-container">
    <?php $qry_new=mysqli_query($con,"select * from register where Photo1 NOT LIKE 'nophoto.jpg' and Gender='Female' and Photo1Approve='Yes'  ORDER BY ID DESC limit 8");   ?>
        <?php  while($row=mysqli_fetch_array($qry_new))
        {?>
<div class="secondskew module" id="skew11">
  <p class="bdate"><?php echo $row['MatriID'] ?> &nbsp; <span> <a href="login" class="mat-id"><?php  echo $row['Caste'] ?> </a></span></p>
  <div class="skew-image">
    <a href="login">
        <img src="photoprocess.php?image=gallary/<?php echo $row['Photo1'];?>&square=500" alt="">
    </a>
  </div>
  <div class="info">
    <div class="left-info">
      <p><?php $explodename=explode(" ",$row['Name']);if($explodename!=""){echo $explodename[0];}else{ echo"Null"; }?></p>
      <p><?php echo $row['Age']."YRS";?>, <?php                                       
                        $strheight = $row['Height'];
                         if($strheight =="1") { echo "4Ft "; }
                         else if($strheight =="") { echo "Null"; }
                         else if($strheight =="2") { echo "4Ft 1 inch "; }
                         else if($strheight =="3") { echo "4Ft 2 inch "; }
                         else if($strheight =="4") { echo "4Ft 3 inch "; }
                         else if($strheight =="5") { echo "4Ft 4 inch "; }
                         else if($strheight =="6") { echo "4Ft 5 inch "; }
                         else if($strheight =="7") { echo "4Ft 6 inch "; }
                         else if($strheight =="8") { echo "4Ft 7 inch "; }
                         else if($strheight =="9") { echo "4Ft 8 inch "; }
                         else if($strheight =="10") { echo "4Ft 9 inch "; }
                         else if($strheight =="11") { echo "4Ft 10 inch "; }
                         else if($strheight =="12") { echo "4Ft 11 inch "; }
                         else if($strheight =="13") { echo "5Ft "; }
                         else if($strheight =="14") { echo "5Ft 1 inch "; }
                         else if($strheight =="15") { echo "5Ft 2 inch "; }
                         else if($strheight =="16") { echo "5Ft 3 inch "; }
                         else if($strheight =="17") { echo "5Ft 4 inch "; }
                         else if($strheight =="18") { echo "5Ft 5 inch "; }
                         else if($strheight =="19") { echo "5Ft 6 inch "; }
                         else if($strheight =="20") { echo "5Ft 7 inch "; }
                         else if($strheight =="21") { echo "5Ft 8 inch "; }
                         else if($strheight =="22") { echo "5Ft 9 inch "; }
                         else if($strheight =="23") { echo "5Ft 10 inch "; }
                         else if($strheight =="24") { echo "5Ft 11 inch "; }
                         else if($strheight =="25") { echo "6Ft "; }
                         else if($strheight =="26") { echo "6Ft 1 inch "; }
                         else if($strheight =="27") { echo "6Ft 2 inch "; }
                         else if($strheight =="28") { echo "6Ft 3 inch "; }
                         else if($strheight =="29") { echo "6Ft 4 inch "; }
                         else if($strheight =="30") { echo "6Ft 5 inch "; }
                         else if($strheight =="31") { echo "6Ft 6 inch "; }
                         else if($strheight =="32") { echo "6Ft 7 inch "; }
                         else if($strheight =="33") { echo "6Ft 8 inch "; }
                         else if($strheight =="34") { echo "6Ft 9 inch "; }
                         else if($strheight =="35") { echo "6Ft 10 inch "; }
                         else if($strheight =="36") { echo "6Ft 11 inch "; }
                         else if($strheight =="37") { echo "7Ft "; } 
                                        ?></p>
      <p><?php echo htmlspecialchars(annual_income_format($row['Annualincome'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
      <p><?php if($row['working_city'] > 0) 
        { 
          echo $row['working_city'];
        }
        else
        {
          echo "Not Set";
        }
       ?></p>
    </div>
    <div class="right-info">
      <p><?php if($row['Maritalstatus'] > 0) 
        {
          echo $row['Maritalstatus'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
      </p>
      <p><?php if($row['Education'] > 0) 
        {
          echo $row['Education'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
       </p>
      <p><?php if($row['Occupation'] > 0) 
        {
          echo $row['Occupation'];
        }
        else
        {
          echo "Not Set";
        }
       ?>
      </p>
    </div>
  </div>
</div>
 <?php  } ?> 
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
$(".skew:nth-child(1)").mouseover(function(){
  $(".skew" ).not(".skew:nth-child(1)" ).addClass("left-animation");
});
$(".skew:nth-child(1)").mouseleave(function(){
  $(".skew" ).not(".skew:lt(1)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(1)" ).addClass("return");
});
$(".skew:nth-child(2)").mouseover(function(){
$(".skew" ).not( ".skew:lt(2)" ).addClass("left-animation");
});
$(".skew:nth-child(2)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(2)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(2)" ).addClass("return");
});
$(".skew:nth-child(3)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(3)" ).addClass("left-animation");
});
$(".skew:nth-child(3)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(3)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(3)" ).addClass("return");
});
$(".skew:nth-child(4)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(4)" ).addClass("left-animation");
});
$(".skew:nth-child(4)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(4)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(4)" ).addClass("return");
});
$(".skew:nth-child(5)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(5)" ).addClass("left-animation");
});
$(".skew:nth-child(5)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(5)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(5)" ).addClass("return");
});
$(".skew:nth-child(6)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(6)" ).addClass("left-animation");
});
$(".skew:nth-child(6)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(6)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(6)" ).addClass("return");
});
$(".skew:nth-child(7)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(7)" ).addClass("left-animation");
});
$(".skew:nth-child(7)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(7)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(7)" ).addClass("return");
});
$(".skew:nth-child(8)").mouseover(function(){
  $(".skew" ).not( ".skew:lt(8)" ).addClass("left-animation");
});
$(".skew:nth-child(8)").mouseleave(function(){
  $(".skew" ).not( ".skew:lt(8)" ).removeClass("left-animation");
  $(".skew" ).not( ".skew:lt(8)" ).addClass("return");
});

$(".secondskew:nth-child(1)").mouseover(function(){
  $(".secondskew" ).not(".secondskew:nth-child(1)" ).addClass("left-animation");
});
$(".secondskew:nth-child(1)").mouseleave(function(){
  $(".secondskew" ).not(".secondskew:lt(1)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(1)" ).addClass("return");
});
$(".secondskew:nth-child(2)").mouseover(function(){
$(".secondskew" ).not( ".secondskew:lt(2)" ).addClass("left-animation");
});
$(".secondskew:nth-child(2)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(2)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(2)" ).addClass("return");
});
$(".secondskew:nth-child(3)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(3)" ).addClass("left-animation");
});
$(".secondskew:nth-child(3)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(3)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(3)" ).addClass("return");
});
$(".secondskew:nth-child(4)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(4)" ).addClass("left-animation");
});
$(".secondskew:nth-child(4)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(4)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(4)" ).addClass("return");
});
$(".secondskew:nth-child(5)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(5)" ).addClass("left-animation");
});
$(".secondskew:nth-child(5)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(5)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(5)" ).addClass("return");
});
$(".secondskew:nth-child(6)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(6)" ).addClass("left-animation");
});
$(".secondskew:nth-child(6)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(6)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(6)" ).addClass("return");
});
$(".secondskew:nth-child(7)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(7)" ).addClass("left-animation");
});
$(".secondskew:nth-child(7)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(7)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(7)" ).addClass("return");
});
$(".secondskew:nth-child(8)").mouseover(function(){
  $(".secondskew" ).not( ".secondskew:lt(8)" ).addClass("left-animation");
});
$(".secondskew:nth-child(8)").mouseleave(function(){
  $(".secondskew" ).not( ".secondskew:lt(8)" ).removeClass("left-animation");
  $(".secondskew" ).not( ".secondskew:lt(8)" ).addClass("return");
});


/*profile image */
var conHeight = $(".skew-image").height();
var imgHeight = $(".skew-image img").height();
var gap = (imgHeight - conHeight) / 2;
$(".skew-image img").css("margin-top", -gap);
/*End profile image */
});   
</script>
