@extends('layouts.app')

@section('title', __('messages.terms_conditions') . ' — ' . __('messages.company_name'))

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
            <span class="text-brand-300 font-semibold">{{ __('messages.terms_conditions') }}</span>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up reveal-delay-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>{{ __('messages.terms_conditions') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up reveal-delay-2">
                {{ __('messages.terms_conditions') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up reveal-delay-3">
                {{ app()->getLocale() === 'ar' ? 'الشروط والأحكام المنظمة للتعاملات الهندسية وخدمات الموقع.' : 'Terms and conditions governing our engineering engagements and site services.' }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="rounded-3xl p-8 sm:p-12 space-y-8 text-surface-300 leading-relaxed text-sm sm:text-base shadow-soft-xl reveal-scale border border-white/10 bg-surface-900/80 backdrop-blur-md">
            <div class="border-b border-white/10 pb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                        {{ app()->getLocale() === 'ar' ? 'الشروط والأحكام العامة' : 'General Terms of Service' }}
                    </h2>
                    <p class="text-xs text-surface-400 mt-1 font-mono">
                        {{ app()->getLocale() === 'ar' ? 'آخر تحديث: أكتوبر 2026' : 'Last Updated: October 2026' }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-brand-500/20 text-brand-300 flex items-center justify-center flex-shrink-0 border border-brand-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '1. نطاق عروض الأسعار والدراسات الفنية' : '1. Proposals & Quotations Scope' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar'
                        ? 'تعتبر عروض الأسعار التقديرية المقدمة عبر الموقع أولية وتعتمد على صحة البيانات والمخططات المدخلة من قبل العميل، وتخضع للتأكيد النهائي بعد المعاينة الميدانية الرسمية من قِبل مهندسينا.'
                        : 'Preliminary quotations generated through the web portal are subject to formal site audit verification and physical drawing validation by certified STS field consultants.' }}
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '2. حقوق الملكية الفكرية' : '2. Intellectual Property' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar'
                        ? 'جميع العلامات التجارية، والمخططات، والمحتويات المعروضة في هذا الموقع هي ملك حصري لشركة STS أو شركائها التقنيين المعتمدين، ولا يجوز إعادة استخدامها دون إذن خطي مسبق.'
                        : 'All design tokens, engineering diagrams, and documentation published on this portal are protected intellectual properties of STS or its certified technology partners.' }}
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '3. الضمان والدعم الفني (SLA)' : '3. SLA & Warranty Policies' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar'
                        ? 'تخضع كافة أعمال التركيب والتوريد لعقود الضمان المبرمة رسمياً مع المنشأة، والتي تتضمن التغطية الشاملة للأجهزة وقطع الغيار ضد العيوب المصنعية والدعم الفني الميداني.'
                        : 'All installation works and hardware procurements are governed by formal commissioning contracts, including SLA maintenance terms and manufacturer warranty conditions.' }}
                </p>
            </div>
        </div>

    </div>
</div>

@endsection
