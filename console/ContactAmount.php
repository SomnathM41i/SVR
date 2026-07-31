<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

$id = $_POST['rowid'];

$result = mysqli_query($con,"SELECT * from contactpaidamount where cid='$id'");
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
                <h5 class="modal-title"> Edit Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
			  <form action="add_contactamount.php?ID=<?php echo $id?>&msg=success" method="post">
            <div class="modal-body">
                <div class="row">
                   

					   <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="Period"><small class="text-danger">* </small>Amount</label>
                            <input type="text" class="form-control" maxlength='3' id="camount" name="camount" placeholder=" Enter Plan Amount" value="<?php echo $row['contactamount']?>" Maxlength="10"  onkeypress="return isNumber(event)">
                        </div>
                    </div>
					<?php  ?>
                </div>
            </div>
			</div>
            <div class="modal-footer">
                <button class="btn btn-primary"  type="submit" name="submit2"> Save </button>
            </div>
       