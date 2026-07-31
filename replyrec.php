<?php require_once('sys_dbconnection.php');

error_reporting(0);
$id = $_POST['rowid'];
$page = $_REQUEST['flag'];

$sqldata=mysqli_query($con,"select * from recommendation where id='$id' ");
$rowdata=mysqli_fetch_array($sqldata);

?>
<style>
.close {
     color: black !important; 
     opacity: none !important; 
}
</style>
    <div class="modal-header">
          <h4 class="modal-title">Reply</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    <?php
    	if($page != '')
    	{
    ?>
    <form action="off_recommend?flag=1&page=<?php echo $page;?>" method="post">
    <?php 
    	}else{
    ?>
		<form action="off_recommend?flag=1" method="post">
    <?php
    	}
    ?> 
		
		<div class="modal-body">
		
		<?php if($rowdata['reply']=='' ) {?>
		 <textarea class="form-control" name='reply' size="40" maxlength="500"></textarea>
		
		
		<?php } else { 
		$message = stripslashes($rowdata['reply']);?>
		
		<textarea  class="form-control" name='reply' size="40" maxlength="500" readonly><?php echo $message; ?></textarea>
		<?php } ?>
		</div>
              <div class="modal-footer" style="padding:1.5rem">
			  <?php if($rowdata['reply']=='' ) {?>
			   <input type="hidden" id="postId" name="postId" value="<?php echo $id ?>">
          <button type="submit" name="submit" class="btn btn-primary" >Send</button>
		  
		  
			  <?php } else {?>
			  <label> You already gave reply </label>
			   
			  <?php } ?>
		</div>
		</form>


<script>
var closebtns = document.getElementsByClassName("close1");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>



