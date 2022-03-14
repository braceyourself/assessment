<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTests extends TestCase
{
    /** @test */ // users are redirected to /login if no session found
    public function users_are_redirected_to_login_if_no_session_found()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    /** @test */ // users are redirected to the dashboard from login when they are authenticated
    public function users_are_redirected_to_the_dashboard_from_login_when_they_are_authenticated()
    {
        $this->actingAs(User::first());

        $this->get('/login')->assertRedirect('/dashboard');
    }
}
