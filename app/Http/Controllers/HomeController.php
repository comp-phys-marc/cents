<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $currentUser = Auth::User();

        $myCampaigns = $currentUser->myCampaigns()->get();
        $otherCampaigns = $currentUser->Campaigns()->get();

        return view('home')->with([
            'myCampaigns' => $myCampaigns,
            'otherCampaigns' => $otherCampaigns,
            'currentUser' => $currentUser
        ]);
    }
}
