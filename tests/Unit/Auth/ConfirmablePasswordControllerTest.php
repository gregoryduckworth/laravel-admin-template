<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ConfirmablePasswordControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_shows_the_confirm_password_view(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('password.confirm'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.confirm-password');
    }

    /**
     * @test
     */
    public function it_confirms_user_password_and_redirects(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * @test
     */
    public function it_throws_validation_exception_for_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
        $response = $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors('password');
    }

    /**
     * @test
     */
    public function it_redirects_to_dashboard_after_password_confirmation(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
        $this->actingAs($user)->post(route('password.confirm'), [
            'password' => 'password123',
        ]);
        $this->assertAuthenticatedAs($user);
        $this->assertNotNull(session('auth.password_confirmed_at'));
    }
}
