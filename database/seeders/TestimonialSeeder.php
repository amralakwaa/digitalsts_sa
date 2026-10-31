<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'م. فيصل بن عبدالله الراجحي',
                'client_position' => 'المشرف العام على مشاريع الضيافة',
                'company' => 'شركة أفق الضيافة للاستثمار',
                'city' => 'الرياض',
                'project_type' => 'كاميرات مراقبة AI ونظام GRMS',
                'rating' => 5,
                'review_text' => 'تعاقدنا مع الفريق لتنفيذ منظومة المراقبة الذكية وإدارة غرف النزلاء (GRMS) لأحد مشاريعنا الفندقية في الرياض. الالتزام بالمخططات الهندسية وتسليم المشروع في الوقت المحدد مع اعتماد الدفاع المدني كان نموذجياً وفاق توقعاتنا.',
                'review_text_en' => 'We partnered with the team to deploy AI CCTV and Hotel GRMS automation for our luxury hospitality project in Riyadh. Full engineering precision, on-time delivery, and Civil Defense approvals exceeded all our expectations.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'أ. سلمان بن خالد الدوسري',
                'client_position' => 'مدير إدارة الأمن والسلامة والمرافق',
                'company' => 'أبراج العليا الإدارية',
                'city' => 'الرياض',
                'project_type' => 'بوابات ذكية Speed Gates ومراقبة مركزية',
                'rating' => 5,
                'review_text' => 'تم تركيب وتشغيل بوابات الدخول السريعة وكاميرات التعرف على الوجه في برجنا الإداري بكفاءة استثنائية. الدقة في ضبط الصلاحيات وربط المصاعد منحت المبنى انسيابية أمنية عالية وسهلت حركة الزوار والموظفين.',
                'review_text_en' => 'The optical speed gates and AI facial recognition cameras in our corporate tower run flawlessly. Smooth elevator integration and access control provided total security and fast throughput.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'د. عبدالعزيز بن فهد الغامدي',
                'client_position' => 'مالك قصر خاص',
                'company' => 'قطاع الإسكان الفاخر',
                'city' => 'جدة',
                'project_type' => 'أتمتة منازل ذكية KNX وحماية محيط',
                'rating' => 5,
                'review_text' => 'تجربة أتمتة القصر عبر معيار KNX كانت ممتازة جداً. التحكم الكامل بالتكييف والإضاءة والستائر والسينما المنزلية من تطبيق واحد، مع شبكة كواشف وحماية الأسوار بالليزر، حققت أعلى معايير الخصوصية والأمان لعائلتي.',
                'review_text_en' => 'The KNX smart automation delivered an exceptional living experience. Unified climate, lighting, and home cinema control combined with perimeter laser defense provided maximum comfort and family privacy.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'م. ماجد بن محمد القحطاني',
                'client_position' => 'مدير التشغيل والخدمات اللوجستية',
                'company' => 'مجمع المستودعات المركزية',
                'city' => 'الدمام',
                'project_type' => 'إنذار حريق معتمد للدفاع المدني',
                'rating' => 5,
                'review_text' => 'احترافية هندسية نادرة في تركيب كواشف الحريق الشعاعية والحرارية للأسقف العالية في مستودعاتنا بالدمام. تم إنهاء الاختبارات واستخراج تقرير المخططات والتراخيص الرسمية من منصة سلامة بسلاسة وبدون أي تأخير.',
                'review_text_en' => 'Outstanding engineering competence installing optical beam fire detection for our high-bay logistics warehouses. Testing and official Civil Defense Salamah certification were completed seamlessly.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'client_name' => 'أ. تركي بن ناصر المطيري',
                'client_position' => 'الرئيس التنفيذي للعمليات',
                'company' => 'مجمع أفق الأعمال المكتبي',
                'city' => 'الرياض',
                'project_type' => 'شبكات ألياف بصرية وغرف خوادم Data Center',
                'rating' => 5,
                'review_text' => 'فريق هندسي متمكن أشرف على تمديد شبكة الألياف الضوئية وتجهيز غرفة الخوادم الرئيسية بكوابل Cat6A وخزائن Racks معتمدة. تنظيم الكوابل والتوثيق والسرعات العالية تعكس معايير الجودة العالمية التي يلتزمون بها.',
                'review_text_en' => 'Highly certified technicians handled fiber optic distribution and our Tier III server room infrastructure. Impeccable structured cabling, labeling, and speed test validation.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'client_name' => 'الشيخ منصور بن حمد الشمري',
                'client_position' => 'مالك ومطور عقاري',
                'company' => 'مجمع فلل الواحة السكنية',
                'city' => 'الخبر',
                'project_type' => 'إنتركم IP وبوابات ANPR ذكية',
                'rating' => 5,
                'review_text' => 'قمنا بتركيب شبكة إنتركم مرئي IP وبوابات سيارات بنظام قراءة اللوحات الذكي لمجمعنا السكني بالخبر. الجودة متينة وخدمة ما بعد البيع والدعم الفني السريع يؤكدان أنهم الشريك التقني الأفضل دائماً.',
                'review_text_en' => 'Installed IP video intercom and ANPR license plate barrier systems for our residential gated compound in Khobar. Robust industrial quality and prompt after-sales technical support.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'client_name' => 'م. سعود بن إبراهيم السبيعي',
                'client_position' => 'استشاري المشاريع الكهروميكانيكية',
                'company' => 'السبيعي للاستشارات الهندسية',
                'city' => 'مكة المكرمة',
                'project_type' => 'نظام صوتيات وإخلاء صوتي طارئ',
                'rating' => 5,
                'review_text' => 'نظام الإخلاء الصوتي والإذاعة الداخلية الذي تم تركيبه بالمركز التجاري يتمتع بنقاء صوتي استثنائي وتوافق كامل مع المعايير الدولية ومتطلبات كود البناء السعودي. سعداء جداً بالشراكة والتعامل الراقي.',
                'review_text_en' => 'The emergency voice alarm and public address system installed in the commercial mall delivers crystal-clear acoustics and full Saudi Building Code compliance. An absolute pleasure to work with.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'client_name' => 'أ. طارق بن سلطان العتيبي',
                'client_position' => 'مدير إدارة المراكز التجارية',
                'company' => 'سلسلة مراكز النخبة للتسوق',
                'city' => 'جدة',
                'project_type' => 'كاميرات مراقبة بعدسات متطورة وتحليل AI',
                'rating' => 5,
                'review_text' => 'تغطية شاملة بزوايا رؤية دقيقة للممرات ومواقف السيارات، مع كاميرات قراءة لوحات السيارات وأنظمة تتبع متقدمة متوافقة تماماً مع اشتراطات وزارة الداخلية والأمن الوقائي. شكراً لفريق العمل المتميز.',
                'review_text_en' => 'Complete high-definition coverage for shopping galleries and parking zones, meeting all Ministry of Interior and preventive security standards. Exceptional engineering team.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 8,
            ],
            [
                'client_name' => 'م. وليد بن أحمد الشهري',
                'client_position' => 'المشرف على تقنية المعلومات',
                'company' => 'شركة البنيان للمقاولات',
                'city' => 'الرياض',
                'project_type' => 'سنترالات IP وحلول مراقبة الفروع',
                'rating' => 5,
                'review_text' => 'ربط فروعنا ومواقعنا الإنشائية بغرفة عمليات مركزية وسنترال IP موحد كان نقلة نوعية في سرعة التواصل والإشراف الميداني المباشر. خبرة فريق الدعم وسرعة استجابتهم لا تقدر بثمن.',
                'review_text_en' => 'Interconnecting our corporate branches and remote construction sites through a centralized IP telephony and video surveillance hub has transformed our operational efficiency.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 9,
            ],
            [
                'client_name' => 'أ. نايف بن سعد الحربي',
                'client_position' => 'مالك فيلا سكنية',
                'company' => 'مجمع ديار النرجس',
                'city' => 'الرياض',
                'project_type' => 'منزل ذكي موفر للطاقة وتحكم صوتي',
                'rating' => 5,
                'review_text' => 'أشكر المهندسين على نصائحهم الثمينة أثناء التأسيس. تم برمجة سيناريوهات الإضاءة والتكييف بطريقة ذكية ساهمت في خفض فاتورة الكهرباء بشكل ملموس مع راحة وتحكم كامل عبر الأوامر الصوتية والجوال.',
                'review_text_en' => 'Big thanks to the engineers for their invaluable guidance during initial rough-in. Smart lighting and HVAC schedules substantially reduced our utility bills with seamless voice control.',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 10,
            ],
        ];

        // Clear existing if any and insert fresh
        Testimonial::truncate();

        foreach ($testimonials as $item) {
            Testimonial::create($item);
        }
    }
}
