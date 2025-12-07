<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'major.department', 'admin'])->withCount('courseRatings');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Student_Name', 'like', "%{$search}%")
                    ->orWhere('Student_Email', 'like', "%{$search}%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('Username', 'like', "%{$search}%")
                            ->orWhere('Email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('major', function($q) use ($search) {
                        $q->where('Major_Name', 'like', "%{$search}%");
                    });
            });
        }
        if ($request->has('major') && $request->major) {
            $query->where('Major_ID', $request->major);
        }
        // Status filter
        if ($request->has('status') && $request->status) {
            if ($request->status === 'with_ratings') {
                $query->has('courseRatings');
            } elseif ($request->status === 'without_ratings') {
                $query->doesntHave('courseRatings');
            }
        }

        // Sort options
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'name':
                $query->orderBy('Student_Name');
                break;
            case 'email':
                $query->orderBy('Student_Email');
                break;
            case 'ratings':
                $query->orderBy('course_ratings_count', 'desc');
                break;
            case 'oldest':
                $query->orderBy('Student_ID', 'asc');
                break;
            default:
                $query->orderBy('Student_ID', 'desc');
                break;
        }

        $students = $query->paginate(10);
        $majors = Major::all();

        return view('admin.students', compact('students', 'majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Student_Name' => 'required|string|max:100',
            'Student_Email' => 'required|string|email|max:100|unique:student,Student_Email',
            'Username' => 'required|string|max:50|unique:user,Username',
            'Email' => 'required|string|email|max:100|unique:user,Email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'Major_ID' => 'nullable|exists:major,Major_ID',
        ]);

        // Create User record
        $user = User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->password),
            'Role' => 'Student'
        ]);
        Student::create([
            'Student_Name' => $request->Student_Name,
            'Student_Email' => $request->Student_Email,
            'User_ID' => $user->User_ID,
            'Major_ID' => $request->Major_ID,
            'Admin_ID' => auth()->id(),
        ]);
        return redirect()->route('admin.students.index')->with('success', 'Student created successfully!');
    }

    public function update(Request $request, $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $request->validate([
            'Student_Name' => 'required|string|max:100',
            'Student_Email' => 'required|string|email|max:100|unique:student,Student_Email,' . $id . ',Student_ID',
            'Username' => 'required|string|max:50|unique:user,Username,' . $student->User_ID . ',User_ID',
            'Email' => 'required|string|email|max:100|unique:user,Email,' . $student->User_ID . ',User_ID',
            'Major_ID' => 'nullable|exists:major,Major_ID',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $userData = [
            'Username' => $request->Username,
            'Email' => $request->Email,
        ];
        if ($request->filled('password')) {
            $userData['Password'] = Hash::make($request->password);
        }
        $student->user->update($userData);
        $student->update([
            'Student_Name' => $request->Student_Name,
            'Student_Email' => $request->Student_Email,
            'Major_ID' => $request->Major_ID,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::with('user')->findOrFail($id);

        if ($student->courseRatings()->count() > 0) {
            return redirect()->route('admin.students.index')->with('error', 'Cannot delete student that has course ratings. Please delete the ratings first.');
        }
        DB::transaction(function () use ($student) {
            $student->delete();
            if ($student->user) {

                $student->user->delete();
            }
        });
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}
