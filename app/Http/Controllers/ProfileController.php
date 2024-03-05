<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        User::where('id', $request->user()->id)->update(['mode' => $request->mode]);
        $request->user()->save();
        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated')->with('success', __('profile.update_success'));
    }

    public function dashboard(): View
    {
        return view('admin.dashboard', [
          'permissions'=> Permission::count(),
          'roles'=> Role::count(),
          'users'=> User::count(),
        ]);
    }
}
