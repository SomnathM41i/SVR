<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
/*include'../dbconnectadmin.php';*/
$id = $_POST['rowid'];
$result = mysqli_query($con,"SELECT * from membershipplan where planid='$id'");
$row=mysqli_fetch_assoc($result);
?>
<script type="text/javascript">
 function nospaces(t)
{
if(t.value.match(/\s/g)){
alert('Sorry, you are not allowed to enter any spaces');
t.value=t.value.replace(/\s/g,'');
}}

</script>
            <div class="modal-header">
                <h5 class="modal-title"> Edit Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
			  <form action="membership.php?ID=<?php echo $id?>&msg=success" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Name"><small class="text-danger">* </small>Plan Display Name</label>
                            <input type="text" class="form-control" id="Name" name="name" placeholder=" Enter Plan Name"  value="<?php echo $row['plandisplayname']?>" Maxlength="12" onkeyup="nospaces(this)">
                            <input type="hidden" name="id" value="<?php echo $row['planid']; ?>">
						</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Price"><small class="text-danger">* </small>No of Contacts</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter No of Contacts" value="<?php echo $row['plannoofcontacts']?>" Maxlength="10" onkeypress="return isNumber(event)" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Period"><small class="text-danger">* </small>Plan Duration | days	</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter Plan Duration" value="<?php echo $row['planduration']?>" Maxlength="10"  onkeypress="return isNumber(event)">
                        </div>
                    </div>
					   <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Period"><small class="text-danger">* </small>Plan Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder=" Enter Plan Amount" value="<?php echo $row['planamount']?>" Maxlength="10"  onkeypress="return isNumber(event)">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                             <label class="form-label" for="Icon">Description</label>
                            <input type="text" class="form-control" placeholder="Enter Description" name="description1" value="<?php echo $row['description1']?>" maxlength="50" id="description1" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group fill">
                          
                            <input type="text" class="form-control" placeholder="Enter Description"  name="description2" value="<?php echo $row['description2']?>" maxlength="50" id="description2" placeholder="">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                          
                            <input type="text" class="form-control" placeholder="Enter Description" name="description3" value="<?php echo $row['description3']?>" maxlength="50"  id="description3" placeholder="">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                          
                            <input type="text" class="form-control" placeholder="Enter Description" name="description4" value="<?php echo $row['description4']?>" maxlength="50" id="description4" placeholder="">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                          
                            <input type="text" class="form-control" placeholder="Enter Description" name="description5" value="<?php echo $row['description5']?>" maxlength="50" id="description5" placeholder="">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                          
                            <input type="text" class="form-control"placeholder="Enter Description" name="description6" value="<?php echo $row['description6']?>" maxlength="50"  id="description6" placeholder="">
                        </div>
                    </div>
					  <div class="col-sm-12">
                        <div class="form-group fill">
                          
                          <input type="text" class="form-control" placeholder="Enter Description" name="description7" value="<?php echo $row['description7']?>" maxlength="50" id="description7" placeholder="">
                        </div>
                    </div>
                   
                </div>
            </div>
			</div>
            <div class="modal-footer">
                <button class="btn btn-primary"  type="submit" name="Update"> Save </button>
            </div>
       