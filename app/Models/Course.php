<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'program_overview',
        'duration',
        'fee',
        'early_bird_fee',
        'awarding_body',
        'goal',
        'examination_components',
        'eligibility_criteria',
        'mandatory_workshops',
        'course_modules',
        'examination_structure',
        'qualification_purpose',
        'examination_details',
        'skills_assessed',
        'eligibility_attempts',
        'whats_included',
        'icon_class',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'early_bird_fee' => 'decimal:2',
        'is_active' => 'boolean',
        'examination_components' => 'array',
        'eligibility_criteria' => 'array',
        'mandatory_workshops' => 'array',
        'course_modules' => 'array',
        'skills_assessed' => 'array',
        'whats_included' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassItem::class);
    }
}
