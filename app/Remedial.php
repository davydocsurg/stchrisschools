<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remedial extends Model
{
    // fillable fields
    protected $fillable = [
        'user_id',
        'class_id',
        'roll_number',
        'gender',
        'remedial_phone',
        'date_of_birth',
        'current_address',
        'permanent_address',
    ];

    // remedial:user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // remedial:class relationship
    public function remedial_class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
