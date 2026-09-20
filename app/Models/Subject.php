<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category',
        'minimum_passing_grade',
        'credit',
        'is_active',
        'description',
    ];

    protected $casts = [
        'minimum_passing_grade' => 'integer',
        'credit' => 'integer',
        'is_active' => 'boolean',
    ];

    public function teachingAssignments(): HasMany
    {
        return $this->hasMany(TeacherClassSubject::class);
    }
}