<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = [
        'academic_year_id',
        'name',
        'level',
        'homeroom_teacher_id',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(
            AcademicYear::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS
    |--------------------------------------------------------------------------
    */

    public function homeroomTeacher(): BelongsTo
    {
        return $this->belongsTo(
            Teacher::class,
            'homeroom_teacher_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LABEL
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return $this->name . ' - ' .
            ($this->academicYear?->full_name ?? '');
    }
}