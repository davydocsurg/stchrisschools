<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_name',
        'slug',
        'subject_code',
        'teacher_id',
        'subject_description',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
