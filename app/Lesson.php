<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = [
        'class_id',
        'slug',
        'lesson_title',
        'lesson_video',
        'lesson_document',
        'lesson_description',
    ];

    public function teacher()
    {
        $this->belongsTo(Teacher::class);
    }

    public function class_lesson()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
}
