<?php require_once('sys_dbconnection.php');
/*include('dbconnectadmin.php');*/
error_reporting(0);
$id = $_POST['rowid'];
//echo $id;

//$sqldata=mysqli_query($con,"select * from successstory where ID='$id' ");
//$rowdata=mysqli_fetch_array($sqldata);
?>

    <div class="modal-header">
          <h4 class="modal-title">Example Of About Us</h4>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
		<div class="modal-body">
				<?php echo "I hail from a family of four members and we are from Dharasuram, a small town near Kumbakonam, but currently, reside in Chennai.My father is a school principal (SBOA Matriculation School) and my mother is a bank teller (Canara Bank). They are both retired now and I currently live with them.I have an elder brother who is doing his master’s degree in Computer Science in the United States.We are not an orthodox family but believes in respect for all religions and sects. My father is an Iyer and my mother is an Iyengar. We do not follow elaborate rituals but do celebrate most festivals and visit temples. We have a tradition of visiting a new place once every year as we believe it helps us learn new things and gives us a chance to meet new people.";?>
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



