<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherClassSubject extends Model
{
    protected $fillable = [
        'academic_year_id',
        'school_class_id',
        'teacher_id',
        'subject_id',
        'credit',
        'is_active',
        'description',
    ];

    protected $casts = [
        'credit' => 'integer',
        'is_active' => 'boolean',
    ];

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(
            Grade::class,
            'teacher_class_subject_id'
        );
    }
}
