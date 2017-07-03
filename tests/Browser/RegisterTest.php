<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{

    public function testUserInscriptionInvalidPass() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('firstname', 'Guillaume')
                ->type('lastname', 'Normand')
                ->type('email', 'guillaume.normand2@gmail.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'otherPassword')
                ->type('username', 'Yaumy')
                ->select('race', 'human')
                ->select('sex', '0')
                ->type('description', 'I love red pandas')
                ->script([
                    "document.querySelector('#birthDate').value = '1995-08-18'",
                ]);
            $browser->type('location', 'Vaucresson')
                ->attach('profilePicture', __DIR__.'/photos/player_walk1.png')
                ->press('register')
                ->assertPathIs('/register')
                ->assertSee('The password confirmation does not match.');
        });
    }



    public function testUserInscriptionOk()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('firstname', 'Guillaume')
                ->type('lastname', 'Normand')
                ->type('email', 'guillaume.normand2@gmail.com')
                ->type('password', 'azerty')
                ->type('password_confirmation', 'azerty')
                ->type('username', 'Yaumy')
                ->select('race', 'human')
                ->select('sex', '0')
                ->type('description', 'I love red pandas')
                ->script([
                    "document.querySelector('#birthDate').value = '1995-08-18'",
                ]);
                $browser->type('location', 'Vaucresson')
                ->attach('profilePicture', __DIR__.'/photos/player_walk1.png')
                ->press('register')
                ->assertPathIs('/home');
        });
    }


}