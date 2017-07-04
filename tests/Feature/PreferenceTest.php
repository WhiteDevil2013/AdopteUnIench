<?php

namespace Tests\Feature;

use AdopteUnIench\Profile;
use AdopteUnIench\User;
use AdopteUnIench\Preference;
use AdopteUnIench\PreferenceType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PreferenceTest extends TestCase
{

    use DatabaseTransactions;

    public function testUserPreference()
    {
        $profile = Profile::create([
            'username' => 'Guillaume',
            'isAnimal' => 0,
            'race' => 'human',
            'description' => 'Ceci est ma description',
            'birthDate' => '1995-08-18',
            'location' => 'Vaucresson',
            'profilePicture' => __DIR__.'../Browser/photos/player_walk1.png',
            'sex' => 0
        ]);

        $profile->push();

        $user = User::create([
            'name' => 'Guillaume Normand',
            'email' => 'norman_g@epita.fr',
            'password' => bcrypt('azerty'),
            'profile_id' => $profile->id
        ]);

        $user->push();

        $preference = Preference::create([
            'sex' => 1,
            'location' => 'Vaucresson',
            'profile_id' => $user->profile_id
        ]);

        $preference->push();

        $preferenceType1 = PreferenceType::create([
            'race' => 'dog',
            'preference_id' => $preference->id
        ]);

        $preferenceType1->push();

        $preferenceType2 = PreferenceType::create([
            'race' => 'cat',
            'preference_id' => $preference->id
        ]);

        $preferenceType2->push();

        $preferenceType3 = PreferenceType::create([
            'race' => 'redpanda',
            'preference_id' => $preference->id
        ]);

        $preferenceType3->push();

        $this->assertDatabaseHas('preferences', [
            'profile_id' => $user->profile_id,
            'sex' => 1,
            'location' => 'Vaucresson'
        ]);

        $this->assertDatabaseHas('preference_types', [
            'id' => $preferenceType1->id,
            'race' => 'dog',
            'preference_id' => $preference->id
        ]);

        $this->assertDatabaseHas('preference_types', [
            'id' => $preferenceType2->id,
            'race' => 'cat',
            'preference_id' => $preference->id
        ]);

        $this->assertDatabaseHas('preference_types', [
            'id' => $preferenceType3->id,
            'race' => 'redpanda',
            'preference_id' => $preference->id
        ]);

    }
}