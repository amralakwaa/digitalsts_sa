<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceOffer;
use App\Models\Service;

class ServiceOfferSeeder extends Seeder
{
    public function run(): void
    {
        $cctv = Service::where('slug', 'cctv-surveillance-systems')->first() ?? Service::first();
        $fire = Service::where('slug', 'fire-alarm-systems')->first() ?? $cctv;
        $access = Service::where('slug', 'access-control-systems')->first() ?? $cctv;
        $datacenter = Service::where('slug', 'data-centers-server-rooms')->first() ?? $cctv;

        $offers = [
            [
                'service_id'     => $cctv?->id,
                'slug'           => 'enterprise-ai-vision-bundle-2026',
                'title_ar'       => 'باقة المراقبة الذكية المتكاملة للشركات والمصانع',
                'title_en'       => 'Enterprise AI Video Surveillance Bundle 2026',
                'badge_text_ar'  => 'الأكثر طلباً — خصم 23%',
                'badge_text_en'  => 'Most Popular — 23% OFF',
                'description_ar' => 'منظومة مراقبة متكاملة مجهزة بخوارزميات الذكاء الاصطناعي لكشف التسلل والتعرف على لوحات المركبات وفق اشتراطات الأمن والسلامة.',
                'description_en' => 'Turn-key AI surveillance suite featuring edge deep-learning analytics, LPR, and 24-month warranty compliant with Saudi security codes.',
                'price'          => 24000.00,
                'discount_price' => 18500.00,
                'currency'       => 'SAR',
                'billing_period' => 'project',
                'features_ar'    => [
                    '16 كاميرا مراقبة بدقة 4K مع رؤية ليلية فائقة بالأشعة تحت الحمراء',
                    'جهاز تسجيل شبكي NVR بسعة تخزين 32 تيرابايت مع تشفير AES-256',
                    'خوارزمية ذكاء اصطناعي للتعرف التلقائي على لوحات المركبات (ANPR/LPR)',
                    'سياج جغرافي افتراضي مع إنذار فوري على الهاتف وكشف التسلل',
                    'تمديد شبكات كابلات معتمدة Cat6 مع كابينة وموزعات PoE صناعية',
                    'ضمان شامل سنتين مع زيارات صيانة دورية مجانية',
                ],
                'features_en'    => [
                    '16x 4K Ultra-HD IP Cameras with Smart IR Night Vision',
                    '32TB Industrial NVR Storage Server with AES-256 Encryption',
                    'Automatic Number Plate Recognition (ANPR/LPR) AI License',
                    'Virtual Perimeter Tripwire & Real-time Mobile Push Alerts',
                    'Certified Cat6 Structured Cabling with Gigabit PoE Switches',
                    '24-Month Comprehensive Warranty with Free Maintenance Visits',
                ],
                'is_featured'    => true,
                'is_active'      => true,
                'valid_until'    => now()->addMonths(3)->format('Y-m-d'),
                'sort_order'     => 1,
                'image'          => 'images/offers/enterprise-ai-vision-bundle-2026.jpg',
            ],
            [
                'service_id'     => $fire?->id,
                'slug'           => 'certified-civil-defense-fire-alarm-pack',
                'title_ar'       => 'باقة السلامة والإنذار المبكر المعتمدة للدفاع المدني',
                'title_en'       => 'Certified Civil Defense Fire Alarm Package',
                'badge_text_ar'  => 'مطابقة لكود البناء السعودي SBC 801',
                'badge_text_en'  => 'SBC 801 & NFPA Compliant',
                'description_ar' => 'باقة معنونة متكاملة تشمل التصميم والتوريد والبرمجة مع إصدار التقرير الفني المعتمد لاستخراج رخصة الدفاع المدني وبلدي.',
                'description_en' => 'Complete addressable fire alarm system designed for rapid municipal and civil defense licensing compliance.',
                'price'          => 16000.00,
                'discount_price' => 12900.00,
                'currency'       => 'SAR',
                'billing_period' => 'project',
                'features_ar'    => [
                    'لوحة تحكم معنونة ذكية (Addressable Fire Panel) مع شاشة LCD',
                    '30 كاشف دخان وحرارة ليزري ضوئي عالي الحساسية',
                    '6 كواسر إنذار يدوية وسارينات إنذار مدمجة بوميض ضوئي فائق',
                    'ربط مباشر بنظام الإخلاء الصوتي وبوابات الطوارئ',
                    'إصدار المخططات الهندسية المعتمدة وشهادة الإنجاز الفني',
                    'تدريب فريق الأمن والسلامة بالمنشأة على إدارة النظام',
                ],
                'features_en'    => [
                    'Intelligent Addressable Fire Alarm Control Panel with LCD',
                    '30x Multi-Sensor Optical Smoke and Heat Detectors',
                    '6x Manual Call Points & Integrated Xenon Strobe Sirens',
                    'Automatic Link to HVAC Shutdown & Emergency Fire Doors',
                    'Civil Defense Approved Engineering Compliance Certificate',
                    'Hands-on Safety Operations Training for Facility Staff',
                ],
                'is_featured'    => true,
                'is_active'      => true,
                'valid_until'    => now()->addMonths(2)->format('Y-m-d'),
                'sort_order'     => 2,
                'image'          => 'images/offers/certified-civil-defense-fire-alarm-pack.jpg',
            ],
            [
                'service_id'     => $datacenter?->id,
                'slug'           => 'tier-3-data-center-infrastructure-suite',
                'title_ar'       => 'باقة البنية التحتية المتطورة لغرف السيرفرات ومراكز البيانات',
                'title_en'       => 'Tier III Mission-Critical Server Room Suite',
                'badge_text_ar'  => 'باقة المراكز الحساسة',
                'badge_text_en'  => 'Mission Critical Tier III',
                'description_ar' => 'تجهيز هندسي متكامل لغرف الخوادم يشمل التبريد الدقيق، أنظمة الطاقة غير المنقطعة، ومكافحة الحريق بالغاز النظيف.',
                'description_en' => 'Engineered server room infrastructure covering in-row precision cooling, redundant UPS power, and clean-agent suppression.',
                'price'          => 55000.00,
                'discount_price' => 45000.00,
                'currency'       => 'SAR',
                'billing_period' => 'project',
                'features_ar'    => [
                    'كابينتين خوادم 42U معزولة بنظام الممر الحار/البارد (Cold Aisle)',
                    'نظام طاقة غير منقطعة UPS بقدرة 20kVA مع بطاريات مزدوجة',
                    'نظام إطفاء غازي تلقائي نظيف FM-200 آمن على الأجهزة الإلكترونية',
                    'مستشعرات إنترنت الأشياء لرصد الحرارة والرطوبة وتسريب المياه',
                    'أرضيات مرفوعة مقاومة للكهرباء الساكنة (Anti-Static Flooring)',
                ],
                'features_en'    => [
                    '2x 42U Server Racks with Cold Aisle Containment',
                    '20kVA Online Double-Conversion UPS with Redundant Batteries',
                    'FM-200 / Clean Agent Automatic Fire Suppression System',
                    'IoT Environmental Monitoring (Temperature, Humidity, Water Leak)',
                    'Anti-Static Raised Access Flooring with Grounding Busbar',
                ],
                'is_featured'    => false,
                'is_active'      => true,
                'valid_until'    => null,
                'sort_order'     => 3,
                'image'          => 'images/offers/tier-3-data-center-infrastructure-suite.jpg',
            ],
            [
                'service_id'     => $access?->id,
                'slug'           => 'smart-biometric-access-control-bundle',
                'title_ar'       => 'باقة التحكم البيومتري المتقدم بالدخول وبوابات المرور',
                'title_en'       => 'Smart Biometric Access Control & Attendance Pack',
                'badge_text_ar'  => 'تقنية التعرف على الوجه',
                'badge_text_en'  => 'Touchless AI Facial ID',
                'description_ar' => 'منظومة تحكم في الدخول بدون لمس تدعم التعرف على الوجه والبطاقات المشفرة وبصمة الإصبع مع ربط سحابي.',
                'description_en' => 'Touchless biometric access control featuring facial recognition, encrypted RFID, and automated attendance logging.',
                'price'          => 11000.00,
                'discount_price' => 8750.00,
                'currency'       => 'SAR',
                'billing_period' => 'project',
                'features_ar'    => [
                    '4 أجهزة قراءة بيومترية للتعرف على الوجه في أقل من 0.2 ثانية',
                    'أقفال مغناطيسية كهرومغناطيسية بقوة مسك 600 رطل مع أزرار خروج لمسية',
                    'وحدة تحكم مركزية IP Controller تدعم حتى 10,000 مستخدم',
                    'برنامج إدارة الصلاحيات وتقارير الحضور وساعات العمل اللحظية',
                    'بطاريات احتياطية تضمن استمرار العمل عند انقطاع الكهرباء لمدة 12 ساعة',
                ],
                'features_en'    => [
                    '4x Fast Facial Recognition Terminals (<0.2s identification)',
                    '600-lb Heavy-Duty Electromagnetic Locks & Touch Exit Sensors',
                    'Central IP Door Controller Supporting up to 10,000 Users',
                    'Enterprise Access Management & Real-time Attendance Software',
                    '12-Hour Battery Backup Unit for Uninterrupted Security',
                ],
                'is_featured'    => false,
                'is_active'      => true,
                'valid_until'    => null,
                'sort_order'     => 4,
                'image'          => 'images/offers/smart-biometric-access-control-bundle.jpg',
            ],
            [
                'service_id'     => null,
                'slug'           => 'annual-gold-maintenance-sla',
                'title_ar'       => 'عقد الصيانة الوقائية السنوي الشامل للمنشآت (عقد ذهبي)',
                'title_en'       => 'Annual Comprehensive Preventative Maintenance SLA (Gold)',
                'badge_text_ar'  => 'عقد معتمد — رعاية 24/7',
                'badge_text_en'  => '24/7 Priority SLA',
                'description_ar' => 'عقد صيانة وقائية وعلاجية دوري لكافة الأنظمة الأمنية والسلامة وشبكات المنشأة يضمن استمرارية الأعمال.',
                'description_en' => 'Yearly SLA ensuring proactive audits, 2-hour emergency dispatch, and discounts on replacement hardware.',
                'price'          => 8500.00,
                'discount_price' => 6000.00,
                'currency'       => 'SAR',
                'billing_period' => 'annually',
                'features_ar'    => [
                    '4 زيارات فحص هندسي وقائي دوري على مدار العام',
                    'استجابة فورية لبلاغات الطوارئ خلال ساعتين داخل الرياض',
                    'فحص حراري دوري للوحات الكهربائية ومولدات الطاقة',
                    'تحديث البرمجيات الثابتة وتعديل إعدادات الحماية والأمان',
                    'خصم خاص 30% على أي قطع غيار أو كاميرات إضافية',
                ],
                'features_en'    => [
                    '4x Scheduled Comprehensive Preventive Maintenance Inspections',
                    'Guaranteed 2-Hour Emergency Response Dispatch in Riyadh',
                    'Thermographic Infrared Inspection of Electrical Panels',
                    'Firmware Updates & Cybersecurity Hardening Audits',
                    'Exclusive 30% Discount on Replacement Hardware & Add-ons',
                ],
                'is_featured'    => true,
                'is_active'      => true,
                'valid_until'    => null,
                'sort_order'     => 5,
                'image'          => 'images/offers/annual-gold-maintenance-sla.jpg',
            ]
        ];

        foreach ($offers as $data) {
            ServiceOffer::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
