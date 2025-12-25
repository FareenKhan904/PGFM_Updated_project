<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // User types
    public const TYPE_STUDENT = 1;
    public const TYPE_DOCTOR  = 2;

    // Optional: human-readable names
    public const TYPE_LABELS = [
        self::TYPE_STUDENT => 'Student',
        self::TYPE_DOCTOR  => 'Doctor',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',           // Important: allow mass assignment
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'type'              => 'integer', // ensures type is always int
        ];
    }

    // Helper Scopes
    public function scopeStudents($query)
    {
        return $query->where('type', self::TYPE_STUDENT);
    }

    public function scopeDoctors($query)
    {
        return $query->where('type', self::TYPE_DOCTOR);
    }

    // Helper Methods
    public function isStudent(): bool
    {
        return $this->type === self::TYPE_STUDENT;
    }

    public function isDoctor(): bool
    {
        return $this->type === self::TYPE_DOCTOR;
    }

    // Optional: Nice display label
    public function getTypeLabelAttribute(): string
    {
        return self::TYPE_LABELS[$this->type] ?? 'Unknown';
    }

    // Optional: Use in blades like {{ $user->type_label }}
    // Add to $appends if you want it always included in JSON
    // protected $appends = ['type_label'];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(\App\Models\Enrollment::class);
    }
}