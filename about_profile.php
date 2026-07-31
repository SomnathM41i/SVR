<?php require_once('includes/bootstrap.php');

//error_reporting(0);
$id = $_POST['rowid'];
$sqldata=mysqli_query($con,"select * from register where MatriID='$id' ");
$rowdata=mysqli_fetch_array($sqldata);?>
   <div class="modal-header">
          <h4 class="modal-title">About Me</h4>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
		<div class="modal-body">
				 <?php 
				           $message =$rowdata['aboutus'];
							echo $message; ?>
		</div>
              <div class="modal-footer" style="padding:1.5rem">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
		


<script>