<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

$id = $_POST['rowid'];
$sqldata=mysqli_query($con,"select * from subcaste where id ='$id'");

$rowdata=mysqli_fetch_array($sqldata);?>
<style>
 .btcs
 {
	     margin-left: 165px;
 }
 </style>

 
<div class="modal-header">
    <h5 class="modal-title">Edit Subcaste</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
</div>
<div class="modal-body">
    <form action="add_subcaste?ID=<?php echo $id?>&msg=edit" method="post">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
						
                                <!--<label class="form-label" for="Name">Enter Religion</label>-->
				    <?php 
                        $mes=$rowdata['subcast']; 
				    ?>
                    <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $mes ;?>" placeholder="Enter Subcaste" required>
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