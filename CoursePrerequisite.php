<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePrerequisite extends Model
{
    use HasFactory;

    protected $table = 'course_prerequisite';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = null;
    protected $fillable = [
        'Course_ID',
        'Prerequisite_Course_ID'
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_ID', 'Course_ID');
    }

    public function prerequisite()
    {
        return $this->belongsTo(Course::class, 'Prerequisite_Course_ID', 'Course_ID');
    }
}
