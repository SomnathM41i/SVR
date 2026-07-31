<?php require_once('../sys_dbconnection.php');/*include'../dbconnectadmin.php';*/
require_once(dirname(__FILE__).'/protect.php');
$id = $_POST['rowid'];
//echo $id;
?>
 <style>
 .btcs
 {
	     margin-left: 165px;
 }
 </style>
 <div class="modal-header">
                <h5 class="modal-title">Add Caste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_caste?ID=<?php echo $id?>&msg=success" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
							<select class="mb-3 form-control" name="religion">
						<?php  $q="select * from religion ORDER BY Religion ASC";
						     $rs=mysqli_query($con,$q); ?>
                                <!--<label class="form-label" for="Name">Enter Country</label>-->
								<option value="" selected>Select Religion </option>
									  <?php  while($data=mysqli_fetch_array($rs)){ ?>
									  <option value="<?php echo $data['Religion'];?>" required> <?php echo $data['Religion']; ?> </option>
										<?php }  ?>
                                  </select>
								  
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Caste" required>
								
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                        </div>
                    </div>
                </form>
            </div>