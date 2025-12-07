<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use App\Models\Department;
use App\Models\StudentCourse;

class HomeController extends Controller
{
    public function home()
    {
        $popularCourses = Course::with(['studentRatings'])
            ->withCount(['studentRatings as total_ratings'])
            ->withAvg('studentRatings', 'Average_difficulty_rate')
            ->having('total_ratings', '>', 0)
            ->orderBy('total_ratings', 'desc')
            ->limit(6)
            ->get();
        $totalCourses = Course::count();
        $totalMajors = Major::count();
        $totalRatings = StudentCourse::count();
        $satisfactionRate = 94;
        $featuredMajors = Major::with('department')
            ->limit(3)
            ->get();

        return view('home', compact(
            'popularCourses',
            'totalCourses',
            'totalMajors',
            'totalRatings',
            'satisfactionRate',
            'featuredMajors'
        ));
    }
}
