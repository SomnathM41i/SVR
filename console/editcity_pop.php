<?php  require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');

$id = $_POST['rowid'];

$sqldata=mysqli_query($con,"select * from e_city where id ='$id'");

$rowdata=mysqli_fetch_array($sqldata);

?>
<style>
 .btcs
 {
	     margin-left: 165px;
 }
 </style>

 
 <div class="modal-header">
                <h5 class="modal-title">Edit City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_city?ID=<?php echo $id?>&msg=edit" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
						
                                <!--<label class="form-label" for="Name">Enter Religion</label>-->
								<?php $mes=$rowdata['city']; ?>
                                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $mes ;?>" placeholder="Enter State" required>
								<input type="hidden" name="dist" value="<?php echo htmlspecialchars($rowdata['dist_ref'], ENT_QUOTES, 'UTF-8'); ?>">
								<select class="mt-3 form-control" name="taluka" required>
									<option value="">Select Taluka</option>
									<?php
									$talukaStatement=mysqli_prepare($con,"SELECT taluka FROM e_taluka WHERE dist_ref=? ORDER BY taluka");
									mysqli_stmt_bind_param($talukaStatement,'s',$rowdata['dist_ref']);
									mysqli_stmt_execute($talukaStatement);
									$talukaResult=mysqli_stmt_get_result($talukaStatement);
									while($talukaRow=mysqli_fetch_assoc($talukaResult)){
										$selected=($talukaRow['taluka']===($rowdata['taluka_ref']??''))?' selected':'';
										echo '<option value="'.htmlspecialchars($talukaRow['taluka'],ENT_QUOTES,'UTF-8').'"'.$selected.'>'.htmlspecialchars($talukaRow['taluka'],ENT_QUOTES,'UTF-8').'</option>';
									}
									?>
								</select>
								<input type="hidden" name="id" value="<?php echo $rowdata['id']; ?>"><?php 
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btcs" type="submit" name="Update">Update</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                        </div>
                    </div>
                </form>
            </div>
