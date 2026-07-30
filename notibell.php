<?php require_once('sys_dbconnection.php');
$matri=$_SESSION['MatriID'];

$s1=mysqli_query($con,"select * from usernote where MatriID='$matri'");
//echo "select * from usernote where MatriID='$matri'";
$s2=mysqli_num_rows($s1);
//echo $s2;

if($s2 > 0){ ?>
	<a href="user_notification"> <i class="fas fa-bell blink" style="color: darkorange; font-size: 21px;"></i></a>
	
<?php } else { ?>
	<a href="user_notification"> <i class="fas fa-bell " style="color: darkorange; font-size: 21px;"></i></a>
<?php } ?>
<style>
.blink{
		animation: blink 1s linear infinite;
	}
	@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;
color: #ec167f;}
100%{opacity: 1;}
}
</style>


