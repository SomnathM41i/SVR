<?php 
/*include 'dbconnectadmin.php';*/
require_once('sys_dbconnection.php');
$op = $_POST['txtop'];
$strop=$op;
$strid = $_SESSION['MatriID'];
$cpwd = mysqli_query($con,"select ConfirmPassword from register WHERE MatriID='$strid'") or die("Could not update data because ".mysql_error());
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
                    //ECHO $strcp;
                $confirm_pass=$strcp;
                $nb=$confirm_pass;
                    //echo $nb;
                $query="UPDATE register set ConfirmPassword='$nb' WHERE MatriID='$strid'";
                $update1 = mysqli_query($con,$query) or die("Could not update data because ".mysql_error());
                  //  echo "SUCCESS";
                header('location:change_pswd?message=success');
            }
            else
            {
                //   echo "NOT MATCH";
                header('location:change_pswd?message=invalid'); 
            }
        }
        else
        {
            //echo "wrong";
            header('location:change_pswd?message=error');
        }
    }
    else
    {
        //    echo "Incorrect Password";
        header('location:change_pswd?message=invalid1');
    }

}   
?>