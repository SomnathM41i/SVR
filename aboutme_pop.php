<?php require_once('sys_dbconnection.php');

error_reporting(0);
$id = $_POST['rowid'];





    <div class="modal-header">
          <h4 class="modal-title">Example Of About Me</h4>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
		<div class="modal-body">
				<?php echo"My name is <b>'Your Name'</b>. I am a 28-year old 5’1” tall, slim woman, based in Bengaluru.I have BE degree from Christ University, Bengaluru. I am currently working as a Software Engineer in Bengaluru. I intend to pursue my career after marriage. I am looking for someone who will appreciate living with a progressive, independent woman. I love reading books and collecting antiques.";?>
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
<script>
$('.modal-body').bind('copy paste cut',function(e) {
  e.preventDefault();
  //alert('cut,copy & paste options are disabled !!');
});
</script>



