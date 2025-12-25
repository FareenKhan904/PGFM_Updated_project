<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ClassMaterial extends Model
{
    protected $table = 'class_items';

    protected $fillable = [
        'course_class_id',
        'title',
        'description',
        'type',
        'file_path',
        'file_name',
        'file_size',
        'external_link',
        'order',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // Type constants
    public const TYPE_PDF = 'pdf';
    public const TYPE_VIDEO = 'video';
    public const TYPE_LINK = 'link';
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_OTHER = 'other';

    public function courseClass(): BelongsTo
    {
        return $this->belongsTo(ClassItem::class, 'course_class_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Get file URL
    public function getFileUrlAttribute(): ?string
    {
        if ($this->external_link) {
            return $this->external_link;
        }

        if ($this->file_path) {
            // For video files, use streaming route for better playback support
            if ($this->type === self::TYPE_VIDEO) {
                return route('video.stream', $this->id);
            }
            
            // For other files (PDF, documents, etc.), use secure download route
            return route('material.download', $this->id);
        }

        return null;
    }

    // Check if it's a file upload
    public function isFile(): bool
    {
        return !empty($this->file_path);
    }

    // Check if it's an external link
    public function isLink(): bool
    {
        return !empty($this->external_link);
    }
}
