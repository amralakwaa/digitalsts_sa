@extends('layouts.app')

@section('title', $offer->title . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-surface-300/80 mb-6 font-medium overflow-x-auto no-scrollbar py-1 reveal-up">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors flex items-center gap-1">
                <span>{{ __('messages.nav_home') }}</span>
            </a>
            <span class="text-surface-500">/</span>
            <a href="{{ route('offers.index') }}" class="hover:text-white transition-colors">
                {{ app()->getLocale() === 'ar' ? 'الباقات والعروض' : 'Packages & Offers' }}
            </a>
            @if($offer->service)
                <span class="text-surface-500">/</span>
                <a href="{{ route('services.show', $offer->service->slug) }}" class="hover:text-white transition-colors">
                    {{ $offer->service->title }}
                </a>
            @endif
            <span class="text-surface-500">/</span>
            <span class="text-brand-300 font-semibold truncate">{{ $offer->title }}</span>
        </nav>

        <div class="max-w-3xl">
            <div class="flex flex-wrap items-center gap-2 mb-4 reveal-up">
                @if($offer->service)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/20 text-brand-300 border border-brand-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                        <span>{{ $offer->service->title }}</span>
                    </span>
                @endif

                @if($offer->badge_text || $offer->is_featured)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-brand-600 to-brand-500 text-white text-xs font-black uppercase tracking-wider shadow-brand-glow">
                        <span>★</span>
                        <span>{{ $offer->badge_text ?: (app()->getLocale() === 'ar' ? 'باقة مميزة' : 'Featured Package') }}</span>
                    </span>
                @endif

                @if($offer->discount_percentage)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-500/30">
                        <span>{{ app()->getLocale() === 'ar' ? 'وفر ' . $offer->discount_percentage . '%' : 'Save ' . $offer->discount_percentage . '%' }}</span>
                    </span>
                @endif
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up leading-tight" data-reveal-delay="100">
                {{ $offer->title }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ $offer->description }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            
            <!-- Left / Main Column (Offer Details) -->
            <div class="lg:col-span-2 space-y-10">

                <!-- Showcase Media Image (STS Logo Palette) -->
                @if($offer->image_url)
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-soft-xl aspect-[16/9] group bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] reveal-scale img-skeleton-holder">
                        <img src="{{ $offer->image_url }}" 
                             alt="{{ $offer->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 img-lazy-transition"
                             loading="lazy" decoding="async">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>
                        
                        <!-- Floating Badge on Media -->
                        <div class="absolute bottom-4 start-4 sm:bottom-6 sm:start-6 z-10 flex items-center gap-2">
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-surface-900/90 backdrop-blur-md border border-white/20 text-white shadow-lg">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>{{ app()->getLocale() === 'ar' ? 'باقة تسليم مفتاح جاهزة' : 'Turnkey Ready Package' }}</span>
                            </span>
                        </div>
                    </div>
                @endif

                <!-- Included Features & Scope of Work -->
                @php $featuresList = $offer->features ?? []; @endphp
                @if(!empty($featuresList))
                    <div class="rounded-3xl p-6 sm:p-8 space-y-6 reveal-up border border-white/10 bg-surface-900/70 backdrop-blur-md shadow-soft">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-2xl bg-brand-500/15 text-brand-300 flex items-center justify-center border border-brand-500/30 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </span>
                                <span>{{ app()->getLocale() === 'ar' ? 'المواصفات والتجهيزات المشمولة بالباقة' : 'Included Deliverables & Specifications' }}</span>
                            </h2>
                            <span class="text-xs text-brand-300 bg-brand-500/15 px-3 py-1 rounded-xl font-mono font-bold border border-brand-500/30">{{ count($featuresList) }} {{ app()->getLocale() === 'ar' ? 'بنود' : 'Items' }}</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" data-reveal-stagger="60">
                            @foreach($featuresList as $feat)
                                <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 flex items-start gap-3 hover:border-brand-500/40 transition-colors reveal-up hover-lift">
                                    <div class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-xs sm:text-sm text-surface-200 font-semibold leading-relaxed">{{ $feat }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Engineering Standards & Compliance -->
                <div class="rounded-3xl p-6 sm:p-8 space-y-6 reveal-up border border-white/10 bg-surface-900/70 backdrop-blur-md shadow-soft">
                    <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center border border-emerald-500/30 shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </span>
                        <span>{{ app()->getLocale() === 'ar' ? 'معايير التنفيذ والضمان الهندسي' : 'Engineering Warranty & Standards' }}</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" data-reveal-stagger="70">
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 space-y-1.5 reveal-up hover-lift">
                            <div class="text-brand-300 font-bold text-sm flex items-center gap-1.5">
                                <span>🛡️</span>
                                <span>{{ app()->getLocale() === 'ar' ? 'ضمان رسمي سنتين' : '2-Year Full Warranty' }}</span>
                            </div>
                            <p class="text-xs text-surface-400 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'ضمان شامل للأجهزة وقطع الغيار ضد العيوب المصنعية مع صيانة دورية.' : 'Comprehensive hardware warranty with certified replacements and SLA support.' }}
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 space-y-1.5 reveal-up hover-lift">
                            <div class="text-emerald-400 font-bold text-sm flex items-center gap-1.5">
                                <span>📋</span>
                                <span>{{ app()->getLocale() === 'ar' ? 'اعتماد الدفاع المدني' : 'Civil Defense Compliant' }}</span>
                            </div>
                            <p class="text-xs text-surface-400 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'مخططات ومعدات متوافقة مع متطلبات كود البناء السعودي ومنصة سلامة.' : 'Fully aligned with Saudi Building Code (SBC) and Salamah platform inspection.' }}
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 space-y-1.5 reveal-up hover-lift">
                            <div class="text-purple-400 font-bold text-sm flex items-center gap-1.5">
                                <span>👷</span>
                                <span>{{ app()->getLocale() === 'ar' ? 'مهندسون وفنيون معتمدون' : 'Certified Engineers' }}</span>
                            </div>
                            <p class="text-xs text-surface-400 leading-relaxed">
                                {{ app()->getLocale() === 'ar' ? 'إشراف ميداني وتركيب احترافي وبرمجة متقدمة تضمن أقصى أداء.' : 'Supervised installation and software commissioning by certified specialists.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Execution Workflow Steps -->
                <div class="rounded-3xl p-6 sm:p-8 space-y-6 reveal-up border border-white/10 bg-surface-900/70 backdrop-blur-md shadow-soft">
                    <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-2xl bg-amber-500/20 text-amber-300 flex items-center justify-center border border-amber-500/30 shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </span>
                        <span>{{ app()->getLocale() === 'ar' ? 'مراحل تنفيذ الباقة' : 'Implementation Workflow' }}</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-start" data-reveal-stagger="70">
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs font-mono font-black text-brand-400 block mb-1">01. الطلب والمسح</span>
                            <span class="text-xs text-surface-200 font-semibold block">{{ app()->getLocale() === 'ar' ? 'تأكيد المتطلبات والمسح الميداني' : 'Scope confirmation & survey' }}</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs font-mono font-black text-brand-400 block mb-1">02. التوريد الهندسي</span>
                            <span class="text-xs text-surface-200 font-semibold block">{{ app()->getLocale() === 'ar' ? 'تجهيز الأجهزة والكوابل المعتمدة' : 'Hardware staging & logistics' }}</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs font-mono font-black text-brand-400 block mb-1">03. التثبيت والبرمجة</span>
                            <span class="text-xs text-surface-200 font-semibold block">{{ app()->getLocale() === 'ar' ? 'التمديدات والمعايرة والربط' : 'Cabling, mounting & config' }}</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs font-mono font-black text-emerald-400 block mb-1">04. الاختبار والتسليم</span>
                            <span class="text-xs text-surface-200 font-semibold block">{{ app()->getLocale() === 'ar' ? 'التشغيل التجريبي وإصدار الشهادات' : 'Testing, handover & sign-off' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column (Sticky Pricing, Quick Order & Actions) -->
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-3xl p-6 sm:p-8 sticky top-24 border border-brand-500/30 shadow-brand-glow/20 space-y-6 bg-surface-900/80 backdrop-blur-md reveal-scale text-white">
                    
                    <!-- Pricing Header -->
                    <div class="text-center pb-6 border-b border-white/10">
                        <span class="text-xs font-bold text-brand-300 uppercase tracking-wider block mb-2">
                            {{ app()->getLocale() === 'ar' ? 'السعر التقديري للباقة' : 'Package Pricing Scope' }}
                        </span>

                        <div class="flex items-baseline justify-center gap-2 flex-wrap my-2">
                            @if($offer->discount_price && $offer->discount_price > 0 && $offer->price > $offer->discount_price)
                                <span class="text-sm sm:text-base text-surface-500 line-through font-mono">
                                    {{ number_format($offer->price, 0) }}
                                </span>
                                <span class="text-4xl sm:text-5xl font-black text-white font-mono tracking-tight">
                                    {{ number_format($offer->discount_price, 0) }}
                                </span>
                            @else
                                <span class="text-4xl sm:text-5xl font-black text-white font-mono tracking-tight">
                                    {{ number_format($offer->price, 0) }}
                                </span>
                            @endif
                            <span class="text-sm font-bold text-surface-400 uppercase">
                                {{ $offer->currency ?: 'SAR' }}
                            </span>
                        </div>

                        <span class="inline-block text-xs font-bold text-brand-300 bg-brand-500/20 px-3 py-1 rounded-full border border-brand-500/30">
                            {{ $offer->billing_period_label }}
                        </span>

                        <p class="text-[11px] text-surface-400 mt-2">
                            {{ app()->getLocale() === 'ar' ? 'الأسعار غير شاملة ضريبة القيمة المضافة 15% (ZATCA)' : 'Prices exclude 15% ZATCA VAT' }}
                        </p>
                    </div>

                    <!-- Primary Action CTA -->
                    <div class="space-y-3">
                        <a href="{{ route('quote.create', ['service' => optional($offer->service)->slug, 'package' => $offer->slug]) }}" 
                           class="btn-primary w-full justify-center text-sm py-4 rounded-xl shadow-brand-glow text-center font-bold">
                            <span>{{ app()->getLocale() === 'ar' ? 'طلب عرض سعر رسمي لهذه الباقة' : 'Request Official Quote for Package' }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <!-- Direct WhatsApp Inquiry -->
                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '966506761942'));
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode(app()->getLocale() === 'ar' ? 'السلام عليكم، أود الاستفسار وطلب تفاصيل باقة: ' . $offer->title : 'Hello, I would like to inquire about the package: ' . $offer->title) }}" 
                           target="_blank"
                           rel="noopener"
                           class="w-full justify-center inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-xs active:scale-95 transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.589 1.761.882 2.796.882 3.183 0 5.772-2.587 5.772-5.769 0-3.181-2.59-5.766-5.772-5.766zm8.814 5.765c0 4.887-3.974 8.862-8.814 8.862-1.554 0-3.016-.411-4.288-1.127l-4.743 1.243 1.268-4.633c-.808-1.328-1.272-2.883-1.272-4.545 0-4.888 3.974-8.864 8.814-8.864 4.841 0 8.815 3.976 8.815 8.864z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'استفسار عبر واتساب' : 'Inquire via WhatsApp' }}</span>
                        </a>
                    </div>

                    <!-- Trust Checkpoints -->
                    <div class="pt-5 border-t border-white/10 space-y-3 text-xs text-surface-300 text-start">
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'معاينة موقعية مجانية للمشاريع' : 'Free on-site engineering survey' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'شهادة إنجاز ومطابقة للدفاع المدني' : 'Civil Defense compliant certificate' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'ضمان الأجهزة والمعدات سنتين' : '2-Year manufacturer warranty' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium">{{ app()->getLocale() === 'ar' ? 'دعم فني واستجابة طارئة 24/7' : '24/7 rapid technical support SLA' }}</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Related Offers / Other Packages -->
        @if(isset($relatedOffers) && $relatedOffers->isNotEmpty())
            <div class="mt-24 pt-16 border-t border-white/10">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10 reveal-up">
                    <div>
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-2 backdrop-blur-md">
                            <span>{{ app()->getLocale() === 'ar' ? 'حلول بديلة ومكملة' : 'Alternative Packages' }}</span>
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            {{ app()->getLocale() === 'ar' ? 'باقات وعروض هندسية أخرى قد تهمك' : 'Other Pre-Engineered Turnkey Packages' }}
                        </h2>
                    </div>

                    <a href="{{ route('offers.index') }}" class="btn-secondary text-xs px-5 py-2.5 rounded-xl self-start sm:self-auto text-white border-white/20 bg-white/5 hover:bg-white/10">
                        <span>{{ app()->getLocale() === 'ar' ? 'استعراض كافة العروض' : 'View All Offers' }}</span>
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" data-reveal-stagger="80">
                    @foreach($relatedOffers as $index => $relOffer)
                        <div class="rounded-3xl overflow-hidden flex flex-col justify-between group border border-white/10 hover:border-brand-500/40 bg-surface-900/70 backdrop-blur-md shadow-soft hover:shadow-brand-glow/20 transition-all reveal-up hover-lift">
                            @if($relOffer->image_url)
                                <a href="{{ route('offers.show', $relOffer->slug) }}" class="block relative h-40 w-full overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-skeleton-holder">
                                    <img src="{{ $relOffer->image_url }}" alt="{{ $relOffer->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 img-lazy-transition" loading="lazy" decoding="async">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent"></div>
                                </a>
                            @endif

                            <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    @if($relOffer->service)
                                        <span class="text-[11px] font-bold text-brand-300 bg-brand-500/15 px-2.5 py-1 rounded-lg inline-block border border-brand-500/30">
                                            {{ $relOffer->service->title }}
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-black text-white group-hover:text-brand-300 transition-colors line-clamp-1">
                                        <a href="{{ route('offers.show', $relOffer->slug) }}">{{ $relOffer->title }}</a>
                                    </h3>
                                    <p class="text-xs text-surface-400 line-clamp-2 leading-relaxed">{{ $relOffer->description }}</p>
                                </div>

                                <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                                    <div class="font-mono">
                                        <span class="text-xl font-black text-white">
                                            {{ number_format($relOffer->effective_price, 0) }}
                                        </span>
                                        <span class="text-[11px] font-bold text-surface-400 uppercase">{{ $relOffer->currency ?: 'SAR' }}</span>
                                    </div>

                                    <a href="{{ route('offers.show', $relOffer->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-brand-400 hover:text-brand-300">
                                        <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل الباقة' : 'View Scope' }}</span>
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
