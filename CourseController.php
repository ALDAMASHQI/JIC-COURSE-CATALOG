<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['majors.department'])
            ->withCount('studentRatings')
            ->withAvg('studentRatings', 'Average_difficulty_rate');

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Course_Code', 'like', "%{$search}%")
                    ->orWhere('Course_Title', 'like', "%{$search}%")
                    ->orWhere('Course_Description', 'like', "%{$search}%");
            });
        }

        // Department filter
        if ($request->has('department') && $request->department) {
            $query->whereHas('majors.department', function($q) use ($request) {
                $q->where('Dept_ID', $request->department);
            });
        }

        // Rating filter
        if ($request->has('rating') && $request->rating) {
            $query->having('student_ratings_avg_average_difficulty_rate', '>=', $request->rating);
        }

        // Sort options
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'name':
                $query->orderBy('Course_Title');
                break;
            case 'code':
                $query->orderBy('Course_Code');
                break;
            case 'ratings':
                $query->orderBy('student_ratings_count', 'desc');
                break;
            case 'difficulty':
                $query->orderBy('student_ratings_avg_average_difficulty_rate', 'desc');
                break;
            default:
                $query->orderBy('Course_ID', 'desc');
                break;
        }

        $courses = $query->paginate(10);
        $allCourses = Course::all();
        $departments = Department::with('majors')->get();

        return view('admin.courses', compact('courses', 'departments', 'allCourses'));
    }

    public function create()
    {
        $departments = Department::with('majors')->get();
        $allCourses = Course::all();
        return view('admin.courses-create', compact('departments', 'allCourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Course_Code' => 'required|string|max:20|unique:course,Course_Code',
            'Course_Title' => 'required|string|max:100',
            'Course_Description' => 'required|string',
            'Credit_Hours' => 'required|integer|min:1|max:6',
            'major_id' => 'required|exists:major,Major_ID',
            'prerequisites' => 'nullable|array',
            'prerequisites.*' => 'exists:course,Course_ID'
        ]);

        DB::transaction(function () use ($request) {
            $course = Course::create([
                'Course_Code' => $request->Course_Code,
                'Course_Title' => $request->Course_Title,
                'Course_Description' => $request->Course_Description,
                'Credit_Hours' => $request->Credit_Hours,
            ]);

            $course->majors()->attach($request->major_id);

            if ($request->has('prerequisites')) {
                foreach ($request->prerequisites as $prerequisiteId) {
                    DB::table('course_prerequisite')->insert([
                        'Course_ID' => $course->Course_ID,
                        'Prerequisite_Course_ID' => $prerequisiteId
                    ]);
                }
            }
        });

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        $course = Course::with(['majors', 'prerequisites'])
            ->findOrFail($id);

        $departments = Department::with('majors')->get();
        $allCourses = Course::where('Course_ID', '!=', $id)->get();

        return view('admin.courses-edit', compact('course', 'departments', 'allCourses'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'Course_Code' => 'required|string|max:20|unique:course,Course_Code,' . $id . ',Course_ID',
            'Course_Title' => 'required|string|max:100',
            'Course_Description' => 'required|string',
            'Credit_Hours' => 'required|integer|min:1|max:6',
            'major_id' => 'required|exists:major,Major_ID',
            'prerequisites' => 'nullable|array',
            'prerequisites.*' => 'exists:course,Course_ID'
        ]);

        DB::transaction(function () use ($request, $course) {
            $course->update([
                'Course_Code' => $request->Course_Code,
                'Course_Title' => $request->Course_Title,
                'Course_Description' => $request->Course_Description,
                'Credit_Hours' => $request->Credit_Hours,
            ]);
            $course->majors()->sync([$request->major_id]);
            DB::table('course_prerequisite')->where('Course_ID', $course->Course_ID)->delete();
            if ($request->has('prerequisites')) {
                foreach ($request->prerequisites as $prerequisiteId) {
                    DB::table('course_prerequisite')->insert([
                        'Course_ID' => $course->Course_ID,
                        'Prerequisite_Course_ID' => $prerequisiteId
                    ]);
                }
            }
        });

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        DB::transaction(function () use ($course) {
            DB::table('course_prerequisite')
                ->where('Course_ID', $course->Course_ID)
                ->orWhere('Prerequisite_Course_ID', $course->Course_ID)
                ->delete();
            $course->majors()->detach();
            $course->students()->detach();
            $course->delete();
        });

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }
}
