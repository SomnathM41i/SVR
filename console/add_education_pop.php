 <?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');
    
    $id = $_POST['rowid'];
?>
 <style>
    .btcs
    {
	     margin-left: 165px;
    }
 </style>
    <div class="modal-header">
                <h5 class="modal-title">Add Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
    </div>
    <div class="modal-body">
        <form action="add_education?ID=<?php echo $id?>&msg=success" method="post">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Education" required>
					</div>
				</div>
                <div class="col-sm-12">
                    <button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                </div>
            </div>
        </form>
    </div>