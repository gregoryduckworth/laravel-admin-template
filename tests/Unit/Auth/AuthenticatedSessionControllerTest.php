<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticatedSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_view_can_be_rendered(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function authenticated_user_can_login(): void
    {
        $user = User::factory()->create();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->post(route('logout'));
        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
