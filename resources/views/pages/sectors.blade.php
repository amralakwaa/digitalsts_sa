@extends('layouts.app')

@section('title', __('messages.nav_sectors') . ' — ' . __('messages.company_name'))

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
                <span>{{ __('messages.sectors_badge') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ __('messages.sectors_title') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ __('messages.sectors_subtitle') }}
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

        <!-- Sectors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20" data-reveal-stagger="80">
            @foreach($sectors as $index => $sec)
                <div class="rounded-3xl p-8 flex flex-col justify-between group hover:border-brand-500/40 transition-all duration-300 reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div>
                        <!-- Icon with ambient hover glow -->
                        <div class="w-16 h-16 rounded-2xl bg-brand-500/15 border border-brand-500/30 text-brand-400 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white group-hover:shadow-brand-glow transition-all duration-300">
                            @if($sec['icon'] === 'building-2')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            @elseif($sec['icon'] === 'hotel')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                            @elseif($sec['icon'] === 'home')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            @elseif($sec['icon'] === 'factory')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            @elseif($sec['icon'] === 'shield')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            @endif
                        </div>

                        <h3 class="text-xl font-black text-white mb-3 group-hover:text-brand-300 transition-colors">
                            {{ app()->getLocale() === 'ar' ? $sec['title_ar'] : $sec['title_en'] }}
                        </h3>

                        <p class="text-xs sm:text-sm text-surface-400 leading-relaxed mb-6">
                            {{ app()->getLocale() === 'ar' ? $sec['desc_ar'] : $sec['desc_en'] }}
                        </p>

                        <!-- Solutions Checklist with Modern Tags -->
                        <div class="space-y-2 border-t border-white/10 pt-5 mb-6">
                            <span class="text-xs font-bold text-surface-500 uppercase tracking-wider block mb-2">
                                {{ app()->getLocale() === 'ar' ? 'أبرز الحلول المقدمة للقطاع:' : 'Key Engineering Solutions:' }}
                            </span>
                            @foreach((app()->getLocale() === 'ar' ? $sec['solutions_ar'] : $sec['solutions_en']) as $sol)
                                <div class="flex items-center gap-2.5 text-xs text-surface-300 bg-surface-800/50 hover:bg-brand-500/10 p-2 rounded-xl transition-colors border border-white/5">
                                    <div class="w-4 h-4 rounded-full bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="font-medium">{{ $sol }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10">
                        <a href="{{ route('quote.create') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-surface-800/70 border border-white/10 hover:bg-brand-600 hover:border-brand-600 text-xs font-bold text-surface-300 hover:text-white transition-all duration-300 group/btn shadow-xs">
                            <span>{{ __('messages.nav_quote_btn') }}</span>
                            <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tech Banner CTA -->
        <div class="card-dark rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal-scale hover-lift">
            <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
            <div class="absolute -end-16 -top-16 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-start">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-300 border border-brand-500/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'حلول مصممة خصيصاً لمجالك' : 'Tailored Sector Engineering' }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'هل تحتاج إلى حل هندسي مخصص لمنشأتك؟' : 'Need a Custom Architecture for Your Industry?' }}
                    </h3>
                    <p class="text-surface-300 text-xs sm:text-sm">
                        {{ app()->getLocale() === 'ar' ? 'مستشارونا الهندسيون مستعدون لدراسة متطلبات مشروعك وتقديم عرض فني ومالي مفصل.' : 'Our solution architects will conduct a needs assessment and design an optimized blueprint.' }}
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

    </div>
</div>

@endsection
