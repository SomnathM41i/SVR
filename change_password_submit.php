<?php

require_once('sys_dbconnection.php');
require_once('includes/security.php');
/* SECURITY (H3): CSRF token check. */
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !svr_csrf_verify(isset($_POST['svr_csrf']) ? $_POST['svr_csrf'] : '')) {
    header('location:change_pswd?message=error');
    exit;
}
$op = $_POST['txtop'];
$strop=$op;
$strid = $_SESSION['MatriID'];
$cpwd = mysqli_query($con,"select ConfirmPassword from register WHERE MatriID='$strid'") or svr_db_fail($con);
$row=mysqli_fetch_assoc($cpwd);

$pwd= $row['ConfirmPassword'];
$hmm=$pwd;
$pass=$pwd;

if(isset($_POST['submit']))
{
    if($op == $hmm || $op == $pwd) 
    {
        if( $_POST['txtop'] != $_POST['txtcp'])
        {

            if($_POST['txtcp'] == $_POST['txtp'])
            {
                $strcp = $_POST['txtcp'];
                    
                $confirm_pass=$strcp;
                $nb=$confirm_pass;
                    
                $query="UPDATE register set ConfirmPassword='$nb' WHERE MatriID='$strid'";
                $update1 = mysqli_query($con,$query) or svr_db_fail($con);
                  
                header('location:change_pswd?message=success');
            }
            else
            {
                
                header('location:change_pswd?message=invalid'); 
            }
        }
        else
        {
            
            header('location:change_pswd?message=error');
        }
    }
    else
    {
        
        header('location:change_pswd?message=invalid1');
    }

}   
?>