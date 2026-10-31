<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('messages.nav_admin') . ' — STS Executive')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/sts-logo-v2.jpg') }}">

    <!-- Fonts: Cairo for authoritative Arabic hierarchy, Outfit & Inter for Swiss-precision numerals -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Anti-flicker Instant Theme Init (Permanent Dark Mode Enforced) -->
    <script>
        (function() {
            try { localStorage.setItem('sts_admin_theme', 'dark'); } catch(e) {}
            document.documentElement.classList.remove('admin-theme-light');
            document.documentElement.classList.add('admin-theme-dark');
        })();
    </script>

    <!-- Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="adminBody" class="admin-theme-dark bg-[#060b16] text-slate-100 min-h-screen font-cairo antialiased flex flex-col md:flex-row relative selection:bg-brand-500 selection:text-white">

    <!-- ================= EXECUTIVE AMBIENT CANVAS (Glassmorphism Aurora & Blueprint Matrix) ================= -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden admin-bg-canvas" aria-hidden="true">
        <!-- Dark Mode Canvas — Deep Obsidian Velvet with Imperial Sapphire & Champagne Gold Auras -->
        <div class="admin-dark-canvas absolute inset-0">
            <!-- Obsidian Base with subtle blue tint -->
            <div class="absolute inset-0 bg-[#060b16]"></div>
            
            <!-- Top Center Spotlight Halo (Illuminates header and top KPI cards) -->
            <div class="absolute -top-32 inset-x-0 h-[560px] bg-[radial-gradient(ellipse_80%_100%_at_50%_0%,rgba(12,141,231,0.28),transparent_75%)]"></div>
            
            <!-- Classical Champagne Gold Ambient Aura (Balances luxury tone) -->
            <div class="absolute top-1/4 -start-32 w-[680px] h-[680px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.12)_0%,transparent_70%)] blur-[120px]"></div>
            
            <!-- Deep Amethyst / Royal Indigo Aura (Rich glass refraction) -->
            <div class="absolute top-1/2 start-1/3 w-[500px] h-[500px] rounded-full bg-[radial-gradient(circle,rgba(99,102,241,0.14)_0%,transparent_70%)] blur-[130px]"></div>
            
            <!-- Imperial Sapphire Aura (Digital tech precision) -->
            <div class="absolute bottom-10 -end-32 w-[650px] h-[650px] rounded-full bg-[radial-gradient(circle,rgba(14,165,233,0.16)_0%,transparent_70%)] blur-[120px]"></div>
            
            <!-- Architectural Precision Dot-Matrix Grid -->
            <div class="absolute inset-0 admin-grid-matrix opacity-40"></div>
            
            <!-- Subtle Vignette Frame -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_45%,#030712_100%)] opacity-60"></div>
        </div>

        <!-- Light Mode Canvas — Crisp Alabaster Platinum with Soft Imperial Sky Halo -->
        <div class="admin-light-canvas absolute inset-0 hidden">
            <!-- Clean Platinum Base -->
            <div class="absolute inset-0 bg-[#f4f7fc]"></div>
            
            <!-- Top Ambient Sky Halo -->
            <div class="absolute -top-32 inset-x-0 h-[520px] bg-[radial-gradient(ellipse_75%_100%_at_50%_0%,rgba(12,141,231,0.14),transparent_70%)]"></div>
            
            <!-- Soft Champagne Warmth -->
            <div class="absolute bottom-0 start-0 w-[550px] h-[550px] bg-[radial-gradient(circle,rgba(212,175,55,0.08)_0%,transparent_70%)] blur-[100px]"></div>
            
            <!-- Sky Blue Refraction Orb -->
            <div class="absolute top-1/3 end-0 w-[500px] h-[500px] bg-[radial-gradient(circle,rgba(56,189,248,0.12)_0%,transparent_70%)] blur-[110px]"></div>
            
            <!-- Light Architectural Dot Matrix Grid -->
            <div class="absolute inset-0 admin-grid-matrix-light opacity-35"></div>
        </div>
    </div>

    <!-- Mobile Top Navigation Header (Shown only on small screens) -->
    <div class="md:hidden sticky top-0 z-40 bg-[#070d18]/60 backdrop-blur-2xl border-b border-white/10 px-4 py-3 flex items-center justify-between shadow-lg">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-surface-900 border border-brand-500/40 p-0.5 shadow-brand-glow overflow-hidden">
                <img src="{{ asset('images/sts-logo-v2.jpg') }}" alt="STS Logo" class="w-full h-full object-cover rounded-lg">
            </div>
            <div>
                <span class="text-sm font-black text-white tracking-wider font-outfit block">STS COMMAND</span>
                <span class="text-[9px] text-amber-400 font-bold uppercase tracking-widest block">Executive Suite</span>
            </div>
        </a>

        <div class="flex items-center gap-2">
            <button id="adminMobileMenuBtn" type="button" class="p-2 rounded-xl bg-white/5 border border-white/15 text-slate-200 hover:text-white" aria-label="Toggle Navigation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- ================= SIDEBAR NAVIGATION ================= -->
    <aside id="adminSidebar" class="admin-sidebar hidden md:flex w-full md:w-64 lg:w-72 bg-[#070d18]/55 backdrop-blur-2xl border-b md:border-b-0 md:border-e border-white/10 flex-shrink-0 flex-col justify-between p-4 md:p-6 min-h-screen shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] z-30 relative transition-all duration-300">

        <div class="space-y-6">
            <!-- Brand Logo with Classical Gold/Sapphire Halo -->
            <div class="flex items-center justify-between pb-5 border-b border-white/10 sidebar-divider">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 group">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-2xl bg-surface-900 border-2 border-brand-500/50 p-1 shadow-[0_0_20px_rgba(12,141,231,0.35)] group-hover:scale-105 group-hover:border-amber-400/60 transition-all duration-300 overflow-hidden">
                            <img src="{{ asset('images/sts-logo-v2.jpg') }}" alt="STS Logo" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <span class="absolute -bottom-1 -end-1 w-3.5 h-3.5 rounded-full bg-emerald-400 border-2 border-[#070d18] shadow-[0_0_8px_#34d399] animate-pulse"></span>
                    </div>
                    <div>
                        <span class="sidebar-brand-title text-lg font-black text-white tracking-wider font-outfit block">STS COMMAND</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span class="sidebar-brand-subtitle text-[10px] text-amber-300 font-bold uppercase tracking-widest">{{ app()->getLocale() === 'ar' ? 'منظومة التحكم الفاخرة' : 'Executive Suite' }}</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- System Live Status Pill -->
            <div class="px-3 py-2 rounded-xl bg-brand-500/10 border border-brand-500/25 flex items-center justify-between text-xs shadow-xs">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-[11px] font-bold text-sky-100">{{ app()->getLocale() === 'ar' ? 'حالة النظام: متصل 100%' : 'System: Operational' }}</span>
                </div>
                <span class="text-[10px] font-mono text-amber-300 font-bold bg-amber-400/15 px-2 py-0.5 rounded-md border border-amber-400/30">v2.5</span>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#1E293B] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    </div>
                    <span>{{ __('messages.admin_dashboard') }}</span>
                </a>

                <!-- Quotes -->
                <a href="{{ route('admin.quotes.index') }}" 
                   class="admin-nav-item flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.quotes.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="flex items-center gap-3.5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.quotes.*') ? 'bg-amber-500/30 text-amber-200 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <span>{{ __('messages.total_quotes') }}</span>
                    </div>
                    @php
                        $pendingQuotesCount = \App\Models\QuoteRequest::where('status', 'pending')->count();
                    @endphp
                    @if($pendingQuotesCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/25 text-amber-200 border border-amber-400/50 shadow-[0_0_12px_rgba(245,158,11,0.35)] animate-pulse">
                            {{ $pendingQuotesCount }}
                        </span>
                    @endif
                </a>

                <!-- Services -->
                <a href="{{ route('admin.services.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.services.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.services.*') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span>{{ __('messages.manage_services') }}</span>
                </a>

                <!-- Service Packages & Offers -->
                <a href="{{ route('admin.service-offers.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.service-offers.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.service-offers.*') ? 'bg-amber-500/30 text-amber-200 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <span>{{ app()->getLocale() === 'ar' ? 'باقات وعروض الخدمات' : 'Packages & Deals' }}</span>
                </a>

                <!-- Projects -->
                <a href="{{ route('admin.projects.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.projects.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.projects.*') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <span>{{ __('messages.manage_projects') }}</span>
                </a>

                <!-- Articles & Blog -->
                <a href="{{ route('admin.articles.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.articles.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.articles.*') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <span>{{ __('messages.manage_articles') }}</span>
                </a>

                <!-- Messages -->
                <a href="{{ route('admin.messages.index') }}" 
                   class="admin-nav-item flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.messages.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="flex items-center gap-3.5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.messages.*') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#1E293B] text-sky-200 border border-sky-500/20' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span>{{ __('messages.manage_messages') }}</span>
                    </div>
                    @php
                        $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
                    @endphp
                    @if($unreadMessagesCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-500/25 text-sky-200 border border-brand-400/50 shadow-[0_0_12px_rgba(12,141,231,0.35)]">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </a>

                <!-- Client Testimonials & Reviews -->
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.testimonials.*') ? 'bg-amber-500/30 text-amber-200 shadow-xs' : 'bg-[#273449] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <span>{{ app()->getLocale() === 'ar' ? 'آراء وشهادات العملاء' : 'Testimonials & Reviews' }}</span>
                </a>


                <!-- Site Settings -->
                <a href="{{ route('admin.settings.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.settings.*') ? 'bg-brand-500/30 text-sky-100 shadow-xs' : 'bg-[#1E293B] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <span>{{ app()->getLocale() === 'ar' ? 'إعدادات المنظومة' : 'Site Settings' }}</span>
                </a>

                <!-- Administrators & Users -->
                <a href="{{ route('admin.users.index') }}" 
                   class="admin-nav-item flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'active' : 'text-sky-100 hover:text-white hover:bg-[#273449]' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.users.*') ? 'bg-amber-500/30 text-amber-200 shadow-xs' : 'bg-[#1E293B] text-sky-200 border border-sky-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <span>{{ app()->getLocale() === 'ar' ? 'فريق الإدارة والصلاحيات' : 'Admins & Staff' }}</span>
                </a>
            </nav>
        </div>

        <!-- Footer / Admin User Profile & Secure Logout -->
        <div class="pt-5 border-t border-brand-500/20 sidebar-divider space-y-3">
            <div class="sidebar-user-card p-3 rounded-2xl bg-brand-950/60 border border-brand-500/30 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 via-brand-500 to-amber-500 text-white font-black flex items-center justify-center text-xs shadow-brand-glow border border-amber-400/40">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <span class="sidebar-user-name text-xs font-bold text-white block truncate">{{ auth()->user()->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-amber-300 font-semibold block uppercase tracking-wider">{{ app()->getLocale() === 'ar' ? 'مدير تنفيذي' : 'Executive Admin' }}</span>
                    </div>
                </div>
            </div>

            <!-- Logout Form with classical red jewel styling -->
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-rose-500/15 hover:bg-rose-500/25 border border-rose-500/30 text-rose-300 text-xs font-bold transition-all flex items-center justify-center gap-2 group cursor-pointer shadow-xs">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 rtl:group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>{{ __('messages.nav_logout') }}</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT AREA ================= -->
    <div class="flex-grow flex flex-col min-h-screen overflow-y-auto relative z-10">
        <!-- Top Executive Header Bar -->
        <header class="admin-top-header h-20 bg-[#070d18]/45 backdrop-blur-2xl border-b border-white/10 shadow-[0_4px_24px_0_rgba(0,0,0,0.25)] px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20 transition-colors duration-300">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="header-title text-base sm:text-lg font-black text-white tracking-tight font-outfit flex items-center gap-2">
                        <span>@yield('header_title', 'STS Command Center')</span>
                    </h1>
                    <span class="text-[11px] text-sky-200 block font-semibold">
                        {{ now()->locale(app()->getLocale())->isoFormat('dddd، D MMMM YYYY') }}
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <!-- Language Toggle -->
                <a href="{{ route('lang.switch', __('messages.other_lang')) }}" 
                   class="header-action-btn text-xs font-semibold px-3 py-1.5 rounded-xl border border-brand-500/30 text-sky-100 hover:text-white hover:border-brand-400 hover:bg-brand-500/20 transition-all font-outfit shadow-sm">
                    {{ __('messages.toggle_language') }}
                </a>

                <!-- View Public Website with pulse dot -->
                <a href="{{ route('home') }}" target="_blank" rel="noopener" 
                   class="header-action-btn text-xs font-semibold px-3 py-1.5 rounded-xl bg-brand-500/15 border border-brand-500/30 text-sky-100 hover:text-white hover:border-brand-400 hover:bg-brand-500/30 transition-all flex items-center gap-1.5 shadow-sm group">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400 group-hover:bg-amber-400 transition-colors"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'معاينة الموقع' : 'Preview Site' }}</span>
                    <svg class="w-3.5 h-3.5 text-brand-400 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </header>

        <!-- Main Body & Flash Messages -->
        <main class="p-6 sm:p-8 flex-grow bg-transparent">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/15 border border-emerald-500/35 text-emerald-200 text-sm flex items-center gap-3 shadow-[0_4px_20px_rgba(16,185,129,0.15)] backdrop-blur-md">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 border border-emerald-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="font-bold text-xs sm:text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-500/15 border border-rose-500/35 text-rose-200 text-sm flex items-center gap-3 shadow-[0_4px_20px_rgba(244,63,94,0.15)] backdrop-blur-md">
                    <div class="w-9 h-9 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center flex-shrink-0 border border-rose-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="font-bold text-xs sm:text-sm">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Admin Footer with Developer Credit -->
        <footer class="mt-auto py-4 px-6 sm:px-8 border-t border-white/5 bg-[#060b14]/30 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <span>© {{ date('Y') }} STS Command Center — {{ __('messages.all_rights_reserved') }}</span>
            <div class="flex items-center gap-2">
                <span>{{ app()->getLocale() === 'ar' ? 'تصميم وتطوير:' : 'Design & Development:' }} <strong class="text-white">{{ app()->getLocale() === 'ar' ? 'م. عبد السلام الماعطي' : 'Eng. Abdulsalam Al-Maati' }}</strong></span>
                <div class="inline-flex items-center gap-1.5" dir="ltr">
                    <a href="https://wa.me/967776288511?text={{ urlencode(app()->getLocale() === 'ar' ? 'السلام عليكم م. عبد السلام الماعطي، بخصوص لوحة تحكم STS' : 'Hello Eng. Abdulsalam Al-Maati, regarding STS Command Center') }}" 
                       target="_blank" 
                       rel="noopener" 
                       class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/15 hover:bg-emerald-500 text-emerald-300 hover:text-white border border-emerald-500/25 transition-all font-mono font-bold text-[11px]"
                       title="{{ app()->getLocale() === 'ar' ? 'مراسلة م. عبد السلام الماعطي عبر واتساب' : 'Chat with Eng. Abdulsalam Al-Maati on WhatsApp' }}">
                        <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.589 1.761.882 2.796.882 3.183 0 5.772-2.587 5.772-5.769 0-3.181-2.589-5.766-5.772-5.766zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824z"/></svg>
                        <span>+967 776 288 511</span>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Admin Interactive Logic (Permanent Dark Mode Enforced) -->
    <script>
        (function() {
            try { localStorage.setItem('sts_admin_theme', 'dark'); } catch(e) {}
            document.documentElement.classList.remove('admin-theme-light');
            document.documentElement.classList.add('admin-theme-dark');
            document.body.classList.remove('admin-theme-light');
            document.body.classList.add('admin-theme-dark');
            document.body.style.backgroundColor = '#060b16';

            // Mobile Menu Toggle
            const mobileBtn = document.getElementById('adminMobileMenuBtn');
            const sidebar = document.getElementById('adminSidebar');
            if (mobileBtn && sidebar) {
                mobileBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                });
            }
        })();
    </script>

</body>
</html>
