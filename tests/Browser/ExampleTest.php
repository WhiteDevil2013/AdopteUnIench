<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    public function testUserConnection()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'guillaume.normand2@gmail.com')
                    ->type('password', 'azerty')
                    ->check('remember')
                    ->press('connect')
                    ->assertPathIs('/home');
        });
    }
}
