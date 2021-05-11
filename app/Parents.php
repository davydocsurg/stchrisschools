<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'user_id',
        'child_licence',
        'parent_phone',
        'gender',
        'current_address',
        'permanent_address',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}
