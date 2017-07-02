<?php

namespace AdopteUnIench\Http\Controllers;

use Illuminate\Http\Request;
use AdopteUnIench\Profile;
use AdopteUnIench\Preference;
use AdopteUnIench\PreferenceType;

use Illuminate\Support\Facades\Auth;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preferences = Preference::where('profile_id', Auth::user()->profile_id)->first();

        return view('home', ['profiles' => Profile::all()]);
    }
}
