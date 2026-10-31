<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            [
                'key' => 'site_name',
                'value_ar' => 'STS — سمارت تك سيستمز للأنظمة الذكية والأمنية',
                'value_en' => 'STS — Smart Tech Systems for Security & Smart Solutions',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_tagline',
                'value_ar' => 'حلول أمنية وتقنية متقدمة للمنشآت الذكية والمؤسسات',
                'value_en' => 'Advanced Security & Smart Technology Solutions for Modern Enterprises',
                'type' => 'text',
                'group' => 'general',
            ],
            // Contact
            [
                'key' => 'contact_phone',
                'value_ar' => '+966 50 676 1942',
                'value_en' => '+966 50 676 1942',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_whatsapp',
                'value_ar' => '+966 50 676 1942',
                'value_en' => '+966 50 676 1942',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_email',
                'value_ar' => 'info@sts.com.sa',
                'value_en' => 'info@sts.com.sa',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value_ar' => 'طريق الملك عبد العزيز، حي الياسمين، الرياض، المملكة العربية السعودية',
                'value_en' => 'King Abdulaziz Road, Al-Yasmin District, Riyadh, Kingdom of Saudi Arabia',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'working_hours',
                'value_ar' => 'الأحد - الخميس: 8:00 صباحاً - 5:00 مساءً | الدعم الفني: 24/7',
                'value_en' => 'Sunday - Thursday: 8:00 AM - 5:00 PM | Technical Support: 24/7',
                'type' => 'text',
                'group' => 'contact',
            ],
            // Social Media
            [
                'key' => 'social_linkedin',
                'value_ar' => 'https://linkedin.com/company/sts-sa',
                'value_en' => 'https://linkedin.com/company/sts-sa',
                'type' => 'text',
                'group' => 'social',
            ],
            [
                'key' => 'social_x',
                'value_ar' => 'https://x.com/sts_sa',
                'value_en' => 'https://x.com/sts_sa',
                'type' => 'text',
                'group' => 'social',
            ],
            // SEO
            [
                'key' => 'meta_description',
                'value_ar' => 'شركة STS الرائدة في الأنظمة الأمنية المتكاملة، كاميرات المراقبة CCTV، التحكم في الدخول، إنذار الحريق، شبكات الألياف، ومراكز البيانات في المملكة العربية السعودية.',
                'value_en' => 'STS is a premier security and smart technologies provider in Saudi Arabia specializing in CCTV surveillance, access control, fire alarms, data centers, and enterprise system integration.',
                'type' => 'textarea',
                'group' => 'seo',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
