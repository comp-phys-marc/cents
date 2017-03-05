<?php
/**
 * Created by PhpStorm.
 * User: marcusedwards
 * Date: 2017-03-01
 * Time: 4:50 PM
 */

namespace App\Http\Controllers;


use App\Models\Campaigns;

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

        if(!is_null($request->input('charge'))) {
            $campaign->charge = $request->input('charge');
        }

        $campaign->created_at = date('Y-m-d H:i:s');
        $campaign->updated_at = date('Y-m-d H:i:s');

        $campaign->save();

        $currentUser->Campaigns()->attach($campaign->id);

        $currentUser->save();

        return Redirect::route('home')->with('alert-success', 'Campaign successfully created.');

    }
}