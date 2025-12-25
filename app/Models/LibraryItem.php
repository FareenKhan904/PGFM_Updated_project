<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryItem extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'author',
        'publisher',
        'year',
        'file_path',
        'file_name',
        'file_size',
        'external_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer',
    ];

    /**
     * Get the user (doctor) who uploaded this item
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the file URL
     */
    public function getFileUrlAttribute(): ?string
    {
        if ($this->external_link) {
            return $this->external_link;
        }

        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }

        return null;
    }

    /**
     * Scope to get only active items
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
