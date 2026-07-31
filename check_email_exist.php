<?php require_once('includes/bootstrap.php');

require_once('includes/security.php');
// check if the username is taken
/* SECURITY: prepared statement (H1 SQLi) + escaped output (H2 XSS).
   Previously the raw GET value was interpolated into the query and echoed
   unquoted into an HTML attribute. */
$strcm = strip_tags(isset($_GET['q']) ? $_GET['q'] : '');

if ($strcm != "")
 {
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
					echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='3' placeholder='Your E-mail'  onBlur='check_exist123(this.value);'>";

					echo"<font color=#FF0000> Email ID already Exists</font>";
					}
					else
					{
						echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='3' placeholder='Your E-mail'  onBlur='check_exist123(this.value);' value=\"".svr_e($strcm)."\">";

					}
					}
					else
					{
						echo"<input class='agile-ltext' style='border-radius:5px' type='email' name='email' tabindex='3' placeholder='Your E-mail'  onBlur='check_exist123(this.value);'>";

					}

?>
