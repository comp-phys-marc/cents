<?php
require_once('vendor/autoload.php');

$stripe = array(
    "secret_key"      => "sk_test_ujuINGdAEzOVpUT3bfUQltdL",
    "publishable_key" => "pk_test_wfR5LNQXkcnvYxnQHjtDd5ox"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
