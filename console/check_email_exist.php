<?php require_once('../sys_dbconnection.php');  
/*include('../dbconnectadmin.php');*/
// check if the username is taken
$strcm = strip_tags($_GET['q']);

if ($strcm != "")
 { 
		$check = "select ConfirmEmail from register where ConfirmEmail = '".$_GET['q']."';"; 
		
		$qry = mysqli_query($con,$check) or die ("Could not match data because ".mysqli_error($con));
		$num_rows = mysqli_num_rows($qry); 
					if ($num_rows!= 0)
					{ 
					echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='1' placeholder='Your E-mail'  onBlur='check_exist123(this.value);'>";
					echo"<span class='fa fa-paper-plane butnsub'></span>";
					echo"<font color=#FF0000> Email ID already Exists</font>";
					}
					else
					{
						echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='1' placeholder='Your E-mail'  onBlur='check_exist123(this.value);' value=".$strcm.">";
						echo"<span class='fa fa-paper-plane butnsub'></span>";
					}
					}
					else
					{
						echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='1' placeholder='Your E-mail'  onBlur='check_exist123(this.value);' value=".$strcm.">";
						echo"<span class='fa fa-paper-plane butnsub'></span>";
					}

?>
 