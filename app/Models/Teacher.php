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


    public function schedules(): HasMany
{
    return $this->hasMany(Schedule::class);
}
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}