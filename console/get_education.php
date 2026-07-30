<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/

?>


                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <!--<th>Sr. No.</th>-->
										  <th width="829px">Caste</th>
										  <th></th>
										  
                                    </tr>
                                </thead>
                                <tbody>
								<?php  
								           $id=$_GET['id'];
								           

										   //echo $id;
								          //$coun1=$_POST['country1'];
										  $allrec=mysqli_query($con,"select * from caste where Religion='$id' ORDER BY Caste ASC");
										  //echo "select * from caste where Religion='$id' ORDER BY Caste ASC";
										  $total=mysqli_num_rows($allrec);
										  $i=0;
										  while($data=mysqli_fetch_assoc($allrec) and $i<$total)
										  {
										   ?>
											<tr>
											  <!--<td ><?php  echo $i+1;?></td>-->
											  <td><?php  echo $data['Caste'];?></td>
											  <td ><a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report2" data-id="<?php echo $data['ID'];?>"><i class="feather icon-edit"></i>Edit </a>
											  <a href="delete_caste.php?id=<?php echo $data['Caste'];?>" class="btn btn-danger btn-sm ml-3"><i class="feather icon-trash-2"></i>Delete</a></td>

											</tr>
											<?php 

										  $i++;
										  }
										  ?>
                                    
                                    
                                </tbody>
                            </table>
                      
