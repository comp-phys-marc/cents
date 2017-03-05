<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('home')->with('myCampaigns', $myCampaigns);
    }
}
