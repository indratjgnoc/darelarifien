<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

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

    /*
    |--------------------------------------------------------------------------
    | LABEL
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute(): string
    {
        return $this->name . ' - ' .
            ucfirst($this->semester);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(
            SchoolClass::class,
            'academic_year_id'
        );
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
