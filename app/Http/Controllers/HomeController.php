<?php

namespace AdopteUnIench\Http\Controllers;

use AdopteUnIench\Match;
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
        $profiles = Profile::all();
        $user_profile = Profile::find(Auth::user()->profile_id);
        $preference = Preference::where('profile_id', $user_profile->id)->first();

        $results = [];

        if ($preference) {

            // Check preferences for each
            foreach ($profiles as $profile) {
                if ($profile->sex == $preference->sex
                    && $profile->location == $preference->location
                    && $profile->isAnimal != $user_profile->isAnimal) {

                    if (!$user_profile->isAnimal) {
                        $preference_types = PreferenceType::where('preference_id', $preference->id)->get();

                        foreach($preference_types as $pref) {
                            if ($pref->race == $profile->race)
                                $results[] = $profile;
                        }
                    }
                    else
                        $results[] = $profile;
                }
            }
        }
        else {
            foreach ($profiles as $profile)
                if ($profile->isAnimal != $user_profile->isAnimal)
                    $results[] = $profile;
        }

        $notMatched = Match::where([['profile_id_1', Auth::user()->profile_id], ['hasMatched', 0]])->pluck('profile_id_2')->toArray();

        $matched_1 = Match::where([['profile_id_1', Auth::user()->profile_id], ['hasMatched', 1]])->pluck('profile_id_2')->toArray();
        $matched_2 = Match::where([['profile_id_2', Auth::user()->profile_id], ['hasMatched', 1]])->pluck('profile_id_1')->toArray();

        $matches = array_merge($matched_1, $matched_2);

        return view('home', ['profiles' => $results, 'notMatched' => $notMatched, 'matches' => $matches]);
    }
}
