
<?php 
include'include/dbconnect.php';

$query="select * from siteconfig where ID=1";
$rs=mysql_query($query);
$webinfo=mysql_fetch_array($rs);

$query="select * from cms";
$rs=mysql_query($query);

$mail->Body ='<table width=740 height=500 border=0 align=center style=border-bottom-width:medium; color:#090 cellpadding=0 cellspacing=0 >
  <tr>
    <td height=64><table width=746 border=0 cellpadding=0 cellspacing=0>
      <tr>
        <td><img src=emailsending/images/relationmatrimonysite.png width=375 height=47 /></td>
        <td width=327 class=subti5555>Call Us: <br>
          +91 9595838444, 9021217111</td>
      </tr>
    </table>
  </tr>
  <tr>
    <td height=80 valign=top><img src=emailsending/images/bg.png width=745 height=80 /></td>
  </tr>

  <tr>
    <td height=350 valign=top bgcolor=#CCFFCC><p><br>
      <span class=giftheadings44><strong> Dear '.$name.'<br>

Congratulations! Welcome to '.$webinfo[WebFriendlyname].' your registration form has been recived & is under varification.
After successfull varification will be live on our website.

Log on to '.$webinfo[WebFriendlyname].' now using the follwing information.</strong></span>
      <strong>
     <ul>
        <li class=abc><em>User Id : '.$id.'</em></li>
        <li class=abc><em>Password : '.$pass.'</em></li>
        
      </ul>
     
    </strong></p>
      <p class=abc>
        <br>
        Yours  truly, <br>
      For <strong>.'.$webinfo[WebFriendlyname].'</strong></p>
      <p class=abc><strong>The  Team</strong><br>
      We have a team of full-time staff,  and a network of freelancers we call on for specific expertise or to assist  when we get busy. Our core team consists  of:<br>
      Core team:<br>
      For Support<br>
      </p>
      <div class=abc><strong>Website:&nbsp;<a href=http://www.'.$webinfo[WebFriendlyname].' target=_blank>'.$webinfo[WebFriendlyname].' </a></strong><br>
        <div>Cell:'.mysql_result($rs,6,content).' <br>
        Add :'.mysql_result($rs,4,content).'</div>
      </div>
      <p class=abc><br>
    </p></td>
  </tr>
</table>';

?>