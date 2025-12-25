<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassItem extends Model
{
    protected $table = 'course_classes';

    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'duration',
        'meeting_link',
        'is_active',
        'user_id',
        'course_id',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function materials()
    {
        return $this->hasMany(ClassMaterial::class, 'course_class_id');
    }
}
