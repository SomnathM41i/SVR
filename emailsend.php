<?php /*include'dbconnectadmin.php';*/
require_once('sys_dbconnection.php');

$contact=mysqli_query($con,"select * from cms where cms_id='9'");
$contactfetch=mysqli_fetch_array($contact);
$site=mysqli_query($con,"select * from siteconfig where ID='1'");
$siteinfo=mysqli_fetch_array($site);

if(isset($_POST['submit']))
{
  

$Name=$_POST['name'];
$Email=$_POST['email'];
$Phone=$_POST['phone'];
$Message=$_POST['message'];
$Subject=$_POST['subject'];
$date=date("Y-m-d");
//echo $date;
$site=mysqli_query($con,"insert into feedback (Date,Name,Mobile,email,Subject,Message) values('$date','$Name','$Phone','$Email','$Subject','$Message')");
    //echo "insert into feedback (Date,Name,Mobile,email,Subject,Message) values('$date','$Name','$Phone','$Email','$Subject','$Message')";
 
//include('smtp2.php');
 /*$mail->AddAddress('test@readymatrimonial.in',"demo");
$mail->Subject    = "Feedback";
$mail->Body="
<table width=280 border=1 style='border-collapse:collapse;' bgcolor='#FFFFCC' cellpadding=10>
        <tr>
          <th colspan='3' >Feedback Form</th>
          </tr>
        <tr>
          <td width='112'>Name</td>
          <td width='152'>$Name</td>
        </tr>
		<tr>
          <td width='112'>Subject</td>
          <td width='152'>$Subject</td>
        </tr>
		<tr>
          <td>Email ID</td>
          <td>$Email</td>
        </tr>
		<tr>
		  <td>Message</td>
          <td>$Message</td>
		</tr>
      </table>
 ";
$mail->Send();*/
 header("location:message?msg=feedback");
}?>