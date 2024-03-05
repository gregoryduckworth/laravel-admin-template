<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Tests\TestCase;

class NewPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_displays_password_reset_form(): void
    {
        $response = $this->get(route('password.reset', ['token' => 'test_token']));
        $response->assertStatus(200);
        $response->assertViewIs('auth.reset-password');
        $response->assertViewHas('request');
    }

    /**
     * @test
     */
    public function it_resets_password_and_redirects_to_login(): void
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);
        $response = $this->post(route('password.store'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertRedirect(route('login'));
        $this->assertNull(DB::table('password_resets')->where('email', $user->email)->first());
    }

    /**
     * @test
     */
    public function it_requires_valid_email_and_token(): void
    {
        $response = $this->post(route('password.store'), [
          'token' => 'invalid_token',
          'email' => 'invalid-email',
          'password' => 'password',
          'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     */
    public function it_requires_matching_password_confirmation(): void
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);
        $response = $this->post(route('password.store'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'wrong_confirmation',
        ]);
        $response->assertSessionHasErrors(['password']);
        $this->assertFalse(Hash::check('new_password', $user->fresh()->password));
    }
}
