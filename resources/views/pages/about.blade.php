@extends('layouts.app')

@section('title', __('messages.nav_about') . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span>{{ __('messages.nav_about') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ app()->getLocale() === 'ar' ? 'عن شركة STS للأنظمة والحلول التقنية' : 'About STS Smart Tech Systems' }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ app()->getLocale() === 'ar' ? 'شريكك الهندسي الموثوق في تصميم وتوريد وتركيب وصيانة أحدث الأنظمة الأمنية والشبكات والحلول الذكية في المملكة العربية السعودية.' : 'Your trusted engineering partner in designing, deploying, and maintaining advanced low-current security, networking, and automation architectures.' }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT =================== -->
<div class="py-16 sm:py-24 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-80 h-80 bg-accent-sky/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Corporate Profile Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <div class="space-y-6 text-surface-300 leading-relaxed text-base reveal-up">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-xs font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'نبذة عن الشركة' : 'Company Overview' }}</span>
                </div>

                <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight leading-tight">
                    {{ app()->getLocale() === 'ar' ? 'ريادة هندسية مبنية على الدقة والموثوقية التقنية' : 'Engineering Excellence Built on Precision & Trust' }}
                </h2>
                
                <p>
                    {{ app()->getLocale() === 'ar' 
                        ? 'تأسست STS لتكون مزوداً رائداً للحلول الأمنية المتكاملة والأنظمة الذكية في المملكة العربية السعودية. نعمل على مساعدة المنشآت والشركات والمؤسسات على حماية أصولها ورفع كفاءتها التشغيلية عبر دمج أحدث تقنيات المراقبة الذكية، والتحكم في الدخول، ومراكز البيانات، وشبكات الألياف البصرية، وأنظمة السلامة ومكافحة الحريق.'
                        : 'STS was established to deliver premier integrated security and smart low-current engineering architectures across the Kingdom of Saudi Arabia. We empower commercial enterprises, government institutions, and luxury residences to safeguard critical assets and streamline operations by integrating cutting-edge surveillance, biometric access, Tier data centers, and Civil Defense certified fire alarms.' }}
                </p>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'يضم فريقنا نخبة من المهندسين والفنيين المؤهلين والمعتمدين الذين يملكون سجلاً حافلاً بالخبرة الميدانية في إدارة المشاريع وفق أعلى المعايير الهندسية وأنظمة الجودة العالمية.'
                        : 'Our multidisciplinary engineering and low-current technicians hold proven field track records in executing turnkey infrastructure projects adhering to stringent quality benchmarks and regulatory mandates.' }}
                </p>

                <!-- Stats Counters Grid -->
                <div class="pt-6 grid grid-cols-3 gap-4 border-t border-white/10" data-reveal-stagger="80">
                    <div class="p-4 rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 shadow-soft text-center group hover:border-brand-500/40 transition-all reveal-up hover-lift">
                        <span class="text-3xl sm:text-4xl font-black text-brand-400 font-outfit block mb-1 group-hover:scale-105 transition-transform">12+</span>
                        <span class="text-xs font-semibold text-surface-400 block">{{ app()->getLocale() === 'ar' ? 'حلول تقنية متخصصة' : 'Core Solutions' }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 shadow-soft text-center group hover:border-emerald-500/40 transition-all reveal-up hover-lift">
                        <span class="text-3xl sm:text-4xl font-black text-emerald-400 font-outfit block mb-1 group-hover:scale-105 transition-transform">100%</span>
                        <span class="text-xs font-semibold text-surface-400 block">{{ app()->getLocale() === 'ar' ? 'معايير أمنية معتمدة' : 'Certified Compliance' }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 shadow-soft text-center group hover:border-brand-500/40 transition-all reveal-up hover-lift">
                        <span class="text-3xl sm:text-4xl font-black text-white font-outfit block mb-1 group-hover:scale-105 transition-transform">24/7</span>
                        <span class="text-xs font-semibold text-surface-400 block">{{ app()->getLocale() === 'ar' ? 'دعم فني وصيانة SLA' : 'SLA Technical Support' }}</span>
                    </div>
                </div>
            </div>

            <!-- Pillars Feature Box -->
            <div class="rounded-3xl p-8 sm:p-10 relative overflow-hidden reveal-scale bg-surface-900/70 backdrop-blur-md border border-white/10">
                <div class="space-y-6" data-reveal-stagger="80">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-800/50 border border-white/5 hover:border-brand-500/30 hover:bg-brand-500/5 transition-all reveal-up hover-lift">
                        <div class="w-12 h-12 rounded-xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ app()->getLocale() === 'ar' ? 'الالتزام بمعايير الدفاع المدني والأمن' : 'Regulatory & Civil Defense Compliance' }}</h3>
                            <p class="text-xs sm:text-sm text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'كافة المخططات والتجهيزات والمعدات مطابقة للاشتراطات الفنية المعتمدة للجهات الرسمية.' : 'All project schematics and equipment strictly satisfy governmental and civil safety guidelines.' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-800/50 border border-white/5 hover:border-brand-500/30 hover:bg-brand-500/5 transition-all reveal-up hover-lift">
                        <div class="w-12 h-12 rounded-xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ app()->getLocale() === 'ar' ? 'سرعة الاستجابة والدعم المستمر' : 'Rapid SLA Incident Dispatch' }}</h3>
                            <p class="text-xs sm:text-sm text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'خدمات دعم فني طارئة وفرق صيانة وقائية مدربة على التدخل السريع لحل أي عطل على مدار الساعة.' : 'Round-the-clock emergency dispatch teams and scheduled preventive servicing audits.' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-surface-800/50 border border-white/5 hover:border-brand-500/30 hover:bg-brand-500/5 transition-all reveal-up hover-lift">
                        <div class="w-12 h-12 rounded-xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ app()->getLocale() === 'ar' ? 'الابتكار والذكاء الاصطناعي' : 'AI-Driven Technological Innovation' }}</h3>
                            <p class="text-xs sm:text-sm text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'تطبيق تحليلات الفيديو الذكية وخوارزميات التعرف التلقائي لتعزيز أمان وكفاءة المنشآت.' : 'Deploying smart video analytics and predictive automated alerting models.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission Dual Modern Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20" data-reveal-stagger="80">
            <div class="rounded-3xl p-8 sm:p-10 relative overflow-hidden group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                <div class="w-14 h-14 rounded-2xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center mb-6 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-white mb-3">
                    {{ app()->getLocale() === 'ar' ? 'رؤيتنا المستقبلية' : 'Our Strategic Vision' }}
                </h3>
                <p class="text-surface-400 text-sm sm:text-base leading-relaxed">
                    {{ app()->getLocale() === 'ar'
                        ? 'أن نكون الخيار الأول والوجهة الهندسية الأكثر ثقة واعتماداً في المملكة لتنفيذ البنى التحتية الذكية والحلول الأمنية المتطورة، مساهمين بفعالية في تحقيق مستهدفات رؤية المملكة 2030 نحو مدن ذكية وبيئات عمل آمنة ومستدامة.'
                        : 'To stand as the premier and most dependable engineering provider for intelligent low-current infrastructures and security innovations, actively contributing toward the Kingdom\'s Vision 2030 smart ecosystem.' }}
                </p>
            </div>

            <div class="rounded-3xl p-8 sm:p-10 relative overflow-hidden group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                <div class="w-14 h-14 rounded-2xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center mb-6 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-white mb-3">
                    {{ app()->getLocale() === 'ar' ? 'رسالتنا الهندسية' : 'Our Engineering Mission' }}
                </h3>
                <p class="text-surface-400 text-sm sm:text-base leading-relaxed">
                    {{ app()->getLocale() === 'ar'
                        ? 'تقديم حلول متكاملة تبدأ من التخطيط والتصميم الهندسي الدقيق وحتى التوريد والتنفيذ والصيانة، بأعلى درجات الاحترافية والمطابقة للمعايير الوطنية والدولية، مع توفير أفضل قيمة مستدامة لعملائنا في كل مرحلة.'
                        : 'Delivering end-to-end engineering excellence from blueprinting through turnkey procurement, commissioning, and continuous lifecycle maintenance with unwavering adherence to regulatory standards.' }}
                </p>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="mb-20">
            <div class="text-center max-w-2xl mx-auto mb-12 reveal-up">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 backdrop-blur-md">
                    {{ app()->getLocale() === 'ar' ? 'مبادئنا الأساسية' : 'Core Principles' }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-white">
                    {{ app()->getLocale() === 'ar' ? 'قيمنا المؤسسية الراسخة' : 'Our Guiding Core Values' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-reveal-stagger="70">
                <div class="rounded-2xl p-7 text-center space-y-3 group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/15 text-brand-400 mx-auto flex items-center justify-center font-black font-outfit border border-brand-500/30 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all">01</div>
                    <h3 class="font-bold text-white text-base">{{ app()->getLocale() === 'ar' ? 'الجودة والدقة الهندسية' : 'Engineering Quality' }}</h3>
                    <p class="text-xs text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'لا مساومة على جودة التوريد ودقة التمديدات والمخططات.' : 'Zero compromise on hardware fidelity and structured wiring standards.' }}</p>
                </div>

                <div class="rounded-2xl p-7 text-center space-y-3 group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/15 text-brand-400 mx-auto flex items-center justify-center font-black font-outfit border border-brand-500/30 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all">02</div>
                    <h3 class="font-bold text-white text-base">{{ app()->getLocale() === 'ar' ? 'الموثوقية والأمان' : 'Trust & Reliability' }}</h3>
                    <p class="text-xs text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'أنظمة مصممة لتعمل باستمرارية تامة دون انقطاع.' : 'Architectures built for 99.99% operational continuity.' }}</p>
                </div>

                <div class="rounded-2xl p-7 text-center space-y-3 group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/15 text-brand-400 mx-auto flex items-center justify-center font-black font-outfit border border-brand-500/30 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all">03</div>
                    <h3 class="font-bold text-white text-base">{{ app()->getLocale() === 'ar' ? 'الشفافية والالتزام' : 'Transparency & Integrity' }}</h3>
                    <p class="text-xs text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'وضوح تام في جداول الكميات، والمواصفات، ومواعيد التسليم.' : 'Clear itemized BoQs, explicit schedules, and punctual handovers.' }}</p>
                </div>

                <div class="rounded-2xl p-7 text-center space-y-3 group hover:border-brand-500/40 transition-all reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/15 text-brand-400 mx-auto flex items-center justify-center font-black font-outfit border border-brand-500/30 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all">04</div>
                    <h3 class="font-bold text-white text-base">{{ app()->getLocale() === 'ar' ? 'الشراكة طويلة الأمد' : 'Long-Term Partnership' }}</h3>
                    <p class="text-xs text-surface-400 leading-relaxed">{{ app()->getLocale() === 'ar' ? 'علاقتنا تبدأ مع التسليم عبر عقود الصيانة والدعم المستمر.' : 'Our partnership flourishes post-commissioning through active SLAs.' }}</p>
                </div>
            </div>
        </div>

        <!-- Call To Action Tech Banner -->
        <div class="card-dark rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal-scale hover-lift mb-20">
            <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
            <div class="absolute -end-16 -top-16 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-start">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-300 border border-brand-500/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'استشارة هندسية مجانية' : 'Free Engineering Consultation' }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'جاهز لتأمين وتطوير البنية التحتية لمنشأتك؟' : 'Ready to Elevate Your Facility Infrastructure?' }}
                    </h3>
                    <p class="text-surface-300 text-xs sm:text-sm">
                        {{ app()->getLocale() === 'ar' ? 'تواصل مع فريقنا الهندسي اليوم للحصول على كشف ميداني ودراسة فنية متكاملة.' : 'Connect with our engineering specialists today for site audits and tailored proposals.' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 flex-shrink-0">
                    <a href="{{ route('quote.create') }}" class="btn-primary">
                        <span>{{ __('messages.nav_quote_btn') }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- =================== INTEGRATED CONTACT SECTION =================== -->
        <section id="contact" class="pt-8 scroll-mt-24">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 reveal-up">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ __('messages.nav_contact') }}</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3">
                    {{ __('messages.contact_page_title') }}
                </h2>
                <p class="text-sm sm:text-base text-surface-300 leading-relaxed">
                    {{ __('messages.contact_page_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
                
                <!-- Contact Info Box -->
                <div class="lg:col-span-1 space-y-6 reveal-up">
                    <div class="rounded-3xl p-7 sm:p-8 space-y-6 bg-surface-900/70 backdrop-blur-md border border-white/10" data-reveal-stagger="70">
                        <div class="border-b border-white/10 pb-4 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>
                                <span>{{ __('messages.contact_info_title') }}</span>
                            </h3>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/25">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>{{ app()->getLocale() === 'ar' ? 'متاحون الآن' : 'Available Now' }}</span>
                            </span>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'المقر الرئيسي' : 'Headquarters' }}</span>
                                <span class="text-sm font-bold text-white leading-relaxed block">{{ $contactAddress }}</span>
                                <span class="text-xs text-brand-400 mt-1 inline-flex items-center gap-1">
                                    <span>{{ app()->getLocale() === 'ar' ? 'المملكة العربية السعودية' : 'Kingdom of Saudi Arabia' }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'الهاتف الموحد' : 'Central Phone' }}</span>
                                <a href="tel:{{ $contactPhone }}" class="text-sm font-bold text-white hover:text-brand-400 transition-colors block" dir="ltr">{{ $contactPhone }}</a>
                            </div>
                        </div>

                        <!-- WhatsApp Direct -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-2xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-xs border border-emerald-500/25">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-surface-500 block mb-1 font-medium">WhatsApp</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWhatsapp) }}" target="_blank" rel="noopener" class="text-sm font-bold text-emerald-400 hover:text-emerald-300 hover:underline flex items-center gap-1.5" dir="ltr">
                                    <span>{{ $contactWhatsapp }}</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}</span>
                                <a href="mailto:{{ $contactEmail }}" class="text-sm font-bold text-white hover:text-brand-400 transition-colors block break-all">{{ $contactEmail }}</a>
                            </div>
                        </div>

                        <!-- Working Hours -->
                        <div class="flex items-start gap-4 group">
                            <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'أوقات العمل المكتبي' : 'Working Hours' }}</span>
                                <span class="text-sm font-bold text-white block">{{ $workingHours }}</span>
                                <span class="text-xs text-surface-500 mt-1 block">{{ app()->getLocale() === 'ar' ? 'الدعم الفني الميداني يعمل 24/7' : 'Field emergency team active 24/7' }}</span>
                            </div>
                        </div>

                    </div>

                    <!-- Fast Response Assurance Card -->
                    <div class="rounded-3xl p-6 bg-gradient-to-br from-brand-950/80 via-surface-900/80 to-brand-950/60 backdrop-blur-md border border-brand-500/30 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center flex-shrink-0 shadow-brand-glow">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-white uppercase tracking-wider mb-1">
                                {{ app()->getLocale() === 'ar' ? 'التزام استجابة SLA' : 'SLA Response Commitment' }}
                            </h4>
                            <p class="text-xs text-surface-400 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'يقوم فريقنا الهندسي بالرد ودراسة الاستفسار خلال أقل من ساعتين عمل.' : 'Our solution engineers respond to all technical inquiries in under 2 business hours.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Message Form -->
                <div class="lg:col-span-2 reveal-scale">
                    <form action="{{ route('contact.store') }}" method="POST" class="rounded-3xl p-8 sm:p-10 space-y-6 bg-surface-900/70 backdrop-blur-md border border-white/10">
                        @csrf

                        <div class="border-b border-white/10 pb-5">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                <h3 class="text-xl sm:text-2xl font-black text-white">
                                    {{ __('messages.contact_send_msg') }}
                                </h3>
                            </div>
                            <p class="text-xs sm:text-sm text-surface-400">
                                {{ app()->getLocale() === 'ar' ? 'املأ الحقول التالية وسيتواصل معك مستشار هندسي مختص لمناقشة مشروعك' : 'Submit your inquiry below and an authorized technical consultant will get in touch' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                    {{ __('messages.form_full_name') }} <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'م. خالد عبدالله' : 'Eng. Khalid Abdullah' }}"
                                       class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('name') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                                @error('name')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                    {{ __('messages.form_email') }} <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                       placeholder="name@company.com" dir="ltr"
                                       class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('email') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start">
                                @error('email')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                    {{ __('messages.form_phone') }}
                                </label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                       placeholder="+966 5X XXX XXXX" dir="ltr"
                                       class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start">
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                    {{ __('messages.contact_form_subject') }} <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                                       placeholder="{{ app()->getLocale() === 'ar' ? 'استفسار عن عقد صيانة أو تنفيذ مشروع' : 'Project inquiry or maintenance contract' }}"
                                       class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('subject') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                                @error('subject')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.contact_form_message') }} <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="5" required
                                      placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب تفاصيل استفسارك، موقع المشروع، أو المتطلبات الهندسية هنا...' : 'Write your project details, location, or engineering requirements here...' }}"
                                      class="w-full px-4 py-3.5 rounded-xl bg-surface-800/70 border @error('message') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-3 border-t border-white/10">
                            <button type="submit" class="btn-primary w-full sm:w-auto">
                                <span>{{ __('messages.contact_form_submit') }}</span>
                                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                            <span class="text-xs text-surface-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span>{{ app()->getLocale() === 'ar' ? 'بياناتك مشفرة ومحمية بخصوصية وسرية تامة' : 'Your data is encrypted and handled with strict confidentiality' }}</span>
                            </span>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Interactive Map Visual Section -->
            <div class="mt-16 rounded-3xl p-6 sm:p-8 relative overflow-hidden reveal-up bg-surface-900/70 backdrop-blur-md border border-white/10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-black text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'مقرنا الرئيسي في الرياض' : 'Riyadh Headquarters Location' }}</span>
                        </h3>
                        <p class="text-xs text-surface-500 mt-1">
                            {{ app()->getLocale() === 'ar' ? 'نرحب بزيارتكم لمعرض الحلول والمختبر الهندسي في مقر الشركة' : 'Visit our customer experience center and engineering lab in Riyadh' }}
                        </p>
                    </div>
                    <a href="https://maps.google.com/?q=Riyadh+Saudi+Arabia" target="_blank" rel="noopener" class="btn-secondary text-xs flex-shrink-0 text-white border-white/20 bg-white/5 hover:bg-white/10">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'فتح في خرائط Google' : 'Open in Google Maps' }}</span>
                    </a>
                </div>
                
                <div class="relative w-full h-64 sm:h-80 rounded-2xl overflow-hidden border border-white/10 shadow-inner bg-surface-950">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115993.45663789018!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d48939b%3A0xedd71f8e7ab007b7!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1620000000000!5m2!1sen!2ssa"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="STS Location Map" class="filter grayscale hover:grayscale-0 transition-all duration-500"></iframe>
                </div>
            </div>

        </section>

    </div>
</div>

@endsection
