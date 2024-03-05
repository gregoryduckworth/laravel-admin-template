<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
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

    public function test_permission_index_view_is_displayed(): void
    {
        $response = $this->get(route('admin.permission.index'));
        $response->assertStatus(200)
            ->assertViewIs('admin.permission.index')
            ->assertSee(__('permission.permission'));
    }

    public function test_permission_create_view_is_displayed(): void
    {
        $response = $this->get(route('admin.permission.create'));
        $response->assertStatus(200)
            ->assertViewIs('admin.permission.create')
            ->assertSee(__('permission.create'));
    }

    public function test_permission_store(): void
    {
        $permissionData = [
            'name' => 'test_permission',
        ];
        $response = $this->post(route('admin.permission.store'), $permissionData);
        $response->assertRedirect(route('admin.permission.index'))
            ->assertSessionHas('success', __('permission.create_success'));
        $this->assertDatabaseHas('permissions', $permissionData);
    }

    public function test_permission_edit_view_is_displayed(): void
    {
        $permission = Permission::create(['name' => 'test-permission']);
        $response = $this->get(route('admin.permission.edit', encrypt($permission->id)));
        $response->assertStatus(200)
            ->assertViewIs('admin.permission.edit')
            ->assertSee(__('permission.edit'));
    }

    public function test_permission_update(): void
    {
        $permission = Permission::create(['name' => 'test-permission']);
        $updatedPermissionData = [
            'name' => 'updated_permission',
        ];
        $response = $this->post(route('admin.permission.store', ['id' => encrypt($permission->id)]), $updatedPermissionData);
        $response->assertRedirect(route('admin.permission.index'))
            ->assertSessionHas('success', __('permission.update_success'));
        $this->assertDatabaseHas('permissions', $updatedPermissionData);
    }

    public function test_permission_destroy(): void
    {
        $permission = Permission::create(['name' => 'test-permission']);
        $response = $this->delete(route('admin.permission.destroy', encrypt($permission->id)));
        $response->assertRedirect(route('admin.permission.index'))
            ->assertSessionHas('success', __('permission.delete_success'));
        $this->assertDatabaseMissing('permissions', ['id' => $permission->id]);
    }
}
