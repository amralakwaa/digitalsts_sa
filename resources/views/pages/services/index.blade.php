@extends('layouts.app')

@section('title', __('messages.nav_services') . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-10 sm:pb-14 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>{{ __('messages.services_badge') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ __('messages.services_title') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ __('messages.services_subtitle') }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-80 h-80 bg-accent-sky/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-12 reveal-up">
            <form action="{{ route('services.index') }}" method="GET" class="relative group">
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="{{ app()->getLocale() === 'ar' ? 'ابحث في الخدمات (كاميرات، تحكم، ألياف، حريق، منازل ذكية...)' : 'Search solutions (CCTV, Access Control, Fiber, Fire Alarm, Smart Home...)' }}"
                       class="w-full px-5 py-4 pe-12 rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 text-white placeholder-surface-500 text-sm focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 shadow-soft transition-all group-hover:border-white/20">
                <button type="submit" class="absolute end-3 top-1/2 -translate-y-1/2 p-2 text-surface-500 hover:text-brand-400 transition-colors" aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Cross-Navigation Strip to Sectors & Offers -->
        <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mb-12 reveal-up">
            <span class="text-xs text-surface-400 font-medium">
                {{ app()->getLocale() === 'ar' ? 'مسارات استكشاف تخصصية:' : 'Specialized exploration paths:' }}
            </span>
            <a href="{{ route('sectors') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-surface-900/80 hover:bg-white/10 border border-white/10 hover:border-brand-500/40 text-surface-200 hover:text-white text-xs font-semibold backdrop-blur-md transition-all shadow-xs group">
                <span class="text-sm">🏢</span>
                <span>{{ app()->getLocale() === 'ar' ? 'استعراض الحلول حسب القطاع (أبراج، فنادق، صناعي)' : 'Browse by Sector (Corporate, Hospitality, Industrial)' }}</span>
                <svg class="w-3.5 h-3.5 text-brand-400 rtl:rotate-180 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('offers.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-500/10 hover:bg-brand-500/20 border border-brand-500/30 hover:border-brand-500/60 text-brand-300 hover:text-white text-xs font-semibold backdrop-blur-md transition-all shadow-xs group">
                <span class="text-sm">⚡</span>
                <span>{{ app()->getLocale() === 'ar' ? 'باقات وعروض الأنظمة المتكاملة' : 'Turnkey System Packages & Special Offers' }}</span>
                <svg class="w-3.5 h-3.5 text-brand-400 rtl:rotate-180 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Grid of 12 Services -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-stagger="80">
            @forelse($services as $index => $service)
                <div class="reveal-up hover-lift">
                    <x-service-card :service="$service" />
                </div>
            @empty
                <div class="col-span-3 text-center py-16 rounded-3xl p-8 text-surface-400 reveal-up bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-surface-800 flex items-center justify-center text-surface-500 border border-white/10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-white mb-2">{{ app()->getLocale() === 'ar' ? 'لم يتم العثور على نتائج مطابقة للبحث.' : 'No services found matching your query.' }}</p>
                    <a href="{{ route('services.index') }}" class="btn-secondary text-xs mt-3 text-white border-white/20 bg-white/5 hover:bg-white/10">
                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط البحث' : 'Reset Search' }}
                    </a>
                </div>
            @endforelse
        </div>

        <!-- ============================================= -->
        <!-- Promotional Offers & Packages Section -->
        <!-- ============================================= -->
        @if(isset($allOffers) && $allOffers->isNotEmpty())
            <div class="mt-24 pt-16 border-t-2 border-white/10" id="offers-section">
                
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-14 reveal-up">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md">
                        <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'باقات وحلول تسليم مفتاح' : 'Turnkey Solution Packages' }}</span>
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-4">
                        {{ app()->getLocale() === 'ar' ? 'عروض وباقات الخدمات الجاهزة' : 'Ready-to-Deploy Service Packages' }}
                    </h2>
                    <p class="text-base sm:text-lg text-surface-400 max-w-2xl mx-auto">
                        {{ app()->getLocale() === 'ar' ? 'حلول هندسية شاملة بأسعار شفافة مدروسة، مع ضمان وصيانة وتوافق كامل مع اشتراطات الدفاع المدني السعودي.' : 'Complete engineered solutions with transparent pricing, full warranty, maintenance SLA, and Saudi Civil Defense compliance.' }}
                    </p>
                </div>

                <!-- Offers Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-stagger="80">
                    @foreach($allOffers as $offerIndex => $offer)
                        <div class="relative rounded-3xl overflow-hidden flex flex-col justify-between transition-all duration-300 group {{ $offer->is_featured ? 'bg-surface-900/80 backdrop-blur-md border-2 border-brand-500 ring-4 ring-brand-500/15 shadow-brand-glow/20' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 hover:border-brand-500/40 shadow-soft' }} reveal-up hover-lift">
                            
                            {{-- Image Banner if available (STS Logo Palette) --}}
                            @if($offer->image_url)
                                <a href="{{ route('offers.show', $offer->slug) }}" class="block relative h-44 w-full overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-zoom img-skeleton-holder">
                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out img-lazy-transition" loading="lazy" decoding="async">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent"></div>
                                </a>
                            @endif

                            {{-- Featured / Promo Badge --}}
                            @if($offer->badge_text || $offer->is_featured)
                                <div class="absolute {{ $offer->image_url ? 'top-3.5' : '-top-3.5' }} start-1/2 -translate-x-1/2 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-gradient-to-r from-brand-600 to-brand-500 text-white text-[11px] font-black uppercase tracking-wider shadow-brand-glow">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span>{{ $offer->badge_text ?: (app()->getLocale() === 'ar' ? 'الأكثر طلباً' : 'Most Popular') }}</span>
                                    </span>
                                </div>
                            @endif

                            <div class="p-6 sm:p-8 flex-grow flex flex-col justify-between">
                            <div class="space-y-5 {{ (!$offer->image_url && ($offer->badge_text || $offer->is_featured)) ? 'pt-3' : '' }}">
                                {{-- Service Tag --}}
                                @if($offer->service)
                                    <a href="{{ route('services.show', $offer->service->slug) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-brand-500/10 hover:bg-brand-500/20 text-brand-300 hover:text-brand-200 text-[11px] font-bold uppercase tracking-wider transition-colors border border-brand-500/20 hover:border-brand-500/40">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        {{ $offer->service->title }}
                                    </a>
                                @endif

                                {{-- Discount Badge --}}
                                @if($offer->discount_percentage)
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-500/15 text-emerald-400 text-xs font-bold border border-emerald-500/25">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>{{ app()->getLocale() === 'ar' ? 'وفّر ' . $offer->discount_percentage . '%' : 'Save ' . $offer->discount_percentage . '%' }}</span>
                                    </div>
                                @endif

                                {{-- Title & Description --}}
                                <div>
                                    <h3 class="text-lg sm:text-xl font-black text-white mb-2 leading-tight hover:text-brand-300 transition-colors">
                                        <a href="{{ route('offers.show', $offer->slug) }}">
                                            {{ $offer->title }}
                                        </a>
                                    </h3>
                                    <p class="text-xs sm:text-sm text-surface-400 leading-relaxed line-clamp-3">{{ $offer->description }}</p>
                                </div>

                                {{-- Price Block --}}
                                <div class="py-4 border-y border-white/10 space-y-1.5">
                                    <div class="flex items-baseline gap-2 flex-wrap">
                                        @if($offer->discount_price && $offer->discount_price > 0 && $offer->price > $offer->discount_price)
                                            <span class="text-sm text-surface-500 line-through font-mono">{{ number_format($offer->price, 0) }}</span>
                                            <span class="text-3xl sm:text-4xl font-black text-white font-mono tracking-tight">{{ number_format($offer->discount_price, 0) }}</span>
                                        @else
                                            <span class="text-3xl sm:text-4xl font-black text-white font-mono tracking-tight">{{ number_format($offer->price, 0) }}</span>
                                        @endif
                                        <span class="text-xs font-bold text-surface-500 uppercase">
                                            {{ $offer->currency ?: 'SAR' }} / {{ $offer->billing_period_label }}
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-surface-500">
                                        {{ app()->getLocale() === 'ar' ? 'السعر غير شامل ضريبة القيمة المضافة 15% (ZATCA)' : 'Excludes 15% ZATCA VAT' }}
                                    </p>
                                </div>

                                {{-- Deliverables / Features --}}
                                @php $featuresList = $offer->features ?? []; @endphp
                                @if(!empty($featuresList))
                                    <div class="space-y-2.5">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-surface-500 block">{{ app()->getLocale() === 'ar' ? 'يشمل العرض:' : 'Package Includes:' }}</span>
                                        <ul class="space-y-2">
                                            @foreach(array_slice($featuresList, 0, 5) as $deliv)
                                                <li class="flex items-start gap-2.5 text-xs text-surface-300">
                                                    <svg class="w-4 h-4 text-brand-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                    <span class="leading-relaxed">{{ $deliv }}</span>
                                                </li>
                                            @endforeach
                                            @if(count($featuresList) > 5)
                                                <li class="text-[11px] text-brand-400 font-semibold ps-6">
                                                    +{{ count($featuresList) - 5 }} {{ app()->getLocale() === 'ar' ? 'ميزة إضافية' : 'more features' }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            {{-- Footer: Delivery, Warranty, CTA --}}
                            <div class="mt-8 space-y-4">
                                @if($offer->valid_until)
                                    <div class="flex items-center justify-between text-[11px] text-surface-500 border-t border-white/10 pt-3">
                                        <span class="flex items-center gap-1.5 text-amber-400 font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>{{ app()->getLocale() === 'ar' ? 'ساري حتى: ' . $offer->valid_until->format('Y-m-d') : 'Valid until: ' . $offer->valid_until->format('Y-m-d') }}</span>
                                        </span>
                                    </div>
                                @endif

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('offers.show', $offer->slug) }}" 
                                       class="btn-secondary text-xs py-3 px-4 rounded-xl text-center flex-shrink-0 text-white border-white/20 bg-white/5 hover:bg-white/10">
                                        <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل الباقة' : 'Details' }}</span>
                                    </a>
                                    <a href="{{ route('quote.create', ['service' => optional($offer->service)->slug, 'package' => $offer->slug]) }}" 
                                       class="flex-1 justify-center btn-primary text-xs py-3 rounded-xl transition-all text-center inline-flex items-center gap-1.5">
                                        <span>{{ app()->getLocale() === 'ar' ? 'طلب هذه الباقة' : 'Request Package' }}</span>
                                        <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Bottom CTA --}}
                <div class="mt-12 text-center reveal-up">
                    <p class="text-xs text-surface-500 mb-4">
                        {{ app()->getLocale() === 'ar' ? 'لم تجد الباقة المناسبة؟ نقدم حلولاً مخصصة حسب احتياجات منشأتك.' : "Can't find the right package? We offer custom solutions tailored to your facility needs." }}
                    </p>
                    <a href="{{ route('quote.create') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'اطلب عرض سعر مخصص' : 'Request a Custom Quote' }}</span>
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
