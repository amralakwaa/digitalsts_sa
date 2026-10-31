@props([
    'title' => null,
    'subtitle' => null,
])

@php
    $items = [
        [
            'badge' => app()->getLocale() === 'ar' ? 'حلول المراقبة والكاميرات الذكية' : 'AI CCTV Surveillance',
            'icon' => '📹',
            'title' => app()->getLocale() === 'ar' ? 'كاميرات مراقبة ذكية 4K بتحليل سلوكي استباقي' : '4K AI Surveillance with Proactive Analytics',
            'description' => app()->getLocale() === 'ar' 
                ? 'أنظمة مراقبة فائقة الدقة مدعومة بالذكاء الاصطناعي لكشف التسلل والتعرف على الوجوه ولوحات المركبات بدقة 99.8%، مع بث سحابي مشفر.'
                : 'Ultra-HD AI-driven surveillance with facial recognition, license plate capture, and instant cloud encryption.',
            'image' => asset('images/services/cctv-surveillance-systems.jpg'),
            'specs' => [
                app()->getLocale() === 'ar' ? 'دقة 4K مع رؤية ليلية ملونة كاملة' : '4K Full-Color Night Vision',
                app()->getLocale() === 'ar' ? 'تحليل ذكي لحركة الأشخاص والمركبات' : 'Smart Object & Person Tracking',
                app()->getLocale() === 'ar' ? 'تخزين سحابي محلي ومشفر NVR' : 'Encrypted Local & Cloud Storage',
                app()->getLocale() === 'ar' ? 'تنبيهات فورية على الهاتف المحمول' : 'Instant Smartphone Push Alerts'
            ],
            'status' => app()->getLocale() === 'ar' ? 'النظام نشط: 32 كاميرا متصلة' : 'System Active: 32 Cams Live',
            'link' => route('services.index')
        ],
        [
            'badge' => app()->getLocale() === 'ar' ? 'التحكم بالدخول والأبواب' : 'Biometric Access Control',
            'icon' => '🛡️',
            'title' => app()->getLocale() === 'ar' ? 'بوابات أمنية وأقفال بيومترية ببصمة الوجه والكف' : 'Biometric Face & Palm Recognition Gates',
            'description' => app()->getLocale() === 'ar'
                ? 'إدارة متكاملة للأمان وتتبع الحضور والانصراف مع بوابات إلكترونية سريعة تمنع الدخول غير المصرح به بأعلى معايير الحماية الدولية.'
                : 'Turnkey access control with rapid face-scan turnstiles, attendance tracking, and anti-tailgating protocols.',
            'image' => asset('images/services/access-control-systems.jpg'),
            'specs' => [
                app()->getLocale() === 'ar' ? 'مطابقة الوجه بأقل من 0.2 ثانية' : 'Sub-0.2s Facial Recognition',
                app()->getLocale() === 'ar' ? 'أقفال كهرومغناطيسية مضادة للاقتحام' : 'Heavy-Duty Magnetic Locks',
                app()->getLocale() === 'ar' ? 'تقارير حضور سحابية لحظية' : 'Real-Time Cloud Time & Attendance',
                app()->getLocale() === 'ar' ? 'تكامل مع إنذار الحريق للطوارئ' : 'Emergency Fire Alarm Integration'
            ],
            'status' => app()->getLocale() === 'ar' ? 'بوابات الأمان: تصريح فوري متاح' : 'Access Gate: Authorized Pass',
            'link' => route('services.index')
        ],
        [
            'badge' => app()->getLocale() === 'ar' ? 'أتمتة الفلل والمنازل الذكية' : 'Smart Home Luxury Automation',
            'icon' => '🏡',
            'title' => app()->getLocale() === 'ar' ? 'تحكم ذكي متكامل بالإضاءة، التكييف، والصوتيات' : 'Unified Luxury Automation for Lighting & Climate',
            'description' => app()->getLocale() === 'ar'
                ? 'حوّل مساحتك إلى بيئة ذكية متناغمة تستجيب لأوامرك الصوتية أو عبر شاشات لمس أنيقة، مع توفير يصل إلى 35% في استهلاك الطاقة.'
                : 'Transform living spaces with voice-activated KNX scenes, smart climate optimization, and multi-room audio.',
            'image' => asset('images/services/smart-home-automation.jpg'),
            'specs' => [
                app()->getLocale() === 'ar' ? 'سيناريوهات ترحيب ونوم مخصصة' : 'Custom Lighting & Ambience Scenes',
                app()->getLocale() === 'ar' ? 'إدارة التكييف الموفر للطاقة' : 'Energy-Saving HVAC Automation',
                app()->getLocale() === 'ar' ? 'ستائر آلية وصوتيات سينمائية' : 'Motorized Shades & Multi-Room Audio',
                app()->getLocale() === 'ar' ? 'تحكم عالمي آمن عبر الجوال' : 'Encrypted Remote Smartphone App'
            ],
            'status' => app()->getLocale() === 'ar' ? 'السيناريو الحالي: وضع الاستقبال' : 'Scene Active: Luxury Ambience',
            'link' => route('services.index')
        ],
        [
            'badge' => app()->getLocale() === 'ar' ? 'مراكز البيانات وشبكات الفايبر' : 'Data Centers & Fiber Infrastructure',
            'icon' => '⚡',
            'title' => app()->getLocale() === 'ar' ? 'بنية تحتية متطورة لكابلات الألياف والشبكات' : 'Enterprise Fiber Optics & Server Infrastructure',
            'description' => app()->getLocale() === 'ar'
                ? 'تجهيز غرف السيرفرات ومراكز البيانات بأحدث كوابل الفايبر والراكّات المنظمة مع أنظمة مراقبة الحرارة وإخماد الحرائق النظيفة FM200.'
                : 'Mission-critical server rooms, high-density structured cabling, FM200 fire suppression, and continuous UPS power.',
            'image' => asset('images/services/data-centers-and-server-rooms.jpg'),
            'specs' => [
                app()->getLocale() === 'ar' ? 'سرعات نقل 10G/40G معتمدة' : 'Certified 10G/40G Fiber Speeds',
                app()->getLocale() === 'ar' ? 'تنظيم الراكّات وتبريد احترافي' : 'Rack Management & In-Row Cooling',
                app()->getLocale() === 'ar' ? 'أنظمة طاقة طوارئ UPS مستمرة' : 'Redundant UPS Power Backup',
                app()->getLocale() === 'ar' ? 'مراقبة بيئية لغرفة الخوادم' : 'Server Room Environmental Telemetry'
            ],
            'status' => app()->getLocale() === 'ar' ? 'جاهزية الشبكة: 99.99% Uptime' : 'Network Uptime: 99.99% Optimal',
            'link' => route('services.index')
        ]
    ];
