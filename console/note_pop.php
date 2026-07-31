<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
$id = $_POST['rowid'];

$note = mysqli_query($con,"SELECT * FROM notes where MatriID='$id' ");
$total=mysqli_num_rows($note);
$i=0;




?>
 <style>
 .btcs
 {
	     margin-left: 180px;
 }
 </style>

 <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_new_note?id=<?php echo $id?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- <div class="form-group">
							    <input type="textarea" class="form-control" id="Name" name="Name" placeholder="Note" required>
								
                            </div> --> 
                            <div class="form-group">
                                <input type="text"  maxlength='75' class="form-control" id="note" autofocus name="note" placeholder="Add New Note" required>
                                
                            </div>
                            <?PHP 
                                if($total != '0')
                                {
                                ?>
                            <div class="form-group">
                                <textarea class="form-control" rows='05'id="editor2" name="your_note" placeholder="Notes"><?php 
                                    while($fetch_note=mysqli_fetch_assoc($note) and $i<$total)  
                                    {
                                        echo "\n".$fetch_note['note'];
                                    }
                                ?></textarea>
                            </div>
                             <?php }?>
                            
					   </div>
                       
                        <div class="col-sm-12 ">
                            <button class="btn btn-primary btcs ml-4" type="submit" name="submit">Add Note</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                        </div>
                    </div>
                </form>
            </div>

