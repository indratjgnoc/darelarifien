<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'semester',
        'is_active',
        'registration_open',
        'course_selection_open',
        'start_date',
        'end_date',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'registration_open' => 'boolean',
        'course_selection_open' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->name . ' - ' . ucfirst($this->semester);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(
            SchoolClass::class,
            'academic_year_id'
        );
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }


    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teachingAssignments(): HasMany
    {
        return $this->hasMany(TeacherClassSubject::class);
    }

    public function gradeWeights(): HasMany
    {
        return $this->hasMany(GradeWeight::class);
    }
}
