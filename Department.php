<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';
    protected $primaryKey = 'Dept_ID';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'Dept_ID',
        'Dept_Name'
    ];

    // Relationships
    public function majors()
    {
        return $this->hasMany(Major::class, 'Dept_ID', 'Dept_ID');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'Dept_ID', 'Dept_ID');
    }
}
