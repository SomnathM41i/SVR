<?php require_once('../includes/bootstrap.php'); 
error_reporting(0);
include('protect.php');


?>
<?php
@header("Cache-Control: ");// leave blank to avoid IE errors
@header("Pragma: ");// leave blank to avoid IE errors
@header('Content-Description: File Transfer');
@header("Content-type: application/vnd.ms-excel");
@header("Content-Disposition: attachment; filename=Member Ban Report.xls"); ?>
<html>
        <head>
        <meta charset="UTF-8">
        </head>    
 <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
          <th> PROFILE ID </th>
	      <th> NAME </th>
		  <th>EMAIL ID </th>
		  <th> MOBILE NO </th>
		 <th>BLOCKED PERSON</th>
		 <th> NAME </th>
		<th>EMAIL ID </th>
		<th>MOBILE NO. </th>								        						    
          </tr>
        </thead>
        <tbody>
         <?php 
			$blocksql2=$con->query("select * from block_member")or svr_db_fail($con);
 
										
				while($blockrow2 = $blocksql2->fetch_assoc())
				{
					$profile_id=$blockrow2['profile_id'];
				  
				$blocksql3=$con->query("select * from register where MatriID='$profile_id'")or svr_db_fail($con);
                   $block3=0;
							if($blockrow3=$blocksql3->fetch_assoc())
							{
							$block3=$blockrow3['Name'];
							} 
											
											?>
           <tr>
          <td><a href="profile_view?ID=<?php echo $blockrow2['matriid'];?>"><?php echo $blockrow2['matriid'];?></a>
           </td>
		   <?php 
		   $rowfet=$blockrow2['matriid'];
		   $row=mysqli_query($con,"Select * from register where MatriID='$rowfet'");
		   $fetch=mysqli_fetch_array($row);
		   ?>
		     <td><?php echo $fetch['Name'];?></td>
		     <td><?php echo $fetch['ConfirmEmail'];?></td>
		     <td><?php echo $fetch['Mobile'];?></td>
            <td><a href="profile_view?ID=<?php echo $blockrow2['profile_id'];?>"><?php echo $blockrow2['profile_id'];?></a>
			</td>
				<?php 
			   $rowfet1=$blockrow2['profile_id'];
			   $row1=mysqli_query($con,"Select * from register where MatriID='$rowfet1'");
			   $fetch1=mysqli_fetch_array($row1);
			   ?>
             <td><?php echo $fetch1['Name'];?></td>
		     <td><?php echo $fetch1['ConfirmEmail'];?></td>
		     <td><?php echo $fetch1['Mobile'];?></td>      
          </tr>
          <?php } ?>
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



	