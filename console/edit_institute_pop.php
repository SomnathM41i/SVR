<?php require_once('../sys_dbconnection.php');  
/*include'../dbconnectadmin.php';*/
$id = $_POST['rowid'];
//echo $id;
//exit;
$sqldata=mysqli_query($con,"select * from iit where Iid='$id'");
//echo "select * from caste where id ='$id'";
$rowdata=mysqli_fetch_array($sqldata);
//echo $rowdata['Caste'];?>
<style>
 .btcs
 {
         margin-left: 165px;
 }
 </style>

 
<div class="modal-header">
    <h5 class="modal-title">Edit Institute</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
</div>
<div class="modal-body">
    <form action="add_institue?ID=<?php echo $id?>&msg=edit" method="post">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <!--<label class="form-label" for="Name">Enter Religion</label>-->
                    <?php 
                        $mes=$rowdata['Inst_nm']; 
                    ?>
                    <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $mes ;?>" placeholder="Enter Institute Name" required>
                    <input type="hidden" name="id" value="<?php echo $rowdata['Iid']; ?>"><?php  $rowdata['Iid']; ?>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary btcs" type="submit" name="Update">Update</button>
                    <!--<button class="btn btn-danger">Clear</button>-->
                </div>
            </div>
    </form>
</div>