<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug'         => 'ai-video-surveillance-future-standards',
                'title_ar'     => 'مستقبل أنظمة المراقبة بالكاميرات والتحليلات المتقدمة بالذكاء الاصطناعي',
                'title_en'     => 'Future of CCTV Surveillance and Advanced AI Video Analytics',
                'excerpt_ar'   => 'كيف تحولت كاميرات المراقبة من مجرد تسجيل سلبي للأحداث إلى خط دفاع أول يستبق الحوادث الأمنية ويحلل السلوك آلياً بدقة فائقة.',
                'excerpt_en'   => 'How video surveillance evolved from passive recording into an active proactive first line of defense with real-time behavioural AI analytics.',
                'content_ar'   => "شهدت تكنولوجيا المراقبة المرئية خلال السنوات الأخيرة قفزة نوعية غير مسبوقة بفضل دمج خوارزميات التعلم العميق والذكاء الاصطناعي على الحافة (Edge AI).

أهم الركائز التقنية للمراقبة الحديثة:
1. التعرف التلقائي على لوحات المركبات (LPR/ANPR) والتحقق اللحظي مع قواعد البيانات الأمنية.
2. الكشف عن التسلل واختراق السياج الجغرافي الافتراضي (Virtual Tripwire).
3. التعرف على الوجوه ومطابقتها المصرح بها في المنشآت الحساسة ومراكز المال والأعمال.
4. خفض الإنذارات الكاذبة الناتجة عن حركة الأشجار والحيوانات وتغيرات الإضاءة بنسبة تتجاوز 95%.

الامتثال التنظيمي:
تتوافق أنظمتنا المنفذة مع معايير الهيئة العليا للأمن الصناعي (HCIS) واللوائح التنظيمية للأمن والسلامة المعمول بها في المملكة العربية السعودية.",
                'content_en'   => "Video surveillance technology has experienced unprecedented transformation through Edge AI deep learning algorithms.

Core Technical Pillars:
1. Automatic Number Plate Recognition (ANPR/LPR) with real-time verification against security blacklists.
2. Virtual Perimeter Intrusion Detection and automated tripwires.
3. Facial recognition and biometric authentication for mission-critical infrastructure.
4. Drastic reduction of false alarms caused by environmental factors by over 95%.

