<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_profile_edit_form(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.profile.edit'));
        $response->assertStatus(200)
            ->assertViewIs('profile.edit')
            ->assertViewHas('user', $user);
    }

    public function test_user_can_update_profile_information(): void
    {
        $user = User::factory()->create();
        $firstNewName = 'John';
        $lastNewName = 'Doe';
        $newEmail = 'john@example.com';
        $newMode = 'dark';
        $response = $this->actingAs($user)->patch(route('admin.profile.update'), [
            'first_name' => $firstNewName,
            'last_name' => $lastNewName,
            'email' => $newEmail,
            'mode' => $newMode,
        ]);
        $response->assertRedirect(route('admin.profile.edit'))
            ->assertSessionHas('status', 'profile-updated')
            ->assertSessionHas('success', __('profile.update_success'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => $firstNewName,
            'last_name' => $lastNewName,
            'email' => $newEmail,
            'mode' => $newMode,
        ]);
    }

    public function test_user_can_view_dashboard(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200)
            ->assertViewIs('admin.dashboard')
            ->assertViewHas('users', User::count());
    }
}
