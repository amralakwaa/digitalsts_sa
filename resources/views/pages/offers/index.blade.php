@extends('layouts.app')

@section('title', (app()->getLocale() === 'ar' ? 'باقات وعروض الخدمات الجاهزة' : 'Engineered Service Packages') . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>{{ app()->getLocale() === 'ar' ? 'حلول وباقات تسليم مفتاح' : 'Turnkey Service Packages' }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ app()->getLocale() === 'ar' ? 'عروض وباقات متكاملة بأسعار شفافة' : 'Pre-Engineered Packages & Turnkey Solutions' }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ app()->getLocale() === 'ar' ? 'اختر باقتك المفضلة واستعرض التفاصيل الهندسية والضمانات، أو اطلب عرض سعر رسمي مخصص لمنشأتك.' : 'Explore pre-configured packages with transparent pricing, full warranty, and civil defense compliance.' }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-80 h-80 bg-accent-sky/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Filter & Search Bar -->
        <div class="max-w-3xl mx-auto mb-16 reveal-up">
            <form action="{{ route('offers.index') }}" method="GET" class="space-y-4">
                <!-- Search input -->
                <div class="relative group">
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'ابحث في الباقات (كاميرات، حريق، ألياف، أتمتة، خوادم...)' : 'Search packages (CCTV, Fire Alarm, KNX, Data Center...)' }}"
                           class="w-full px-5 py-4 pe-12 rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 text-white placeholder-surface-500 text-sm focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 shadow-soft transition-all group-hover:border-white/20">
                    <button type="submit" class="absolute end-3 top-1/2 -translate-y-1/2 p-2 text-surface-400 hover:text-brand-300 transition-colors" aria-label="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>

                <!-- Service Category Pills -->
                @if(isset($services) && $services->isNotEmpty())
                    <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-1">
                        <a href="{{ route('offers.index') }}" 
                           class="flex-shrink-0 px-4 py-2 rounded-xl text-xs font-bold transition-all {{ !request('service') ? 'bg-brand-600 text-white shadow-brand-glow' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white' }}">
                            {{ app()->getLocale() === 'ar' ? 'كافة الخدمات' : 'All Solutions' }}
                        </a>
                        @foreach($services as $srv)
                            <a href="{{ route('offers.index', ['service' => $srv->slug]) }}" 
                               class="flex-shrink-0 px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('service') === $srv->slug ? 'bg-brand-600 text-white shadow-brand-glow' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 text-surface-300 hover:border-brand-500/40 hover:text-white' }}">
                                {{ $srv->title }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>

        <!-- Offers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20" data-reveal-stagger="90">
            @forelse($offers as $index => $offer)
                <div class="rounded-3xl overflow-hidden flex flex-col justify-between transition-all duration-300 group border bg-surface-900/70 backdrop-blur-md {{ $offer->is_featured ? 'border-2 border-brand-500 ring-4 ring-brand-500/15 shadow-brand-glow/20' : 'border-white/10 hover:border-brand-500/40 shadow-soft' }} reveal-up hover-lift">
                    
                    <!-- Image Banner (STS Logo Palette) -->
                    @if($offer->image_url)
                        <a href="{{ route('offers.show', $offer->slug) }}" class="block relative h-48 w-full overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-skeleton-holder">
                            <img src="{{ $offer->image_url }}" alt="{{ $offer->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out img-lazy-transition" loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent"></div>
                            
                            @if($offer->badge_text || $offer->is_featured)
                                <span class="absolute top-3.5 start-3.5 px-3 py-1 rounded-full bg-gradient-to-r from-brand-600 to-brand-500 text-white text-[10px] font-black uppercase tracking-wider shadow-brand-glow">
                                    {{ $offer->badge_text ?: (app()->getLocale() === 'ar' ? 'الأكثر طلباً' : 'Most Popular') }}
                                </span>
                            @endif

                            @if($offer->discount_percentage)
                                <span class="absolute top-3.5 end-3.5 px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-bold border border-emerald-500/30">
                                    {{ app()->getLocale() === 'ar' ? 'وفر ' . $offer->discount_percentage . '%' : 'Save ' . $offer->discount_percentage . '%' }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <div class="p-6 sm:p-7 flex-grow flex flex-col justify-between space-y-5">
                        <div class="space-y-4">
                            <!-- Service Tag -->
                            @if($offer->service)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-brand-500/15 text-brand-300 border border-brand-500/30 text-[11px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                                    <span>{{ $offer->service->title }}</span>
                                </span>
                            @endif

                            <!-- Title & Description -->
                            <div>
                                <h3 class="text-xl font-black text-white group-hover:text-brand-300 transition-colors mb-2 leading-tight">
                                    <a href="{{ route('offers.show', $offer->slug) }}">
                                        {{ $offer->title }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-surface-400 leading-relaxed line-clamp-2">{{ $offer->description }}</p>
                            </div>

                            <!-- Price Block -->
                            <div class="py-3 border-y border-white/10">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl font-black text-white font-mono tracking-tight">
                                        {{ number_format($offer->effective_price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-surface-400 uppercase">
                                        {{ $offer->currency ?: 'SAR' }} / {{ $offer->billing_period_label }}
                                    </span>
                                    @if($offer->discount_price && $offer->discount_price < $offer->price)
                                        <span class="text-xs text-surface-500 line-through font-mono">
                                            {{ number_format($offer->price, 0) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Features List (First 3) -->
                            @php $featuresList = $offer->features ?? []; @endphp
                            @if(!empty($featuresList))
                                <ul class="space-y-2">
                                    @foreach(array_slice($featuresList, 0, 3) as $deliv)
                                        <li class="flex items-start gap-2 text-xs text-surface-300">
                                            <svg class="w-4 h-4 text-brand-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            <span class="line-clamp-1 font-medium">{{ $deliv }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 border-t border-white/10 flex items-center gap-2">
                            <a href="{{ route('offers.show', $offer->slug) }}" 
                               class="flex-1 btn-secondary text-xs py-3 rounded-xl justify-center text-center text-white border-white/10 bg-white/5 hover:bg-white/10">
                                <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل الباقة' : 'View Scope' }}</span>
                            </a>

                            <a href="{{ route('quote.create', ['service' => optional($offer->service)->slug, 'package' => $offer->slug]) }}" 
                               class="flex-1 btn-primary text-xs py-3 rounded-xl justify-center text-center shadow-brand-glow">
                                <span>{{ app()->getLocale() === 'ar' ? 'طلب فوري' : 'Order' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 rounded-3xl p-8 text-surface-400 reveal-up bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-surface-800 flex items-center justify-center text-surface-500 border border-white/10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'لا توجد باقات مطابقة لخيارات البحث الحالية.' : 'No packages found matching your criteria.' }}
                    </p>
                    <a href="{{ route('offers.index') }}" class="btn-secondary text-xs mt-3 text-white border-white/20 bg-white/5 hover:bg-white/10">
                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط البحث' : 'Reset Search' }}
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Tech Banner CTA -->
        <div class="rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal-scale hover-lift border border-brand-500/30 bg-gradient-to-br from-surface-950 via-brand-950 to-surface-900 shadow-xl">
            <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
            <div class="absolute -end-16 -top-16 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-start">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-300 border border-brand-500/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'عروض أسعار مخصصة' : 'Custom Enterprise Proposals' }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'هل تحتاج إلى مواصفات كميات BoQ خاصة؟' : 'Need a Tailored Bill of Quantities (BoQ)?' }}
                    </h3>
                    <p class="text-surface-300 text-xs sm:text-sm">
                        {{ app()->getLocale() === 'ar' ? 'أرسل لنا المخطط أو جدول الكميات وسيقوم مهندسونا بتسعير المشروع بدقة وتوفير بدائل معتمدة.' : 'Upload your project specifications or drawings to receive a custom engineering quotation.' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 flex-shrink-0">
                    <a href="{{ route('quote.create') }}" class="btn-primary shadow-brand-glow">
                        <span>{{ __('messages.nav_quote_btn') }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
