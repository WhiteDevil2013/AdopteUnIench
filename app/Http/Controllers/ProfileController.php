<?php

namespace AdopteUnIench\Http\Controllers;

use AdopteUnIench\Http\ImageHandler;
use AdopteUnIench\Match;
use AdopteUnIench\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
            return view('profile/profile')->with(['profile' => $curProfile, 'user_profile_id' => $profile_id]);
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
        if (isset($id))
        {
            $user = Auth::user();
            $profile_id = $user->profile_id;

            $profile = Profile::find($id);
            $profile->race = $this->tradRace($profile->race);

            return view('profile/profile')->with(['profile' => $profile, 'user_profile_id' => $profile_id]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        if (Auth::guest())
            return view('auth.login');
        $user = Auth::user();
        $profile_id = $user->profile_id;
        $profile = Profile::find($profile_id);
        $profile->race = $this->tradRace($profile->race);

        return view('profile/profile_edit')->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        if (Auth::guest())
            return view('auth.login');

        $user = Auth::user();
        $profile_id = $user->profile_id;

        $profile = Profile::find($profile_id);

        $race = input::get('race');
        $isAnimal = 1;
        if ($race == "human")
            $isAnimal = 0;

        print(input::get('profilePicture'));
        
        $imgPath = $_FILES['profilePicture'];

        $imgHandler = new ImageHandler();
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",input::get('birthDate')) && $imgHandler->isImage($imgPath))
        {
            $location = $imgHandler->updateImageOnDisk($imgPath, $profile->profilePicture);

            $profile->update([
                'username' => input::get('username'),
                'race' =>  input::get('race'),
                'isAnimal' => $isAnimal,
                'sex' => input::get('sex'),
                'description' => input::get('description'),
                'location' => input::get('location'),
                'birthDate' => input::get('birthDate'),
                'profilePicture' => $location
            ]);

            return redirect()->to('/profile');
        }
        return redirect()->to('/profile/edit');


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

    protected function match($id)
    {
        if (Auth::guest())
            return view('auth.login');
        $profile_id = Auth::user()->profile_id;
        if ($id == $profile_id)
            return redirect()->to('/home');

        $notMatched = Match::where([['profile_id_1', $id], ['hasMatched', 0], ['profile_id_2', $profile_id]])->first();

        if (!empty($notMatched)) {
            echo 'KOKO';
            Match::where([['profile_id_1', $id], ['hasMatched', 0], ['profile_id_2', $profile_id]])->update(array('hasMatched' => 1));
        }
        else {
            echo 'OKOK';
            Match::create([
                'profile_id_1' => $profile_id,
                'profile_id_2' => $id,
                'hasMatched' => 0
            ])->push();
        }

        return back();
    }

    protected function deleteMatch($unfriend_id) {
        $profile_id = Auth::user()->profile_id;
        Match::where([['profile_id_1', $unfriend_id], ['hasMatched', 0], ['profile_id_2', $profile_id]])->orWhere([['profile_id_1', $profile_id], ['profile_id_2', $unfriend_id], ['hasMatched', 0]])->delete();

        return back();
    }
}
