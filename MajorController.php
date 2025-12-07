<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $query = Major::with(['department', 'courses'])
            ->withCount('courses', 'students');

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Major_Name', 'like', "%{$search}%")
                    ->orWhereHas('department', function($q) use ($search) {
                        $q->where('Dept_Name', 'like', "%{$search}%");
                    });
            });
        }

        // Department filter
        if ($request->has('department') && $request->department) {
            $query->where('Dept_ID', $request->department);
        }

        // Sort options
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'courses':
                $query->orderBy('courses_count', 'desc');
                break;
            case 'students':
                $query->orderBy('students_count', 'desc');
                break;
            case 'credits':
                $query->orderBy('Required_Credits', 'desc');
                break;
            case 'newest':
                $query->orderBy('Major_ID', 'desc');
                break;
            default:
                $query->orderBy('Major_Name');
                break;
        }

        $majors = $query->paginate(10);
        $departments = Department::all();

        return view('admin.majors', compact('majors', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Major_Name' => 'required|string|max:100|unique:major,Major_Name',
            'Required_Credits' => 'required|integer|min:1|max:200',
            'Dept_ID' => 'required|exists:department,Dept_ID',
        ]);

        Major::create([
            'Major_Name' => $request->Major_Name,
            'Required_Credits' => $request->Required_Credits,
            'Dept_ID' => $request->Dept_ID,
        ]);

        return redirect()->route('admin.majors.index')->with('success', 'Major created successfully!');
    }

    public function update(Request $request, $id)
    {
        $major = Major::findOrFail($id);

        $request->validate([
            'Major_Name' => 'required|string|max:100|unique:major,Major_Name,' . $id . ',Major_ID',
            'Required_Credits' => 'required|integer|min:1|max:200',
            'Dept_ID' => 'required|exists:department,Dept_ID',
        ]);

        $major->update([
            'Major_Name' => $request->Major_Name,
            'Required_Credits' => $request->Required_Credits,
            'Dept_ID' => $request->Dept_ID,
        ]);

        return redirect()->route('admin.majors.index')->with('success', 'Major updated successfully!');
    }

    public function destroy($id)
    {
        $major = Major::findOrFail($id);

        // Check if major has students
        if ($major->students()->count() > 0) {
            return redirect()->route('admin.majors.index')->with('error', 'Cannot delete major that has students. Please reassign or remove the students first.');
        }

        // Check if major has courses
        if ($major->courses()->count() > 0) {
            return redirect()->route('admin.majors.index')->with('error', 'Cannot delete major that has courses. Please remove the courses first.');
        }

        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'Major deleted successfully!');
    }
}
