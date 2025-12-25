<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    // News Types
    const TYPE_CLASSES = 0;
    const TYPE_REFERENCE = 1;

    protected $fillable = [
        'title',
        'content',
        'image',
        'type',
        'is_published',
        'user_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'type' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
