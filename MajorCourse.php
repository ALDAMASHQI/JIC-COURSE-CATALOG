<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorCourse extends Model
{
    use HasFactory;

    protected $table = 'major_course';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Major_ID',
        'Course_ID',
        'Degree_Plan'
    ];

    // Relationships
    public function major()
    {
        return $this->belongsTo(Major::class, 'Major_ID', 'Major_ID');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course_ID', 'Course_ID');
    }
}
