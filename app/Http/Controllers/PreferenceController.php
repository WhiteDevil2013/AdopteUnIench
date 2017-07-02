<?php

namespace AdopteUnIench\Http\Controllers;

use AdopteUnIench\Preference;
use AdopteUnIench\PreferenceType;
use AdopteUnIench\Profile;
use AdopteUnIench\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PreferenceController extends Controller
{
    public function index()
    {
        if (Auth::guest())
            return view('home');

        $profile_id = User::find(Auth::user()->id)->profile_id;
        $profile = Profile::find($profile_id);
        $preferences = Preference::where('profile_id', $profile_id)->first();
        if ($preferences)
            return view('preference/preference', ['race' => $profile->race, 'preferences' => $preferences]);
        return view('preference/preference', ['race' => $profile->race]);
    }

    protected function create(Request $request) {

        $preference = Preference::create([
            'sex' => (int) $request->input('sex'),
            'location' => $request->input('location'),
            'profile_id' => Profile::find(User::find(Auth::user()->id)->profile_id)->id
        ]);

        $preference->push();

        foreach ($request->input('races') as $race) {
            PreferenceType::create([
                'race' => $race,
                'preference_id' => $preference->id
            ])->push();
        }

        return view('home');
    }

    protected function update(Request $request) {
        $profile_id = User::find(Auth::user()->id)->profile_id;
        $preference = Preference::where('profile_id', $profile_id)->first();
        $preference->update([
            'sex' => (int) $request->input('sex'),
            'location' => $request->input('location')
        ]);

        PreferenceType::where('preference_id', $preference->id)->delete();

        foreach ($request->input('races') as $race) {
            PreferenceType::create([
                'race' => $race,
                'preference_id' => $preference->id
            ])->push();
        }
        return view('home');
    }
}
