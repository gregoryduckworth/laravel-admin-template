<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('id', 'DESC')->get();
        return view('admin.permission.index', ['permissions' => $permissions]);
    }


    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);
        Permission::updateOrCreate(
            [
                'id' => $request->id,
            ], [
                'name' => $request->name,
            ]
        );
        if ($request->id) {
            $msg = __('permission.update_success');
        } else {
            $msg = __('permission.create_success');
        }
        return redirect()->route('admin.permission.index')->with('success', $msg);
    }

    public function edit($id)
    {
        $permission = Permission::where('id', decrypt($id))->first();
        return view('admin.permission.edit', ['permission' => $permission]);
    }

    public function destroy($id)
    {
        Permission::where('id', decrypt($id))->delete();
        return redirect()->route('admin.permission.index')->with('success', __('permission.delete_success'));
    }
}
