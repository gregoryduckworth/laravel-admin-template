<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Tests\TestCase;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_registration_view_is_displayed(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200)
            ->assertViewIs('auth.register');
    }

    /** @test */
    public function test_user_can_register(): void
    {
        Event::fake();

        $response = $this->post(route('register'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));

        // Ensure the user is logged in after registration
        $this->assertTrue(Auth::check());

        // Ensure the user is stored in the database
        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

        // Ensure the Registered event was dispatched
        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function test_user_registration_requires_unique_email(): void
    {
        $existingUser = User::factory()->create();

        $response = $this->post(route('register'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => $existingUser->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);

        // Ensure the user is not stored in the database
        $this->assertDatabaseMissing('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => $existingUser->email,
        ]);
    }
}
