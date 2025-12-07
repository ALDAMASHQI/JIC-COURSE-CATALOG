<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'major';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'Major_ID';
    protected $fillable = [
        'Major_ID',
        'Major_Name',
        'Required_Credits',
        'Dept_ID'
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class, 'Dept_ID', 'Dept_ID');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'major_course', 'Major_ID', 'Course_ID')
            ->withPivot('Degree_Plan');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Major_ID', 'Major_ID');
    }
}
