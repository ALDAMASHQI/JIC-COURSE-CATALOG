<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    protected $primaryKey = 'Course_ID';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Course_ID',
        'Course_Code',
        'Course_Title',
        'Course_Description',
        'Credit_Hours'
    ];

    // Relationships
    public function prerequisites()
    {
        return $this->hasMany(CoursePrerequisite::class, 'Course_ID', 'Course_ID');
    }

    public function requiredBy()
    {
        return $this->hasMany(CoursePrerequisite::class, 'Prerequisite_Course_ID', 'Course_ID');
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'major_course', 'Course_ID', 'Major_ID')
            ->withPivot('Degree_Plan');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'Course_ID', 'Student_ID')
            ->withPivot('Average_difficulty_rate', 'Rating_number');
    }

    public function studentRatings()
    {
        return $this->hasMany(StudentCourse::class, 'Course_ID', 'Course_ID');
    }
}
