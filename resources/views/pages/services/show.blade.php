@extends('layouts.app')

@section('title', $service->title . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-surface-300/80 mb-6 font-medium reveal-up">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('messages.nav_home') }}</a>
            <span class="text-surface-500">/</span>
            <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">{{ __('messages.nav_services') }}</a>
            <span class="text-surface-500">/</span>
            <span class="text-brand-300 font-semibold truncate">{{ $service->title }}</span>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>{{ app()->getLocale() === 'ar' ? 'حلول هندسية متكاملة' : 'Engineered Solution' }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up leading-tight" data-reveal-delay="100">
                {{ $service->title }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ $service->description }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-12">
                
                @if($service->image)
                    <!-- Service Showcase Visual (STS Logo Palette) -->
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-soft-xl aspect-[16/9] group bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] reveal-scale img-skeleton-holder">
                        <img src="{{ asset($service->image) }}" 
                             alt="{{ $service->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 img-lazy-transition"
                             loading="lazy" decoding="async">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-4 start-4 sm:bottom-6 sm:start-6 z-10">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-surface-900/90 backdrop-blur-md border border-white/20 text-white shadow-lg">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>{{ $service->title }}</span>
                            </span>
                        </div>
                    </div>
                @endif

                <!-- Comprehensive Description -->
                <div class="rounded-3xl p-8 sm:p-10 space-y-4 text-surface-300 leading-relaxed text-base reveal-up bg-surface-900/70 backdrop-blur-md border border-white/10 shadow-soft">
                    <h2 class="text-xl font-black text-white flex items-center gap-3 mb-4">
                        <span class="w-10 h-10 rounded-2xl bg-brand-500/15 text-brand-300 flex items-center justify-center border border-brand-500/30 shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <span>{{ app()->getLocale() === 'ar' ? 'نظرة عامة على الحل التقني' : 'Engineering Solution Overview' }}</span>
                    </h2>
                    <p class="whitespace-pre-line text-surface-300 leading-relaxed text-sm sm:text-base">{{ $service->content }}</p>
                </div>

                <!-- Key Technical Features -->
                @if(!empty($service->features))
                    <div class="space-y-6 reveal-up">
                        <h2 class="text-2xl font-black text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-400"></span>
                            <span>{{ app()->getLocale() === 'ar' ? 'المواصفات والخصائص الهندسية' : 'Key Technical Capabilities' }}</span>
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" data-reveal-stagger="60">
                            @foreach($service->features as $index => $feat)
                                <div class="rounded-2xl p-5 flex items-start gap-3.5 bg-surface-900/70 backdrop-blur-md border border-white/10 hover:border-brand-500/40 transition-all duration-300 group shadow-soft reveal-up hover-lift">
                                    <div class="w-7 h-7 rounded-xl bg-brand-500/15 text-brand-300 group-hover:bg-brand-500 group-hover:text-white flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-xs sm:text-sm text-surface-200 font-semibold leading-relaxed">{{ $feat }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Business & Safety Benefits -->
                @if(!empty($service->benefits))
                    <div class="space-y-6 reveal-up">
                        <h2 class="text-2xl font-black text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                            <span>{{ app()->getLocale() === 'ar' ? 'العائد والقيمة المضافة لمنشأتك' : 'Business & Security Value' }}</span>
                        </h2>

                        <div class="space-y-3" data-reveal-stagger="60">
                            @foreach($service->benefits as $benefit)
                                <div class="p-4 sm:p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-200 flex items-start gap-3.5 backdrop-blur-sm reveal-up hover-lift">
                                    <div class="w-7 h-7 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs sm:text-sm font-bold leading-relaxed">{{ $benefit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Beneficiary Sectors -->
                @if(!empty($service->sectors))
                    <div class="space-y-4 reveal-up">
                        <h3 class="text-base font-black text-white">
                            {{ app()->getLocale() === 'ar' ? 'القطاعات والمنشآت المستفيدة' : 'Target Industry Sectors' }}
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($service->sectors as $sec)
                                <span class="px-4 py-2 rounded-2xl text-xs font-bold bg-surface-900/70 border border-white/10 text-surface-300 shadow-soft">
                                    {{ $sec }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sticky Sidebar: Direct Quote Request Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-3xl p-8 sticky top-28 border border-brand-500/30 bg-surface-900/80 backdrop-blur-md shadow-brand-glow/20 space-y-6 text-center reveal-scale">
                    
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brand-600 to-brand-400 mx-auto flex items-center justify-center text-white shadow-brand-glow">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-white">
                            {{ app()->getLocale() === 'ar' ? 'طلب عرض سعر للخدمة' : 'Request Engineering Quote' }}
                        </h3>
                        <p class="text-xs text-surface-400 leading-relaxed">
                            {{ app()->getLocale() === 'ar' ? 'احصل على دراسة فنية متخصصة وعرض سعر رسمي مخصص لمنشأتك.' : 'Request an itemized technical proposal and site inspection from our certified engineers.' }}
                        </p>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('quote.create', ['service' => $service->slug]) }}" 
                           class="btn-primary w-full justify-center text-sm py-3.5 shadow-brand-glow">
                            <span>{{ __('messages.nav_quote_btn') }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '966506761942')) }}?text={{ urlencode('مرحباً، أود الاستفسار عن خدمة ' . $service->title) }}" 
                           target="_blank" rel="noopener"
                           class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-emerald-500/15 hover:bg-emerald-500/25 text-emerald-300 border border-emerald-500/30 text-xs font-bold transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'استشارة عبر واتساب' : 'WhatsApp Inquiry' }}</span>
                        </a>
                    </div>

                    <div class="pt-5 border-t border-white/10 space-y-3 text-xs text-surface-400 text-start">
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium text-surface-300">{{ app()->getLocale() === 'ar' ? 'معاينة ميدانية وتخطيط هندسي' : 'On-site survey & engineering plans' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium text-surface-300">{{ app()->getLocale() === 'ar' ? 'مواصفات مطابقة للدفاع المدني' : 'Civil Defense compliant hardware' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="font-medium text-surface-300">{{ app()->getLocale() === 'ar' ? 'ضمان شامل وعقود صيانة SLA' : 'Full warranty & SLA maintenance' }}</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Service Offers & Packages Section -->
        @if(isset($offers) && $offers->isNotEmpty())
            <div class="mt-24 pt-16 border-t border-white/10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 reveal-up">
                    <div>
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 backdrop-blur-md">
                            <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'باقات وحلول جاهزة' : 'Ready Turnkey Packages' }}</span>
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                            {{ app()->getLocale() === 'ar' ? 'باقات وعروض خاصة لـ ' . $service->title : 'Special Bundles for ' . $service->title }}
                        </h2>
                    </div>
                    <p class="text-xs sm:text-sm text-surface-400 max-w-md">
                        {{ app()->getLocale() === 'ar' ? 'حلول تسليم مفتاح بأسعار شفافة مدروسة ومطابقة لأعلى معايير الجودة والسلامة.' : 'Turnkey engineered packages with transparent pricing, full SLA warranty, and compliance.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-stagger="80">
                    @foreach($offers as $index => $offer)
                        <div class="relative rounded-3xl overflow-hidden flex flex-col justify-between transition-all duration-300 {{ $offer->is_featured ? 'bg-surface-900/80 backdrop-blur-md border-2 border-brand-500 ring-4 ring-brand-500/15 shadow-brand-glow/20' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 hover:border-brand-500/40 shadow-soft' }} reveal-up hover-lift">
                            @if($offer->image_url)
                                <a href="{{ route('offers.show', $offer->slug) }}" class="block relative h-48 w-full overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 group/img img-skeleton-holder">
                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-500 img-lazy-transition" loading="lazy" decoding="async">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent"></div>
                                </a>
                            @endif

                            @if($offer->badge_text || $offer->is_featured)
                                <div class="absolute {{ $offer->image_url ? 'top-3.5' : '-top-3.5' }} start-1/2 -translate-x-1/2 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-600 text-white text-[11px] font-black uppercase tracking-wider shadow-brand-glow">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span>{{ $offer->badge_text ?: (app()->getLocale() === 'ar' ? 'الأكثر طلباً' : 'Most Popular') }}</span>
                                    </span>
                                </div>
                            @endif

                            <div class="p-6 sm:p-8 flex-grow flex flex-col justify-between space-y-4">
                                <div class="space-y-4 {{ (!$offer->image_url && ($offer->badge_text || $offer->is_featured)) ? 'pt-2' : '' }}">
                                    @if($offer->discount_percentage)
                                        <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-500/15 text-emerald-300 text-xs font-bold border border-emerald-500/30">
                                            <span>{{ app()->getLocale() === 'ar' ? 'خصم ' . $offer->discount_percentage . '%' : 'Save ' . $offer->discount_percentage . '%' }}</span>
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="text-xl font-black text-white mb-2 hover:text-brand-300 transition-colors">
                                            <a href="{{ route('offers.show', $offer->slug) }}">
                                                {{ $offer->title }}
                                            </a>
                                        </h3>
                                        <p class="text-xs sm:text-sm text-surface-400 leading-relaxed">{{ $offer->description }}</p>
                                    </div>

                                    <!-- Price block -->
                                    <div class="py-4 border-y border-white/10 space-y-1">
                                        <div class="flex items-baseline gap-2 flex-wrap">
                                            @if($offer->discount_price && $offer->discount_price > 0 && $offer->price > $offer->discount_price)
                                                <span class="text-sm text-surface-500 line-through font-mono">{{ number_format($offer->price, 0) }}</span>
                                                <span class="text-3xl font-black text-white font-mono tracking-tight">{{ number_format($offer->discount_price, 0) }}</span>
                                            @else
                                                <span class="text-3xl font-black text-white font-mono tracking-tight">{{ number_format($offer->price, 0) }}</span>
                                            @endif
                                            <span class="text-xs font-bold text-surface-400 uppercase">{{ $offer->currency ?: 'SAR' }} / {{ $offer->billing_period_label }}</span>
                                        </div>
                                    </div>

                                    <!-- Features / Deliverables -->
                                    @php $featuresList = $offer->features ?? []; @endphp
                                    @if(!empty($featuresList))
                                        <div class="space-y-2 pt-2">
                                            <span class="text-xs font-bold uppercase tracking-wider text-surface-400 block">{{ app()->getLocale() === 'ar' ? 'المحتويات والخدمات المشمولة:' : 'Included Deliverables:' }}</span>
                                            <ul class="space-y-2 text-xs text-surface-300">
                                                @foreach(array_slice($featuresList, 0, 3) as $deliv)
                                                    <li class="flex items-start gap-2.5">
                                                        <svg class="w-4 h-4 text-brand-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span class="leading-relaxed font-medium">{{ $deliv }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-4 border-t border-white/10 flex items-center gap-2">
                                    <a href="{{ route('offers.show', $offer->slug) }}" 
                                       class="btn-secondary text-xs py-3 px-4 rounded-xl text-center flex-shrink-0 text-white border-white/10 bg-white/5 hover:bg-white/10">
                                        <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل الباقة' : 'Details' }}</span>
                                    </a>
                                    <a href="{{ route('quote.create', ['service' => $service->slug, 'package' => $offer->slug]) }}" 
                                       class="flex-1 justify-center btn-primary text-xs py-3 rounded-xl text-center inline-flex items-center gap-1.5 shadow-brand-glow">
                                        <span>{{ app()->getLocale() === 'ar' ? 'طلب الباقة' : 'Request' }}</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Related Services -->
        @if($relatedServices->isNotEmpty())
            <div class="mt-24 pt-16 border-t border-white/10">
                <div class="mb-8 reveal-up">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-2 backdrop-blur-md">
                        {{ app()->getLocale() === 'ar' ? 'حلول متكاملة' : 'Integrated Systems' }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white">
                        {{ app()->getLocale() === 'ar' ? 'حلول تقنية وأمنية ذات صلة' : 'Related Engineering Solutions' }}
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-reveal-stagger="80">
                    @foreach($relatedServices as $index => $related)
                        <div class="reveal-up hover-lift">
                            <x-service-card :service="$related" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
