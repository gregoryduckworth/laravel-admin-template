<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetLinkControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_password_reset_link_request_view_is_displayed(): void
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200)
            ->assertViewIs('auth.forgot-password');
    }

    /** @test */
    public function test_password_reset_link_request_with_valid_email(): void
    {
        $user = User::factory()->create();
        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);
        $response->assertRedirect(route('password.request'))
            ->assertSessionHas('status', __('passwords.sent'));
        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }

    /** @test */
    public function test_password_reset_link_request_with_invalid_email(): void
    {
        $invalidEmail = 'invalid-email@incorrect.com';
        $response = $this->post(route('password.email'), [
            'email' => $invalidEmail,
        ]);
        $response->assertRedirect(route('password.request'))
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('password_resets', [
            'email' => $invalidEmail,
        ]);
    }
}
