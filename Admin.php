<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Admin_ID',
        'Admin_Name',
        'Admin_Email',
        'Admin_Role',
        'Dept_ID',
        'User_ID'
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class, 'Dept_ID', 'Dept_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID', 'User_ID');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Admin_ID', 'Admin_ID');
    }
}