@endphp

<!-- ========================================================================= -->
<!-- قسم المعرض التفاعلي: تدرج رمادي على رصاصي معدني مع كتابة وصور متحركة -->
<!-- ========================================================================= -->
<section class="py-14 sm:py-20 relative overflow-hidden reveal-scale" 
         x-data="animatedShowcase({ 
             items: {{ json_encode($items) }}, 
             slideDuration: 6000 
         })"
         x-init="initShowcase()">

    <!-- خلفية تطابق لون خلفية الشعار (STS Logo Midnight Black) -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#000418] via-[#010318] to-[#040822] pointer-events-none"></div>

    <!-- شبكة خلفية تقنية رمادية Tech Grid -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#0c8de710_1px,transparent_1px),linear-gradient(to_bottom,#0c8de710_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>

    <!-- هالات ضوئية زرقاء تحاكي توهج الشعار -->
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-600/15 rounded-full blur-[120px] pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-1/4 end-1/4 w-96 h-96 bg-cyan-500/15 rounded-full blur-[140px] pointer-events-none animate-pulse" style="animation-delay: 2s;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        
        <!-- البطاقة الرئيسية الكبرى المحتوية على التصميم بنفس خلفية الشعار -->
        <div class="rounded-3xl border border-white/10 bg-gradient-to-b from-[#030722]/90 via-[#010318]/95 to-[#000418] backdrop-blur-xl shadow-2xl overflow-hidden">
            
            <!-- الرأس وشريط العنوان والأزرار -->
            <div class="px-6 sm:px-10 pt-8 pb-6 border-b border-slate-700/50 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-800 text-slate-300 border border-slate-600/60 mb-3 shadow-inner">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                        <span>{{ $title ?? (app()->getLocale() === 'ar' ? 'عرض تفاعلي حي • أنظمة STS المتطورة' : 'Interactive Showcase • STS Systems') }}</span>
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight flex items-center gap-3">
                        <span>{{ app()->getLocale() === 'ar' ? 'الجيل القادم من الأنظمة الأمنية والذكية' : 'Next-Gen Intelligent Security & Tech' }}</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5">
                        {{ $subtitle ?? (app()->getLocale() === 'ar' ? 'تحكم ذكي متكامل، مراقبة استباقية بالذكاء الاصطناعي، وبنية تحتية عالية الاعتمادية' : 'Full automation, proactive AI surveillance, and ultra-reliable enterprise networking') }}
                    </p>
                </div>

                <!-- أزرار التحكم بالتنقل والتشغيل -->
                <div class="flex items-center gap-2">
                    <button @click="toggleAutoPlay()" 
                            class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-slate-800/90 hover:bg-slate-700 text-slate-200 border border-slate-600/70 transition-all hover:scale-105 active:scale-95 flex items-center gap-1.5 shadow-md">
                        <span class="w-2 h-2 rounded-full" :class="autoPlay ? 'bg-emerald-400 animate-pulse' : 'bg-amber-400'"></span>
                        <span x-text="autoPlay ? ({{ app()->getLocale() === 'ar' ? "'إيقاف مؤقت'" : "'Pause'" }}) : ({{ app()->getLocale() === 'ar' ? "'تشغيل تلقائي'" : "'Auto Play'" }})"></span>
                    </button>

                    <button @click="prev()" 
                            class="p-2.5 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-300 border border-slate-600/70 transition-all hover:scale-105 active:scale-95" 
                            title="{{ app()->getLocale() === 'ar' ? 'السابق' : 'Previous' }}">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>

                    <button @click="next()" 
                            class="p-2.5 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-300 border border-slate-600/70 transition-all hover:scale-105 active:scale-95" 
                            title="{{ app()->getLocale() === 'ar' ? 'التالي' : 'Next' }}">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- شريط التبويبات العلوية -->
            <div class="px-6 sm:px-10 py-3.5 border-b border-slate-700/50 bg-slate-900/60 flex items-center gap-2 overflow-x-auto no-scrollbar">
                <template x-for="(item, index) in items" :key="index">
                    <button @click="goTo(index)" 
                            class="flex-shrink-0 px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 border"
                            :class="currentIndex === index 
                                ? 'bg-gradient-to-r from-slate-700 to-slate-600 text-white border-slate-400 shadow-md scale-102' 
                                : 'bg-slate-800/60 text-slate-400 border-slate-700/80 hover:bg-slate-800 hover:text-slate-200'">
                        <span x-text="item.icon"></span>
                        <span x-text="item.badge"></span>
                    </button>
                </template>
            </div>

            <!-- جسم العرض: الصور المتحركة + النصوص التفاعلية المتحركة -->
            <div class="p-6 sm:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- 1) الجزء البصري: الصورة المتحركة وتأثيرات الليزر والرادار -->
                <div class="lg:col-span-7">
                    <div class="relative rounded-2xl overflow-hidden border border-white/10 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] aspect-[16/10] shadow-2xl group">
                        
                        <!-- الصورة الحقيقية مع تكبير ديناميكي سلس Ken Burns -->
                        <img :src="currentItem.image" 
                             :alt="currentItem.title"
                             class="w-full h-full object-cover transform scale-100 transition-all duration-1000 ease-out group-hover:scale-105 opacity-90">

                        <!-- تدرج لوني يطابق لون خلفية الشعار على أطراف الصورة -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>

                        <!-- خط الليزر الماسح المتحرك رأسياً (Scanning Laser Beam) -->
                        <div class="absolute left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-cyan-400 to-transparent pointer-events-none shadow-[0_0_12px_#22d3ee] animate-pulse"
                             style="animation: scanBeam 3.5s ease-in-out infinite alternate;"></div>

                        <!-- زوايا استهداف تكتيكية HUD Corners -->
                        <div class="absolute top-4 start-4 w-6 h-6 border-t-2 border-s-2 border-cyan-400/90 pointer-events-none"></div>
                        <div class="absolute top-4 end-4 w-6 h-6 border-t-2 border-e-2 border-cyan-400/90 pointer-events-none"></div>
                        <div class="absolute bottom-4 start-4 w-6 h-6 border-b-2 border-s-2 border-cyan-400/90 pointer-events-none"></div>
                        <div class="absolute bottom-4 end-4 w-6 h-6 border-b-2 border-e-2 border-cyan-400/90 pointer-events-none"></div>

                        <!-- شارة البث المباشر العائمة المتحركة -->
                        <div class="absolute top-4 start-5 z-20 flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-900/90 backdrop-blur-md border border-slate-700 text-xs font-mono text-slate-200 shadow-md">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-ping"></span>
                            <span class="font-bold">LIVE • 4K ULTRA</span>
                            <span class="text-slate-400 text-[11px] ps-1 border-s border-slate-700 font-mono" x-text="currentTime"></span>
                        </div>

                        <!-- رادار تكتيكي في الزاوية العلوية -->
                        <div class="absolute top-4 end-5 z-20 w-10 h-10 rounded-full border border-cyan-500/40 bg-slate-900/80 backdrop-blur-md overflow-hidden flex items-center justify-center">
                            <div class="w-full h-full border-r border-t border-cyan-400/70 origin-bottom-left animate-spin" style="animation-duration: 5s;"></div>
                            <div class="absolute w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></div>
                        </div>

                        <!-- البطاقة العائمة السفلية المتحركة (Micro HUD Bar) -->
                        <div class="absolute bottom-4 start-4 end-4 z-20 p-3 rounded-xl bg-slate-900/90 backdrop-blur-lg border border-slate-700/80 flex items-center justify-between text-xs shadow-xl">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_10px_#34d399] animate-pulse"></span>
                                <div>
                                    <p class="text-white font-bold tracking-tight" x-text="currentItem.status"></p>
                                    <p class="text-slate-400 text-[11px]">{{ app()->getLocale() === 'ar' ? 'كشف ذكي مستمر • زمن استجابة 15ms' : 'AI Telemetry • Active Latency 15ms' }}</p>
                                </div>
                            </div>
                            
                            <!-- أعمدة موجات بيانية متحركة (Equalizer Bars) -->
                            <div class="flex items-end gap-1 h-5 px-2">
                                <span class="w-1 bg-cyan-400 rounded-full animate-bounce" style="height: 14px; animation-duration: 1s;"></span>
                                <span class="w-1 bg-cyan-400 rounded-full animate-bounce" style="height: 18px; animation-duration: 0.7s;"></span>
                                <span class="w-1 bg-cyan-400 rounded-full animate-bounce" style="height: 12px; animation-duration: 1.2s;"></span>
                                <span class="w-1 bg-cyan-400 rounded-full animate-bounce" style="height: 20px; animation-duration: 0.9s;"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2) الجزء النصي: الكتابة المتحركة والنصوص التفاعلية -->
                <div class="lg:col-span-5 space-y-5">
                    
                    <!-- الوسم العلوي -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider bg-slate-800/90 text-slate-300 border border-slate-700">
                        <span x-text="currentItem.icon"></span>
                        <span x-text="currentItem.badge"></span>
                    </div>

                    <!-- العنوان الرئيسي مع تأثير الكتابة المتحركة (Typewriter) -->
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight min-h-[64px]">
                            <span x-text="displayedTitle"></span>
                            <span class="inline-block w-2.5 h-6 bg-cyan-400 animate-pulse ms-1 align-middle"></span>
                        </h3>
                    </div>

                    <!-- الوصف المفصل -->
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed min-h-[55px]" x-text="currentItem.description"></p>

                    <!-- المزايا الحية كقوائم تقنية -->
                    <div class="space-y-2 pt-2 border-t border-slate-800">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            {{ app()->getLocale() === 'ar' ? 'المواصفات والخصائص الهندسية:' : 'Engineering Capabilities:' }}
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                            <template x-for="(spec, sIdx) in currentItem.specs" :key="sIdx">
                                <div class="flex items-center gap-2 p-2 rounded-lg bg-slate-800/70 border border-slate-700/60 text-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 flex-shrink-0"></span>
                                    <span class="truncate" x-text="spec"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- شريط التقدم للتبديل التلقائي -->
                    <div class="pt-3">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1 font-mono">
                            <span>{{ app()->getLocale() === 'ar' ? 'مؤشر التبديل التلقائي' : 'Auto Cycle' }}</span>
                            <span x-text="progressPercent + '%'"></span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden border border-slate-700">
                            <div class="h-full bg-gradient-to-r from-slate-400 via-cyan-400 to-slate-200 transition-all duration-100 ease-linear"
                                 :style="`width: ${progressPercent}%`"></div>
                        </div>
                    </div>

                    <!-- أزرار الإجراء السريع -->
                    <div class="pt-3 flex items-center gap-3">
                        <a :href="currentItem.link" 
                           class="flex-1 py-3 px-5 rounded-xl bg-gradient-to-r from-slate-700 via-slate-600 to-slate-700 hover:from-slate-600 hover:to-slate-500 text-white font-bold text-xs sm:text-sm border border-slate-400/50 shadow-lg hover:shadow-cyan-500/10 transition-all active:scale-95 text-center flex items-center justify-center gap-2">
                            <span>{{ app()->getLocale() === 'ar' ? 'استكشاف هذا النظام بالتفصيل' : 'Explore System Details' }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <a href="{{ route('quote.create') }}" 
                           class="py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-semibold text-xs border border-slate-700 transition-all">
                            {{ app()->getLocale() === 'ar' ? 'طلب تسعيرة' : 'Get Quote' }}
                        </a>
                    </div>

                </div>

            </div>

            <!-- الشريط السفلي للمؤشرات والتدرج المعدني -->
            <div class="px-6 py-4 bg-slate-950/80 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'نمط رمادي ورصاصي فخم (Metallic Slate & Charcoal)' : 'Metallic Slate & Charcoal Palette' }}</span>
                </div>
                
                <div class="flex items-center gap-2">
                    <template x-for="(item, index) in items" :key="index">
                        <button @click="goTo(index)" 
                                class="h-2 rounded-full transition-all"
                                :class="currentIndex === index ? 'w-6 bg-cyan-400' : 'w-2 bg-slate-700 hover:bg-slate-500'"></button>
                    </template>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- كود حركة الليزر في الـ CSS والتفاعل عبر Alpine.js -->
<style>
@keyframes scanBeam {
    0% { top: 2%; opacity: 0.9; }
    50% { opacity: 1; }
    100% { top: 96%; opacity: 0.9; }
}
</style>

<script>
function animatedShowcase(config) {
    return {
        items: config.items || [],
        slideDuration: config.slideDuration || 6000,
        currentIndex: 0,
        displayedTitle: '',
        currentTime: '00:00:00',
        autoPlay: true,
        progressPercent: 0,
        timer: null,
        typingInterval: null,
        clockInterval: null,

        get currentItem() {
            return this.items[this.currentIndex] || {};
        },

        initShowcase() {
            this.updateClock();
            this.clockInterval = setInterval(() => this.updateClock(), 1000);
            this.startSlide();
        },

        updateClock() {
            const d = new Date();
            this.currentTime = d.toTimeString().split(' ')[0];
        },

        typeTitle(fullText) {
            if (this.typingInterval) clearInterval(this.typingInterval);
            this.displayedTitle = '';
            let i = 0;
            this.typingInterval = setInterval(() => {
                if (i < fullText.length) {
                    this.displayedTitle += fullText.charAt(i);
                    i++;
                } else {
                    clearInterval(this.typingInterval);
                }
            }, 30);
        },

        startSlide() {
            this.typeTitle(this.currentItem.title || '');
            this.startProgress();
        },

        startProgress() {
            if (this.timer) clearInterval(this.timer);
            this.progressPercent = 0;
            if (!this.autoPlay) return;

            const stepTime = 100;
            const totalSteps = this.slideDuration / stepTime;
            let step = 0;

            this.timer = setInterval(() => {
                step++;
                this.progressPercent = Math.min(100, Math.round((step / totalSteps) * 100));
                if (step >= totalSteps) {
                    clearInterval(this.timer);
                    this.next();
                }
            }, stepTime);
        },

        next() {
            this.currentIndex = (this.currentIndex + 1) % this.items.length;
            this.startSlide();
        },

        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
            this.startSlide();
        },

        goTo(index) {
            this.currentIndex = index;
            this.startSlide();
        },

        toggleAutoPlay() {
            this.autoPlay = !this.autoPlay;
            if (this.autoPlay) {
                this.startProgress();
            } else {
                if (this.timer) clearInterval(this.timer);
                this.progressPercent = 0;
            }
        }
    };
}
</script>

