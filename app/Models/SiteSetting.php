<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value_ar',
        'value_en',
        'type',
        'group',
    ];

    public static function get(string $key, $default = null): ?string
    {
        $setting = Cache::remember("site_setting_{$key}", 3600, function () use ($key) {
            return self::where('key', $key)->first();
        });

        if (!$setting) {
            return $default;
        }

        $locale = app()->getLocale();
        return $locale === 'en' 
            ? ($setting->value_en ?: $setting->value_ar ?: $default)
            : ($setting->value_ar ?: $setting->value_en ?: $default);
    }

    public static function set(string $key, ?string $valueAr, ?string $valueEn = null, string $group = 'general'): self
    {
        Cache::forget("site_setting_{$key}");
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value_ar' => $valueAr,
                'value_en' => $valueEn ?: $valueAr,
                'group' => $group,
            ]
        );
    }
}