Regulatory Compliance:
Our integrated systems strictly adhere to Saudi High Commission for Industrial Security (HCIS) requirements.",
                'category'     => 'security',
                'image'        => 'images/articles/ai-video-surveillance-future-standards.jpg',
                'author_name'  => 'م. أحمد الخالدي — استشاري أنظمة أمنية',
                'tags_ar'      => ['كاميرات مراقبة', 'ذكاء اصطناعي', 'الأمن الصناعي', 'HCIS'],
                'tags_en'      => ['CCTV', 'AI Analytics', 'Industrial Security', 'HCIS'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count'  => 342,
                'sort_order'   => 1,
            ],
            [
                'slug'         => 'nfpa-fire-alarm-engineering-standards',
                'title_ar'     => 'معايير تصميم شبكات إنذار ومكافحة الحريق وفق كود NFPA وكود البناء السعودي',
                'title_en'     => 'Designing Fire Alarm & Protection Networks per NFPA & Saudi Building Code',
                'excerpt_ar'   => 'دليل هندسي موجز حول الأسس التصميمية لأنظمة الإنذار المعنونة وشبكات الإطفاء التلقائي بالغاز والماء للمباني والمنشآت التجارية.',
                'excerpt_en'   => 'An engineering summary of addressable fire alarm design criteria, clean agent gas suppression, and sprinkler hydraulic calculations.',
                'content_ar'   => "تعتبر أنظمة السلامة ومكافحة الحريق حجر الزاوية في حماية الأرواح والأصول في أي منشأة تجارية أو صناعية.

أهم متطلبات التصميم الهندسي:
1. اختيار الحساسات المناسبة لكل فراغ معماري (حساسات دخان كهروضوئية، حساسات حرارة ثابتة ومتغيرة، حساسات لهب بصرية).
2. أنظمة الإطفاء بغازات نظيفة (FM-200 / Novec 1230) لحماية غرف الخوادم ومراكز البيانات دون الإضرار بالإلكترونيات الحساسة.
3. حسابات الهيدروليك لشبكات رشاشات المياه ومضخات الحريق المعتمدة من UL/FM.
4. تكامل نظام الإنذار مع مصاعد المبنى ونظام التهوية وضغط السلالم (Stairwell Pressurization).",
                'content_en'   => "Fire alarm and life safety systems represent the essential safeguard for protecting personnel and corporate assets.

Key Engineering Considerations:
1. Detector selection tailored to specific room environments (photoelectric smoke, thermal rate-of-rise, optical flame detectors).
2. Clean agent gaseous suppression (FM-200 / Novec 1230) for data center and server room protection without moisture damage.
3. Hydraulic calculations for automatic sprinkler networks and UL/FM certified fire pumps.
4. Comprehensive integration with elevators, smoke evacuation, and stairwell pressurization systems.",
                'category'     => 'fire_safety',
                'image'        => 'images/articles/nfpa-fire-alarm-engineering-standards.jpg',
                'author_name'  => 'م. سلطان المنصور — مهندس سلامة معتمد',
                'tags_ar'      => ['إنذار حريق', 'سلامة', 'NFPA', 'كود البناء السعودي'],
                'tags_en'      => ['Fire Alarm', 'NFPA', 'Life Safety', 'SBC'],
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'views_count'  => 518,
                'sort_order'   => 2,
            ],
            [
                'slug'         => 'data-center-tier-3-infrastructure-design',
                'title_ar'     => 'الأسس الهندسية لتصميم غرف السيرفرات ومراكز البيانات بتصنيف Tier III',
                'title_en'     => 'Engineering Guidelines for Designing Tier III Server Rooms & Data Centers',
                'excerpt_ar'   => 'كيفية تحقيق توفرية بنسبة 99.982% من خلال مسارات التغذية الكهربائية المزدوجة والتبريد الدقيق لأنظمة الحوسبة عالية الكثافة.',
                'excerpt_en'   => 'How to achieve 99.982% uptime availability through redundant dual electrical paths and precision InRow climate management.',
                'content_ar'   => "تعتمد استمرارية الأعمال الرقمية للشركات والبنوك والمؤسسات الكبرى على كفاءة البنية التحتية الفيزيائية لمراكز البيانات وغرف الاتصالات.

معايير جهوزية Tier III:
1. توفرية مستمرة: صيانة جميع المعدات ومسارات الطاقة دون الحاجة لإيقاف تشغيل الخوادم (Concurrently Maintainable).
2. وحدات التغذية غير المنقطعة (UPS) المزدوجة بنظام التكرارية (N+1 أو 2N).
3. التبريد الدقيق وتوجيه تيارات الهواء بالممرات الباردة والساخنة (Hot/Cold Aisle Containment).
4. المراقبة المركزية البيئية وأنظمة DCIM لرصد درجات الحرارة والرطوبة وتسريبات السوائل اللحظية.",
                'content_en'   => "Digital operational continuity relies fundamentally on resilient physical infrastructure in mission-critical data rooms.

Tier III Reliability Pillars:
1. Concurrently Maintainable topology: equipment maintenance without operational shutdown.
2. Redundant Uninterruptible Power Supplies (UPS) configured in N+1 or 2N arrangements.
3. Precision InRow cooling paired with hot/cold aisle containment systems.
4. Comprehensive DCIM environmental monitoring covering ambient temperature, humidity, and fluid leak detection.",
                'category'     => 'engineering',
                'image'        => 'images/articles/data-center-tier-3-infrastructure-design.jpg',
                'author_name'  => 'فريق STS الهندسي',
                'tags_ar'      => ['مراكز بيانات', 'سيرفرات', 'Tier III', 'شبكات'],
                'tags_en'      => ['Data Center', 'Tier III', 'Server Rooms', 'Networking'],
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'views_count'  => 680,
                'sort_order'   => 3,
            ],
            [
                'slug'         => 'biometric-access-control-enterprise-security',
                'title_ar'     => 'تكامل أنظمة التحكم بالدخول البيومترية مع بوابات المرور السريع للمقرات المؤسسية',
                'title_en'     => 'Integrating Biometric Access Control with Speed Gates for Enterprise HQs',
                'excerpt_ar'   => 'دمج تقنيات التعرف على الوجه وبصمة الكف مع بوابات Flap Barrier لتوفير تجربة مرور انسيابية وآمنة للموظفين والزوار.',
                'excerpt_en'   => 'Seamless integration of touchless biometric facial recognition with architectural flap turnstiles for corporate facilities.',
                'content_ar'   => "تتطلب المقرات الإدارية والأبراج المكتبية الحديثة توازناً دقيقاً بين توفير أعلى درجات الأمان من جهة، وسلاسة تدفق حركة الموظفين والزوار من جهة أخرى.

الحلول الهندسية المعتمدة:
1. بوابات المرور السريع (Speed Gates & Flap Turnstiles) ذات التصميم الزجاجي العصري المقاوم للصدمات.
2. أجهزة التحقق اللا تلامسية فائقة السرعة بزمن قراءة يقل عن 0.2 ثانية.
3. نظام إدارة الزوار (VMS) بإصدار رموز QR مؤقتة تنتهي صلاحيتها بعد انتهاء الموعد.
4. التكامل الكامل مع نظام الحضور والانصراف السحابي وتطبيق الهاتف الذكي.",
                'content_en'   => "Modern office towers require a delicate balance between enterprise-grade perimeter control and frictionless pedestrian flow.

Core Engineering Solutions:
1. Architectural speed gates with tempered glass aesthetic barriers and anti-tailgating sensors.
2. Contactless biometric facial recognition terminals operating at sub-0.2 second validation speeds.
3. Dynamic Visitor Management System (VMS) generating self-expiring mobile QR passes.
4. Seamless synchronization with enterprise HR attendance databases.",
                'category'     => 'security',
                'image'        => 'images/articles/biometric-access-control-enterprise-security.jpg',
                'author_name'  => 'م. أحمد الخالدي — استشاري أنظمة أمنية',
                'tags_ar'      => ['تحكم بالدخول', 'بوابات ذكية', 'أنظمة بيومترية'],
                'tags_en'      => ['Access Control', 'Speed Gates', 'Biometrics'],
                'is_published' => true,
                'published_at' => now()->subDays(28),
                'views_count'  => 412,
                'sort_order'   => 4,
            ],
            [
                'slug'         => 'iot-smart-building-management-systems-bms',
                'title_ar'     => 'دور إنترنت الأشياء وأنظمة BMS في ترشيد استهلاك الطاقة بالمباني الذكية',
                'title_en'     => 'The Role of IoT & BMS in Optimizing Energy Efficiency in Smart Buildings',
                'excerpt_ar'   => 'كيف تسهم أجهزة الاستشعار المتصلة وأنظمة إدارة المباني الذكية في خفض تكاليف التشغيل بنسبة تصل إلى 30%.',
                'excerpt_en'   => 'How interconnected IoT sensors and central Building Management Systems drive facility energy reductions up to 30%.',
                'content_ar'   => "مع التوجه الوطني نحو الاستدامة وتحقيق أهداف رؤية المملكة 2030، أصبحت أنظمة المباني الذكية ضرورة استراتيجية للحد من الهدر التشغيلي.

قدرات نظام إدارة المباني (BMS):
1. التحكم الذكي في التكييف والإضاءة بناءً على نسبة الإشغال الفعلية لكل قاعة ومكتب.
2. مراقبة جودة الهواء الداخلي (IAQ) ومستويات ثاني أكسيد الكربون لرفع إنتاجية بيئة العمل.
3. التنبؤ بالأعطال الميكانيكية والكهربائية قبل وقوعها من خلال تحليل الاهتزازات وسحب التيار.
4. لوحات تحكم ومؤشرات أداء لحظية (KPI Dashboards) لإدارة المرافق عن بعد.",
                'content_en'   => "In alignment with sustainability targets and Saudi Vision 2030, smart building engineering is paramount to optimizing facility lifecycle costs.

BMS Capabilities:
1. Intelligent HVAC and lighting automation tuned to real-time occupancy sensor feeds.
2. Indoor Air Quality (IAQ) and CO2 tracking for healthier work environments.
3. Predictive maintenance algorithms detecting electrical and mechanical drift prior to failures.
4. Real-time executive dashboards for remote facility portfolio supervision.",
                'category'     => 'iot',
                'image'        => 'images/articles/iot-smart-building-management-systems-bms.jpg',
                'author_name'  => 'فريق STS الهندسي',
                'tags_ar'      => ['إنترنت الأشياء', 'BMS', 'مباني ذكية', 'كفاءة الطاقة'],
                'tags_en'      => ['IoT', 'BMS', 'Smart Buildings', 'Energy Efficiency'],
                'is_published' => true,
                'published_at' => now()->subDays(35),
                'views_count'  => 590,
                'sort_order'   => 5,
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(
                ['slug' => $art['slug']],
                $art
            );
        }
    }
}
