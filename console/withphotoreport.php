<?php require_once('../sys_dbconnection.php'); 
error_reporting(0);
include('protect.php');
/*include('../dbconnectadmin.php');*/

?>
<?php
@header("Cache-Control: ");// leave blank to avoid IE errors
@header("Pragma: ");// leave blank to avoid IE errors
@header('Content-Description: File Transfer');
@header("Content-type: application/vnd.ms-excel");
@header("Content-Disposition: attachment; filename=WithPhoto.xls"); ?>
<html>
        <head>
        <meta charset="UTF-8">
        </head>    
 <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
             <th>PROFILE ID</th>
			<th>PHOTO STATUS-YES</th>
            <th>PHOTO </th>
            <th>MOBILE NO.</th>
            <th>EMAIL ID</th>
          </tr>
        </thead>
         <?php  
		   
		   
		    $relsql1=$con->query("select * from register where Photo1!='nophoto.jpg'");
			while($relrow1 = $relsql1->fetch_assoc())
			{
			$matriid1=$relrow1['MatriID'];
			$photo=$relrow1['Photo1'];
			$mobile=$relrow1['Mobile'];
			$email=$relrow1['ConfirmEmail'];	
			?>
            
			<td><?php echo $matriid1?></td>
			<td><?php if($relrow1['Photo1']!="nophoto.jpg")
			{  echo  "Yes";  }  
			?></td>
			<td><?php if($relrow1['Photo1']!="nophoto.jpg"){ ?>
			<img src="../gallary/<?php echo $photo?>" style="height:80px;width:80px;">
			<?php } ?></td>
			<td><?php echo $mobile?></td>
            <td><?php echo $email?></td>
		    </tr>
			<?php  }?>
        </tbody>
      </table> <br>
<br>

      
     
   
                  </div>
                 </div>
              </div>
            </div>
          </div>
                </div>
      </div>
              <!-- /.row -->
              <div id="model"> </div>
          
<!-- ./wrapper --> 

<!-- jQuery 2.0.2 --> 

<script src="js/jquery.min.js"></script> 
<!-- Bootstrap --> 
<script src="js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 

<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
</html>



	