<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $roles = Role::all();
        view()->share('roles', $roles);
    }

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:'.User::class,
            'password' => 'required|max:255|min:6',
            'role' => 'string',
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('admin.user.index')->with('success', __('user.create_success'));
    }

    public function edit($id)
    {
        $user = User::where('id', decrypt($id))->first();
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['string'],
        ]);
        $user = User::where('id', $user->id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
        if($request->role) {
          $user->assignRole($request->role);
        }
        return redirect()->route('admin.user.index')->with('success', __('user.update_success'));
    }

    public function destroy($id)
    {
        User::where('id', decrypt($id))->delete();
        return redirect()->route('admin.user.index')->with('success', __('user.delete_success'));
    }
}
