<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'student_name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'phone',
        'email',
        'parent_name',
        'parent_phone',
        'school_origin',
        'program',
        'document',
        'status',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}