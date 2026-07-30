<?php  require_once('../sys_dbconnection.php');
//include'../dbconnectadmin.php';

?>


                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <!--<th>Sr. No.</th>-->
										  <th>City</th>
										  <th>Taluka</th>
										  <th width="100px">Action</th>
										  
                                    </tr>
                                </thead>
                                <tbody>
								<?php  
								           $id=$_GET['id'];
								           

										   //echo $id;
								          //$coun1=$_POST['country1'];
										  $allrec=mysqli_query($con,"select * from e_city where dist_ref='$id'");
										  //echo "select * from caste where Religion='$id' ORDER BY Caste ASC";
										  $total=mysqli_num_rows($allrec);
										  $i=0;
										  while($data=mysqli_fetch_assoc($allrec) and $i<$total)
										  {
										   ?>
											<tr>
											  <!--<td ><?php  echo $i+1;?></td>-->
											  <td><?php  echo $data['city'];?></td>
											  <td><?php echo htmlspecialchars($data['taluka_ref'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
											  <td >
											  	<a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report2" data-id="<?php echo $data['id'];?>">Edit </a>
											  	<?php
													if($data['status']=='enable')
													{

													
												?>
												<a href="delete_city?flag=1&id=<?php echo $data['id'];?>" class="btn btn-danger btn-sm ml-3" >Inactivate</a></td>
												<?php
													}
													else
													{
												?>
												<a href="delete_city?flag=0&id=<?php echo $data['id'];?>" class="btn btn-danger btn-sm ml-3" >Activate</a></td>
												<?php
													}
												?>
											</tr>
											<?php 
													$i++;
										  }
										  ?>
                                    
                                    
                                </tbody>
                            </table>
                      
