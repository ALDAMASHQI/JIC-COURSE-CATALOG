<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show()
    {
        $student = auth()->user()->student;
        $ratings = StudentCourse::with('course.majors.department')
            ->where('Student_ID', $student->Student_ID)
            ->latest()
            ->paginate(10);

        return view('student.profile', compact('student', 'ratings'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $student = $user->student;

        $request->validate([
            'Student_Name' => 'required|string|max:100',
            'Student_Email' => 'required|string|email|max:100|unique:student,Student_Email,' . $student->Student_ID . ',Student_ID',
            'Username' => 'required|string|max:50|unique:user,Username,' . $user->User_ID . ',User_ID',
            'Email' => 'required|string|email|max:100|unique:user,Email,' . $user->User_ID . ',User_ID',
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

        // Update Student record
        $student->update([
            'Student_Name' => $request->Student_Name,
            'Student_Email' => $request->Student_Email,
        ]);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
    }

    public function deleteRating($courseId)
    {
        $student = auth()->user()->student;

        $rating = StudentCourse::where('Student_ID', $student->Student_ID)
            ->where('Course_ID', $courseId)
            ->delete();
        return redirect()->route('student.profile')->with('success', 'Rating deleted successfully!');
    }
}
