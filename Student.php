<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $primaryKey='Student_ID';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Student_ID',
        'Student_Name',
        'Student_Email',
        'Major_ID',
        'Admin_ID',
        'User_ID'
    ];

    // Relationships
    public function major()
    {
        return $this->belongsTo(Major::class, 'Major_ID', 'Major_ID');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'Admin_ID', 'Admin_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID', 'User_ID');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course', 'Student_ID', 'Course_ID')
            ->withPivot('Average_difficulty_rate', 'Rating_number');
    }

    public function courseRatings()
    {
        return $this->hasMany(StudentCourse::class, 'Student_ID', 'Student_ID');
    }
}
