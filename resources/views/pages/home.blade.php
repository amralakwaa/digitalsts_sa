@extends('layouts.app')

@section('title', __('messages.company_name') . ' — ' . __('messages.company_slogan'))

@section('content')

<!-- ================= HERO SECTION (MOBILE-FIRST LUXURY) ================= -->
<section id="hero-section" class="relative min-h-[92vh] sm:min-h-[88vh] flex items-center justify-center overflow-hidden pt-24 pb-16 sm:py-32 bg-surface-950">
    <!-- Hero Background Image & Layered Tech Overlays -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero-smart-city-bg.jpg') }}" 
             alt="STS Smart Tech Systems &amp; Intelligent Security" 
             class="w-full h-full object-cover object-center transform scale-100 sm:scale-102 opacity-85 sm:opacity-90 transition-all duration-700"
             width="1920" height="1080"
             fetchpriority="high"
             decoding="async">
        
        <!-- Multi-layer dark tech gradients for optimal text contrast and sleek aesthetics -->
        <div class="absolute inset-0 bg-gradient-to-b from-surface-950/85 via-surface-950/50 to-surface-950/95"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface-950/90 via-surface-950/40 to-surface-950/70 rtl:from-surface-950/90 rtl:via-surface-950/40 rtl:to-surface-950/70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-600/25 via-transparent to-transparent pointer-events-none"></div>
        
        <!-- High-tech grid and decorative orbs -->
        <div class="absolute inset-0 bg-grid-light opacity-5"></div>
        <div class="absolute top-1/4 start-1/4 w-72 sm:w-[500px] h-72 sm:h-[500px] bg-brand-500/15 rounded-full blur-[100px] sm:blur-[140px] pointer-events-none animate-float"></div>
        <div class="absolute bottom-1/4 end-1/4 w-64 sm:w-[400px] h-64 sm:h-[400px] bg-accent-sky/15 rounded-full blur-[90px] sm:blur-[120px] pointer-events-none animate-float-delay"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="text-center max-w-4xl mx-auto space-y-6 sm:space-y-8">
            
            <!-- Live Operational Status Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 sm:px-5 sm:py-2 rounded-full text-[11px] sm:text-xs font-semibold bg-white/10 backdrop-blur-md border border-white/20 text-brand-300 shadow-soft animate-fade-in">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>{{ __('messages.hero_badge') }}</span>
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-7xl font-black text-white tracking-tight leading-[1.2] sm:leading-[1.14] animate-slide-up drop-shadow-xl">
                {{ __('messages.hero_title') }}
            </h1>

            <!-- Subtitle -->
            <p class="text-sm sm:text-lg lg:text-xl text-surface-200/90 leading-relaxed font-normal max-w-3xl mx-auto animate-slide-up px-2 sm:px-0">
                {{ __('messages.hero_subtitle') }}
            </p>

            <!-- Mobile-Friendly Quick Role / Sector Pills Bar -->
            <div class="pt-2 animate-slide-up">
                <span class="block text-[11px] uppercase tracking-wider text-surface-400 font-bold mb-2.5">
                    {{ app()->getLocale() === 'ar' ? 'اختر قطاع منشأتك للاستكشاف السريع:' : 'Select your sector for instant solutions:' }}
                </span>
                <div class="flex items-center justify-start sm:justify-center gap-2 overflow-x-auto no-scrollbar py-1 px-1 -mx-4 sm:mx-0 px-4 sm:px-0">
                    <a href="#roles-explorer-section" class="flex-shrink-0 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/15 backdrop-blur-md transition-all active:scale-95 flex items-center gap-1.5">
                        <span>🏢</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'أبراج وشركات' : 'Corporate Towers' }}</span>
                    </a>
                    <a href="#roles-explorer-section" class="flex-shrink-0 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/15 backdrop-blur-md transition-all active:scale-95 flex items-center gap-1.5">
                        <span>🏨</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'فنادق وضيافة' : 'Hospitality' }}</span>
                    </a>
                    <a href="#roles-explorer-section" class="flex-shrink-0 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/15 backdrop-blur-md transition-all active:scale-95 flex items-center gap-1.5">
                        <span>🏰</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Luxury Villas' }}</span>
                    </a>
                    <a href="#roles-explorer-section" class="flex-shrink-0 px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/15 backdrop-blur-md transition-all active:scale-95 flex items-center gap-1.5">
                        <span>🏭</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مستودعات وصناعي' : 'Industrial' }}</span>
                    </a>
                </div>
            </div>

            <!-- Dual Call to Action Buttons -->
            <div class="pt-3 flex flex-col sm:flex-row items-center justify-center gap-3.5 sm:gap-4 animate-slide-up w-full">
                <a href="{{ route('quote.create') }}" 
                   class="w-full sm:w-auto btn-primary text-sm sm:text-base px-8 sm:px-10 py-3.5 sm:py-4 rounded-2xl group shadow-brand-glow hover:scale-[1.02] active:scale-[0.98] transition-all justify-center">
                    <span>{{ __('messages.hero_cta_quote') }}</span>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <a href="#instant-calculator" 
                   class="w-full sm:w-auto text-sm sm:text-base px-8 sm:px-10 py-3.5 sm:py-4 rounded-2xl text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md hover:border-white/40 transition-all font-semibold shadow-soft hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حاسبة تقدير الأنظمة' : 'Instant System Scope' }}</span>
                </a>
            </div>

            <!-- Trust KPI Metric Counters (2x2 on Mobile, 4x1 on Desktop) -->
            <div class="pt-6 sm:pt-10 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-5 animate-slide-up text-start">
                <div class="bg-surface-900/70 backdrop-blur-xl border border-white/10 hover:border-brand-500/40 rounded-2xl p-4 sm:p-6 shadow-xl transition-all duration-300 group">
                    <span class="text-2xl sm:text-4xl font-black text-white font-outfit block mb-0.5 group-hover:text-brand-300 transition-colors">150+</span>
                    <span class="text-[11px] sm:text-sm text-surface-300 font-medium">{{ __('messages.stat_projects') }}</span>
                </div>
                <div class="bg-surface-900/70 backdrop-blur-xl border border-white/10 hover:border-brand-500/40 rounded-2xl p-4 sm:p-6 shadow-xl transition-all duration-300 group">
                    <span class="text-2xl sm:text-4xl font-black text-brand-400 font-outfit block mb-0.5 group-hover:text-brand-300 transition-colors">99.4%</span>
                    <span class="text-[11px] sm:text-sm text-surface-300 font-medium">{{ __('messages.stat_satisfaction') }}</span>
                </div>
                <div class="bg-surface-900/70 backdrop-blur-xl border border-white/10 hover:border-brand-500/40 rounded-2xl p-4 sm:p-6 shadow-xl transition-all duration-300 group">
                    <span class="text-2xl sm:text-4xl font-black text-white font-outfit block mb-0.5 group-hover:text-brand-300 transition-colors">24/7</span>
                    <span class="text-[11px] sm:text-sm text-surface-300 font-medium">{{ __('messages.stat_support') }}</span>
                </div>
                <div class="bg-surface-900/70 backdrop-blur-xl border border-white/10 hover:border-brand-500/40 rounded-2xl p-4 sm:p-6 shadow-xl transition-all duration-300 group">
                    <span class="text-2xl sm:text-4xl font-black text-emerald-400 font-outfit block mb-0.5 group-hover:text-emerald-300 transition-colors">100%</span>
                    <span class="text-[11px] sm:text-sm text-surface-300 font-medium">{{ __('messages.stat_compliance') }}</span>
                </div>
            </div>

            <!-- Signature Security Pillars Quick Access (From Reference Visual) -->
            <div class="pt-6 sm:pt-8 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 animate-slide-up text-start">
                <a href="{{ route('services.index') }}#cctv" class="group p-3.5 sm:p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.09] border border-white/10 hover:border-brand-400/50 backdrop-blur-md transition-all duration-300 flex items-center gap-3 shadow-soft hover:shadow-brand-glow/20 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/20 text-brand-300 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors">{{ app()->getLocale() === 'ar' ? 'أنظمة المراقبة' : 'Surveillance Systems' }}</span>
                        <span class="block text-[10px] text-surface-400 font-mono">CCTV & AI Video</span>
                    </div>
                </a>

                <a href="{{ route('services.index') }}#fire" class="group p-3.5 sm:p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.09] border border-white/10 hover:border-brand-400/50 backdrop-blur-md transition-all duration-300 flex items-center gap-3 shadow-soft hover:shadow-brand-glow/20 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-300 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-rose-500 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors">{{ app()->getLocale() === 'ar' ? 'أنظمة إنذار الحريق' : 'Fire Alarm Systems' }}</span>
                        <span class="block text-[10px] text-surface-400 font-mono">Civil Defense Certified</span>
                    </div>
                </a>

                <a href="{{ route('services.index') }}#access" class="group p-3.5 sm:p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.09] border border-white/10 hover:border-brand-400/50 backdrop-blur-md transition-all duration-300 flex items-center gap-3 shadow-soft hover:shadow-brand-glow/20 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-300 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors">{{ app()->getLocale() === 'ar' ? 'أنظمة مكافحة التسلل' : 'Access & Intrusion' }}</span>
                        <span class="block text-[10px] text-surface-400 font-mono">Biometric & Gates</span>
                    </div>
                </a>

                <a href="{{ route('services.index') }}#network" class="group p-3.5 sm:p-4 rounded-2xl bg-white/[0.04] hover:bg-white/[0.09] border border-white/10 hover:border-brand-400/50 backdrop-blur-md transition-all duration-300 flex items-center gap-3 shadow-soft hover:shadow-brand-glow/20 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-300 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <span class="block text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors">{{ app()->getLocale() === 'ar' ? 'الشبكات والبنية التحتية' : 'IT & Infrastructure' }}</span>
                        <span class="block text-[10px] text-surface-400 font-mono">Fiber & Data Center</span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ================= ANIMATED INTERACTIVE SHOWCASE (عرض حي تفاعلي: رمادي ورصاصي مع كتابة وصور متحركة) ================= -->
