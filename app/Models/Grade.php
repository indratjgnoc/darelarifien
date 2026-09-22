<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_class_subject_id',
        'assessment_type',
        'assessment_name',
        'score',
        'notes',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class
        );
    }

    public function teacherClassSubject(): BelongsTo
    {
        return $this->belongsTo(
            TeacherClassSubject::class,
            'teacher_class_subject_id'
        );
    }
}