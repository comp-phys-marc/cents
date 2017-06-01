<?php
/**
 * Created by PhpStorm.
 * User: marcusedwards
 * Date: 2017-02-27
 * Time: 4:16 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController
{
    public function index()
    {
        $currentUser = Auth::User();

        return view('profile')->with([
            'currentUser' => $currentUser,
            'success' => null
        ]);
    }

    public function account()
    {
        $currentUser = Auth::User();

        return view('profile')->with([
            'currentUser' => $currentUser,
            'success' => 'Fill out the Register Account Form to Enable Payouts'
        ]);
    }

    public function registerAccount(Request $request)
    {

        $currentUser = Auth::user();

        $rules = array(
            'date_of_birth' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('profile', ['currentUser' => $currentUser])->withErrors($validator)->withInput();
        }

        if(is_null($currentUser->legal_id)) {

            \Stripe\Stripe::setApiKey("sk_test_ujuINGdAEzOVpUT3bfUQltdL");

            $acct = null;

            $acct = \Stripe\Account::create(array(
                "date_of_birth" => $currentUser->address,
                "country" => $currentUser->country,
                "state" => $currentUser->state,
                "city" => $currentUser->city,
                "external_account" => '', //account id thing from JS
                "type" => "custom"
            ));

            while (is_null($acct)) {
                //NOP
            }

            $currentUser->legal_id = json_decode($acct)['id'];
        }

        $currentUser->birth = $request->input('date_of_birth');
        $currentUser->address = $request->input('address');
        $currentUser->city = $request->input('city');
        $currentUser->state = $request->input('state');
        $currentUser->country = $request->input('country');
        $currentUser->save();

        return view('profile')->with([
            'currentUser' => $currentUser,
            'success' => 'Account successfully updated.'
        ]);
    }

    public function update(Request $request)
    {

        $currentUser = Auth::user();

        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'passwordOld' => 'required_with:password',
            'password_confirmation' => 'required_with:password'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('profile', ['currentUser' => $currentUser])->withErrors($validator)->withInput();
        }

        if(!is_null($request->input('password')) && !($request->input('password') == "")){

            if(Hash::check($request->input('passwordOld'), $currentUser->password)) {

                if ($request->input('password') == $request->input('password_confirmation')) {

                    $currentUser->password = bcrypt($request->input('password'));

                } else {
                    return Redirect::route('profile', ['currentUser' => $currentUser])->withErrors(array('password' => 'The new password and new password confirmation did not match.'))->withInput();
                }
            }
            else{
                return Redirect::route('profile', ['currentUser' => $currentUser])->withErrors(array('passwordOld' => 'The current password was not entered correctly.'))->withInput();
            }
        }

        $currentUser->name = $request->input('name');
        $currentUser->email = $request->input('email');
        $currentUser->save();

        return view('profile')->with([
            'currentUser' => $currentUser,
            'success' => 'Profile successfully updated.'
        ]);

    }

    public function socialLogin(Request $request){

        if (($request->input('email') != 'noemail@cents.ca') && ($request->input('password') != 'nopassword') && (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])))
        {
            return Redirect::route('home');
        }
        else{
            $user = User::where('facebook_email', '=', $request->input('facebook_email'))->first();

            if(!is_null($user) && Hash::check($request->input('facebook_id'), $user->facebook_id)){

                Auth::loginUsingId($user->id);
                return Redirect::route('home');
            }

            else{
                return view('auth.login')->withErrors(['fail' => 'Credentials did not match our records.']);
            }
        }
    }
}