<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $table = 'student_course';
//    protected $primaryKey = null;
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Student_ID',
        'Course_ID',
        'Average_difficulty_rate',
        'Rating_Comment',
        'Rating_number'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID', 'Student_ID');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_ID', 'Course_ID');
    }
}
