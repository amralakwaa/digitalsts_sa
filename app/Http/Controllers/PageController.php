<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\Article;
use App\Models\ServiceOffer;
use App\Models\SiteSetting;

class PageController extends Controller
{
    public function about()
    {
        $servicesCount = Service::where('is_active', true)->count();
        $projectsCount = Project::where('is_published', true)->count();

        $contactPhone = SiteSetting::get('contact_phone', '+966 50 676 1942');
        $contactWhatsapp = SiteSetting::get('contact_whatsapp', '+966 50 676 1942');
        $contactEmail = SiteSetting::get('contact_email', 'info@sts.com.sa');
        $contactAddress = SiteSetting::get('contact_address', 'طريق الملك عبد العزيز، حي الياسمين، الرياض');
        $workingHours = SiteSetting::get('working_hours', 'الأحد - الخميس: 8:00 صباحاً - 5:00 مساءً');

        return view('pages.about', compact(
            'servicesCount',
            'projectsCount',
            'contactPhone',
            'contactWhatsapp',
            'contactEmail',
            'contactAddress',
            'workingHours'
        ));
    }

    public function sectors()
    {
        $sectors = [
            [
                'id' => 'commercial',
                'title_ar' => 'الأبراج والشركات التجارية',
                'title_en' => 'Commercial & Corporate Towers',
                'desc_ar' => 'حلول أمنية مصممة للشركات والمباني الإدارية تشمل كاميرات المراقبة بالذكاء الاصطناعي، وبوابات المرور السريع، والتحكم بمصاعد الموظفين والزوار، وشبكات البيانات عالية السرعة.',
                'desc_en' => 'Integrated enterprise solutions including AI surveillance, turnstile speed gates, elevator destination dispatch, and high-speed fiber local area networks.',
                'icon' => 'building-2',
                'solutions_ar' => [
                    'بوابات الدخول السريعة الذكية (Turnstiles)',
                    'كاميرات مراقبة مع التعرف على الوجوه وبطاقات الزوار',
                    'شبكات Wi-Fi 6 مؤسسية وتجهيز كبائن السيرفرات',
                    'تجهيز غرف الاجتماعات الذكية بالأنظمة السمعية والبصرية',
                ],
                'solutions_en' => [
                    'Intelligent optical speed gates and turnstiles',
                    'Facial recognition CCTV and digital visitor badges',
                    'Enterprise Wi-Fi 6 and structured cabling patch panels',
                    'Smart hybrid boardroom audio-visual conferencing',
                ],
            ],
            [
                'id' => 'hospitality',
                'title_ar' => 'الفنادق والمنتجعات السياحية',
                'title_en' => 'Hospitality & Luxury Resorts',
                'desc_ar' => 'منظومة ذكية متكاملة للفنادق والشقق المخدومة ترتقي بتجربة النزيل وتوفر حتى 40% من استهلاك الطاقة في الغرف غير المشغولة.',
                'desc_en' => 'Comprehensive hospitality technology enhancing guest experience while cutting unoccupied room HVAC energy costs by up to 40%.',
                'icon' => 'hotel',
                'solutions_ar' => [
                    'أنظمة إدارة غرف النزلاء الذكية (GRMS)',
                    'أقفال إلكترونية فندقية RFID ومفاتيح الهاتف الذكي BLE',
                    'لوحات مؤشرات الغرف الخارجية (DND / MUR)',
                    'أنظمة الصوتيات الموزعة للحدائق والمسابح والمطاعم',
                ],
                'solutions_en' => [
                    'Smart Guest Room Management Systems (GRMS)',
                    'RFID and Bluetooth BLE mobile key electronic locks',
                    'Capacitive glass doorbell DND/MUR corridor indicators',
                    'Multi-zone distributed audio for gardens and pools',
                ],
            ],
            [
                'id' => 'residential',
                'title_ar' => 'القصور والفلل السكنية الفاخرة',
                'title_en' => 'Luxury Villas & Palaces',
                'desc_ar' => 'تحكم كامل بأتمتة المنزل الفاخر عبر بروتوكولات KNX العالمية وتطبيقات الهاتف الذكية، مع تأمين الأسوار الخارجية بحساسات الحركة والاهتزاز.',
                'desc_en' => 'Seamless KNX home automation for lighting, HVAC, and shades coupled with active perimeter security and laser tripwires.',
                'icon' => 'home',
                'solutions_ar' => [
                    'أتمتة الإضاءة والتكييف والستائر عبر المفاتيح اللمسية والصوت',
                    'تأمين الأسوار بكاميرات حرارية ومستشعرات اهتزاز',
                    'أنظمة إنتركوم مرئي ذكي مع ربط مباشر بهاتف المالك',
                    'تجهيز صالات السينما المنزلية بصوت Dolby Atmos المحيطي',
                ],
                'solutions_en' => [
                    'KNX lighting scenes, motorized shades, and climate automation',
                    'Perimeter fence thermal surveillance and vibration sensors',
                    'IP video door intercom connected to smartphones',
                    'Bespoke private cinema setups with Dolby Atmos acoustics',
                ],
            ],
            [
                'id' => 'industrial',
                'title_ar' => 'المستودعات والمنشآت اللوجستية والمصانع',
                'title_en' => 'Warehouses, Logistics & Manufacturing',
                'desc_ar' => 'حماية المنشآت الصناعية والمخازن الكبرى بأنظمة كشف الحريق الشعاعية المعتمدة وتأمين البوابات عبر قارئات لوحات الشاحنات.',
                'desc_en' => 'High-bay warehouse optical beam fire signaling, ANPR vehicle gate access, and ruggedized industrial wireless infrastructure.',
                'icon' => 'factory',
                'solutions_ar' => [
                    'كواشف دخان وحرارة شعاعية (Beam Detectors) للأسقف المرتفعة',
                    'بوابات أمنية مع قارئات لوحات سيارات الشحن (ANPR)',
                    'كاميرات مراقبة خارجية مقاومة للظروف المناخية القاسية',
                    'شبكات لاسلكية صناعية تدعم أجهزة قراءة الباركود اللحظية',
                ],
                'solutions_en' => [
                    'Optical beam smoke sensors for high-ceiling hangars',
                    'Automated truck gate barriers with ANPR cameras',
                    'Heavy-duty weatherproof outdoor CCTV housings',
                    'Rugged industrial Wi-Fi for mobile RFID scanners',
                ],
            ],
            [
                'id' => 'government',
                'title_ar' => 'القطاع الحكومي والمنشآت الحيوية',
                'title_en' => 'Government & Critical Infrastructure',
                'desc_ar' => 'حلول أمنية وتقنية مطابقة لجميع اشتراطات الهيئة العليا للأمن الصناعي والدفاع المدني مع أعلى معايير التشفير والاعتمادية.',
                'desc_en' => 'Strictly compliant infrastructure adhering to Civil Defense and industrial security governance standards with redundant fail-safes.',
                'icon' => 'shield',
                'solutions_ar' => [
                    'مراكز قيادة وتحكم أمنية متكاملة (PSIM)',
                    'مراكز بيانات Tier III بغرف سيرفرات مبردة ومعزولة',
                    'أنظمة إطفاء بالغاز النظيف الصديق للبيئة NOVEC 1230',
                    'تحكم بالدخول عبر البطاقات الذكية المشفرة والبصمات البيومترية',
                ],
                'solutions_en' => [
                    'Central security command and control room (PSIM)',
                    'Tier III data centers with InRow cooling and N+1 UPS',
                    'Clean agent gas fire suppression systems (NOVEC 1230)',
                    'High-security biometric readers and encrypted smartcards',
                ],
            ],
            [
                'id' => 'retail',
                'title_ar' => 'متاجر التجزئة والمراكز التجارية',
                'title_en' => 'Retail Chains & Shopping Malls',
                'desc_ar' => 'كاميرات ذكية لحساب أعداد الزوار (People Counting)، وكشف السرقات، وأنظمة النداء العام وشاشات العرض الرقمية الإعلانية.',
                'desc_en' => 'AI retail analytics (footfall and heat mapping), loss prevention EAS pedestals, and centralized digital signage displays.',
                'icon' => 'shopping-cart',
                'solutions_ar' => [
                    'تحليلات الفيديو لحساب أعداد المتسوقين وتحديد خريطة الحرارة',
                    'بوابات إلكترونية لكشف سرقة البضائع (EAS)',
                    'أنظمة صوتية موزعة لبث الموسيقى والإعلانات الترويجية',
                    'شاشات عرض رقمية (Digital Signage) تدار مركزياً',
                ],
                'solutions_en' => [
                    'Video analytics footfall counting and customer heatmaps',
                    'Electronic Article Surveillance (EAS) antitheft gates',
                    'Distributed background music and voice announcement systems',
                    'Centrally managed commercial digital signage screens',
                ],
            ],
        ];

        return view('pages.sectors', compact('sectors'));
    }

