<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'slug',
        'title_ar',
        'title_en',
        'badge_text_ar',
        'badge_text_en',
        'description_ar',
        'description_en',
        'price',
        'discount_price',
        'currency',
        'billing_period',
        'features_ar',
        'features_en',
        'is_featured',
        'is_active',
        'valid_until',
        'sort_order',
        'image',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'discount_price' => 'decimal:2',
        'features_ar'    => 'array',
        'features_en'    => 'array',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
        'valid_until'    => 'date',
        'sort_order'     => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

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

    public function getBadgeTextAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->badge_text_en ?: $this->badge_text_ar) : ($this->badge_text_ar ?: $this->badge_text_en);
    }

    public function getFeaturesAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->features_en ?: $this->features_ar ?: []) : ($this->features_ar ?: $this->features_en ?: []);
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->discount_price && $this->discount_price > 0 ? $this->discount_price : $this->price);
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->discount_price && $this->discount_price > 0 && $this->price > $this->discount_price) {
            return (int) round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return null;
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    public function getBillingPeriodLabelAttribute(): string
    {
        $isAr = app()->getLocale() === 'ar';
        return match ($this->billing_period) {
            'monthly'   => $isAr ? 'شهرياً' : 'Monthly',
            'annually'  => $isAr ? 'سنوياً' : 'Annually',
            'one_time'  => $isAr ? 'دفعة واحدة' : 'One-Time',
            'project'   => $isAr ? 'لكل مشروع' : 'Per Project',
            default     => $this->billing_period,
        };
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->latest();
    }
}
