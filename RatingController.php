<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentCourse;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentCourse::with(['student.user', 'course.majors.department'])->latest();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('student', function($q) use ($search) {
                    $q->where('Student_Name', 'like', "%{$search}%")
                        ->orWhere('Student_Email', 'like', "%{$search}%")
                        ->orWhereHas('user', function($q) use ($search) {
                            $q->where('Username', 'like', "%{$search}%");
                        });
                })
                    ->orWhereHas('course', function($q) use ($search) {
                        $q->where('Course_Code', 'like', "%{$search}%")
                            ->orWhere('Course_Title', 'like', "%{$search}%");
                    });
            });
        }

        // Course filter
        if ($request->has('course') && $request->course) {
            $query->where('Course_ID', $request->course);
        }

        // Rating filter
        if ($request->has('rating') && $request->rating) {
            $query->where('Average_difficulty_rate', '>=', $request->rating);
        }

        // Student filter
        if ($request->has('student') && $request->student) {
            $query->where('Student_ID', $request->student);
        }

        // Sort options
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'rating_high':
                $query->orderBy('Average_difficulty_rate', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('Average_difficulty_rate', 'asc');
                break;
            case 'student':
                $query->join('student', 'student_course.Student_ID', '=', 'student.Student_ID')
                    ->orderBy('student.Student_Name');
                break;
            case 'course':
                $query->join('course', 'student_course.Course_ID', '=', 'course.Course_ID')
                    ->orderBy('course.Course_Title');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $ratings = $query->paginate(10);
        $courses = Course::all();
        $students = Student::with('user')->get();

        return view('admin.ratings', compact('ratings', 'courses', 'students'));
    }

    public function update(Request $request, $studentId, $courseId)
    {
        $request->validate([
            'Average_difficulty_rate' => 'required|numeric|min:1|max:5',
            'Rating_Comment' => 'nullable|string|max:500',
        ]);

        $rating = StudentCourse::where('Student_ID', $studentId)
            ->where('Course_ID', $courseId)
            ->firstOrFail();

        $rating->update([
            'Average_difficulty_rate' => $request->Average_difficulty_rate,
            'Rating_Comment' => $request->Rating_Comment,
        ]);

        return redirect()->route('admin.ratings.index')->with('success', 'Rating updated successfully!');
    }

    public function destroy($studentId, $courseId)
    {
        StudentCourse::where('Student_ID', $studentId)
            ->where('Course_ID', $courseId)
            ->delete();

        return redirect()->route('admin.ratings.index')->with('success', 'Rating deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'rating_ids' => 'required|array',
            'rating_ids.*' => 'exists:student_course,Student_ID,Course_ID'
        ]);
        foreach ($request->rating_ids as $ratingId) {
            list($studentId, $courseId) = explode('_', $ratingId);
            StudentCourse::where('Student_ID', $studentId)->where('Course_ID', $courseId)->delete();
        }
        return redirect()->route('admin.ratings.index')->with('success', 'Selected ratings deleted successfully!');
    }
}