    public function privacy()
    {
        return view('pages.legal.privacy');
    }

    public function terms()
    {
        return view('pages.legal.terms');
    }

    public function sitemap()
    {
        $urls = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => url('/about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/services'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/sectors'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/projects'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/articles'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => url('/offers'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/quote'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => url('/privacy-policy'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => url('/terms'), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        foreach (Service::where('is_active', true)->get(['slug', 'updated_at']) as $service) {
            $urls[] = [
                'loc' => url('/services/' . $service->slug),
                'lastmod' => $service->updated_at?->toAtomString(),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];
        }

        foreach (Project::where('is_published', true)->get(['slug', 'updated_at']) as $project) {
            $urls[] = [
                'loc' => url('/projects/' . $project->slug),
                'lastmod' => $project->updated_at?->toAtomString(),
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ];
        }

        foreach (Article::where('is_published', true)->get(['slug', 'updated_at']) as $article) {
            $urls[] = [
                'loc' => url('/articles/' . $article->slug),
                'lastmod' => $article->updated_at?->toAtomString(),
                'priority' => '0.7',
                'changefreq' => 'monthly',
            ];
        }

        foreach (ServiceOffer::where('is_active', true)->get(['slug', 'updated_at']) as $offer) {
            $urls[] = [
                'loc' => url('/offers/' . $offer->slug),
                'lastmod' => $offer->updated_at?->toAtomString(),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc']) . '</loc>' . "\n";
            if (!empty($u['lastmod'])) {
                $xml .= '    <lastmod>' . $u['lastmod'] . '</lastmod>' . "\n";
            }
            if (!empty($u['changefreq'])) {
                $xml .= '    <changefreq>' . $u['changefreq'] . '</changefreq>' . "\n";
            }
            if (!empty($u['priority'])) {
                $xml .= '    <priority>' . $u['priority'] . '</priority>' . "\n";
            }
            $xml .= '  </url>' . "\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
