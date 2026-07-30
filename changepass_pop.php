<?php require_once('sys_dbconnection.php');
/*include('../dbconnectadmin.php');*/
//error_reporting(0);
$id = $_POST['rowid'];
echo $id ?>



<div class="modal-header justify-content-center">
	<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
		</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4>Great!</h4>	
				<p>Your account has been created successfully.</p>
				<button class="btn btn-success" data-dismiss="modal"><span>Start Exploring</span> <i class="material-icons">&#xE5C8;</i></button>
			</div>
	