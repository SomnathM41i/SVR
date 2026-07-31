<?php
    require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
    $data_config = $db -> get_siteconfig();
    
    $on_off = $data_config -> is_smtp_set;
    $auto_on_off = $data_config -> auto_approve;
    $sms_on_off = $data_config -> is_sms_set;
    $pay_on_off = $data_config -> is_pay_gateway_set;
    $otp_on_off = $data_config -> otp_on_off;
    $translator_on_off = $data_config-> translator_on_off;
    if(isset($_POST['submit']))
    {
        if($on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set is_smtp_set='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set is_smtp_set='1'");
          header("Location: pay_sms_details");
        }
    }

    if(isset($_POST['update']))
    {
        if($auto_on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set auto_approve='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set auto_approve='1'");
          header("Location: pay_sms_details");
        }
    }
    if(isset($_POST['update1']))
    {
        if($sms_on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set is_sms_set='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set is_sms_set='1'");
          header("Location: pay_sms_details");
        }
    }
    if(isset($_POST['update_pay']))
    {
        if($pay_on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set is_pay_gateway_set='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set is_pay_gateway_set='1'");
          header("Location: pay_sms_details");
        }
    }
    if(isset($_POST['update_otp']))
    {
        if($otp_on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set otp_on_off='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set otp_on_off='1'");
          header("Location: pay_sms_details");
        }
    }
    if(isset($_POST['update_translator_status']))
    {
        if($translator_on_off != 0)
        {
            mysqli_query($con,"UPDATE siteconfig set translator_on_off='0'");
            header("Location: pay_sms_details");
        }
        else
        {
          mysqli_query($con,"UPDATE siteconfig set translator_on_off='1'");
          header("Location: pay_sms_details");
        }
    }
?>