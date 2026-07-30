<?php require_once('../sys_dbconnection.php');   
include('protect.php');
/*include('../dbconnectadmin.php');*/
$pid=$_GET['id'];
$id=$_GET['matid'];

$con->query("update gallary set photo_approve='Yes' where photo_id='$pid'");
$con->query("update register set Photo2Approve='Yes' where MatriID='$id'");
//echo "update gallary set photo_approve='Yes' where photo_id='$pid'";

$sql = $con->query("SELECT a.*,b.* FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending'");
//echo "SELECT a.*,b.* FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending' "; 

$rsapp=$con->query("select * from gallary where photo_id='$pid'");	
//echo "select * from gallary where photo_id='$pid'";
$rowapp=$rsapp->fetch_array();
$pname=$rowapp['photo_name'];
//echo $pname;
$con->query("update activity set act_approve='Yes' where act_pic='$pname'");
//echo "update activity set act_approve='Yes' where act_pic='$pname'";
header('location:gal_photo_approve?msg=success');
//echo "1";

?>
<?PHP /*

<title>Gallary Photo approval</title>

<div class="row"> 
  <div class="col-xs-6 col-lg-2 col-sm-3">
      <div class="timeline-item"> 
        <h4 class="timeline-header">
  <?php  
    while($row=$sql->fetch_array())
		{
	?>
    
          <a href="profile_view.php?ID=<?php  echo $row['MatriID']?>"><?php  echo $row['MatriID']?>
          </a>
        </h4>
        <div class="timeline-body">
          <img src="photoprocess.php?image=../gallary/<?php  echo $row['photo_name']?>&square=250"  border="0"/>
				</div>&nbsp;

        <div class="timeline-footer">  &nbsp;
					<a class="btn btn-success btn-xs" onClick="approve(<?php  echo $row['photo_id']?>,'<?php  echo $row['MatriID']?>')"><i class="fa fa-check" aria-hidden="true"></i>
          </a> &nbsp;&nbsp;
          <a class="btn btn-primary btn-xs" onClick="MM_openBrWindow('realcrop.php?matid=<?php   echo $row['MatriID']?>&Choice=1&op=<?php  echo $row['Photo1'] ?>&photoid=<?php  echo $row['photo_id'] ?>','editphotosize','scrollbars=yes,resizable=yes,width=550,height=600')"><i class="fa fa-crop" aria-hidden="true"></i>
          </a> &nbsp;&nbsp;
          <a class="btn btn-danger btn-xs" onClick="unapprove(<?php  echo $row['photo_id']?>,'<?php  $row['MatriID']?>','<?php  $row['Gender']?>')"><i class="fa fa-trash-o" aria-hidden="true"></i>
          </a> 
          </div>
                    
        </div>
      </div>
  <?php  
					}
					?>
</div>
*/
