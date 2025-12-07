<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Department;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $totalRatings = StudentCourse::count();
        $totalDepartments = Department::count();

        // Get new courses this month
        $newCoursesThisMonth = Course::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Get student growth (this month vs last month)
        $currentMonthStudents = Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthStudents = Student::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $studentGrowth = $lastMonthStudents > 0 ?
            (($currentMonthStudents - $lastMonthStudents) / $lastMonthStudents) * 100 : 0;

        // Get new ratings today
        $newRatingsToday = StudentCourse::whereDate('created_at', today())->count();

        // Get most rated courses
        $mostRatedCourses = Course::withCount('studentRatings')
            ->withAvg('studentRatings', 'Average_difficulty_rate')
            ->orderBy('student_ratings_count', 'desc')
            ->limit(5)
            ->get();

        $recentActivities = $this->getRecentActivities();

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalStudents',
            'totalRatings',
            'totalDepartments',
            'newCoursesThisMonth',
            'studentGrowth',
            'newRatingsToday',
            'mostRatedCourses',
            'recentActivities'
        ));
    }

    private function getRecentActivities()
    {
        // This is a simplified version. You might want to create an activities table
        $recentCourses = Course::latest()->limit(3)->get();

        $activities = [];
        foreach ($recentCourses as $course) {
            $activities[] = [
                'type' => 'add',
                'title' => 'New course added',
                'description' => "\"{$course->Course_Title}\" was added to catalog",
                'time' => $course->created_at->diffForHumans(),
                'icon' => 'plus-lg'
            ];
        }

        return $activities;
    }

    public function courses()
    {
        $courses = Course::withCount('studentRatings')
            ->withAvg('studentRatings', 'Average_difficulty_rate')
            ->with('majors.department')
            ->paginate(10);

        return view('admin.courses', compact('courses'));
    }

    public function students()
    {
        $students = Student::with('user', 'major')
            ->paginate(10);

        return view('admin.students', compact('students'));
    }

    public function departments()
    {
        $departments = Department::withCount('majors')
            ->with('majors')
            ->get();

        return view('admin.departments', compact('departments'));
    }

    public function ratings()
    {
        $ratings = StudentCourse::with('student.user', 'course')
            ->latest()
            ->paginate(10);

        return view('admin.ratings', compact('ratings'));
    }
}
