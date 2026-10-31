<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_position',
        'company',
        'city',
        'project_type',
        'rating',
        'review_text',
        'review_text_en',
        'avatar',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Helper to get client initials for elegant avatar circle
     */
    public function getInitialsAttribute(): string
    {
        $words = preg_split('/\s+/u', trim($this->client_name));
        $initials = '';
        if (isset($words[0])) {
            $initials .= mb_substr($words[0], 0, 1);
        }
        if (isset($words[1])) {
            $initials .= mb_substr($words[1], 0, 1);
        }
        return $initials ?: 'ع';
    }

    /**
     * Helper to get avatar URL
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
            return $this->avatar;
        }

        $trimmed = ltrim($this->avatar, '/');

        if (str_starts_with($trimmed, 'images/')) {
            return asset($trimmed);
        }

        if (str_starts_with($trimmed, 'storage/')) {
            return asset($trimmed);
        }

        return asset('storage/' . $trimmed);
    }
}

