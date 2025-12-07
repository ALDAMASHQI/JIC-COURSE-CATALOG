<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = auth()->user()->admin;
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $admin = $user->admin;

        $request->validate([
            'Admin_Name' => 'required|string|max:100',
            'Admin_Email' => 'required|string|email|max:100|unique:admin,Admin_Email,' . $admin->Admin_ID . ',Admin_ID',
            'Username' => 'required|string|max:50|unique:user,Username,' . $user->User_ID . ',User_ID',
            'Email' => 'required|string|email|max:100|unique:user,Email,' . $user->User_ID . ',User_ID',
            'Admin_Role' => 'required|string|max:50',
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Update User record
        $userData = [
            'Username' => $request->Username,
            'Email' => $request->Email,
        ];

        if ($request->filled('password')) {
            $userData['Password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update Admin record
        $admin->update([
            'Admin_Name' => $request->Admin_Name,
            'Admin_Email' => $request->Admin_Email,
            'Admin_Role' => $request->Admin_Role,
        ]);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
