<?php  require('stripe-php-master/init.php');
$Publishablekey ="pk_test_REPLACE_WITH_YOUR_PUBLISHABLE_KEY";

$Secretkey="sk_test_REPLACE_WITH_YOUR_SECRET_KEY";
\Stripe\Stripe::setApiKey($Secretkey);

?>