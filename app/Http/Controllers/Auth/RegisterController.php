<?php

namespace AdopteUnIench\Http\Controllers\Auth;

use AdopteUnIench\Profile;
use AdopteUnIench\User;
use AdopteUnIench\Http\Controllers\Controller;
use Faker\Provider\Image;
use AdopteUnIench\Http\ImageHandler;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|unique:profiles',
            'birthDate' => 'required|date_format:"Y-m-d"',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return UserD
     */
    protected function create(array $data)
    {
        $imageHandler = new ImageHandler();
        $location = $imageHandler->uploadImageOnDisk($_FILES['profilePicture']);

        $birthDate = $this->prepareBirthDate($data['birthDate']);

        $profile = Profile::create([
            'username' => $data['username'],
            'isAnimal' => $data['race'] != 'human',
            'race' => $data['race'],
            'description' => $data['description'],
            'birthDate' => $birthDate,
            'location' => $data['location'],
            'profilePicture' => $location,
            'sex' => (int)$data['sex']
        ]);

        $profile->push();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_id' => $profile->id
        ]);
    }

    protected function prepareBirthDate($birthDate) {
        if (strptime($birthDate, '%d/%m/%Y')) {
            $elements = explode('/', $birthDate);
            if (count($elements) == 3) {
                $day = $elements[0];
                $month = $elements[1];
                $year = $elements[2];
                $newStr = $year . '-' . $month . '-' . $day;
                $birthDate = $newStr;
            }
        }
        return $birthDate;
    }
}
