<?php require_once('includes/bootstrap.php');

error_reporting(0);
$id = $_POST['rowid'];
$sqldata=mysqli_query($con,"select * from successstory where ID='$id' ");
$rowdata=mysqli_fetch_array($sqldata);?>

    <div class="modal-header">
          <h4 class="modal-title">Happy Story</h4>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
		<div class="modal-body">
				 <?php 
				           $message =$rowdata['successmessage'];
							echo $message; ?>
		</div>
              <div class="modal-footer" style="padding:1.5rem">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
		


<script>
var closebtns = document.getElementsByClassName("close1");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>



