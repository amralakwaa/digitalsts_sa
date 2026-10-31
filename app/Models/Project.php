<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'content_ar',
        'content_en',
        'category',
        'client',
        'location',
        'completion_date',
        'cover_image',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->title_en ?: $this->title_ar) : ($this->title_ar ?: $this->title_en);
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->description_en ?: $this->description_ar) : ($this->description_ar ?: $this->description_en);
    }

    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->content_en ?: $this->content_ar) : ($this->content_ar ?: $this->content_en);
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        if (str_starts_with($this->cover_image, 'http://') || str_starts_with($this->cover_image, 'https://')) {
            return $this->cover_image;
        }

        $trimmed = ltrim($this->cover_image, '/');

        if (str_starts_with($trimmed, 'images/')) {
            return asset($trimmed);
        }

        if (str_starts_with($trimmed, 'storage/')) {
            return asset($trimmed);
        }

        return asset('storage/' . $trimmed);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order', 'asc');
    }
}
