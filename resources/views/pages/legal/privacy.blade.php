@extends('layouts.app')

@section('title', __('messages.privacy_policy') . ' — ' . __('messages.company_name'))

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
            <span class="text-brand-300 font-semibold">{{ __('messages.privacy_policy') }}</span>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up reveal-delay-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>{{ __('messages.privacy_policy') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up reveal-delay-2">
                {{ __('messages.privacy_policy') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up reveal-delay-3">
                {{ app()->getLocale() === 'ar' ? 'التزامنا الكامل بحماية بياناتك وسرية المخططات الهندسية لمنشأتك.' : 'Our full commitment to protecting your privacy and confidential engineering schematics.' }}
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
                        {{ app()->getLocale() === 'ar' ? 'بنود سياسة الخصوصية وسرية البيانات' : 'Privacy & Confidentiality Guidelines' }}
                    </h2>
                    <p class="text-xs text-surface-400 mt-1 font-mono">
                        {{ app()->getLocale() === 'ar' ? 'آخر تحديث: أكتوبر 2026' : 'Last Updated: October 2026' }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 border border-emerald-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '1. جمع البيانات' : '1. Information Collection' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar' 
                        ? 'تلتزم شركة STS بحماية خصوصية زوار ومستخدمي موقعنا الإلكتروني. نقوم بجمع البيانات التي تقدمها طواعية عند تعبئة نموذج طلب عرض السعر أو نموذج الاتصال، مثل الاسم، والبريد الإلكتروني، ورقم الهاتف، وتفاصيل المشروع.' 
                        : 'STS is committed to safeguarding the privacy of visitors. We collect details provided voluntarily via quote request forms or contact channels including names, corporate emails, telephone numbers, and technical project scopes.' }}
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '2. استخدام البيانات' : '2. Use of Information' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar' 
                        ? 'تُستخدم بياناتك فقط للتواصل معك بخصوص طلبك، وتقديم العروض الفنية والمالية، وإجراء الدراسات الهندسية المطلوبة. لا نقوم ببيع أو مشاركة بياناتك مع أي طرف ثالث لأغراض تسويقية.' 
                        : 'Collected data is solely utilized to respond to your technical RFPs, deliver commercial proposals, and execute on-site assessments. We never sell or share client data with third-party advertisers.' }}
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-lg font-black text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? '3. حماية وأمن المعلومات' : '3. Data Security & Storage' }}</span>
                </h3>
                <p class="text-surface-300 leading-relaxed">
                    {{ app()->getLocale() === 'ar' 
                        ? 'نطبق معايير تقنية مشددة لحماية الملفات المرفقة والبيانات المخزنة في قواعد بياناتنا من الوصول غير المصرح به أو التعديل أو الإفشاء، وفق الأنظمة المعمول بها في المملكة العربية السعودية.' 
                        : 'We implement industry-standard encryption and operational access control safeguards to preserve files and server records from unauthorized breach or disclosure.' }}
                </p>
            </div>
        </div>

    </div>
</div>

@endsection
