<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use App\Models\Department;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::withAvg('studentRatings', 'Average_difficulty_rate')
            ->withCount('studentRatings');

        // Search filter
        if ($request->filled('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Course_Title', 'like', "%{$search}%")
                    ->orWhere('Course_Code', 'like', "%{$search}%")
                    ->orWhere('Course_Description', 'like', "%{$search}%");
            });
        }

        // Category filter (by department)
        if ($request->filled('category') && $request->category) {
            $query->whereHas('majors.department', function($q) use ($request) {
                $q->where('Dept_Name', 'like', "%{$request->category}%");
            });
        }

        // Difficulty filter
        if ($request->filled('difficulty') && $request->difficulty) {
            $difficulty = $request->difficulty;
            $query->whereHas('studentRatings', function($q) use ($difficulty) {
                if ($difficulty === 'beginner') {
                    $q->where('Average_difficulty_rate', '<=', 2.5);
                } elseif ($difficulty === 'intermediate') {
                    $q->whereBetween('Average_difficulty_rate', [2.6, 3.5]);
                } elseif ($difficulty === 'advanced') {
                    $q->where('Average_difficulty_rate', '>=', 3.6);
                }
            });
        }

        // Rating filter
        if ($request->filled('min_rating') && $request->min_rating) {
            $minRating = $request->min_rating;
            $query->having('student_ratings_avg_average_difficulty_rate', '>=', $minRating);
        }

        // Sort options
        $sort = $request->get('sort', 'relevance');
        switch ($sort) {
            case 'rating':
                $query->orderBy('student_ratings_avg_average_difficulty_rate', 'desc');
                break;
            case 'duration':
                $query->orderBy('Credit_Hours', 'asc');
                break;
            case 'newest':
                $query->orderBy('Course_ID', 'desc');
                break;
            default:
                $query->orderBy('student_ratings_count', 'desc');
                break;
        }
        $courses = $query->paginate(9);
        $totalCourses = Course::count();
        $departments = Department::with('majors.courses')->get();
        return view('courses.index', compact('courses', 'totalCourses', 'departments'));
    }

    public function show($id)
    {
        $course = Course::with([
            'studentRatings.student.user',
            'prerequisites.prerequisite',
            'majors.department'
        ])
            ->withAvg('studentRatings', 'Average_difficulty_rate')
            ->withCount('studentRatings')
            ->findOrFail($id);
        $ratingDistribution = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];
        $ratings = $course->studentRatings;
        foreach ($ratings as $rating) {
            $roundedRating = round($rating->Average_difficulty_rate);
            if (isset($ratingDistribution[$roundedRating])) {
                $ratingDistribution[$roundedRating]++;
            }
        }
        $totalRatings = $course->student_ratings_count;
        $ratingPercentages = [];
        foreach ($ratingDistribution as $stars => $count) {
            $ratingPercentages[$stars] = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
        }
        $relatedCourses = Course::whereHas('majors', function($query) use ($course) {
            $query->whereIn('major.Major_ID', $course->majors->pluck('Major_ID'));
        })
            ->where('Course_ID', '!=', $course->Course_ID)
            ->withAvg('studentRatings', 'Average_difficulty_rate')
            ->withCount('studentRatings')
            ->limit(3)
            ->get();

        return view('courses.show', compact(
            'course',
            'ratingDistribution',
            'ratingPercentages',
            'totalRatings',
            'relatedCourses'
        ));
    }


    public function rate(Request $request, $id)
    {
        $request->validate([
            'difficulty_rating' => 'required|integer|min:1|max:5',
            'rating_comment' => 'nullable|string|max:500'
        ]);

        $course = Course::findOrFail($id);
        $student = auth()->user()->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Only students can rate courses.');
        }
        $existingRating = StudentCourse::where('Student_ID', $student->Student_ID)
            ->where('Course_ID', $id)
            ->first();

        if ($existingRating) {
            StudentCourse::where('Student_ID', $student->Student_ID)
                ->where('Course_ID', $id)
                ->update([
                    'Average_difficulty_rate' => $request->difficulty_rating,
                    'Rating_Comment' => $request->rating_comment,
                    'updated_at' => now(),
                ]);
            $message = 'Rating updated successfully!';
        } else {
            StudentCourse::create([
                'Student_ID' => $student->Student_ID,
                'Course_ID' => $id,
                'Average_difficulty_rate' => $request->difficulty_rating,
                'Rating_Comment' => $request->rating_comment,
                'Rating_number' => 1
            ]);
            $message = 'Rating submitted successfully!';
        }
        return redirect()->back()->with('success', $message);
    }
}
