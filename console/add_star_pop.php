 <?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
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
                <h5 class="modal-title">Add Star</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_star?ID=<?php echo $id?>&msg=success" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?php /* ?>
                            <select class="mb-3 form-control" name="religion">
                        <?php  $q="select * from education";
                             $rs=mysqli_query($con,$q); ?>
                                <!--<label class="form-label" for="Name">Enter Country</label>-->
                                <option value="" selected>Select Education </option>
                                      <?php  while($data=mysqli_fetch_array($rs)){ ?>
                                      <option value="<?php echo $data['edu'];?>" required> <?php echo $data['edu']; ?> </option>
                                        <?php }  ?>
                                  </select>
                                  <?php */?>
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Star" required>
                                
                            </div>
                       </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                        </div>
                    </div>
                </form>
            </div>