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
        $curProfile = $this->show($profile_id);
        if (isset($curProfile))
        {
            $race = "humain";
            switch ($curProfile->race)
            {
                case "cat":
                    $race = "chat";
                    break;
                case "dog":
                    $race = "chien";
                    break;
                case "horse":
                    $race = "cheval";
                    break;
                case "redpanda":
                    $race = "panda roux";
                    break;
                case "turtle":
                    $race = "tortue";
                    break;
                case "bird":
                    $race = "oiseau";
                    break;
                case "mouse":
                    $race = "souris";
                    break;
            }

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
        try
        {
            $profile = Profile::findOrFail($id);
            return $profile;
        }
        catch (ModelNotFoundException $e)
        {
            return null;
        }
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
}
