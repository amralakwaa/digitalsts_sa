<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectImage;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'al-faisaliah-commercial-tower',
                'title_ar' => 'برج الأعمال التجاري الذكي - الرياض',
                'title_en' => 'Smart Commercial Business Tower - Riyadh',
                'description_ar' => 'تجهيز متكامل للبرج التجاري بأنظمة المراقبة CCTV فائقة الدقة، والتحكم في الدخول عبر بصمة الوجه، ونظام الدخول السريع عبر البوابات الإلكترونية.',
                'description_en' => 'Comprehensive integration of 4K CCTV surveillance, biometric facial recognition speed gates, and automated elevator destination control.',
                'content_ar' => 'تم تنفيذ المشروع على مساحة 25,000 متر مربع ويشمل 28 طابقاً، حيث تم تركيب أكثر من 350 كاميرا ذكية، و16 بوابة دخول سريعة بتقنية التعرف على الوجه، وشبكة ألياف ضوئية متكاملة لربط كافة مرافق البرج بغرفة التحكم المركزية.',
                'content_en' => 'Executed across 25,000 sqm encompassing 28 stories. Deployed 350+ smart IP cameras, 16 optical turnstiles with facial recognition, and a certified high-speed fiber backbone linking all building facilities to the central security command center.',
                'category' => 'commercial',
                'client' => 'شركة أفق للاستثمار العقاري',
                'location' => 'الرياض - طريق الملك فهد',
                'completion_date' => '2025-11-15',
                'cover_image' => 'images/projects/al-faisaliah-commercial-tower.jpg',
                'is_published' => true,
                'sort_order' => 1,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/cctv-surveillance-systems.jpg',
                        'caption_ar' => 'منظومة كاميرات المراقبة الذكية بدقة 4K وغرفة العمليات',
                        'caption_en' => '4K Intelligent CCTV Surveillance System & Monitoring Hub',
                    ],
                    [
                        'image_path' => 'images/services/access-control-systems.jpg',
                        'caption_ar' => 'بوابات الدخول السريع الزجاجية وبصمة الوجه البيومترية',
                        'caption_en' => 'Optical Speed Gates & Biometric Facial Recognition',
                    ],
                    [
                        'image_path' => 'images/services/networks-and-infrastructure.jpg',
                        'caption_ar' => 'شبكة الألياف الضوئية عالية السرعة وغرف السيرفرات الفرعية',
                        'caption_en' => 'Certified High-Speed Fiber Backbone & Floor Racks',
                    ],
                    [
                        'image_path' => 'images/hero-operations-center.jpg',
                        'caption_ar' => 'مركز القيادة والتحكم الأمني الموحد للبرج',
                        'caption_en' => 'Central Unified Security Operations Command Center',
                    ],
                ],
            ],
            [
                'slug' => 'grand-resort-and-spa-hospitality',
                'title_ar' => 'منتجع وفندق جراند لاكشري - جدة',
                'title_en' => 'Grand Luxury Resort & Spa - Jeddah',
                'description_ar' => 'نظام إدارة غرف النزلاء (GRMS) الذكي لـ 240 جناحاً فندقياً، مع أقفال RFID المتطورة، والأنظمة الصوتية الموزعة في الحدائق والمسابح.',
                'description_en' => 'Full Guest Room Management System (GRMS) across 240 luxury suites, RFID mobile keys, and multi-zone outdoor background sound systems.',
                'content_ar' => 'مشروع ضيافة متكامل يوفر أقصى درجات الرفاهية والتحكم الذكي لنزلاء المنتجع. يشمل لوحات تحكم لمسية جدارية للغرف، وتكامل الإضاءة مع التكييف لتوفير الطاقة بنسبة 35%، ونظام إنذار حريق معنون يغطي كافة أرجاء المنتجع.',
                'content_en' => 'A turnkey hospitality technology project delivering five-star guest comfort and energy optimization. Features capacitive touch bedside panels, occupancy-based climate automation saving 35% on cooling, and full Civil Defense certified fire alarm coverage.',
                'category' => 'hospitality',
                'client' => 'مجموعة شواطئ البحر الأحمر الفندقية',
                'location' => 'جدة - الكورنيش الشمالي',
                'completion_date' => '2025-08-20',
                'cover_image' => 'images/projects/grand-resort-and-spa-hospitality.jpg',
                'is_published' => true,
                'sort_order' => 2,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/hospitality-solutions.jpg',
                        'caption_ar' => 'لوحات التحكم الذكية GRMS لإدارة أجنحة وغرف النزلاء',
                        'caption_en' => 'GRMS Capacitive Touch Panels for Luxury Guestrooms',
                    ],
                    [
                        'image_path' => 'images/services/audio-visual-systems.jpg',
                        'caption_ar' => 'الأنظمة الصوتية الموزعة المقاومة للعوامل الجوية بالمسابح والحدائق',
                        'caption_en' => 'All-Weather Outdoor Distributed Sound System for Pool & Gardens',
                    ],
                    [
                        'image_path' => 'images/services/fire-alarm-systems.jpg',
                        'caption_ar' => 'شبكة إنذار الحريق المعنونة المعتمدة من الدفاع المدني',
                        'caption_en' => 'Civil Defense Certified Addressable Fire Alarm Infrastructure',
                    ],
                ],
            ],
            [
                'slug' => 'al-nakheel-luxury-villa-automation',
                'title_ar' => 'قصر النخيل الذكي - الخبر',
                'title_en' => 'Al-Nakheel Smart Palace - Al-Khobar',
                'description_ar' => 'أتمتة شاملة بتقنية KNX للقصور: الإضاءة، التكييف، الستائر، نظام السينما المنزلية Dolby Atmos، وتأمين الأسوار بحساسات التسلل الليزرية.',
                'description_en' => 'Full KNX automation for a luxury private estate: smart lighting, HVAC, automated drapes, Dolby Atmos cinema, and perimeter laser intrusion sensors.',
                'content_ar' => 'قصر خاص متكامل التقنيات على مساحة 4,500 متر مربع. تم ربط أكثر من 200 دائرة إضاءة وتكييف بنظام تحكم ذكي بشاشات لمس فاخرة وتطبيق هاتف موحد، مع تأمين كامل المحيط الخارجي بكاميرات حرارية ومستشعرات اهتزاز.',
                'content_en' => 'Palatial residential residence across 4,500 sqm. Integrated 200+ lighting and HVAC circuits through a bespoke KNX bus, custom glass touch panels, and secure remote mobile monitoring alongside perimeter thermal surveillance.',
                'category' => 'residential',
                'client' => 'عميل خاص',
                'location' => 'الخبر - حي الشاطئ',
                'completion_date' => '2025-05-10',
                'cover_image' => 'images/projects/al-nakheel-luxury-villa-automation.jpg',
                'is_published' => true,
                'sort_order' => 3,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/smart-home-automation.jpg',
                        'caption_ar' => 'واجهات وشاشات التحكم الذكي KNX للإنارة والتكييف',
                        'caption_en' => 'Smart KNX Glass Touch Interfaces for Lighting & Climate',
                    ],
                    [
                        'image_path' => 'images/services/audio-visual-systems.jpg',
                        'caption_ar' => 'صالة السينما المنزلية الفاخرة بنظام الصوت المحيطي Dolby Atmos',
                        'caption_en' => 'Private Cinema Hall with Dolby Atmos Immersive Audio',
                    ],
                    [
                        'image_path' => 'images/services/intrusion-alarm-systems.jpg',
                        'caption_ar' => 'حساسات الليزر وكواشف التسلل النشطة لحماية الأسوار والمحيط',
                        'caption_en' => 'Active Laser Perimeter Protection & Intrusion Detection Sensors',
                    ],
                ],
            ],
            [
                'slug' => 'industrial-logistics-distribution-center',
                'title_ar' => 'مركز الخدمات اللوجستية والمستودعات المركزية - الدمام',
                'title_en' => 'Central Logistics & Distribution Hub - Dammam',
                'description_ar' => 'شبكة أمنية صناعية متقدمة: كاميرات مراقبة متخصصة للمستودعات، كواشف دخان شعاعية (Beam Detectors)، وشبكة Wi-Fi للمستودعات الذكية.',
                'description_en' => 'Industrial security & infrastructure fit-out: optical beam fire detectors, high-bay CCTV monitoring, and ruggedized warehouse Wi-Fi.',
                'content_ar' => 'تم تجهيز مجمع المستودعات البالغة مساحته 40,000 متر مربع بأنظمة حماية المحيط الخارجي، وتأمين البوابات عبر التعرف الآلي على لوحات شاحنات النقل (ANPR)، وتوفير بنية تحتية لاسلكية قوية تدعم أجهزة المسح الضوئي اللحظية.',
                'content_en' => 'Fitted out a 40,000 sqm industrial logistics center with perimeter security, automated ANPR truck gate barriers, high-sensitivity optical beam fire sensors, and high-density industrial wireless coverage for handheld RFID barcode scanners.',
                'category' => 'industrial',
                'client' => 'الشركة الوطنية للخدمات اللوجستية',
                'location' => 'الدمام - المدينة الصناعية الثانية',
                'completion_date' => '2025-02-18',
                'cover_image' => 'images/projects/industrial-logistics-distribution-center.jpg',
                'is_published' => true,
                'sort_order' => 4,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/cctv-surveillance-systems.jpg',
                        'caption_ar' => 'كاميرات مراقبة متخصصة للمستودعات المرتفعة وممرات الشاحنات',
                        'caption_en' => 'High-Bay Industrial CCTV for Aisle & Truck Yard Monitoring',
                    ],
                    [
                        'image_path' => 'images/services/fire-alarm-systems.jpg',
                        'caption_ar' => 'كواشف الحريق البصرية والشعاعية المعتمدة للمساحات المفتوحة',
                        'caption_en' => 'High-Sensitivity Optical Beam Smoke Detectors',
                    ],
                    [
                        'image_path' => 'images/services/networks-and-infrastructure.jpg',
                        'caption_ar' => 'تغطية شبكة Wi-Fi الصناعية عالية الكثافة لأجهزة القراءة اللاسلكية',
                        'caption_en' => 'Ruggedized Industrial Wireless Network for Logistics Scanners',
                    ],
                ],
            ],
            [
                'slug' => 'central-data-center-tier-3',
                'title_ar' => 'مركز البيانات الرئيسي Tier III - الرياض',
                'title_en' => 'Enterprise Tier III Data Center - Riyadh',
                'description_ar' => 'تصميم وتنفيذ غرفة سيرفرات رئيسية بأنظمة تبريد دقيق InRow، وأنظمة UPS مضاعفة N+1، وإطفاء بالغاز النظيف NOVEC 1230.',
                'description_en' => 'Engineering and deployment of a Tier III server facility: InRow precision cooling, redundant N+1 UPS power banks, and clean NOVEC 1230 suppression.',
                'content_ar' => 'إنشاء بيئة خوادم عالية الكفاءة تدعم استمرارية تشغيل بنسبة 99.982%. يشمل المشروع 40 كابينة خوادم، وأنظمة مراقبة بيئية ذكية لحرارة ورطوبة الأجهزة، ونظام تحكم بالدخول عبر البصمة البيومترية المشفرة لخزائن السيرفرات.',
                'content_en' => 'Designed and commissioned a robust server facility guaranteeing 99.982% uptime. Features 40 high-density server racks, comprehensive temperature/humidity telemetry, and rack-level biometric access locks.',
                'category' => 'government',
                'client' => 'هيئة تقنية وطنية',
                'location' => 'الرياض - واحة التقنية',
                'completion_date' => '2024-12-05',
                'cover_image' => 'images/projects/central-data-center-tier-3.jpg',
                'is_published' => true,
                'sort_order' => 5,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/data-centers-and-server-rooms.jpg',
                        'caption_ar' => 'خزائن السيرفرات عالية الكثافة وتبريد الكابينة الذكي InRow',
                        'caption_en' => 'High-Density Server Racks with InRow Precision Airflow',
                    ],
                    [
                        'image_path' => 'images/hero-operations-center.jpg',
                        'caption_ar' => 'غرفة المراقبة المركزية والتحكم في تليمتري السيرفرات والطاقة',
                        'caption_en' => 'Telemetry & NOC Operations Monitoring Console',
                    ],
                    [
                        'image_path' => 'images/services/networks-and-infrastructure.jpg',
                        'caption_ar' => 'شبكات الربط المزدوج المتكررة ومسارات الألياف الضوئية المعتمدة',
                        'caption_en' => 'Redundant Dual-Path Cat6A & MPO Multi-Fiber Cabling',
                    ],
                ],
            ],
            [
                'slug' => 'healthcare-specialty-hospital-av-security',
                'title_ar' => 'المستشفى التخصصي للرعاية الطبية - مكة المكرمة',
                'title_en' => 'Specialty Healthcare Hospital - Makkah',
                'description_ar' => 'تكامل شامل لأنظمة نداء الممرضات، والتحكم في الدخول لأجنحة العمليات، والأنظمة الصوتية الطبية، وشاشات العرض التفاعلية.',
                'description_en' => 'Full IP nurse call integration, sterile operating theatre access control, emergency public address, and interactive digital signage.',
                'content_ar' => 'تجهيز صرح طبي متقدم بسعة 180 سريراً. تم دمج نظام النداء الطبي السريع مع هواتف التمريض الذكية، وتركيب كاميرات مراقبة ذكية للأروقة والمداخل تراعي خصوصية المرضى، ونظام بطاقات ذكية للأطباء والكوادر التمريضية.',
                'content_en' => 'Equipped a 180-bed specialty hospital. Unified the IP nurse call alert matrix with staff mobile handsets, deployed compliant corridor CCTV, and implemented smart multi-level credential badges for medical teams.',
                'category' => 'commercial',
                'client' => 'مجموعة الرعاية الحديثة الطبية',
                'location' => 'مكة المكرمة - العزيزية',
                'completion_date' => '2024-09-14',
                'cover_image' => 'images/projects/healthcare-specialty-hospital-av-security.jpg',
                'is_published' => true,
                'sort_order' => 6,
                'gallery_images' => [
                    [
                        'image_path' => 'images/services/access-control-systems.jpg',
                        'caption_ar' => 'التحكم بالدخول الإلكتروني المعقم لأجنحة العمليات والعناية المركزة',
                        'caption_en' => 'Sterile Hands-Free Access Control for Surgical & ICU Suites',
                    ],
                    [
                        'image_path' => 'images/services/audio-visual-systems.jpg',
                        'caption_ar' => 'أنظمة الإخلاء الصوتي في حالات الطوارئ والشاشات التفاعلية',
                        'caption_en' => 'Emergency Hospital Voice Evacuation & Interactive Panels',
                    ],
                    [
                        'image_path' => 'images/services/system-integration.jpg',
                        'caption_ar' => 'تكامل نظام نداء الممرضات IP مع الشبكة المركزية للمستشفى',
                        'caption_en' => 'Hospital-Wide IP Nurse Call & Building Systems Integration',
                    ],
                ],
            ],
        ];

        foreach ($projects as $projData) {
            $gallery = $projData['gallery_images'] ?? [];
            unset($projData['gallery_images']);

            $project = Project::updateOrCreate(
                ['slug' => $projData['slug']],
                $projData
            );

            // Populate Gallery Images
            if (!empty($gallery)) {
                $sort = 1;
                foreach ($gallery as $gImg) {
                    ProjectImage::updateOrCreate(
                        [
                            'project_id' => $project->id,
                            'image_path' => $gImg['image_path'],
                        ],
                        [
                            'caption_ar' => $gImg['caption_ar'],
                            'caption_en' => $gImg['caption_en'],
                            'sort_order' => $sort++,
                        ]
                    );
                }
            }
        }
    }
}
