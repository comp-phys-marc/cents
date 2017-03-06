<?php
/**
 * Created by PhpStorm.
 * User: marcusedwards
 * Date: 2017-03-01
 * Time: 4:50 PM
 */

namespace App\Http\Controllers;


use App\Models\Campaigns;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CampaignController
{
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'charge' => 'required_with:set-charge'
        );

        $messages = [
            'name.required' => 'Campaign name required. Save not successful.',
            'charge.required' => 'Charge not specified. Save not successful.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator)->withInput();
        }

        $currentUser = Auth::user();

        $campaign = new Campaigns();
        $campaign->name = $request->input('name');
        $campaign->goal = $request->input('goal');

        if(!is_null($request->input('set-charge'))) {
            $campaign->set_charge = true;
            $campaign->charge = $request->input('charge');
        }
        else{
            $campaign->set_charge = false;
        }

        $campaign->created_at = date('Y-m-d H:i:s');
        $campaign->updated_at = date('Y-m-d H:i:s');
        $campaign->owner_id = $currentUser->id;

        $campaign->save();

        return Redirect::route('home')->with('alert-success', 'Campaign successfully created.');

    }

    public function update(Request $request){

        $rules = array(
            'id' => 'required',
            'name' => 'required',
            'charge' => 'required_with:set-charge'
        );

        $messages = [
            'id.required' => 'Something went wrong. Update not successful.',
            'name.required' => 'Campaign name required. Update not successful.',
            'charge.required' => 'Charge not specified. Update not successful.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator)->withInput();
        }

        $campaign = $campaign = Campaigns::where('id', '=', $request->input('id'))->first();
        $campaign->name = $request->input('name');

        if(!is_null($request->input('set-charge'))) {
            $campaign->set_charge = true;
        }
        else{
            $campaign->set_charge = false;
        }

        $campaign->updated_at = date('Y-m-d H:i:s');

        $campaign->save();

        return Redirect::route('home')->with('alert-success', 'Campaign successfully updated.');
    }

    public function close(Request $request){

        $rules = array(
            'id' => 'required'
        );

        $messages = [
            'id.required' => 'Something went wrong. Closing campaign not successful.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator)->withInput();
        }

        $campaign = Campaigns::where('id', '=', $request->input('id'))->first();

        $campaign->status = 'complete';

        return Redirect::route('home')->with('alert-success', 'Campaign successfully closed.');
    }

    public function remove(Request $request){

        $rules = array(
            'id' => 'required'
        );

        $messages = [
            'id.required' => 'Something went wrong. Deletion not successful.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator)->withInput();
        }

        $campaign = Campaigns::where('id', '=', $request->input('id'))->first();

        $campaign->delete();

        return Redirect::route('home')->with('alert-success', 'Campaign successfully deleted.');
    }
}