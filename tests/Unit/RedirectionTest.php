<?php

namespace Tests\Unit;

use Tests\TestCase;

class RedirectionTest extends TestCase
{

    public function testGetHome()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testGetConnection()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testGetRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testGetProfile()
    {
        $response = $this->get('/profile');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testGetProfileEdition()
    {
        $response = $this->get('/profile/edit');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testGetMessage()
    {
        $response = $this->get('/message');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testGetPreference()
    {
        $response = $this->get('/preference');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

}