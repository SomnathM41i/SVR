<?php require_once('../includes/bootstrap.php');  
require_once(dirname(__FILE__).'/protect.php');

// check if the username is taken
$strcm = strip_tags(isset($_GET['q']) ? $_GET['q'] : '');

if ($strcm != "")
 {
		/* SECURITY (H1): prepared statement instead of raw interpolation. */
		$num_rows = 0;
		$stmt = mysqli_prepare($con, "SELECT COUNT(*) AS c FROM register WHERE ConfirmEmail=?");
		if ($stmt) {
		    mysqli_stmt_bind_param($stmt, "s", $strcm);
		    mysqli_stmt_execute($stmt);
		    $res = mysqli_stmt_get_result($stmt);
		    if ($res && ($r = mysqli_fetch_assoc($res))) { $num_rows = (int)$r['c']; }
		    mysqli_stmt_close($stmt);
		}
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
 