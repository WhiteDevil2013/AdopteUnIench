<?php

namespace Tests\Feature;

use AdopteUnIench\Match;
use AdopteUnIench\Profile;
use AdopteUnIench\User;
use AdopteUnIench\Preference;
use AdopteUnIench\PreferenceType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MatchTest extends TestCase
{

    use DatabaseTransactions;

    public function testMatching()
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

        $user2->push();

        $this->assertDatabaseHas('users', [
            'email' => 'william.wakim@epita.fr',
            'name' => 'William Wakim'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'moussa.oufkir@epita.fr',
            'name' => 'Moussa Oufkir'
        ]);

        $match = Match::create([
            'profile_id_1' => $profile1->id,
            'profile_id_2' => $profile2->id,
            'hasMatched' => 0
        ]);

        $match->push();

        $this->assertDatabaseHas('matches', [
            'id' => $match->id,
            'profile_id_1' => $profile1->id,
            'profile_id_2' => $profile2->id,
            'hasMatched' => 0
        ]);

        $notMatched = Match::where([['profile_id_1', $profile1->id], ['hasMatched', 0], ['profile_id_2', $profile2->id]])->first();

        $this->assertNotNull($notMatched);

        if (!empty($notMatched)) {
            Match::where([['profile_id_1', $profile1->id], ['hasMatched', 0], ['profile_id_2', $profile2->id]])->update(array('hasMatched' => 1));
        }

        $this->assertDatabaseHas('matches', [
            'id' => $match->id,
            'profile_id_1' => $profile1->id,
            'profile_id_2' => $profile2->id,
            'hasMatched' => 1
        ]);

    }
}