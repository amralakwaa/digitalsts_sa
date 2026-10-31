<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_ar',
        'title_en',
        'excerpt_ar',
        'excerpt_en',
        'content_ar',
        'content_en',
        'category',
        'image',
        'author_name',
        'tags_ar',
        'tags_en',
        'is_published',
        'published_at',
        'views_count',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'tags_ar'      => 'array',
        'tags_en'      => 'array',
        'views_count'  => 'integer',
        'sort_order'   => 'integer',
    ];

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->title_en ?: $this->title_ar) : ($this->title_ar ?: $this->title_en);
    }

    public function getExcerptAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->excerpt_en ?: $this->excerpt_ar) : ($this->excerpt_ar ?: $this->excerpt_en);
    }

    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->content_en ?: $this->content_ar) : ($this->content_ar ?: $this->content_en);
    }

    public function getTagsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->tags_en ?: $this->tags_ar ?: []) : ($this->tags_ar ?: $this->tags_en ?: []);
    }

    public function getCategoryLabelAttribute(): string
    {
        $categories = [
            'engineering' => app()->getLocale() === 'ar' ? 'حلول هندسية' : 'Engineering Solutions',
            'fire_safety' => app()->getLocale() === 'ar' ? 'السلامة ومكافحة الحريق' : 'Fire & Safety',
            'security'    => app()->getLocale() === 'ar' ? 'الأنظمة الأمنية والمراقبة' : 'Security & Surveillance',
            'iot'         => app()->getLocale() === 'ar' ? 'التقنيات الذكية وإنترنت الأشياء' : 'Smart IoT & BMS',
            'corporate'   => app()->getLocale() === 'ar' ? 'أخبار الشركة والقطاع' : 'Corporate & Industry News',
        ];

        return $categories[$this->category] ?? (app()->getLocale() === 'ar' ? 'مقالات عامة' : 'General');
    }

    public function getReadingTimeAttribute(): int
    {
        $totalWords = str_word_count(strip_tags($this->content_ar . ' ' . $this->content_en));
        $minutes = (int) ceil($totalWords / 180);
        return max(1, $minutes);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
    }
}
