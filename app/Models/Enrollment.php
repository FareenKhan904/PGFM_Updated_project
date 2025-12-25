<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'notes',
        'approved_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'approved_at' => 'datetime',
    ];

    // Status constants
    public const STATUS_PENDING = 0;   // Pending
    public const STATUS_ACCEPTED = 1;   // Accepted
    public const STATUS_REJECTED = 2;   // Rejected
    public const STATUS_PAUSED = 3;     // Paused/Deactivated (e.g., due to non-payment)

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Check if the enrollment is expired based on course duration
     */
    public function isExpired(): bool
    {
        // Only check expiration for accepted enrollments (not paused)
        if ($this->status !== self::STATUS_ACCEPTED || !$this->approved_at) {
            return false;
        }

        // If course has no duration, enrollment never expires
        if (!$this->course || !$this->course->duration) {
            return false;
        }

        $expirationDate = $this->getExpirationDate();
        
        return $expirationDate && Carbon::now()->isAfter($expirationDate);
    }

    /**
     * Get the expiration date based on approved_at + course duration
     */
    public function getExpirationDate(): ?Carbon
    {
        if (!$this->approved_at || !$this->course || !$this->course->duration) {
            return null;
        }

        $duration = trim(strtolower($this->course->duration));
        
        // Parse duration string (e.g., "3 months", "6 months", "1 year")
        $months = 0;
        
        if (preg_match('/(\d+)\s*(month|months|mo)/i', $duration, $matches)) {
            $months = (int) $matches[1];
        } elseif (preg_match('/(\d+)\s*(year|years|yr)/i', $duration, $matches)) {
            $months = (int) $matches[1] * 12;
        } elseif (preg_match('/(\d+)\s*(week|weeks|wk)/i', $duration, $matches)) {
            // Convert weeks to approximate months (1 week ≈ 0.23 months)
            $weeks = (int) $matches[1];
            $months = round($weeks * 0.23, 1);
        } elseif (preg_match('/(\d+)\s*(day|days)/i', $duration, $matches)) {
            // Convert days to approximate months (1 day ≈ 0.033 months)
            $days = (int) $matches[1];
            $months = round($days * 0.033, 1);
        } elseif (preg_match('/^(\d+)$/', $duration, $matches)) {
            // If just a number, assume months
            $months = (int) $matches[1];
        }

        if ($months <= 0) {
            return null;
        }

        return $this->approved_at->copy()->addMonths($months);
    }

    /**
     * Get days remaining until expiration
     */
    public function getDaysRemaining(): ?int
    {
        if ($this->isExpired()) {
            return 0;
        }

        $expirationDate = $this->getExpirationDate();
        
        if (!$expirationDate) {
            return null; // Never expires
        }

        return max(0, Carbon::now()->diffInDays($expirationDate, false));
    }

    /**
     * Scope to get enrollments for a specific doctor's courses
     */
    public function scopeForDoctor($query, $doctorId)
    {
        return $query->whereHas('course', function($q) use ($doctorId) {
            $q->where('user_id', $doctorId);
        });
    }
}

