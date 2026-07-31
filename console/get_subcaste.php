<?php require_once('../sys_dbconnection.php'); 
require_once(dirname(__FILE__).'/protect.php');
/*include'../dbconnectadmin.php';*/

?>


    <table id="report-table" class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <!--<th>Sr. No.</th>-->
				<th width="829px">Subcaste</th>
				<th width="100px">Action</th>
			</tr>
        </thead>
        <tbody>
		<?php  
			$id=$_GET['id'];
										  // echo $id;
								          //$coun1=$_POST['country1'];
			$allrec=mysqli_query($con,"select * from subcaste where Caste='$id'");
										  // echo "select * from e_dist where sid2='$id'";
										  //exit;
			$total=mysqli_num_rows($allrec);
			$i=0;
			while($data=mysqli_fetch_assoc($allrec) and $i< $total)
			{
		?>
			<tr>
					<!--<td ><?php  echo $i+1;?></td>-->
				<td><?php  echo $data['subcast'];?></td>
				<td >
					<a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report2" data-id="<?php echo $data['id'];?>">
						Edit 
					</a>
					<?php
						if($data['status']=='enable')
						{
					?>
					<a href="delete_subcaste?flag=1&id=<?php echo $data['id'];?>" class="btn btn-danger btn-sm ml-3" >
						Inactivate
					</a>
					<?php
						}
						else
						{
					?>
					<a href="delete_subcaste?flag=0&id=<?php echo $data['id'];?>" class="btn btn-danger btn-sm ml-3" >
						Activate
					</a>
					
					<?php 
						}
					?>
				</td>
			</tr>
			<?php  
				$i++;
			}
			?>
                                    
                                    
        </tbody>
    </table>
                      
