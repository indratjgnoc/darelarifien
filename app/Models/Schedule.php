<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'teacher_class_subject_id',
        'teacher_id',
        'subject',
        'class_name',
        'day',
        'start_time',
        'end_time',
        'room',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function teacherClassSubject(): BelongsTo
    {
        return $this->belongsTo(
            TeacherClassSubject::class,
            'teacher_class_subject_id'
        );
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}