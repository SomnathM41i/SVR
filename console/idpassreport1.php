<?php  require_once('../includes/bootstrap.php'); 
error_reporting(0);
include('protect.php');


?>
<?php
@header("Cache-Control: ");// leave blank to avoid IE errors
@header("Pragma: ");// leave blank to avoid IE errors
@header('Content-Description: File Transfer');
@header("Content-type: application/vnd.ms-excel");
@header("Content-Disposition: attachment; filename=ID& Password download.xls"); ?>
<html>
        <head>
        <meta charset="UTF-8">
        </head>    
 <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NAME</th>
			<th>PROFILE ID</th>
			<th>MOBILE NO.</th>
			<th>EMAIL ID</th>			
			<th>PASSWORD</th>
            
            
          </tr>
        </thead>
        <tbody>
         <?php 
			$relsql=$con->query("select * from register")or svr_db_fail($con);
			while($relrow = $relsql->fetch_assoc())
			{
			$name=$relrow['Name'];
			$matriid=$relrow['MatriID'];
			$mobile=$relrow['Mobile'];
			$email=$relrow['ConfirmEmail'];
			$Password=$relrow['ConfirmPassword'];
					
			?>
          <tr>
            <td><?php echo $name;?></td>
			<td><?php echo $matriid;?></td>
			<td><?php echo $mobile;?></td>
			<td><?php echo $email;?></td>
            <td><?php echo $Password?></td>
            
          </tr>
          <?php 
											}
											
											
										?>
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



	