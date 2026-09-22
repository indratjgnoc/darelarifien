<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TeacherClassSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'phone',
        'father_name',
        'mother_name',
        'guardian_name',
        'parent_phone',
        'academic_year_id',
        'school_class_id',
        'photo',
        'is_active',
        'description',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function teachingAssignments(): HasMany
    {
        return $this->hasMany(
            TeacherClassSubject::class,
            'school_class_id',
            'school_class_id'
        );
    }

    public function grades(): HasMany
    {
        return $this->hasMany(
            Grade::class
        );
    }
}
