<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'User_ID';
    public $timestamps = false;

    protected $fillable = [
        'User_ID',
        'Username',
        'Email',
        'password',
        'Role'
    ];

    protected $hidden = [
        'Password'
    ];

    // Relationships
    public function student()
    {
        return $this->hasOne(Student::class, 'User_ID', 'User_ID');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'User_ID', 'User_ID');
    }

    public function isAdmin(): bool
    {
        return $this->Role === 'Admin';
    }

    public function isStudent(): bool
    {
        return $this->Role === 'Student';
    }
}
