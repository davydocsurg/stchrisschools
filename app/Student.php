<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // fillable fields
    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'roll_number',
        'gender',
        'student_phone',
        'date_of_birth',
        'current_address',
        'permanent_address',
    ];

    // student:user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // student:parent relationship
    public function parent()
    {
        return $this->belongsTo(Parent::class);
    }

    // student:class relationship
    public function student_class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
