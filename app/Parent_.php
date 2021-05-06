<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_ extends Model
{

    protected $table = 'parent';

    protected $fillable = [
        // 'first_name',
        // 'last_name',
        // 'parent_email',
        'child_licence',
        'parent_phone',
        'gender',
        'current_address',
        'permanent_address',

    ];
}
