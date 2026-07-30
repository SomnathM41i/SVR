<?php  require('stripe-php-master/init.php');
$Publishablekey ="pk_test_REPLACED";

$Secretkey="sk_test_REPLACED";
\Stripe\Stripe::setApiKey($Secretkey);

?>