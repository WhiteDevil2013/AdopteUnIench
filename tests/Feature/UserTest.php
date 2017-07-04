<?php

namespace Tests\Feature;

use AdopteUnIench\Profile;
use AdopteUnIench\User;
use AdopteUnIench\Preference;
use AdopteUnIench\PreferenceType;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCreation()
    {
        $profile1 = Profile::create([
            'username' => 'WhiteDevil',
            'isAnimal' => 0,
            'race' => 'human',
            'description' => 'Wonderful description',
            'birthDate' => '1993-09-25',
            'location' => 'Puteaux',
            'profilePicture' => __DIR__.'../Browser/photos/player_walk1.png',
            'sex' => 0
        ]);

        $profile1->push();

        $user1 = User::create([
            'name' => 'William Wakim',
            'email' => 'william.wakim@epita.fr',
            'password' => bcrypt('azerty'),
            'profile_id' => $profile1->id
        ]);

        $user1->push();

        $profile2 = Profile::create([
            'username' => 'Moussanji',
            'isAnimal' => 1,
            'race' => 'dog',
            'description' => 'Wouaf Wouaf',
            'birthDate' => '1995-04-13',
            'location' => 'Puteaux',
            'profilePicture' => __DIR__.'../Browser/photos/player_walk1.png',
            'sex' => 1
        ]);

        $profile2->push();

        $user2 = User::create([
            'name' => 'Moussa Oufkir',
            'email' => 'moussa.oufkir@epita.fr',
            'password' => bcrypt('azerty'),
            'profile_id' => $profile2->id
        ]);

        $user1->push();

        $this->assertDatabaseHas('users', [
            'email' => 'william.wakim@epita.fr',
            'name' => 'William Wakim'
        ]);

        $this->assertDatabaseHas('profiles', [
            'description' => 'Wonderful description',
            'isAnimal' => 0
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'moussa.oufkir@epita.fr',
            'name' => 'Moussa Oufkir'
        ]);

        $this->assertDatabaseHas('profiles', [
            'race' => 'dog',
            'birthDate' => '1995-04-13'
        ]);
    }

    public function testUserUpdate()
    {
        $profile = Profile::create([
            'username' => 'Blareach',
            'isAnimal' => 0,
            'race' => 'human',
            'description' => 'Ceci est ma description',
            'birthDate' => '1994-11-06',
            'location' => 'Kremlin Bicetre',
            'profilePicture' => __DIR__.'../Browser/photos/player_walk1.png',
            'sex' => 0
        ]);

        $profile->push();

        $user = User::create([
            'name' => 'Lorris Saint-Genez',
            'email' => 'saint-_l@epita.fr',
            'password' => bcrypt('azerty'),
            'profile_id' => $profile->id
        ]);

        $user->push();

        $this->assertDatabaseHas('users', [
            'name' => 'Lorris Saint-Genez',
            'email' => 'saint-_l@epita.fr'
        ]);

        $user->update([
            'name' => 'Jean-Lorris Saint-Genez',
            'email' => 'lorris.saint-genez@epita.fr'
        ]);

        $profile->update([
            'username' => 'asreach',
            'race' =>  'red panda',
            'isAnimal' => 1,
            'sex' => 0,
            'description' => 'nouvelle description',
            'location' => 'Kremlin Bicetre',
            'birthDate' => '1994-11-06',
            'profilePicture' => $profile->profilePicture
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'Lorris Saint-Genez',
            'email' => 'saint-_l@epita.fr'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Jean-Lorris Saint-Genez',
            'email' => 'lorris.saint-genez@epita.fr'
        ]);

        $this->assertDatabaseMissing('profiles', [
            'username' => 'Blareach',
            'race' => 'human'
        ]);

        $this->assertDatabaseHas('profiles', [
            'username' => 'asreach',
            'race' => 'red panda',
            'isAnimal' => 1,
            'description' => 'nouvelle description'
        ]);
    }

}