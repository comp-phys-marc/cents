<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Campaigns;
use App\User;

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
            return response()->json([
                'message' => 'Payment was not successful.',
                'status' => 'fail'
            ]);
        }

        $campaign = Campaigns::where('id', '=', $cid)->first();
        $user = User::where('id','=',$id)->first();


        //STRIPE CODE------------
        // See your keys here: https://dashboard.stripe.com/account/apikeys
                \Stripe\Stripe::setApiKey("sk_live_59mTgorIDd0ekM5qxWYQFqWk");

        if(!is_null($user->stripe)){

            $charge = \Stripe\Charge::create(array(
                "amount" => $request->input('amount'),
                "currency" => "cad",
                "customer" => $user->stripe
            ));
        }
        else {

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

            $user->stripe = $customer->id;
            $user->save();
        }

        $payment = new Payments();
        $payment->user_id=$user->id;
        $payment->campaign_id=$campaign->id;
        $payment->amount=$request->input('amount');
        $payment->created_at=date('Y-m-d H:i:s');

        $payment->save();

        return response()->json([
            'message' => 'Payment received.',
            'status' => 'success'
        ]);

    }
}