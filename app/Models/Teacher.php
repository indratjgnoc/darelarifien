<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'position',
        'education',
        'photo',
        'bio',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function homeroomClasses(): HasMany
    {
        return $this->hasMany(
            SchoolClass::class,
            'homeroom_teacher_id'
        );
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
