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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CampaignController
{
    public function index($id)
    {
        $currentUser = Auth::User();

        $campaign = Campaigns::where('id', '=', $id)->first();
        $payments = $campaign->Payments()->get();

        $progress = 0;
        foreach($payments as $payment){
            $progress += $payment->amount;
        }

        return view('campaign')->with([
            'campaign' => $campaign,
            'currentUser' => $currentUser,
            'payments' => $payments,
            'progress' => $progress
        ]);
    }

    public function store(Request $request)
    {

        if(!is_null($request->file('image'))) {
            $rules = array(
                'name' => 'required',
                'charge' => 'required_with:set-charge',
                'description' => 'required',
                'image' => 'mimes:jpg,jpeg,png'
            );

            $messages = [
                'name.required' => 'Campaign name required. Save not successful.',
                'description.required' => 'Campaign description required. Save not successful.',
                'charge.required' => 'Charge not specified. Save not successful.',
                'image.mimes' => 'Image must be of type jpg, jpeg or png. Save was not successful.'
            ];
        }
        else{
            $rules = array(
                'name' => 'required',
                'charge' => 'required_with:set-charge',
                'description' => 'required'
            );

            $messages = [
                'name.required' => 'Campaign name required. Save not successful.',
                'description.required' => 'Campaign description required. Save not successful.',
                'charge.required' => 'Charge not specified. Save not successful.'
            ];
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::route('home')->withErrors($validator)->withInput();
        }

        $currentUser = Auth::user();

        $campaign = new Campaigns();
        $campaign->name = $request->input('name');
        $campaign->description = $request->input('description');
        $campaign->goal = $request->input('goal');
        $campaign->link = str_replace('/','_',password_hash($currentUser->password.$request->input('name'),PASSWORD_DEFAULT));

        if(!is_null($request->input('set-charge'))) {
            $campaign->set_charge = true;
            $campaign->charge = $request->input('charge');
        }
        else{
            $campaign->set_charge = false;
        }

        if(!is_null($request->file('image'))){

            $image = $request->file('image');
            $mime = '.'.$image->getClientOriginalExtension();
            $imageName = $campaign->id.'-image'.$mime;

            $campaign->image = $imageName;

            $request->file('image')->move(public_path("img/"), $imageName);
        }

        $campaign->created_at = date('Y-m-d H:i:s');
        $campaign->updated_at = date('Y-m-d H:i:s');
        $campaign->owner_id = $currentUser->id;

        $campaign->save();

        return Redirect::route('home')->with('alert-success',
            'Campaign successfully created.');

    }

    public function update(Request $request, $id){

        $currentUser = Auth::user();

        if(!is_null($request->file('image'))) {
            $rules = array(
                'name' => 'required',
                'charge' => 'required_with:set-charge',
                'description' => 'required',
                'image' => 'mimes:jpg,jpeg,png'
            );

            $messages = [
                'name.required' => 'Campaign name required. Save not successful.',
                'description.required' => 'Campaign description required. Save not successful.',
                'charge.required' => 'Charge not specified. Save not successful.',
                'image.mimes' => 'Image must be of type jpg, jpeg or png. Save was not successful.'
            ];
        }
        else {
            $rules = array(
                'name' => 'required',
                'description.required' => 'Campaign description required. Save not successful.',
                'charge' => 'required_with:set-charge'
            );

            $messages = [
                'name.required' => 'Campaign name required. Update not successful.',
                'description.required' => 'Campaign description required. Save not successful.',
                'charge.required' => 'Charge not specified. Update not successful.'
            ];
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Update failed.',
                'status' => 'fail'
            ]);
        }

        $campaign = Campaigns::where('id', '=', $id)->first();
        $campaign->name = $request->input('name');

        if(!is_null($request->input('description'))) {
            $campaign->description = $request->input('description');
        }

        if(!is_null($request->file('image'))){

            $image = $request->file('image');
            $mime = '.'.$image->getClientOriginalExtension();
            $imageName = $campaign->id.'-image'.$mime;

            $campaign->image = $imageName;

            $request->file('image')->move(public_path("img/"), $imageName);
        }

        if(!is_null($request->input('set-charge'))) {
            $campaign->set_charge = true;
        }
        else{
            $campaign->set_charge = false;
        }

        $campaign->updated_at = date('Y-m-d H:i:s');

        $campaign->save();

        return response()->json([
            'message' => 'Update successful.',
            'status' => 'success'
        ]);
    }

    public function join($id, $link){

        $currentUser = Auth::User();

        $campaign = Campaigns::where('id', '=', $id)->where('link', '=', $link)->first();

        if(!is_null($campaign)){

            if(!$campaign->Users()->get()->contains($currentUser->id)) {

                $campaign->Users()->attach($currentUser->id);

                $campaign->save();
                $currentUser->save();
            }
            else{

                return Redirect::route('home')->with('alert-warning', 'An attempt was made to join a group you are already in.');
            }

            return Redirect::route('home')->with('alert-success', 'Campaign successfully joined.');
        }
        else{

            return Redirect::route('home')->with('alert-danger', 'Invalid link. Campaign not successfully joined.');
        }
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

        $campaign->save();

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