<x-animated-showcase />

<!-- ================= INTERACTIVE ROLES & DOMAINS EXPLORER ("الأدوار والحقول الذكية") ================= -->
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5" id="roles-explorer-section" x-data="{
    activeRole: 'commercial',
    roles: {
        commercial: {
            title_ar: 'قطاع الأبراج والشركات والمؤسسات الكبرى',
            title_en: 'Commercial Towers & Corporate Facilities',
            badge_ar: 'بوابات ذكية ومراقبة مركزية',
            badge_en: 'Speed Gates & Central CCTV',
            icon: '🏢',
            desc_ar: 'منظومة حماية وتحكم هندسي شامل للأبراج الإدارية ومقار الشركات تشمل بوابات مرور سريعة (Speed Gates)، كاميرات ذكية بالذكاء الاصطناعي مع التعرف على الوجوه، وربط المصاعد بأنظمة الصلاحيات.',
            desc_en: 'Enterprise-grade speed gates, AI facial recognition CCTV, and destination-dispatch elevator control for high-rise corporate towers.',
            systems_ar: ['بوابات بصرية ذكية Speed Gates', 'كاميرات AI لرصد وتحليل الحركة', 'ربط مصاعد ذكي بنظام الصلاحيات', 'غرفة عمليات ومراقبة موحدة'],
            systems_en: ['Optical Speed Gates', 'AI Analytics CCTV', 'Elevator Access Dispatch', 'Unified Command Center'],
            compliance_ar: 'معتمد من الدفاع المدني والهيئة العليا للأمن الصناعي',
            compliance_en: 'Civil Defense & HCIS Compliant'
        },
        hospitality: {
            title_ar: 'قطاع الفنادق والمنتجعات والضيافة',
            title_en: 'Hotels, Resorts & Luxury Hospitality',
            badge_ar: 'أنظمة GRMS وأقفال ذكية',
            badge_en: 'GRMS & RFID Mobile Access',
            icon: '🏨',
            desc_ar: 'حلول متطورة لقطاع الفنادق ترفع مستوى رفاهية النزيل وتخفض فاتورة الطاقة بنسبة تصل إلى 35% عبر أنظمة إدارة غرف النزلاء (GRMS)، والأقفال الإلكترونية الفندقية المدمجة مع أنظمة PMS.',
            desc_en: 'Guest Room Management Systems (GRMS) delivering luxury convenience, automated climate/energy setbacks, and RFID/BLE mobile key locks.',
            systems_ar: ['أتمتة غرف النزلاء GRMS الشاملة', 'أقفال فندقية RFID وبلوتوث للهاتف', 'توفير طاقة التكييف والإضاءة 35%', 'أنظمة صوتية وإذاعة داخلية IP'],
            systems_en: ['Comprehensive Hotel GRMS', 'RFID/BLE Mobile Door Locks', 'Energy Savings Automation (35%)', 'IP Audio & PA Sound Systems'],
            compliance_ar: 'متوافق مع معايير هيئة السياحة والفنادق العالمية',
            compliance_en: 'Compliant with Tourism Ministry & Hotel Standards'
        },
        residential: {
            title_ar: 'القصور والفلل السكنية الفاخرة',
            title_en: 'Villas & Private Smart Mansions',
            badge_ar: 'أتمتة KNX وحماية المحيط',
            badge_en: 'KNX Automation & Perimeter Shield',
            icon: '🏰',
            desc_ar: 'أتمتة فائقة وفق معيار KNX العالمي للتحكم الكامل بالإضاءة، التكييف، الستائر، والسينما المنزلية عبر الصوت والهاتف، مع شبكة حماية أمنية للمحيط والأسوار الخارجية ضد أي تسلل.',
            desc_en: 'Premier KNX smart home ecosystem unifying architectural lighting, VRF HVAC, acoustic cinema, and perimeter radar intrusion defense.',
            systems_ar: ['أتمتة إضاءة وتكييف بمعيار KNX', 'حماية محيط وسور بالرادار والليزر', 'تحكم صوتي وشاشات لمس جدارية', 'سينما منزلية وصوتيات احترافية'],
            systems_en: ['KNX European Standard Automation', 'Perimeter Radar & Laser Security', 'Voice & Wall Touchscreen Control', 'Dedicated Cinema & Multiroom Audio'],
            compliance_ar: 'أعلى معايير الخصوصية والأمان مع سيرفر محلي مشفر',
            compliance_en: 'Highest Privacy Standards with Encrypted Local Server'
        },
        industrial: {
            title_ar: 'المصانع والمستودعات والمجمعات اللوجستية',
            title_en: 'Industrial Plants & Logistics Parks',
            badge_ar: 'كشف حريق شعاعي وبوابات ANPR',
            badge_en: 'Beam Fire Detection & ANPR Gates',
            icon: '🏭',
            desc_ar: 'أنظمة أمن وسلامة معتمدة للبيئات الصعبة؛ كواشف حريق شعاعية وحرارية للأسقف العالية معتمدة من الدفاع المدني، وبوابات دخول شاحنات ذكية بقراءة لوحات السيارات (LPR/ANPR).',
            desc_en: 'Industrial-grade optical beam detectors for high-bay ceilings certified by Civil Defense, coupled with automated ANPR truck barrier gates.',
            systems_ar: ['كواشف حريق شعاعية Optical Beam', 'بوابات ذكية لقراءة لوحات الشاحنات', 'شبكات صناعية وكبائن Data Racks', 'كاميرات حرارية لمراقبة الحرارة والمكائن'],
            systems_en: ['Optical Beam Smoke Detection', 'ANPR Vehicle Barrier Access', 'Ruggedized Industrial Data Racks', 'Thermal Cameras for Overheat Safety'],
            compliance_ar: 'معتمد رسمياً لمخططات الدفاع المدني والتراخيص البلدية',
            compliance_en: 'Full Civil Defense & Municipal Licensing Compliance'
        },
        healthcare: {
            title_ar: 'المستشفيات والمراكز الطبية والمختبرات',
            title_en: 'Hospitals, Clinics & Medical Hubs',
            badge_ar: 'استدعاء ممرضات وتحكم بالدخول',
            badge_en: 'Nurse Call & Biometric Access',
            icon: '🏥',
            desc_ar: 'حلول متخصصة للقطاع الطبي تشمل أنظمة استدعاء الممرضات الرقمية (IP Nurse Call)، التحكم في دخول غرف العمليات والعناية المركزة بالبصمة البيومترية، وحماية غرف الأدوية الحساسة.',
            desc_en: 'Digital IP Nurse Call systems, sterile operating room biometric access control, and specialized cleanroom monitoring for healthcare excellence.',
            systems_ar: ['نظام استدعاء ممرضات رقمي IP Nurse Call', 'بوابات غرف عمليات بدون لمس Touchless', 'مراقبة حرارة ورطوبة ثلاجات الأدوية', 'نظام نداء عام وإخلاء صوتي طبي'],
            systems_en: ['IP Digital Nurse Call Station', 'Touchless Sterile OR Doors', 'Medicine Cold-Chain Monitoring', 'Public Address & Emergency Evac'],
            compliance_ar: 'معتمد وفق معايير CBAHI ووزارة الصحة والدفاع المدني',
            compliance_en: 'CBAHI, Ministry of Health & Safety Approved'
        }
    }
}">
    <!-- Background Tech Glows -->
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 end-1/4 w-96 h-96 bg-accent-sky/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Heading -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-14 reveal-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-brand-glow/20 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'الأدوار والقطاعات التخصصية' : 'Sector Solutions & Roles' }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                {{ app()->getLocale() === 'ar' ? 'حلول هندسية مصممة خصيصاً لكل قطاع' : 'Engineered Systems Tailored for Every Sector' }}
            </h2>
            <p class="text-xs sm:text-base text-surface-400 mt-2.5 max-w-2xl mx-auto">
                {{ app()->getLocale() === 'ar' ? 'المس القطاع الذي يمثل منشأتك لتتعرف فوراً على حزمة الأنظمة المعتمدة والمعايير الهندسية الخاصة به' : 'Tap your facility sector to explore dedicated systems, compliance standards, and deployed technologies' }}
            </p>
        </div>

        <!-- Role Touch Selector Tabs (Swipeable on Mobile) -->
        <div class="flex items-center justify-start lg:justify-center gap-2 sm:gap-3 overflow-x-auto no-scrollbar pb-3 mb-6 sm:mb-8 -mx-4 sm:mx-0 px-4 sm:px-0 reveal-up" data-reveal-delay="100">
            <button type="button" @click="activeRole = 'commercial'" 
                    :class="activeRole === 'commercial' ? 'bg-brand-600 text-white shadow-brand-glow scale-[1.02] border-brand-400' : 'bg-surface-900/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white backdrop-blur-md'"
                    class="flex-shrink-0 px-4 sm:px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all duration-200 active:scale-95 shadow-xs">
                <span class="text-base sm:text-lg">🏢</span>
                <span>{{ app()->getLocale() === 'ar' ? 'أبراج وشركات' : 'Commercial' }}</span>
            </button>

            <button type="button" @click="activeRole = 'hospitality'" 
                    :class="activeRole === 'hospitality' ? 'bg-brand-600 text-white shadow-brand-glow scale-[1.02] border-brand-400' : 'bg-surface-900/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white backdrop-blur-md'"
                    class="flex-shrink-0 px-4 sm:px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all duration-200 active:scale-95 shadow-xs">
                <span class="text-base sm:text-lg">🏨</span>
                <span>{{ app()->getLocale() === 'ar' ? 'فنادق وضيافة' : 'Hospitality' }}</span>
            </button>

            <button type="button" @click="activeRole = 'residential'" 
                    :class="activeRole === 'residential' ? 'bg-brand-600 text-white shadow-brand-glow scale-[1.02] border-brand-400' : 'bg-surface-900/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white backdrop-blur-md'"
                    class="flex-shrink-0 px-4 sm:px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all duration-200 active:scale-95 shadow-xs">
                <span class="text-base sm:text-lg">🏰</span>
                <span>{{ app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Luxury Villas' }}</span>
            </button>

            <button type="button" @click="activeRole = 'industrial'" 
                    :class="activeRole === 'industrial' ? 'bg-brand-600 text-white shadow-brand-glow scale-[1.02] border-brand-400' : 'bg-surface-900/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white backdrop-blur-md'"
                    class="flex-shrink-0 px-4 sm:px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all duration-200 active:scale-95 shadow-xs">
                <span class="text-base sm:text-lg">🏭</span>
                <span>{{ app()->getLocale() === 'ar' ? 'صناعي ولوجستي' : 'Industrial' }}</span>
            </button>

            <button type="button" @click="activeRole = 'healthcare'" 
                    :class="activeRole === 'healthcare' ? 'bg-brand-600 text-white shadow-brand-glow scale-[1.02] border-brand-400' : 'bg-surface-900/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white backdrop-blur-md'"
                    class="flex-shrink-0 px-4 sm:px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold flex items-center gap-2 transition-all duration-200 active:scale-95 shadow-xs">
                <span class="text-base sm:text-lg">🏥</span>
                <span>{{ app()->getLocale() === 'ar' ? 'صحي ومستشفيات' : 'Healthcare' }}</span>
            </button>
        </div>

        <!-- Dynamic Role Content Card -->
        <div class="rounded-3xl p-6 sm:p-10 border border-brand-500/20 shadow-2xl bg-surface-900/70 backdrop-blur-xl relative overflow-hidden transition-all duration-300 reveal-scale">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Role Details Column -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-brand-500/20 text-brand-300 border border-brand-500/30"
                              x-text="{{ app()->getLocale() === 'ar' ? 'roles[activeRole].badge_ar' : 'roles[activeRole].badge_en' }}"></span>
                        <span class="text-xs font-semibold text-emerald-300 bg-emerald-500/15 px-3 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span x-text="{{ app()->getLocale() === 'ar' ? 'roles[activeRole].compliance_ar' : 'roles[activeRole].compliance_en' }}"></span>
                        </span>
                    </div>

                    <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight"
                        x-text="{{ app()->getLocale() === 'ar' ? 'roles[activeRole].title_ar' : 'roles[activeRole].title_en' }}"></h3>

                    <p class="text-sm sm:text-base text-surface-300 leading-relaxed"
                       x-text="{{ app()->getLocale() === 'ar' ? 'roles[activeRole].desc_ar' : 'roles[activeRole].desc_en' }}"></p>

                    <!-- Systems checklist -->
                    <div class="space-y-2.5 pt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-surface-400 block">
                            {{ app()->getLocale() === 'ar' ? 'أبرز الأنظمة والتجهيزات المضمنة في هذا القطاع:' : 'Key Included Deployed Systems:' }}
                        </span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <template x-for="(system, index) in ({{ app()->getLocale() === 'ar' ? 'roles[activeRole].systems_ar' : 'roles[activeRole].systems_en' }})" :key="index">
                                <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-white bg-surface-950/70 p-3 rounded-xl border border-white/10 hover:border-brand-500/40 transition-colors">
                                    <div class="w-5 h-5 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span x-text="system"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center gap-3">
                        <a :href="'{{ route('quote.create') }}?sector=' + activeRole" 
                           class="w-full sm:w-auto btn-primary text-xs sm:text-sm py-3 px-6 rounded-xl shadow-brand-glow justify-center">
                            <span>{{ app()->getLocale() === 'ar' ? 'طلب دراسة وتصميم لهذا القطاع' : 'Request Sector Engineering Study' }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('sectors') }}" class="w-full sm:w-auto btn-secondary text-white border-white/20 bg-white/5 hover:bg-white/10 hover:border-brand-400/50 text-xs sm:text-sm py-3 px-6 rounded-xl justify-center inline-flex items-center gap-2 group">
                            <span>{{ app()->getLocale() === 'ar' ? 'استعراض كافة قطاعات الأعمال والحلول' : 'Explore All Sectors & Solutions' }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Visual Tech HUD Badge Column -->
                <div class="lg:col-span-5 bg-gradient-to-br from-surface-950 via-brand-950 to-surface-950 p-6 sm:p-8 rounded-3xl text-white relative overflow-hidden shadow-2xl border border-brand-500/30">
                    <div class="absolute -top-12 -end-12 w-48 h-48 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl" x-text="roles[activeRole].icon"></span>
                                <div>
                                    <span class="text-[10px] tracking-widest uppercase font-mono text-brand-400 block font-bold">STS SYSTEM ARCHITECTURE</span>
                                    <span class="text-sm font-bold text-white" x-text="roles[activeRole].title_ar"></span>
                                </div>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                        <!-- Technical Highlights -->
                        <div class="space-y-3 text-xs">
                            <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/10">
                                <span class="text-surface-300">{{ app()->getLocale() === 'ar' ? 'معيار المطابقة:' : 'Compliance Standard:' }}</span>
                                <span class="font-bold text-emerald-400">Saudi Building Code (SBC)</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/10">
                                <span class="text-surface-300">{{ app()->getLocale() === 'ar' ? 'فترة الضمان الهندسي:' : 'Engineering Warranty:' }}</span>
                                <span class="font-bold text-white">{{ app()->getLocale() === 'ar' ? 'سنتان شاملة قطع الغيار والصيانة' : '2 Years Full Parts & Labor' }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/10">
                                <span class="text-surface-300">{{ app()->getLocale() === 'ar' ? 'زمن الاستجابة للطوارئ:' : 'Emergency SLA Response:' }}</span>
                                <span class="font-bold text-brand-300">{{ app()->getLocale() === 'ar' ? 'خلال 4 ساعات على مدار الساعة' : 'Under 4 Hours 24/7' }}</span>
                            </div>
                        </div>

                        <div class="pt-2 text-center border-t border-white/10">
                            <span class="text-[11px] text-surface-400 font-medium">
                                {{ app()->getLocale() === 'ar' ? 'مخططات تنفيذية واعتماد مهني معتمد لكافة الجهات' : 'Certified As-Built Drawings & Municipal Clearances' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- ================= SERVICES ECOSYSTEM (INFINITE ROTATING CAROUSEL - دوّارة غير منتهية) ================= -->
<section class="py-20 sm:py-28 relative overflow-hidden bg-surface-950 text-white" 
         id="services-carousel-section"
         x-data="{ 
             isPaused: false, 
             isReverse: false,
             pauseOnMobile() {
                 this.isPaused = true;
                 clearTimeout(this._timeout);
                 this._timeout = setTimeout(() => { this.isPaused = false; }, 3500);
             }
         }">
    
    <!-- 1. Deep Tech Gradients (STS Identity: Obsidian, Navy #072849, Midnight #0a3f6e, Electric Blue #0c8de7) -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#020617] via-[#051c36] to-[#020617] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-15%,rgba(12,141,231,0.28),transparent)] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_115%,rgba(14,165,233,0.22),transparent)] pointer-events-none"></div>

    <!-- 2. Ambient Soft Blue Lighting Points (Depth & Elegance) -->
    <div class="absolute top-1/4 start-1/6 w-80 sm:w-[480px] h-80 sm:h-[480px] bg-brand-500/15 rounded-full blur-[110px] sm:blur-[140px] pointer-events-none animate-float"></div>
    <div class="absolute bottom-1/4 end-1/6 w-72 sm:w-[440px] h-72 sm:h-[440px] bg-accent-sky/15 rounded-full blur-[100px] sm:blur-[130px] pointer-events-none animate-float-delay"></div>
    <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-96 sm:w-[600px] h-72 bg-brand-600/10 rounded-full blur-[150px] pointer-events-none"></div>

    <!-- 3. Connected Telecom Network & Circuit Traces (Vector SVG Pattern) -->
    <svg class="absolute inset-0 w-full h-full pointer-events-none select-none opacity-35" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="sts-services-circuit" width="180" height="180" patternUnits="userSpaceOnUse">
                <!-- Circuit & Cable Traces -->
                <path d="M0 45 h55 l20 20 h50 l15 -15 h40" fill="none" stroke="#36a7f6" stroke-width="1.2" stroke-opacity="0.35" />
                <path d="M45 180 v-45 l20 -20 v-35" fill="none" stroke="#0c8de7" stroke-width="1.2" stroke-opacity="0.3" />
                <path d="M180 135 h-50 l-25 25 h-35" fill="none" stroke="#0070c5" stroke-width="1.2" stroke-opacity="0.35" />
                <path d="M135 0 v40 l-15 15 v55 l20 20 v50" fill="none" stroke="#38bdf8" stroke-width="1" stroke-opacity="0.25" stroke-dasharray="3 3" />
                <path d="M0 135 l45 -45 h40 l25 25" fill="none" stroke="#0ea5e9" stroke-width="1" stroke-opacity="0.25" />
                
                <!-- Connection Nodes & Smart Terminals -->
                <circle cx="55" cy="45" r="3" fill="#0c8de7" fill-opacity="0.7" />
                <circle cx="125" cy="65" r="2.5" fill="#7cc5fb" fill-opacity="0.8" />
                <circle cx="45" cy="135" r="3" fill="#0ea5e9" fill-opacity="0.6" />
                <circle cx="130" cy="160" r="2" fill="#36a7f6" fill-opacity="0.7" />
                <circle cx="85" cy="90" r="2" fill="#38bdf8" fill-opacity="0.5" />
                <rect x="122" y="62" width="6" height="6" rx="1.5" fill="#0059a0" stroke="#36a7f6" stroke-width="0.8" stroke-opacity="0.6" />
            </pattern>
            <linearGradient id="sts-services-mask-vert" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#fff" stop-opacity="0.15" />
                <stop offset="20%" stop-color="#fff" stop-opacity="1" />
                <stop offset="80%" stop-color="#fff" stop-opacity="1" />
                <stop offset="100%" stop-color="#fff" stop-opacity="0.15" />
            </linearGradient>
            <mask id="sts-services-circuit-fade">
                <rect width="100%" height="100%" fill="url(#sts-services-mask-vert)" />
            </mask>
        </defs>
        <rect width="100%" height="100%" fill="url(#sts-services-circuit)" mask="url(#sts-services-circuit-fade)" />
    </svg>

    <!-- 4. Translucent Geometric Shapes (Surveillance HUD & Cybersecurity Radar) -->
    <div class="pointer-events-none absolute inset-0 select-none overflow-hidden">
        <!-- Top-End: Surveillance Camera Viewfinder Bracket -->
        <div class="absolute top-8 end-6 sm:end-14 text-brand-400/25 font-mono text-[10px] hidden sm:block">
            <svg class="w-24 sm:w-28 h-24 sm:h-28" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                <path d="M10 32 V10 H32" stroke-width="1.5" />
                <path d="M68 10 H90 V32" stroke-width="1.5" />
                <path d="M90 68 V90 H68" stroke-width="1.5" />
                <path d="M32 90 H10 V68" stroke-width="1.5" />
                <circle cx="50" cy="50" r="16" stroke-width="1" stroke-dasharray="3 3" />
                <path d="M50 38 V44 M50 56 V62 M38 50 H44 M56 50 H62" stroke-width="1.5" />
            </svg>
            <div class="text-[9px] tracking-wider text-brand-300/40 mt-1 uppercase text-end font-mono">STS // SMART-SERVICES // 4K</div>
        </div>

        <!-- Bottom-Start: Radar & Cybersecurity Sensor Grid -->
        <div class="absolute bottom-8 start-6 sm:start-14 text-accent-sky/20 hidden sm:block">
            <svg class="w-28 sm:w-32 h-28 sm:h-32" viewBox="0 0 120 120" fill="none" stroke="currentColor">
                <circle cx="60" cy="60" r="50" stroke-width="1" stroke-dasharray="4 6" />
                <circle cx="60" cy="60" r="32" stroke-width="1" />
                <circle cx="60" cy="60" r="14" stroke-width="1" stroke-dasharray="2 2" />
                <path d="M60 5 V115 M5 60 H115" stroke-width="0.8" stroke-opacity="0.3" />
                <path d="M60 60 L95 25" stroke-width="1.2" stroke="#38bdf8" stroke-opacity="0.6" />
            </svg>
            <div class="text-[9px] font-mono tracking-widest text-accent-sky/40 -mt-2 uppercase">HCIS // CERTIFIED ECOSYSTEM</div>
        </div>

        <!-- Center Hexagonal Cybersecurity Shield Grid -->
        <div class="absolute top-1/2 -translate-y-1/2 start-4 opacity-15 hidden xl:block">
            <svg class="w-48 h-48 text-brand-400" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1">
                <polygon points="50,5 90,27 90,73 50,95 10,73 10,27" />
                <polygon points="50,15 80,32 80,68 50,85 20,68 20,32" stroke-dasharray="3 3" />
            </svg>
        </div>
    </div>

    <!-- 5. Seamless Transitions with Adjacent Sections (Glowing Borders & Edge Vignettes) -->
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent z-20"></div>
    <div class="absolute top-0 inset-x-0 h-10 bg-gradient-to-b from-[#020617] to-transparent pointer-events-none z-10"></div>
    
    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent z-20"></div>
    <div class="absolute bottom-0 inset-x-0 h-10 bg-gradient-to-t from-[#020617] to-transparent pointer-events-none z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mb-6 sm:mb-10">
        <x-section-heading 
            :badge="__('messages.services_badge')"
            :title="__('messages.services_title')"
            :subtitle="__('messages.services_subtitle')"
            :dark="true"
        />

        <!-- Interactive Infinite Carousel Control Bar (Sleek Dark Glassmorphism) -->
        <div class="mt-6 flex flex-wrap items-center justify-between gap-3 bg-surface-900/80 border border-white/10 backdrop-blur-xl rounded-2xl px-4 py-3 shadow-xl">
            <!-- Status Badge & Helper Text -->
            <div class="flex items-center gap-2 sm:gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-all"
                      :class="isPaused ? 'bg-amber-500/15 text-amber-300 border border-amber-500/30' : 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30'">
                    <span class="w-2 h-2 rounded-full transition-colors"
                          :class="isPaused ? 'bg-amber-400' : 'bg-emerald-400 animate-ping'"></span>
                    <span x-text="isPaused 
                        ? '{{ app()->getLocale() === 'ar' ? 'متوقفة مؤقتاً للتصفح' : 'Paused for Browsing' }}' 
                        : '{{ app()->getLocale() === 'ar' ? 'دوّارة تلقائية مستمرة' : 'Infinite Auto-Rotation' }}'">
                    </span>
                </span>
                
                <span class="hidden md:inline-flex items-center gap-1.5 text-xs text-surface-300 font-medium">
                    <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'مرر الماوس فوق أي بطاقة لإيقاف الحركة وتصفح التفاصيل' : 'Hover over any card to pause and view details' }}</span>
                </span>
            </div>

            <!-- Controls: Play/Pause, Reverse Direction, and Catalog Link -->
            <div class="flex items-center gap-2 ms-auto">
                <!-- Play / Pause Toggle Button -->
                <button type="button" 
                        @click="isPaused = !isPaused"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 text-white shadow-xs transition-all active:scale-95"
                        :title="isPaused ? '{{ app()->getLocale() === 'ar' ? 'تشغيل الدوّارة' : 'Resume Carousel' }}' : '{{ app()->getLocale() === 'ar' ? 'إيقاف الدوّارة مؤقتاً' : 'Pause Carousel' }}'">
                    <template x-if="!isPaused">
                        <span class="flex items-center gap-1 text-surface-200">
                            <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'إيقاف مؤقت' : 'Pause' }}</span>
                        </span>
                    </template>
                    <template x-if="isPaused">
                        <span class="flex items-center gap-1 text-surface-200">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'تشغيل' : 'Play' }}</span>
                        </span>
                    </template>
                </button>

                <!-- Direction Reverse Toggle Button -->
                <button type="button" 
                        @click="isReverse = !isReverse"
                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 text-white shadow-xs transition-all active:scale-95"
                        title="{{ app()->getLocale() === 'ar' ? 'عكس اتجاه الدوران' : 'Reverse Direction' }}">
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': isReverse }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span class="hidden sm:inline">{{ app()->getLocale() === 'ar' ? 'عكس الاتجاه' : 'Reverse' }}</span>
                </button>

                <!-- Quick Services Count Badge -->
                <a href="{{ route('services.index') }}" 
                   class="inline-flex items-center gap-1 text-xs font-bold text-brand-300 hover:text-white px-3 py-1.5 rounded-xl bg-brand-500/20 hover:bg-brand-500/30 border border-brand-400/30 transition-colors">
                    <span>{{ app()->getLocale() === 'ar' ? 'عرض الفهرس' : 'View Catalog' }}</span>
                    <span class="font-mono text-[11px] bg-brand-400/30 text-white px-1.5 py-0.5 rounded-md">{{ $services->count() }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Infinite Carousel Track Container with Deep Edge Fades -->
    <div class="relative w-full overflow-hidden marquee-fade-edges py-4 sm:py-6"
         @touchstart="pauseOnMobile()"
         @touchend="pauseOnMobile()">
        
        <!-- Left & Right Gradient Soft Edge Overlays (Deep Dark Tech Edge Fades) -->
        <div class="pointer-events-none absolute inset-y-0 start-0 w-16 sm:w-32 bg-gradient-to-r rtl:bg-gradient-to-l from-[#020617] via-[#020617]/90 to-transparent z-20"></div>
        <div class="pointer-events-none absolute inset-y-0 end-0 w-16 sm:w-32 bg-gradient-to-l rtl:bg-gradient-to-r from-[#020617] via-[#020617]/90 to-transparent z-20"></div>

        <!-- The Animated Infinite Track -->
        <div class="infinite-marquee-track items-stretch"
             :class="{ 'is-paused': isPaused, 'track-reverse': isReverse }">
            
            <!-- Set 1 (Original items) -->
            <div class="flex gap-5 sm:gap-7 items-stretch flex-shrink-0 pe-5 sm:pe-7">
                @foreach($services as $service)
                    <div class="w-[290px] sm:w-[350px] md:w-[380px] flex-shrink-0 flex flex-col drop-shadow-2xl">
                        <x-service-card :service="$service" />
                    </div>
                @endforeach
            </div>

            <!-- Set 2 (Identical duplicate for seamless continuous infinite rotation) -->
            <div class="flex gap-5 sm:gap-7 items-stretch flex-shrink-0 pe-5 sm:pe-7" aria-hidden="true">
                @foreach($services as $service)
                    <div class="w-[290px] sm:w-[350px] md:w-[380px] flex-shrink-0 flex flex-col drop-shadow-2xl">
                        <x-service-card :service="$service" />
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Bottom Action CTAs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-8 sm:mt-12 text-center">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('services.index') }}" class="px-8 py-3.5 rounded-xl group inline-flex items-center gap-2 text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md transition-all duration-300 font-semibold shadow-soft hover:scale-[1.02]">
                <span>{{ __('messages.view_all_services') }}</span>
                <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>

            <a href="{{ route('quote.create') }}" class="btn-primary px-8 py-3.5 rounded-xl group inline-flex items-center gap-2">
                <span>{{ __('messages.hero_cta_quote') }}</span>
                <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ================= FEATURED TURNKEY PACKAGES & OFFERS ================= -->
@if(isset($featuredOffers) && $featuredOffers->isNotEmpty())
<section class="py-20 sm:py-28 relative overflow-hidden bg-surface-950 text-white" id="home-offers-section">
    
    <!-- 1. Layered Deep Tech Gradients (STS Identity: Obsidian, Navy #072849, Midnight #0a3f6e, Electric Blue #0c8de7) -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#020617] via-[#051c36] to-[#020617] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_-15%,rgba(12,141,231,0.28),transparent)] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_115%,rgba(14,165,233,0.22),transparent)] pointer-events-none"></div>

    <!-- 2. Ambient Soft Blue Lighting Points (Depth & Elegance) -->
    <div class="absolute top-1/4 start-1/6 w-80 sm:w-[480px] h-80 sm:h-[480px] bg-brand-500/15 rounded-full blur-[110px] sm:blur-[140px] pointer-events-none animate-float"></div>
    <div class="absolute bottom-1/4 end-1/6 w-72 sm:w-[440px] h-72 sm:h-[440px] bg-accent-sky/15 rounded-full blur-[100px] sm:blur-[130px] pointer-events-none animate-float-delay"></div>
    <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-96 sm:w-[600px] h-72 bg-brand-600/10 rounded-full blur-[150px] pointer-events-none"></div>

    <!-- 3. Connected Telecom Network & Circuit Traces (Vector SVG Pattern) -->
    <svg class="absolute inset-0 w-full h-full pointer-events-none select-none opacity-35" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="sts-circuit-network" width="180" height="180" patternUnits="userSpaceOnUse">
                <!-- Circuit & Cable Traces -->
                <path d="M0 45 h55 l20 20 h50 l15 -15 h40" fill="none" stroke="#36a7f6" stroke-width="1.2" stroke-opacity="0.35" />
                <path d="M45 180 v-45 l20 -20 v-35" fill="none" stroke="#0c8de7" stroke-width="1.2" stroke-opacity="0.3" />
                <path d="M180 135 h-50 l-25 25 h-35" fill="none" stroke="#0070c5" stroke-width="1.2" stroke-opacity="0.35" />
                <path d="M135 0 v40 l-15 15 v55 l20 20 v50" fill="none" stroke="#38bdf8" stroke-width="1" stroke-opacity="0.25" stroke-dasharray="3 3" />
                <path d="M0 135 l45 -45 h40 l25 25" fill="none" stroke="#0ea5e9" stroke-width="1" stroke-opacity="0.25" />
                
                <!-- Connection Nodes & Smart Terminals -->
                <circle cx="55" cy="45" r="3" fill="#0c8de7" fill-opacity="0.7" />
                <circle cx="125" cy="65" r="2.5" fill="#7cc5fb" fill-opacity="0.8" />
                <circle cx="45" cy="135" r="3" fill="#0ea5e9" fill-opacity="0.6" />
                <circle cx="130" cy="160" r="2" fill="#36a7f6" fill-opacity="0.7" />
                <circle cx="85" cy="90" r="2" fill="#38bdf8" fill-opacity="0.5" />
                <rect x="122" y="62" width="6" height="6" rx="1.5" fill="#0059a0" stroke="#36a7f6" stroke-width="0.8" stroke-opacity="0.6" />
            </pattern>
            <linearGradient id="sts-mask-vertical" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#fff" stop-opacity="0.1" />
                <stop offset="20%" stop-color="#fff" stop-opacity="1" />
                <stop offset="80%" stop-color="#fff" stop-opacity="1" />
                <stop offset="100%" stop-color="#fff" stop-opacity="0.1" />
            </linearGradient>
            <mask id="sts-circuit-fade">
                <rect width="100%" height="100%" fill="url(#sts-mask-vertical)" />
            </mask>
        </defs>
        <rect width="100%" height="100%" fill="url(#sts-circuit-network)" mask="url(#sts-circuit-fade)" />
    </svg>

    <!-- 4. Translucent Geometric Shapes (Surveillance HUD & Cybersecurity Radar) -->
    <div class="pointer-events-none absolute inset-0 select-none overflow-hidden">
        <!-- Top-End: Surveillance Camera Viewfinder Bracket -->
        <div class="absolute top-8 end-6 sm:end-14 text-brand-400/25 font-mono text-[10px] hidden sm:block">
            <svg class="w-24 sm:w-28 h-24 sm:h-28" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                <path d="M10 32 V10 H32" stroke-width="1.5" />
                <path d="M68 10 H90 V32" stroke-width="1.5" />
                <path d="M90 68 V90 H68" stroke-width="1.5" />
                <path d="M32 90 H10 V68" stroke-width="1.5" />
                <circle cx="50" cy="50" r="16" stroke-width="1" stroke-dasharray="3 3" />
                <path d="M50 38 V44 M50 56 V62 M38 50 H44 M56 50 H62" stroke-width="1.5" />
            </svg>
            <div class="text-[9px] tracking-wider text-brand-300/40 mt-1 uppercase text-end font-mono">STS // SURVEILLANCE // 4K AI</div>
        </div>

        <!-- Bottom-Start: Radar & Cybersecurity Sensor Grid -->
        <div class="absolute bottom-8 start-6 sm:start-14 text-accent-sky/20 hidden sm:block">
            <svg class="w-28 sm:w-32 h-28 sm:h-32" viewBox="0 0 120 120" fill="none" stroke="currentColor">
                <circle cx="60" cy="60" r="50" stroke-width="1" stroke-dasharray="4 6" />
                <circle cx="60" cy="60" r="32" stroke-width="1" />
                <circle cx="60" cy="60" r="14" stroke-width="1" stroke-dasharray="2 2" />
                <path d="M60 5 V115 M5 60 H115" stroke-width="0.8" stroke-opacity="0.3" />
                <path d="M60 60 L95 25" stroke-width="1.2" stroke="#38bdf8" stroke-opacity="0.6" />
            </svg>
            <div class="text-[9px] font-mono tracking-widest text-accent-sky/40 -mt-2 uppercase">HCIS // PERIMETER SECURED</div>
        </div>

        <!-- Center Hexagonal Cybersecurity Shield Grid -->
        <div class="absolute top-1/2 -translate-y-1/2 start-4 opacity-15 hidden xl:block">
            <svg class="w-48 h-48 text-brand-400" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1">
                <polygon points="50,5 90,27 90,73 50,95 10,73 10,27" />
                <polygon points="50,15 80,32 80,68 50,85 20,68 20,32" stroke-dasharray="3 3" />
            </svg>
        </div>
    </div>

    <!-- 5. Seamless Transitions with Adjacent Sections (Glowing Borders & Edge Vignettes) -->
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent z-20"></div>
    <div class="absolute top-0 inset-x-0 h-10 bg-gradient-to-b from-[#020617] to-transparent pointer-events-none z-10"></div>
    
    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent z-20"></div>
    <div class="absolute bottom-0 inset-x-0 h-10 bg-gradient-to-t from-[#020617] to-transparent pointer-events-none z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Translucent Shield Watermark (From Reference Image Quadrant 2) -->
        <div class="absolute -top-6 end-6 sm:end-20 opacity-15 pointer-events-none">
            <svg class="w-64 sm:w-96 h-64 sm:h-96 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>

        <!-- Section Header (Matching Reference Image: "باقات خدماتنا") -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16 reveal-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-brand-glow/20 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-ping"></span>
                <span>{{ app()->getLocale() === 'ar' ? 'باقات خدماتنا' : 'Our Service Packages' }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight drop-shadow-md">
                {{ app()->getLocale() === 'ar' ? 'باقات خدماتنا المتكاملة' : 'Integrated Service Packages' }}
            </h2>
            <p class="text-xs sm:text-base text-surface-200/90 max-w-2xl mx-auto leading-relaxed mt-2 font-normal">
                {{ app()->getLocale() === 'ar' ? 'اختر الباقة المناسبة لاحتياجاتك واستمتع بحلول أمنية وتقنية متكاملة معتمدة من الدفاع المدني.' : 'Select the right package for your facility and enjoy certified turnkey security and smart technology solutions.' }}
            </p>
        </div>

        <!-- Packages Slider on Mobile, Grid on Desktop -->
        <div class="flex md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8 overflow-x-auto md:overflow-visible snap-x snap-mandatory no-scrollbar pb-4 md:pb-0 -mx-4 md:mx-0 px-4 md:px-0" data-reveal-stagger="90">
            @foreach($featuredOffers as $offer)
                <div class="w-[88vw] sm:w-[360px] md:w-auto flex-shrink-0 snap-start flex flex-col justify-between rounded-3xl overflow-hidden transition-all duration-300 group bg-white border reveal-up hover-lift {{ $offer->is_featured ? 'border-brand-400 ring-4 ring-brand-400/25 shadow-[0_20px_60px_rgba(12,141,231,0.35)]' : 'border-surface-200/80 hover:border-brand-300 shadow-[0_20px_45px_rgba(0,0,0,0.5)] hover:shadow-[0_25px_55px_rgba(12,141,231,0.25)]' }}">
                    
                    {{-- Image Banner if available (STS Logo Palette) --}}
                    @if($offer->image_url)
                        <a href="{{ route('offers.show', $offer->slug) }}" class="block relative h-44 w-full overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 group/img img-skeleton-holder">
                            <img src="{{ $offer->image_url }}" alt="{{ $offer->title }}" class="w-full h-full object-cover group-hover/img:scale-108 transition-transform duration-700 ease-out img-lazy-transition" loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent"></div>
                            
                            @if($offer->badge_text || $offer->is_featured)
                                <span class="absolute top-3 start-3 px-3 py-1 rounded-full bg-gradient-to-r from-brand-600 to-brand-500 text-white text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $offer->badge_text ?: (app()->getLocale() === 'ar' ? 'الأكثر طلباً' : 'Most Popular') }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <div class="p-5 sm:p-7 flex-grow flex flex-col justify-between">
                        <div class="space-y-4">
                            @if($offer->service)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-surface-100 text-surface-600 text-[11px] font-bold">
                                    {{ $offer->service->title }}
                                </span>
                            @endif

                            <div>
                                <h3 class="text-lg sm:text-xl font-black text-surface-900 mb-1 leading-tight hover:text-brand-600 transition-colors">
                                    <a href="{{ route('offers.show', $offer->slug) }}">
                                        {{ $offer->title }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-surface-500 leading-relaxed line-clamp-2">{{ $offer->description }}</p>
                            </div>

                            <!-- Price Block -->
                            <div class="py-3 border-y border-surface-100">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-black text-surface-900 font-mono tracking-tight">
                                        {{ number_format($offer->discount_price ?: $offer->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-surface-500 uppercase">
                                        {{ $offer->currency ?: 'SAR' }}
                                    </span>
                                    @if($offer->discount_price && $offer->discount_price < $offer->price)
                                        <span class="text-xs text-surface-400 line-through font-mono">
                                            {{ number_format($offer->price, 0) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Features List -->
                            @php $featuresList = $offer->features ?? []; @endphp
                            @if(!empty($featuresList))
                                <ul class="space-y-2">
                                    @foreach(array_slice($featuresList, 0, 4) as $deliv)
                                        <li class="flex items-start gap-2 text-xs text-surface-700">
                                            <svg class="w-4 h-4 text-brand-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span class="line-clamp-1">{{ $deliv }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- CTA Actions -->
                        <div class="mt-6 flex items-center gap-2">
                            <a href="{{ route('offers.show', $offer->slug) }}" 
                               class="btn-secondary text-xs py-3 px-4 rounded-xl text-center flex-shrink-0">
                                <span>{{ app()->getLocale() === 'ar' ? 'التفاصيل' : 'Details' }}</span>
                            </a>
                            <a href="{{ route('quote.create', ['service' => optional($offer->service)->slug, 'package' => $offer->slug]) }}" 
                               class="flex-1 justify-center btn-primary text-xs sm:text-sm py-3 rounded-xl transition-all shadow-xs text-center inline-flex items-center gap-1.5">
                                <span>{{ app()->getLocale() === 'ar' ? 'طلب الباقة' : 'Request Package' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Packages CTA Button -->
        <div class="mt-12 text-center reveal-up">
            <a href="{{ route('offers.index') }}" 
               class="inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm border border-white/20 hover:border-brand-400 backdrop-blur-md transition-all shadow-soft group hover:scale-[1.02] active:scale-[0.98]">
                <span>{{ app()->getLocale() === 'ar' ? 'استعراض كافة العروض والباقات الهندسية المتاحة' : 'Explore All Engineering Packages & Offers' }}</span>
                <span class="w-7 h-7 rounded-full bg-brand-500/20 group-hover:bg-brand-500/40 flex items-center justify-center text-brand-300 transition-colors">
                    <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </span>
            </a>
        </div>

    </div>
</section>
@endif

<!-- ================= INSTANT INTERACTIVE SOLUTION CONFIGURATOR ("حاسبة الأنظمة والمواصفات الميدانية") ================= -->
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5" id="instant-calculator" x-data="{
    facilityType: 'commercial',
    selectedSystems: ['cctv', 'access'],
    projectPhase: 'new',
    toggleSystem(sys) {
        if (this.selectedSystems.includes(sys)) {
            this.selectedSystems = this.selectedSystems.filter(s => s !== sys);
        } else {
            this.selectedSystems.push(sys);
        }
    },
    getQuoteUrl() {
        return '{{ route('quote.create') }}?facility=' + this.facilityType + '&systems=' + this.selectedSystems.join(',') + '&phase=' + this.projectPhase;
    }
}">
    <!-- Background Tech Glows -->
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 end-1/4 w-96 h-96 bg-accent-sky/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14 reveal-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-brand-glow/20 backdrop-blur-md">
                <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'تحديد المواصفات والحساب الفوري' : 'Interactive System Estimator' }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                {{ app()->getLocale() === 'ar' ? 'حدد متطلبات منشأتك واستلم دراسة وعرض سعر رسمي' : 'Configure Your Facility Systems in 3 Quick Steps' }}
            </h2>
            <p class="text-xs sm:text-base text-surface-400 mt-2">
                {{ app()->getLocale() === 'ar' ? 'خطوات تفاعلية بسيطة ومباشرة تساعدك على تحديد الأنظمة والمخططات المطلوبة بدقة' : 'Interactive touch configuration designed for rapid scope definition and instant quote submission' }}
            </p>
        </div>

        <div class="rounded-3xl p-6 sm:p-10 border border-brand-500/20 shadow-2xl bg-surface-900/70 backdrop-blur-xl reveal-scale">
            
            <!-- Step 1: نوع المنشأة -->
            <div class="mb-8">
                <label class="block text-xs sm:text-sm font-black text-white mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-600 text-white text-xs flex items-center justify-center font-mono shadow-xs">1</span>
                    <span>{{ app()->getLocale() === 'ar' ? 'نوع المنشأة أو المشروع:' : 'Select Facility Type:' }}</span>
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5">
                    <button type="button" @click="facilityType = 'commercial'" 
                            :class="facilityType === 'commercial' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex flex-col items-center gap-1.5 transition-all active:scale-95 text-center">
                        <span class="text-xl">🏢</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مبنى تجاري' : 'Commercial' }}</span>
                    </button>
                    <button type="button" @click="facilityType = 'residential'" 
                            :class="facilityType === 'residential' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex flex-col items-center gap-1.5 transition-all active:scale-95 text-center">
                        <span class="text-xl">🏰</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'فيلا / قصر' : 'Villa / Palace' }}</span>
                    </button>
                    <button type="button" @click="facilityType = 'hospitality'" 
                            :class="facilityType === 'hospitality' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex flex-col items-center gap-1.5 transition-all active:scale-95 text-center">
                        <span class="text-xl">🏨</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'فندق / منتجع' : 'Hotel / Resort' }}</span>
                    </button>
                    <button type="button" @click="facilityType = 'industrial'" 
                            :class="facilityType === 'industrial' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex flex-col items-center gap-1.5 transition-all active:scale-95 text-center">
                        <span class="text-xl">🏭</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مستودع / مصنع' : 'Industrial' }}</span>
                    </button>
                    <button type="button" @click="facilityType = 'healthcare'" 
                            :class="facilityType === 'healthcare' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="col-span-2 sm:col-span-1 p-3 rounded-2xl border text-xs font-bold flex flex-col items-center gap-1.5 transition-all active:scale-95 text-center">
                        <span class="text-xl">🏥</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مستشفى / طبي' : 'Healthcare' }}</span>
                    </button>
                </div>
            </div>

            <!-- Step 2: الأنظمة المطلوبة -->
            <div class="mb-8">
                <label class="block text-xs sm:text-sm font-black text-white mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-600 text-white text-xs flex items-center justify-center font-mono shadow-xs">2</span>
                    <span>{{ app()->getLocale() === 'ar' ? 'الأنظمة والحلول المطلوب تركيبها (يمكن اختيار أكثر من نظام):' : 'Select Required Systems (Multi-select):' }}</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                    <button type="button" @click="toggleSystem('cctv')" 
                            :class="selectedSystems.includes('cctv') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>📹</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'كاميرات مراقبة ذكية AI CCTV' : 'AI CCTV Surveillance' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('cctv')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>

                    <button type="button" @click="toggleSystem('access')" 
                            :class="selectedSystems.includes('access') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>🚪</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'تحكم بالدخول وبوابات أمنية' : 'Access Control & Gates' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('access')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>

                    <button type="button" @click="toggleSystem('fire')" 
                            :class="selectedSystems.includes('fire') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>🚨</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'إنذار حريق معتمد دفاع مدني' : 'Civil Defense Fire Alarm' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('fire')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>

                    <button type="button" @click="toggleSystem('datacenter')" 
                            :class="selectedSystems.includes('datacenter') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>💻</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'غرفة خوادم ومراكز بيانات Tier III' : 'Data Center & Server Rooms' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('datacenter')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>

                    <button type="button" @click="toggleSystem('automation')" 
                            :class="selectedSystems.includes('automation') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>🏡</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'أتمتة ذكية ومنازل ذكية KNX' : 'Smart Automation & KNX' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('automation')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>

                    <button type="button" @click="toggleSystem('network')" 
                            :class="selectedSystems.includes('network') ? 'bg-brand-600/25 border-brand-400 text-white ring-2 ring-brand-400/30 shadow-brand-glow/15' : 'bg-surface-950/80 border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white'"
                            class="p-3.5 rounded-2xl border flex items-center justify-between text-xs font-bold transition-all active:scale-95 text-start">
                        <span class="flex items-center gap-2">
                            <span>🌐</span>
                            <span>{{ app()->getLocale() === 'ar' ? 'شبكات ألياف ضوئية وWi-Fi 7' : 'Fiber Optics & Enterprise Wi-Fi' }}</span>
                        </span>
                        <span x-show="selectedSystems.includes('network')" class="w-4 h-4 rounded-full bg-brand-500 text-white text-[10px] flex items-center justify-center shadow-xs">✓</span>
                    </button>
                </div>
            </div>

            <!-- Step 3: حالة المشروع -->
            <div class="mb-8">
                <label class="block text-xs sm:text-sm font-black text-white mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-brand-600 text-white text-xs flex items-center justify-center font-mono shadow-xs">3</span>
                    <span>{{ app()->getLocale() === 'ar' ? 'مرحلة ونطاق المشروع:' : 'Project Stage & Scope:' }}</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                    <button type="button" @click="projectPhase = 'new'" 
                            :class="projectPhase === 'new' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex items-center justify-center gap-2 transition-all active:scale-95">
                        <span>🏗️</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مشروع جديد قيد الإنشاء' : 'New Construction' }}</span>
                    </button>
                    <button type="button" @click="projectPhase = 'upgrade'" 
                            :class="projectPhase === 'upgrade' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex items-center justify-center gap-2 transition-all active:scale-95">
                        <span>🔄</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'تطوير وتحديث نظام حالي' : 'Retrofit / Upgrade' }}</span>
                    </button>
                    <button type="button" @click="projectPhase = 'maintenance'" 
                            :class="projectPhase === 'maintenance' ? 'bg-brand-600 text-white border-brand-400 shadow-brand-glow' : 'bg-surface-950/80 text-surface-300 border border-white/10 hover:border-brand-500/40 hover:text-white'"
                            class="p-3 rounded-2xl border text-xs font-bold flex items-center justify-center gap-2 transition-all active:scale-95">
                        <span>🛠️</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'عقد صيانة وتراخيص سنوية' : 'Annual SLA & Maintenance' }}</span>
                    </button>
                </div>
            </div>

            <!-- Dynamic Result Summary & Direct Action -->
            <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-950/80 p-4 sm:p-6 rounded-2xl border border-brand-500/30">
                <div>
                    <span class="text-xs font-bold text-brand-400 uppercase tracking-wider block">
                        {{ app()->getLocale() === 'ar' ? 'ملخص المواصفات المحددة:' : 'Configured Scope Summary:' }}
                    </span>
                    <span class="text-sm font-black text-white mt-1 block">
                        <span x-text="selectedSystems.length"></span> {{ app()->getLocale() === 'ar' ? 'أنظمة مختارة | جاهز لإعداد العرض الهندسي المعتمد' : 'Systems Configured | Ready for Certified Study' }}
                    </span>
                </div>

                <a :href="getQuoteUrl()" 
                   class="w-full sm:w-auto btn-primary text-xs sm:text-sm py-3.5 px-8 rounded-xl shadow-brand-glow justify-center active:scale-95 transition-all">
                    <span>{{ app()->getLocale() === 'ar' ? 'استكمال الطلب والحصول على العرض الفوري' : 'Submit & Receive Official Quote' }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- ================= METHODOLOGY WORKFLOW ================= -->
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-96 bg-brand-500/10 rounded-full blur-[150px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 reveal-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-brand-glow/20 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-ping"></span>
                <span>{{ __('messages.methodology_badge') }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                {{ __('messages.methodology_title') }}
            </h2>
            <p class="text-xs sm:text-base text-surface-400 mt-2 max-w-2xl mx-auto">
                {{ __('messages.methodology_subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3.5 sm:gap-6" data-reveal-stagger="70">
            <!-- Stage 1 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-brand-400/60 group-hover:text-brand-300 font-outfit block mb-2 transition-colors">01</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-brand-200 transition-colors">{{ __('messages.step_1_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_1_desc') }}</p>
            </div>

            <!-- Stage 2 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-brand-400/60 group-hover:text-brand-300 font-outfit block mb-2 transition-colors">02</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-brand-200 transition-colors">{{ __('messages.step_2_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_2_desc') }}</p>
            </div>

            <!-- Stage 3 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-brand-400/60 group-hover:text-brand-300 font-outfit block mb-2 transition-colors">03</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-brand-200 transition-colors">{{ __('messages.step_3_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_3_desc') }}</p>
            </div>

            <!-- Stage 4 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-brand-400/60 group-hover:text-brand-300 font-outfit block mb-2 transition-colors">04</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-brand-200 transition-colors">{{ __('messages.step_4_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_4_desc') }}</p>
            </div>

            <!-- Stage 5 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-brand-400/60 group-hover:text-brand-300 font-outfit block mb-2 transition-colors">05</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-brand-200 transition-colors">{{ __('messages.step_5_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_5_desc') }}</p>
            </div>

            <!-- Stage 6 -->
            <div class="rounded-2xl p-4 sm:p-6 relative group bg-surface-900/60 border border-white/10 hover:border-brand-400/50 hover:bg-surface-900/90 hover:shadow-brand-glow/20 transition-all duration-300 text-start reveal-up hover-lift">
                <span class="text-2xl sm:text-3xl font-black text-emerald-400/80 group-hover:text-emerald-300 font-outfit block mb-2 transition-colors">06</span>
                <h4 class="text-xs sm:text-sm font-bold text-white mb-1.5 group-hover:text-emerald-200 transition-colors">{{ __('messages.step_6_title') }}</h4>
                <p class="text-[11px] sm:text-xs text-surface-400 leading-relaxed">{{ __('messages.step_6_desc') }}</p>
            </div>
        </div>

    </div>
</section>

<!-- ================= FEATURED PROJECTS SECTION (TOUCH SLIDER & SHOWCASE) ================= -->
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14 reveal-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-brand-glow/20 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-ping"></span>
                <span>{{ __('messages.projects_badge') }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                {{ __('messages.projects_title') }}
            </h2>
            <p class="text-xs sm:text-base text-surface-400 mt-2 max-w-2xl mx-auto">
                {{ __('messages.projects_subtitle') }}
            </p>
        </div>

        <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8 overflow-x-auto sm:overflow-visible snap-x snap-mandatory no-scrollbar pb-4 sm:pb-0 -mx-4 sm:mx-0 px-4 sm:px-0" data-reveal-stagger="90">
            @foreach($featuredProjects as $proj)
                <div class="w-[85vw] sm:w-auto flex-shrink-0 snap-start flex flex-col">
                    <x-project-card :project="$proj" />
                </div>
            @endforeach
        </div>

        <div class="mt-10 sm:mt-16 text-center reveal-up">
            <a href="{{ route('projects.index') }}" class="btn-secondary text-white border-white/20 bg-white/5 hover:bg-white/10 hover:border-brand-400/50 px-8 py-3.5 rounded-xl group inline-flex items-center gap-2 transition-all shadow-soft">
                <span>{{ __('messages.view_all_projects') }}</span>
                <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>
</section>

<!-- ================= CLIENT TESTIMONIALS & TRUST SECTION (تقييمات وشهادات العملاء في المملكة) ================= -->
@if(isset($testimonials) && $testimonials->isNotEmpty())
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5" id="testimonials-section">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 end-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header with Trust Metrics -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14 reveal-up">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-500/15 text-amber-300 border border-amber-500/30 mb-3 shadow-xs">
                <svg class="w-3.5 h-3.5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'ثقة وشهادات عملائنا بالمملكة' : 'Client Trust & Verified Reviews' }}</span>
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                {{ app()->getLocale() === 'ar' ? 'ماذا يقول عملاؤنا عن دقة التنفيذ والالتزام الهندسي؟' : 'What Our Clients Say About Engineering Excellence' }}
            </h2>
            <p class="text-xs sm:text-base text-surface-400 max-w-2xl mx-auto leading-relaxed mt-2">
                {{ app()->getLocale() === 'ar' ? 'آراء وتقييمات حقيقية من نخبة الشركاء وأصحاب المنشآت والقصور والمستودعات في الرياض وجدة والدمام والخبر ومكة المكرمة.' : 'Real feedback from distinguished enterprise partners, commercial towers, warehouses, and luxury residences across Saudi Arabia.' }}
            </p>

            <!-- Trust Badge Strip -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 sm:gap-6 text-xs text-surface-300 font-semibold">
                <div class="flex items-center gap-1.5 bg-surface-900/80 border border-white/10 px-3.5 py-1.5 rounded-xl shadow-xs backdrop-blur-md">
                    <span class="text-amber-400 font-bold font-mono text-sm">4.9 / 5.0</span>
                    <div class="flex text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span class="text-surface-500">|</span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تقييم ممتاز' : 'Top Rated' }}</span>
                </div>

                <div class="flex items-center gap-1.5 bg-surface-900/80 border border-white/10 px-3.5 py-1.5 rounded-xl shadow-xs text-emerald-400 backdrop-blur-md">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? '100% تقييمات موثقة' : '100% Verified Clients' }}</span>
                </div>

                <div class="flex items-center gap-1.5 bg-surface-900/80 border border-white/10 px-3.5 py-1.5 rounded-xl shadow-xs text-brand-300 backdrop-blur-md">
                    <span>🇸🇦</span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تغطية شاملة لجميع مناطق المملكة' : 'Kingdom-wide coverage' }}</span>
                </div>
            </div>
        </div>

        <!-- Testimonials Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7" data-reveal-stagger="80">
            @foreach($testimonials as $testimonial)
                <div class="flex flex-col">
                    <x-testimonial-card :testimonial="$testimonial" />
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

<!-- ================= LATEST ARTICLES & KNOWLEDGE HUB ("المدونة والمقالات الهندسية") ================= -->
@if(isset($latestArticles) && $latestArticles->isNotEmpty())
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5" id="articles-section">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 end-1/4 w-96 h-96 bg-accent-sky/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 sm:mb-16 reveal-up">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 shadow-xs">
                    <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'المدونة الهندسية والمعرفية' : 'Engineering Insights & Knowledge Hub' }}</span>
                </span>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                    {{ app()->getLocale() === 'ar' ? 'أحدث المقالات والرؤى الهندسية' : 'Latest Technical Insights & Research' }}
                </h2>
                <p class="text-xs sm:text-base text-surface-400 mt-2.5 leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'مقالات متخصصة ودراسات فنية في مجالات المراقبة الذكية، السلامة ومكافحة الحريق، إنترنت الأشياء والشبكات المتطورة.' : 'Expert guides and analyses on smart surveillance, fire safety, IoT networks, and modern building automation.' }}
                </p>
            </div>

            <!-- View All Articles Link Desktop -->
            <div class="hidden md:block flex-shrink-0">
                <a href="{{ route('articles.index') }}" class="btn-secondary text-white border-white/20 bg-white/5 hover:bg-white/10 hover:border-brand-400/50 px-6 py-3 rounded-xl group inline-flex items-center gap-2 transition-all shadow-soft text-xs sm:text-sm">
                    <span>{{ app()->getLocale() === 'ar' ? 'تصفح كافة المقالات' : 'View All Articles' }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- 3 Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" data-reveal-stagger="90">
            @foreach($latestArticles as $index => $article)
                <article class="rounded-3xl overflow-hidden shadow-soft hover:shadow-brand-glow/20 transition-all duration-300 flex flex-col group border border-white/10 bg-surface-900/70 backdrop-blur-md hover:border-brand-500/40 reveal-up hover-lift">
                    <!-- Thumbnail (STS Logo Palette) -->
                    <div class="relative h-48 sm:h-52 overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-skeleton-holder">
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 img-lazy-transition" loading="lazy" decoding="async">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#000418] to-[#010318] flex items-center justify-center text-slate-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>

                        <div class="absolute top-3.5 start-3.5">
                            <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-surface-900/90 text-brand-300 shadow-sm backdrop-blur-sm border border-brand-500/30">
                                {{ $article->category_label }}
                            </span>
                        </div>

                        <div class="absolute bottom-3.5 end-3.5">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-semibold bg-surface-950/80 text-white backdrop-blur-sm flex items-center gap-1 font-outfit border border-white/10">
                                <svg class="w-3 h-3 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($article->views_count) }}
                            </span>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-5 sm:p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-[11px] text-surface-400">
                                <span class="font-mono">{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</span>
                                <span>&bull;</span>
                                <span>{{ $article->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'mins read' }}</span>
                            </div>

                            <h3 class="text-base font-bold text-white group-hover:text-brand-300 transition-colors line-clamp-2 leading-snug">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-xs text-surface-400 line-clamp-2 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-3.5 border-t border-white/10 flex items-center justify-between text-xs">
                            <span class="font-semibold text-surface-400 truncate max-w-[130px]">
                                {{ $article->author_name ?? 'فريق STS' }}
                            </span>

                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-brand-400 hover:text-brand-300 font-bold transition-colors">
                                <span>{{ app()->getLocale() === 'ar' ? 'اقرأ المقال' : 'Read Article' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- View All Articles Link Mobile -->
        <div class="mt-8 text-center md:hidden reveal-up">
            <a href="{{ route('articles.index') }}" class="btn-secondary text-white border-white/20 bg-white/5 hover:bg-white/10 w-full py-3.5 rounded-xl inline-flex items-center justify-center gap-2 text-xs font-bold">
                <span>{{ app()->getLocale() === 'ar' ? 'تصفح كافة المقالات الهندسية' : 'View All Engineering Articles' }}</span>
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>
</section>
@endif

<!-- ================= HIGH IMPACT CALL TO ACTION ================= -->
<section class="py-16 sm:py-24 bg-surface-950 text-white relative overflow-hidden border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl p-6 sm:p-14 bg-gradient-to-br from-[#061e38] via-brand-900 to-[#030d1d] overflow-hidden shadow-2xl border border-brand-500/40 cta-gradient-card reveal-scale hover-lift">
            <!-- Background decorative elements -->
            <div class="absolute -top-24 -end-24 w-96 h-96 bg-brand-500/25 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -start-20 w-80 h-80 bg-accent-sky/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl space-y-5 sm:space-y-6">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/15 text-white border border-white/20 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    {{ __('messages.support_badge') }}
                </span>

                <h2 class="text-2xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                    {{ __('messages.cta_box_title') }}
                </h2>

                <p class="text-sm sm:text-lg text-surface-200 leading-relaxed">
                    {{ __('messages.cta_box_subtitle') }}
                </p>

                <div class="pt-2 flex flex-col sm:flex-row items-center gap-3.5">
                    <a href="{{ route('quote.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 sm:py-4 rounded-xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm sm:text-base shadow-brand-glow hover:scale-105 active:scale-95 transition-all group">
                        <span>{{ __('messages.cta_request_now') }}</span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 rtl:rotate-180 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
