<!DOCTYPE html>
<html lang="en">

<head>
	    
	    <title>MODAL EXAMPLE</title>
	   
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="description" content="DashboardKit is modern yet powerful Bootstrap 5 Admin Template comes with thousands of UI components & 180+ pages."/>
	    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template"/>
	    <meta name="author" content="DashboardKit" />

	    <!-- Favicon icon -->
	      <!-- Favicon icon -->
	    <link rel="icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

	    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
	    <!-- font css -->
	    <link rel="stylesheet" href="assets/fonts/feather.css">
	    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
	    <link rel="stylesheet" href="assets/fonts/material.css">

	    <!-- vendor css -->
	    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
	    <link rel="stylesheet" href="assets/css/layout-horizontal.css" id="main-style-link">
	    <link rel="stylesheet" href="assets/css/customizer.css"> 
		<!--popup css-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>


	.modal-confirm 
	{		
		color: #434e65;
		width: 525px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		font-size: 16px;
		border-radius: 5px;
		border: none;
	}
	.modal-confirm .modal-header {
		background: #47c9a2;
		border-bottom: none;   
		position: relative;
		text-align: center;
		margin: -20px -20px 0;
		border-radius: 5px 5px 0 0;
		padding: 35px;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 36px;
		margin: 10px 0;
	}
	.modal-confirm .form-control, .modal-confirm .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-confirm .close {
		position: absolute;
		top: 15px;
		right: 15px;
		color: #fff;
		text-shadow: none;
		opacity: 0.5;
	}
	.modal-confirm .close:hover {
		opacity: 0.8;
	}
	.modal-confirm .icon-box {
		color: #fff;		
		width: 95px;
		height: 95px;
		display: inline-block;
		border-radius: 50%;
		z-index: 9;
		border: 5px solid #fff;
		padding: 15px;
		text-align: center;
	}
	.modal-confirm .icon-box i {
		font-size: 64px;
		margin: -4px 0 0 -4px;
	}
	.modal-confirm.modal-dialog {
		margin-top: 80px;
	}
	.modal-confirm .btn, .modal-confirm .btn:active {
		color: #fff;
		border-radius: 4px;
		background: #eeb711 !important;
		text-decoration: none;
		transition: all 0.4s;
		line-height: normal;
		border-radius: 30px;
		margin-top: 10px;
		padding: 6px 20px;
		border: none;
	}
	</style>




	 
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  			<form method="POST" action="#" >
            	<div class="row">
            	
            		<div class="col-sm-6">
						<div class="form-group">
                            <label class="form-label">New Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Enter New password" id="newpwd" name="newpwd">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Enter your password again" id="confirmpwd" name="confirmpwd">
                        </div>
                    </div>
                   
				</div>
				<div class="card-footer text-end">
					
                	<a href="#.php"><button class=" btn btn-success"  type="button"  data-toggle="modal" data-target="#myModal" >Change Password</button>
                	</a><button class="btn btn-outline-dark ms-2">Clear</button>
            	</div>
			</form>
    <?php /* ?>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
    <?php */ ?>
  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-confirm">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="icon-box">
					    <i class="material-icons">&#xE876;</i>
				    </div>
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body text-center">
                    <h4> Great!
				    </h4>	
				    <p>
					    <?php 
						    echo "HELO"; 
					    ?> 
				    </p>
				    <button class="btn btn-success" data-dismiss="modal"><span>Start Exploring</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
      
        </div>
    </div>
</div>

</body>
</html>
