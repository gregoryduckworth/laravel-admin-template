<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class RoleControllerTest extends TestCase
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

    public function test_role_index_view_is_displayed(): void
    {
        $response = $this->get(route('admin.role.index'));
        $response->assertStatus(200)
            ->assertViewIs('admin.role.index')
            ->assertSee(__('role.role'));
    }

    public function test_role_create_view_is_displayed(): void
    {
        $response = $this->get(route('admin.role.create'));
        $response->assertStatus(200)
            ->assertViewIs('admin.role.create')
            ->assertSee(__('role.create'));
    }

    public function test_role_store(): void
    {
        $permission1 = Permission::create(['name' => 'test-permission1']);
        $permission2 = Permission::create(['name' => 'test-permission2']);
        $roleData = [
            'name' => 'test_role',
            'permissions' => [encrypt($permission1), encrypt($permission2)],
        ];
        $response = $this->post(route('admin.role.store'), $roleData);
        $response->assertRedirect(route('admin.role.index'))
            ->assertSessionHas('success', __('role.create_success'));
        $this->assertDatabaseHas('roles', ['name' => 'test_role']);
        $this->assertDatabaseHas('role_has_permissions', ['role_id' => Role::where('name', 'test_role')->first()->id]);
    }

    public function test_role_edit_view_is_displayed(): void
    {
        $role = Role::create(['name' => 'test-role']);
        $response = $this->get(route('admin.role.edit', encrypt($role->id)));
        $response->assertStatus(200)
            ->assertViewIs('admin.role.edit')
            ->assertSee(__('role.edit'));
    }

    public function test_role_update(): void
    {
        $role = Role::create(['name' => 'test-role']);
        $permission1 = Permission::create(['name' => 'test-permission1']);
        $permission2 = Permission::create(['name' => 'test-permission2']);
        $updatedRoleData = [
            'name' => 'updated_role',
            'permissions' => [encrypt($permission1), encrypt($permission2)],
        ];
        $response = $this->post(route('admin.role.store', ['id' => encrypt($role->id)]), $updatedRoleData);
        $response->assertRedirect(route('admin.role.index'))
            ->assertSessionHas('success', __('role.update_success'));
        $this->assertDatabaseHas('roles', ['name' => 'updated_role']);
        $this->assertDatabaseHas('role_has_permissions', ['role_id' => Role::where('name', 'updated_role')->first()->id]);
    }

    public function test_role_destroy(): void
    {
        $role = Role::create(['name' => 'test-role']);
        $response = $this->delete(route('admin.role.destroy', encrypt($role->id)));
        $response->assertRedirect(route('admin.role.index'))
            ->assertSessionHas('success', __('role.delete_success'));
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
