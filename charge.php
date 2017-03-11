<?php require_once('./config.php'); ?>

<form action="charge.php" method="post">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="Access for a year"
            data-amount="5000"
            data-locale="auto"></script>
</form>

<?php
require_once('./config.php');

$token  = $_POST['stripeToken'];

$customer = \Stripe\Customer::create(array(
    'email' => 'customer@example.com',
    'source'  => $token
));

$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount'   => 5000,
    'currency' => 'usd'
));

echo '<h1>Successfully charged $50.00!</h1>';
?>