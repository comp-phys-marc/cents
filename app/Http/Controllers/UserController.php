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
    public function socialLogin(Request $request){

        if (($request->input('email') != 'noemail@cents.ca') && ($request->input('password') != 'nopassword') && (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])))
        {
            return Redirect::route('home');
        }
        else{
            $user = User::where('facebook_email', '=', $request->input('facebook_email'))->first();

            if(!is_null($user) && Hash::check($request->input('facebook_id'), $user->facebook_id) && ($user->social_auto == true)){

                Auth::loginUsingId($user->id);
                return Redirect::route('home');
            }

            else{
                return view('auth.login');
            }
        }
    }
}