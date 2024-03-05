<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);
        $role = Role::updateOrCreate(
            ['id' => $id],
            ['name' => $request->name]
        );
        if ($request->has('permissions')) {
            $decryptedPermissions = array_map('decrypt', $request->permissions);
            $role->syncPermissions($decryptedPermissions);
        }
        $msg = $id ? __('role.update_success') : __('role.create_success');
        return redirect()->route('admin.role.index')->with('success', $msg);
    }

    public function edit($id)
    {
        $role = Role::where('id', decrypt($id))->first();
        $permissions = Permission::all();
        return view('admin.role.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function destroy($id)
    {
        Role::where('id', decrypt($id))->delete();
        return redirect()->route('admin.role.index')->with('success', __('role.delete_success'));
    }
}
