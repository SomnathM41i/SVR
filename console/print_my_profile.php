<?php require_once('../sys_dbconnection.php');  
include('protect1.php');
/*include('../dbconnectadmin.php');*/

$id=$_GET['ID'];
$result =mysqli_query($con,"SELECT * FROM register where MatriID='$id' ");
$me = mysqli_fetch_assoc($result);	
error_reporting(0); 
 ?>

<!DOCTYPE html>
<html>
    <head>	
        <meta charset="UTF-8"> 
        <title>print my profile</title>
        <?php //include('../newadmin/meta.php')?>
        <?php //include('../newadmin/main_style.php'); ?>  
      
  <script type="text/javascript">
function print_report()
{
	 var divElements = document.getElementById('print').innerHTML;
            var oldPage = document.body.innerHTML;

            document.body.innerHTML ="<html><head><title>Report</title> </head><body>"+divElements+"</body></html>" ;

            window.print();

            document.body.innerHTML = oldPage;
}
</script>

<link href="style.css" rel="stylesheet" type="text/css">
</head>

    
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
                        <!-- Header Navbar: style can be found in header.less -->
            <?php //include('topheader.php');?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <?php //include('leftmenu.php');?>
                <!-- /.sidebar -->
            </aside>
 

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><!-- /.col -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Profile</title>
<!--#F7F7F7-->
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" id="Outer">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="inner">
     
      <tr>
        
        <td width="80%">
		
		<table width="100%" height="0" border="0" cellpadding="1" cellspacing="1" id="content">
          
          <tr>
            <td colspan="4" valign="top" class="HeadText1">
            <div id="print">
            <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
   			 <tr>
     			 <td colspan="3"><?php include'profile_print_my.php';?></td>
  			 </tr>
    		 <tr>
    			  <td colspan="3" align="center"></td>
   			 </tr>
		  </table>
 		  </div>
        
     </td>
   </tr>
        </table>
             
              </td>
        </tr>
          
        </table>
		
		</td>
      </tr>
     
    </table></td>
  </tr>
</table>
</body>
</html>
 </div><!-- /.row -->
                    
                    
                
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
           
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
           <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
      
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>

