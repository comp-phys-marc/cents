<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use Stripe;

class PaymentController
{
    public function pay(Request $request, $id, $cid){
        $rules = array(
            'token' => 'required',
            'amount' => 'required'
        );

        $messages = [
            'token.required' => 'Token Error.',
            'amount.required' => 'Amount unspecified'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('campaign',['id'=>$cid])->withErrors($validator)->withInput();
        }

        $campaign = Campaigns::where('id', '=', $cid)->first();
        $user = User::where('id','=',$id)->first();


        //STRIPE CODE------------
        // See your keys here: https://dashboard.stripe.com/account/apikeys
                \Stripe\Stripe::setApiKey("sk_test_ujuINGdAEzOVpUT3bfUQltdL");

        // Token is created using Stripe.js or Checkout!
        // Get the payment token submitted by the form:
        $token = $_POST['stripeToken'];

        // Create a Customer:
        $customer = \Stripe\Customer::create(array(
            "email" => $user->email,
            "source" => $request->input('token')
        ));

        // Charge the Customer instead of the card:
        $charge = \Stripe\Charge::create(array(
            "amount" => $request->input('amount'),
            "currency" => "cad",
            "customer" => $customer->id
        ));

        // YOUR CODE: Save the customer ID and other info in a database for later.

        // YOUR CODE (LATER): When it's time to charge the customer again, retrieve the customer ID.
        $charge = \Stripe\Charge::create(array(
            "amount" => 1500, // $15.00 this time
            "currency" => "cad",
            "customer" => $customer_id
        ));
        //END STRIPE--------

        $payment = new Payments();
        $payment->user_id=$user->id;
        $payment->campaign_id=$campaign->id;
        $payment->amount=$request->input('amount');
        $payment->created_at=date('Y-m-d H:i:s');
        $payment->save();
        return Redirect::route('campaign',['id'=>$cid])->with('alert-success','Payment received');

    }
}