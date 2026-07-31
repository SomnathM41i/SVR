<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');


?>


                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <!--<th>Sr. No.</th>-->
										  <th width="829px">Caste</th>
										  <th width="100px">Action</th>
										  
                                    </tr>
                                </thead>
                                <tbody>
								<?php  
								           $id=$_GET['id'];
								           

										   
								          
										  $allrec=mysqli_query($con,"select * from caste where Religion='$id' ORDER BY Caste ASC");
										  
										  $total=mysqli_num_rows($allrec);
										  $i=0;
										  while($data=mysqli_fetch_assoc($allrec) and $i<$total)
										  {
										   ?>
											<tr>
											  
											  <td><?php  echo $data['Caste'];?></td>
											  <td>
											  	<a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report2" data-id="<?php echo $data['ID'];?>">Edit </a>
											  	<?php
													if($data['status']=='enable')
													{ 
											  	?>
											  	<a href="delete_caste?flag=1&id=<?php echo $data['ID'];?>" class="btn btn-danger btn-sm ml-3" >Inactivate</a>
												<?php
													}
													else
													{ 
												?>
												<a href="delete_caste?flag=0&id=<?php echo $data['ID'];?>" class="btn btn-danger btn-sm ml-3" >Activate</a>
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
                      
