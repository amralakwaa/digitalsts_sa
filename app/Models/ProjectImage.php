<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_path',
        'caption_ar',
        'caption_en',
        'sort_order',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getCaptionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->caption_en ?: $this->caption_ar) : ($this->caption_ar ?: $this->caption_en);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return '';
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        $trimmed = ltrim($this->image_path, '/');

        if (str_starts_with($trimmed, 'images/')) {
            return asset($trimmed);
        }

        if (str_starts_with($trimmed, 'storage/')) {
            return asset($trimmed);
        }

        return asset('storage/' . $trimmed);
    }
}
