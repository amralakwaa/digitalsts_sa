@extends('layouts.admin')

@section('title', __('messages.admin_dashboard') . ' — STS Executive')
@section('header_title', __('messages.admin_dashboard'))

@section('content')

<div class="space-y-8">
    
    <!-- ================= 1. EXECUTIVE WELCOME & COMMAND HERO BANNER ================= -->
    <div class="admin-card-executive p-6 sm:p-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative overflow-hidden group border border-brand-500/30">
        <!-- Ambient Background Glow inside card -->
        <div class="absolute -top-24 -end-24 w-80 h-80 rounded-full bg-[radial-gradient(circle,rgba(12,141,231,0.22)_0%,transparent_70%)] pointer-events-none blur-3xl"></div>
        <div class="absolute -bottom-24 -start-24 w-80 h-80 rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.12)_0%,transparent_70%)] pointer-events-none blur-3xl"></div>
        
        <div class="space-y-3 relative z-10">
            <!-- Live Status Beacon Pill -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 border border-brand-500/30 shadow-xs">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span class="text-sky-100 font-semibold">{{ app()->getLocale() === 'ar' ? 'منظومة التحكم متصلة ومستقرة • تشفير مؤمّن 100%' : 'Command Suite Online • End-to-End Encrypted' }}</span>
                <span class="text-[10px] text-amber-300 font-mono bg-amber-400/15 px-2 py-0.5 rounded border border-amber-400/30">LIVE</span>
            </div>

            <!-- Main Greeting Heading with Royal Classical Typographic Rhythm -->
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight flex items-center gap-3">
                <span>{{ app()->getLocale() === 'ar' ? 'طاب يومك، ' : 'Welcome, ' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-sky-100 to-amber-300">{{ auth()->user()->name }}</span></span>
                <span class="text-2xl sm:text-3xl inline-block hover:rotate-12 transition-transform cursor-default">👋</span>
            </h2>

            <!-- Enhanced High-Contrast Subtitle (Replacing dull gray with luminous Ice-Blue) -->
            <p class="text-xs sm:text-sm text-sky-100/90 max-w-2xl font-medium leading-relaxed">
                {{ app()->getLocale() === 'ar' 
                    ? 'مركز التحكم الإداري الأعلى — إليك تدفق عروض الأسعار الواردة، مؤشرات الأداء الحيوية، وحالة المنظومة الهندسية لحظة بلحظة.' 
                    : 'Executive Operations Center — Real-time overview of RFP inquiries, engineering workflow telemetry, and system KPIs.' }}
            </p>
        </div>

        <!-- Quick Action Buttons with Neo-Classical Jewelry Styling -->
        <div class="flex flex-wrap items-center gap-3 relative z-10">
            <!-- Primary Action: Add Project -->
            <a href="{{ route('admin.projects.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-brand-600 via-brand-500 to-sky-500 hover:from-brand-500 hover:to-sky-400 shadow-[0_0_20px_rgba(12,141,231,0.35)] hover:shadow-[0_0_25px_rgba(12,141,231,0.5)] border border-brand-300/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'إضافة مشروع جديد' : 'New Project' }}</span>
            </a>

            <!-- Secondary Action: Add Service with Champagne Gold Accent -->
            <a href="{{ route('admin.services.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-amber-200 bg-amber-500/15 hover:bg-amber-500/25 border border-amber-400/40 hover:border-amber-400/60 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 shadow-xs">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'إضافة خدمة' : 'New Service' }}</span>
            </a>

            <!-- Tertiary Action: Settings -->
            <a href="{{ route('admin.settings.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-sky-100 bg-brand-500/10 hover:bg-brand-500/20 border border-brand-500/30 hover:border-brand-400 hover:text-white hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                <svg class="w-4 h-4 text-brand-300 group-hover:rotate-45 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'إعدادات المنظومة' : 'Settings' }}</span>
            </a>
        </div>
    </div>
    
    <!-- ================= 2. PRIMARY EXECUTIVE KPI METRIC CARDS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- KPI 1: Total Quotes (Royal Sapphire Theme) -->
        <div class="admin-card-executive glass-sapphire p-6 flex items-center justify-between group border border-brand-500/25 hover:border-brand-500/60">
            <div class="space-y-1.5">
                <span class="text-xs text-sky-300 block font-bold uppercase tracking-wider">{{ __('messages.total_quotes') }}</span>
                <span class="text-3xl sm:text-4xl font-black text-white font-outfit tracking-tight block" data-counter>{{ $stats['total_quotes'] }}</span>
                <div class="flex items-center gap-1.5 text-[11px] text-sky-200 font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'إجمالي الطلبات التراكمية' : 'Cumulative Inquiries' }}</span>
                </div>
            </div>
            <!-- Sapphire Icon Halo with Document Seal -->
            <div class="admin-icon-halo admin-icon-halo-sapphire w-14 h-14">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>

        <!-- KPI 2: Pending Quotes (Champagne Gold / Priority Action Theme) -->
        <div class="admin-card-executive glass-gold p-6 flex items-center justify-between group border border-amber-400/40 hover:border-amber-400/70">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-amber-300 block font-bold uppercase tracking-wider">{{ __('messages.pending_quotes') }}</span>
                    @if($stats['pending_quotes'] > 0)
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    @endif
                </div>
                <span class="text-3xl sm:text-4xl font-black text-amber-300 font-outfit tracking-tight block" data-counter>{{ $stats['pending_quotes'] }}</span>
                <div class="flex items-center gap-1.5 text-[11px] text-amber-200 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تتطلب دراسة ومراجعة فورية' : 'Requires immediate attention' }}</span>
                </div>
            </div>
            <!-- Gold Icon Halo with Precision Chronometer Hourglass -->
            <div class="admin-icon-halo admin-icon-halo-gold w-14 h-14">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- KPI 3: Under Review (Royal Amethyst / Technical Engineering Audit Theme) -->
        <div class="admin-card-executive glass-amethyst p-6 flex items-center justify-between group border border-indigo-400/30 hover:border-indigo-400/60">
            <div class="space-y-1.5">
                <span class="text-xs text-indigo-300 block font-bold uppercase tracking-wider">{{ __('messages.review_quotes') }}</span>
                <span class="text-3xl sm:text-4xl font-black text-indigo-200 font-outfit tracking-tight block" data-counter>{{ $stats['under_review_quotes'] }}</span>
                <div class="flex items-center gap-1.5 text-[11px] text-indigo-200 font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'قيد التدقيق والدراسة الفنية' : 'Under engineering audit' }}</span>
                </div>
            </div>
            <!-- Indigo Icon Halo with Calipers & Architecture Plan -->
            <div class="admin-icon-halo admin-icon-halo-indigo w-14 h-14">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>

        <!-- KPI 4: Completed Quotes (Imperial Emerald / Verified Contracts Theme) -->
        <div class="admin-card-executive glass-emerald p-6 flex items-center justify-between group border border-emerald-400/30 hover:border-emerald-400/60">
            <div class="space-y-1.5">
                <span class="text-xs text-emerald-300 block font-bold uppercase tracking-wider">{{ __('messages.completed_quotes') }}</span>
                <span class="text-3xl sm:text-4xl font-black text-emerald-300 font-outfit tracking-tight block" data-counter>{{ $stats['completed_quotes'] }}</span>
                <div class="flex items-center gap-1.5 text-[11px] text-emerald-200 font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تم تسليم العروض وإغلاقها' : 'Dispatched & Finalized' }}</span>
                </div>
            </div>

            <!-- Emerald Icon Halo with Royal Verified Shield -->
            <div class="admin-icon-halo admin-icon-halo-emerald w-14 h-14">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>

    </div>

    <!-- ================= 3. SECONDARY OPERATIONAL METRICS GRID ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Services Telemetry -->
        <a href="{{ route('admin.services.index') }}" class="admin-card-executive p-5 flex items-center justify-between text-white group border border-brand-500/25 hover:border-brand-500/60">
            <div class="flex items-center gap-4">
                <div class="admin-icon-halo admin-icon-halo-sapphire w-11 h-11">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-sky-300 block">{{ __('messages.manage_services') }}</span>
                    <span class="text-lg font-black text-white font-outfit">{{ $stats['total_services'] }} {{ app()->getLocale() === 'ar' ? 'خدمة نشطة' : 'Services' }}</span>
                </div>
            </div>
            <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-sky-200 group-hover:text-white group-hover:bg-brand-500/30 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Projects Telemetry -->
        <a href="{{ route('admin.projects.index') }}" class="admin-card-executive p-5 flex items-center justify-between text-white group border border-brand-500/25 hover:border-brand-500/60">
            <div class="flex items-center gap-4">
                <div class="admin-icon-halo admin-icon-halo-sapphire w-11 h-11">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-sky-300 block">{{ __('messages.manage_projects') }}</span>
                    <span class="text-lg font-black text-white font-outfit">{{ $stats['total_projects'] }} {{ app()->getLocale() === 'ar' ? 'مشروع منجز' : 'Projects' }}</span>
                </div>
            </div>
            <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-sky-200 group-hover:text-white group-hover:bg-brand-500/30 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Articles & Blog Telemetry -->
        <a href="{{ route('admin.articles.index') }}" class="admin-card-executive p-5 flex items-center justify-between text-white group border border-amber-400/30 hover:border-amber-400/60">
            <div class="flex items-center gap-4">
                <div class="admin-icon-halo admin-icon-halo-gold w-11 h-11">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-amber-200 block">{{ __('messages.manage_articles') }}</span>
                    <span class="text-lg font-black text-white font-outfit">{{ $stats['total_articles'] ?? 0 }} {{ app()->getLocale() === 'ar' ? 'مقال منشور' : 'Articles' }}</span>
                </div>
            </div>
            <div class="w-8 h-8 rounded-lg bg-amber-500/15 border border-amber-400/30 flex items-center justify-center text-amber-300 group-hover:text-amber-200 group-hover:bg-amber-500/30 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Messages & Inquiries Telemetry -->
        <a href="{{ route('admin.messages.index') }}" class="admin-card-executive p-5 flex items-center justify-between text-white group border border-brand-500/25 hover:border-brand-500/60">
            <div class="flex items-center gap-4">
                <div class="admin-icon-halo admin-icon-halo-sapphire w-11 h-11">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-sky-300 block">{{ __('messages.manage_messages') }}</span>
                    <span class="text-lg font-black text-white font-outfit">{{ $stats['unread_messages'] }} {{ app()->getLocale() === 'ar' ? 'رسالة واردة' : 'Unread' }}</span>
                </div>
            </div>
            <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-sky-200 group-hover:text-white group-hover:bg-brand-500/30 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

    </div>

    <!-- ================= 4. RECENT QUOTATION REQUESTS EXECUTIVE TABLE ================= -->
    <div class="admin-card-executive overflow-hidden shadow-2xl border border-brand-500/25">
        <!-- Table Header Toolbar -->
        <div class="p-6 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-brand-500/10 backdrop-blur-md">
            <div class="flex items-center gap-3.5">
                <div class="admin-icon-halo admin-icon-halo-sapphire w-10 h-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white tracking-wide">{{ __('messages.recent_quotes') }}</h2>
                    <span class="text-xs text-sky-200 font-medium">{{ app()->getLocale() === 'ar' ? 'متابعة مباشرة لأحدث طلبات عروض الأسعار والمناقصات المستلمة' : 'Real-time feed of recently received quote inquiries' }}</span>
                </div>
            </div>

            <a href="{{ route('admin.quotes.index') }}" 
               class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-brand-500/15 hover:bg-brand-500/30 border border-brand-500/35 text-xs font-bold text-sky-100 hover:text-white transition-all group shadow-xs">
                <span>{{ app()->getLocale() === 'ar' ? 'عرض كافة الطلبات والتقارير' : 'View All Inquiries' }}</span>
                <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Table Viewport -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-sky-100">
                <thead class="bg-brand-950/40 backdrop-blur-md text-sky-200 font-bold uppercase tracking-wider border-b border-white/10">
                    <tr>
                        <th class="py-4 px-6 text-start">{{ __('messages.quote_ref') }}</th>
                        <th class="py-4 px-6 text-start">{{ __('messages.client_name') }}</th>
                        <th class="py-4 px-6 text-start">{{ __('messages.service') }}</th>
                        <th class="py-4 px-6 text-start">{{ __('messages.status') }}</th>
                        <th class="py-4 px-6 text-start">{{ __('messages.date') }}</th>
                        <th class="py-4 px-6 text-end">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-500/10">
                    @forelse($recentQuotes as $quote)
                        <tr class="admin-table-row transition-colors hover:bg-brand-500/10">
                            <!-- Ref ID with Monospaced Sapphire Chip -->
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.quotes.show', $quote->id) }}" class="inline-flex items-center gap-1.5 font-mono font-black text-sky-200 hover:text-amber-300 bg-brand-500/20 hover:bg-brand-500/30 px-2.5 py-1 rounded-lg border border-brand-500/40 transition-all">
                                    <span>{{ $quote->reference_number }}</span>
                                </a>
                            </td>

                            <!-- Client Avatar & Contact -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-brand-600 via-brand-500 to-indigo-600 text-white font-bold flex items-center justify-center text-xs shadow-xs border border-white/20 flex-shrink-0">
                                        {{ strtoupper(mb_substr($quote->full_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-white block text-sm">{{ $quote->full_name }}</span>
                                        <span class="text-[11px] text-sky-300 font-mono block mt-0.5" dir="ltr">{{ $quote->phone }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Service Requested -->
                            <td class="py-4 px-6 text-sky-100 font-medium">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-brand-500/15 border border-brand-500/30 text-xs text-sky-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    <span>{{ $quote->service ? $quote->service->title : 'استشارة عامة' }}</span>
                                </span>
                            </td>

                            <!-- Status Badge with Jewel Aura -->
                            <td class="py-4 px-6">
                                @if($quote->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-200 border border-amber-400/50 shadow-[0_0_14px_rgba(245,158,11,0.3)]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        <span>{{ $quote->status_label }}</span>
                                    </span>
                                @elseif($quote->status === 'under_review')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-500/20 text-indigo-200 border border-indigo-400/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                                        <span>{{ $quote->status_label }}</span>
                                    </span>
                                @elseif($quote->status === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/20 text-emerald-200 border border-emerald-400/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        <span>{{ $quote->status_label }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold {{ $quote->status_badge_class }}">
                                        <span>{{ $quote->status_label }}</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Timestamp -->
                            <td class="py-4 px-6 text-sky-200 font-medium">
                                <div class="flex items-center gap-1.5 font-mono text-[11px]">
                                    <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ $quote->created_at->format('Y-m-d H:i') }}</span>
                                </div>
                            </td>

                            <!-- Action -->
                            <td class="py-4 px-6 text-end">
                                <a href="{{ route('admin.quotes.show', $quote->id) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-sky-100 bg-brand-500/15 hover:bg-brand-500/35 border border-brand-500/35 hover:border-brand-400 hover:text-white transition-all shadow-xs group">
                                    <span>{{ __('messages.view_details') }}</span>
                                    <svg class="w-3 h-3 rtl:rotate-180 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5 transition-transform text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <div class="max-w-xs mx-auto text-center space-y-3">
                                    <div class="admin-icon-halo admin-icon-halo-sapphire w-14 h-14 mx-auto">
                                        <svg class="w-7 h-7 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-white">{{ __('messages.no_quotes_found') }}</h3>
                                    <p class="text-xs text-sky-200">{{ app()->getLocale() === 'ar' ? 'لا توجد طلبات عروض أسعار جديدة حالياً.' : 'No quotation inquiries received yet.' }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= 5. EXECUTIVE TELEMETRY & SECURITY FOOTER DOCK ================= -->
    <div class="p-4 rounded-2xl bg-brand-950/40 border border-brand-500/25 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-sky-200">
        <div class="flex flex-wrap items-center gap-4 sm:gap-6">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span class="text-sky-100">{{ app()->getLocale() === 'ar' ? 'قاعدة البيانات: متصلة ونشطة' : 'Database: Connected' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-400"></span>
                <span class="text-sky-100">{{ app()->getLocale() === 'ar' ? 'تشفير الجلسات: نشط TLS' : 'Security: TLS Encrypted' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <span class="text-amber-200">{{ app()->getLocale() === 'ar' ? 'النسخة الفاخرة v2.5' : 'Executive Edition v2.5' }}</span>
            </div>
        </div>

        <div class="text-[11px] font-mono text-sky-300">
            <span>PHP {{ PHP_VERSION }} • Laravel {{ app()->version() }}</span>
        </div>
    </div>

</div>

@endsection
