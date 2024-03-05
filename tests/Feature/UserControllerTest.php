<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
    }

    public function test_user_can_view_user_index(): void
    {
        $response = $this->get(route('admin.user.index'));
        $response->assertStatus(200)
            ->assertViewIs('admin.user.index')
            ->assertSee(__('user.users'));
    }

    public function test_user_can_view_user_create_form(): void
    {
        $response = $this->get(route('admin.user.create'));
        $response->assertStatus(200)
            ->assertViewIs('admin.user.create')
            ->assertSee(__('user.create'));
    }

    public function test_user_can_create_user(): void
    {
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];
        $response = $this->post(route('admin.user.store'), $userData);
        $response->assertRedirect(route('admin.user.index'))
            ->assertSessionHas('success', __('user.create_success'));
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }

    public function test_user_can_view_user_edit_form(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('admin.user.edit', encrypt($user->id)));
        $response->assertStatus(200)
            ->assertViewIs('admin.user.edit')
            ->assertSee(__('user.edit'))
            ->assertViewHas('user', $user);
    }

    public function test_user_can_update_user(): void
    {
        $user = User::factory()->create();
        $newUserData = [
            'first_name' => 'Updated John',
            'last_name' => 'Updated Doe',
            'email' => 'updated_john@example.com',
        ];
        $response = $this->put(route('admin.user.update', $user->id), $newUserData);
        $response->assertRedirect(route('admin.user.index'))
            ->assertSessionHas('success', __('user.update_success'));
        $this->assertDatabaseHas('users', ['email' => $newUserData['email']]);
    }

    public function test_user_can_delete_user(): void
    {
        $user = User::factory()->create();
        $response = $this->delete(route('admin.user.destroy', encrypt($user->id)));
        $response->assertRedirect(route('admin.user.index'))
            ->assertSessionHas('success', __('user.delete_success'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
