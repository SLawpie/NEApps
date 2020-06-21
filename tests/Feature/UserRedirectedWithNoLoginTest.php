<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRedirectedWithNoLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserisRedirectedWithNoLogin()
    {
        $response = $this->get('/home');

        //$response->assertStatus(200);
        $response->assertRedirect(route('login'));
    }
}
