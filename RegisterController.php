<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Student_Name' => 'required|string|max:100',
            'Email' => 'required|string|email|max:100|unique:user,Email|unique:student,Student_Email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create User record
        $user = User::create([
            'Username' => $request->Student_Name, // Use email as username
            'Email' => $request->Email,
            'password' => Hash::make($request->password),
            'Role' => 'Student'
        ]);
        $student = Student::create([
            'Student_Name' => $request->Student_Name,
            'Student_Email' => $request->Email,
            'User_ID' => $user->User_ID,
            'Major_ID' => null,
            'Admin_ID' => null
        ]);

        // Log in the user
        Auth::login($user);

        return redirect('/profile')->with('success', 'Account created successfully!');
    }
}
