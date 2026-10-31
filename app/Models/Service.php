<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        'features_ar',
        'features_en',
        'benefits_ar',
        'benefits_en',
        'sectors_ar',
        'sectors_en',
        'icon',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features_ar' => 'array',
        'features_en' => 'array',
        'benefits_ar' => 'array',
        'benefits_en' => 'array',
        'sectors_ar' => 'array',
        'sectors_en' => 'array',
        'is_active' => 'boolean',
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

    public function getFeaturesAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->features_en ?: $this->features_ar ?: []) : ($this->features_ar ?: $this->features_en ?: []);
    }

    public function getBenefitsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->benefits_en ?: $this->benefits_ar ?: []) : ($this->benefits_ar ?: $this->benefits_en ?: []);
    }

    public function getSectorsAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->sectors_en ?: $this->sectors_ar ?: []) : ($this->sectors_ar ?: $this->sectors_en ?: []);
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function offers()
    {
        return $this->hasMany(ServiceOffer::class);
    }
}
