<?php require_once('../sys_dbconnection.php');  
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
                <h5 class="modal-title">Add Featured User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="featured_user.php?ID=<?php echo $id?>&msg=success" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
						
                                <!--<label class="form-label" for="Name">Enter Religion</label>-->
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Profile ID" required>
								
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
							
                            <button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
							
                        </div>
                    </div>
                </form>
            </div>