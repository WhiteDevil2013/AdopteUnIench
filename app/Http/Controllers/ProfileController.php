<?php

namespace AdopteUnIench\Http\Controllers;

use AdopteUnIench\Profile;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    private $errMsg;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::guest())
            return view('auth.login');
        $user = Auth::user();
        $profile_id = $user->profile_id;
        $curProfile = Profile::findOrFail($profile_id);
        if (isset($curProfile))
        {
            $race = $this->tradRace($curProfile->race);

            $curProfile->race = $race;
            return view('profile/profile')->with('profile', $curProfile);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::guest())
            return view('auth.login');

        $profile = Profile::find($id);
        $profile->race = $this->tradRace($profile->race);

        return view('profile/profile')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public static function tradRace($race_eng) {
        $race = "Humain";
        switch ($race_eng)
        {
            case "cat":
                $race = "Chat";
                break;
            case "dog":
                $race = "Chien";
                break;
            case "horse":
                $race = "Cheval";
                break;
            case "redpanda":
                $race = "Panda-Roux";
                break;
            case "turtle":
                $race = "Tortue";
                break;
            case "bird":
                $race = "Oiseau";
                break;
            case "mouse":
                $race = "Souris";
                break;
        }

        return $race;
    }
}
