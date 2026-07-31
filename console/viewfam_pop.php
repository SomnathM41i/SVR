<?php require_once('../sys_dbconnection.php');   
/*include'../dbconnectadmin.php';*/
$id = $_POST['rowid'];
$sqldata=mysqli_query($con,"SELECT * FROM register where MatriID='$id'");
//echo "select * from e_dist where id ='$id'";
$rowdata=mysqli_fetch_array($sqldata);


 ?>
 <style>
 .btcs
 {
         margin-left: 130px;
 }
 .spcss
 {
    color:blue;
    margin-left:10px 
 }
 </style>
 <div class="modal-header">
                <h5 class="modal-title">Family Description Approval</h5>
                <h5 class="modal-title"><span  class="spcss">ID:</span> <?php echo $id ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="family_approval" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                        
                                <!--<label class="form-label" for="Name">Enter Country</label>-->
                                <textarea type="text" class="form-control" id="Name" name="Name" rows="5"><?php  echo $rowdata['FamilyDetails']?></textarea>
                                <input type="hidden" name="id" value="<?php echo $id; ?>"><?php //echo $id ?>
                            </div>
                       </div>
                       
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-sm btcs" type="submit" name="submit">Approve</button>
                            <!--<button class="btn btn-danger">Clear</button>-->
                            <button class="btn btn-danger btn-sm btn-flat" type="submit" name="ignore1">Decline</a>
                        </div>
                    </div>
                </form>
            </div>