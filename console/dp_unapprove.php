<?php require_once('../sys_dbconnection.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/

$pid=$_GET['id'];
$matri=$_GET['matriid'];
$gch=$con->query("select * from gallary where photo_id='$pid'");
//echo "select * from gallary where photo_id='$pid'";
$fetch=$gch->fetch_array();
//$matri=$fetch['matri_id'];
$gch1=$con->query("select * from register where MatriID='$matri'");
//echo "select * from register where MatriID='$matri'"; 
$fetch1=$gch1->fetch_array();
$gend=$fetch1['Gender'];
$con->query("delete from gallary where photo_id='$pid'"); 
//echo "delete from gallary where photo_id='$pid'"; 
$con->query("update register set Photo1='nophoto.jpg',Photo1Approve='Rejected' where MatriID='$matri'");

//echo "update register set Photo1='nophoto.jpg',Photo1Approve='Rejected' where MatriID='$matri'";
//echo"update register set Photo1='no-photo.gif' where MatriID='$matri'"; 
$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b WHERE a.photo1=b.photo_name and b.photo_approve='Pending' order by id desc");  
//echo "SELECT a.*,b.* FROM register a,gallary b WHERE a.photo1=b.photo_name and b.photo_approve='Pending' order by id desc";
$stroldphoto1 = $fetch1['Photo1'];
$myFile = "../gallary/".$stroldphoto1;
unlink($myFile); 
header('location:photo_approve?msg=delete'); 

?>

<?php
/*

?>
<title>dp Unapproval</title>

<div class="row"> 
  <!-- /.col -->
  <?php  
                    while($row=$sql->fetch_array())
					{
					?>
  <div class="col-xs-6 col-lg-2 col-sm-3">
       				 <div class="timeline-item">
                      <h4 class="timeline-header">
                      <a href="profile_view.php?ID=<?php  echo $row['MatriID']?>"><?php  echo $row['MatriID']?></a>
                      </h4>
                      <div class="timeline-body">
                      <img src="photoprocess.php?image=../gallary/<?php  echo $row['photo_name']?>&square=250"  border="0"/>
					 </div>
                       &nbsp;
                      <div class="timeline-footer">  &nbsp;
					  <a class="btn btn-success btn-xs" onClick="approve(<?php  echo $row['photo_id']?>,'<?php  echo $row['MatriID']?>')"><i class="fa fa-check" aria-hidden="true"></i></a> &nbsp;&nbsp;
                      <a class="btn btn-primary btn-xs" onClick="MM_openBrWindow('realcrop.php?matid=<?php   echo $row['MatriID']?>&Choice=1&op=<?php  echo $row['Photo1'] ?>&photoid=<?php  echo $row['photo_id'] ?>','editphotosize','scrollbars=yes,resizable=yes,width=550,height=600')"><i class="fa fa-crop" aria-hidden="true"></i></a> &nbsp;&nbsp;
                      <a class="btn btn-danger btn-xs" onClick="unapprove(<?php  echo $row['photo_id']?>,'<?php  $row['MatriID']?>','<?php  $row['Gender']?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> </div>
                    </div>
      </div>
  <?php  
					}
					?>
</div>
<?php */ ?>