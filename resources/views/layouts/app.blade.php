<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#010318">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>@yield('title', config('app.name', 'STS Smart Tech Systems'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\SiteSetting::get('meta_description', 'STS — الرائدة في الأنظمة الأمنية والتقنيات الذكية'))">
    
    <!-- Open Graph / Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'STS — Smart Tech Systems')">
    <meta property="og:description" content="@yield('meta_description', 'STS — الرائدة في الأنظمة الأمنية والتقنيات الذكية')">
    <meta property="og:url" content="{{ url()->current() }}">
    @yield('og_image')
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/sts-logo-v2.jpg') }}">

    <!-- Fonts: Preconnect for faster DNS resolution -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Load only Cairo (primary) and Outfit (brand heading) — Inter removed to reduce requests -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet"></noscript>

    <!-- Permanent Dark Theme Lock (Day mode completely removed) -->
    <script>
        try { localStorage.setItem('sts_public_theme', 'dark'); } catch(e) {}
        document.documentElement.classList.remove('theme-light');
        document.documentElement.classList.add('theme-dark');
    </script>

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Page-specific head additions -->
    @yield('head')
</head>
<body id="appBody" class="theme-dark bg-surface-950 text-surface-100 min-h-screen flex flex-col font-cairo antialiased relative overflow-x-hidden">

    <!-- =================== SCROLL PROGRESS BAR =================== -->
    <div class="scroll-progress" id="scrollProgress" style="width: 0%"></div>

    <!-- =================== HEADER NAVIGATION — DARK NAVY TECH =================== -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="{ 'nav-dark-scrolled': scrolled, 'nav-dark': !scrolled }"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-xl bg-navy-900 border border-brand-500/30 overflow-hidden flex items-center justify-center shadow-dark-glow group-hover:scale-105 group-hover:border-brand-400/60 transition-all duration-300 p-0.5">
                            <img src="{{ asset('images/sts-logo-v2.jpg') }}" alt="STS Logo" class="w-full h-full object-cover rounded-lg" width="48" height="48" fetchpriority="high">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black tracking-wider text-white flex items-center gap-1.5 font-outfit">
                                STS <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse-soft"></span>
                            </span>
                            <span class="text-[10px] tracking-widest text-brand-400 uppercase font-bold -mt-0.5">SecureTech Systems</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-0.5">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'text-white font-bold bg-white/10 border border-white/10' : 'text-surface-300 hover:text-white hover:bg-white/8' }}">
                        {{ __('messages.nav_home') }}
                    </a>
                    <a href="{{ route('about') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'text-white font-bold bg-white/10 border border-white/10' : 'text-surface-300 hover:text-white hover:bg-white/8' }}">
                        {{ __('messages.nav_about') }}
                    </a>
                    <a href="{{ route('services.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('services.*') ? 'text-white font-bold bg-white/10 border border-white/10' : 'text-surface-300 hover:text-white hover:bg-white/8' }}">
                        {{ __('messages.nav_services') }}
                    </a>
                    <a href="{{ route('projects.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('projects.*') ? 'text-white font-bold bg-white/10 border border-white/10' : 'text-surface-300 hover:text-white hover:bg-white/8' }}">
                        {{ __('messages.nav_projects') }}
                    </a>
                </nav>

                <!-- Actions (Language Switch + Quote Button) -->
                <div class="hidden lg:flex items-center gap-2.5">

                    <!-- Language Switcher -->
                    <a href="{{ route('lang.switch', __('messages.other_lang')) }}" 
                       class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-white/15 text-xs font-semibold text-surface-200 hover:text-white hover:border-brand-400/40 hover:bg-white/5 transition-all duration-200 header-lang-btn">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <span>{{ __('messages.toggle_language') }}</span>
                    </a>

                    <!-- Request Quote CTA -->
                    <a href="{{ route('quote.create') }}" 
                       class="btn-primary relative overflow-hidden group">
                        <span class="relative flex items-center gap-2">
                            <span>{{ __('messages.nav_quote_btn') }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle -->
                <div class="flex items-center gap-3 lg:hidden">
                    <a href="{{ route('lang.switch', __('messages.other_lang')) }}" 
                       class="px-2.5 py-1 rounded-lg border border-white/15 text-xs font-medium text-surface-300">
                        {{ __('messages.toggle_language') }}
                    </a>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            type="button" 
                            class="p-2 rounded-lg text-surface-300 hover:text-white hover:bg-white/10 transition-colors focus:outline-none"
                            aria-label="Toggle menu">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer Menu — Dark Navy -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.outside="mobileMenuOpen = false"
             class="lg:hidden glass-dark px-4 pt-3 pb-6 space-y-1 shadow-dark-card border-t border-white/5">
            
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('home') ? 'bg-brand-500/15 text-brand-400 font-bold border border-brand-500/20' : 'text-surface-300 hover:bg-white/5 hover:text-white' }}">
                {{ __('messages.nav_home') }}
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('about') ? 'bg-brand-500/15 text-brand-400 font-bold border border-brand-500/20' : 'text-surface-300 hover:bg-white/5 hover:text-white' }}">
                {{ __('messages.nav_about') }}
            </a>
            <a href="{{ route('services.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('services.*') ? 'bg-brand-500/15 text-brand-400 font-bold border border-brand-500/20' : 'text-surface-300 hover:bg-white/5 hover:text-white' }}">
                {{ __('messages.nav_services') }}
            </a>
            <a href="{{ route('projects.index') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('projects.*') ? 'bg-brand-500/15 text-brand-400 font-bold border border-brand-500/20' : 'text-surface-300 hover:bg-white/5 hover:text-white' }}">
                {{ __('messages.nav_projects') }}
            </a>

            <!-- Additional Sections Quick Access -->
            <div class="pt-2 pb-1 border-t border-white/5 space-y-1">
                <span class="px-4 text-[10px] uppercase tracking-wider font-bold text-surface-500 block mb-1">
                    {{ app()->getLocale() === 'ar' ? 'أقسام إضافية' : 'More Sections' }}
                </span>
                <div class="grid grid-cols-3 gap-1.5 px-1">
                    <a href="{{ route('offers.index') }}" class="p-2 rounded-xl text-xs font-semibold text-center bg-white/5 hover:bg-white/10 text-surface-300 hover:text-white transition-all flex flex-col items-center gap-1">
                        <span>🏷️</span>
                        <span>{{ __('messages.nav_offers') }}</span>
                    </a>
                    <a href="{{ route('sectors') }}" class="p-2 rounded-xl text-xs font-semibold text-center bg-white/5 hover:bg-white/10 text-surface-300 hover:text-white transition-all flex flex-col items-center gap-1">
                        <span>🏢</span>
                        <span>{{ __('messages.nav_sectors') }}</span>
                    </a>
                    <a href="{{ route('articles.index') }}" class="p-2 rounded-xl text-xs font-semibold text-center bg-white/5 hover:bg-white/10 text-surface-300 hover:text-white transition-all flex flex-col items-center gap-1">
                        <span>📰</span>
                        <span>{{ __('messages.nav_articles') }}</span>
                    </a>
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('quote.create') }}" class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl btn-primary text-center shadow-brand-glow">
                    <span>{{ __('messages.nav_quote_btn') }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Container with top padding for fixed header -->
    <main class="flex-grow pt-20">
        <!-- Global Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4">
                <div class="flash-alert flash-alert-success">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <span class="text-sm font-bold block">{{ app()->getLocale() === 'ar' ? 'تم بنجاح!' : 'Success!' }}</span>
                        <span class="text-xs font-medium opacity-80">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="p-1.5 rounded-lg hover:bg-emerald-100 transition-colors flex-shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4">
                <div class="flash-alert flash-alert-error">
                    <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <span class="text-sm font-bold block">{{ app()->getLocale() === 'ar' ? 'حدث خطأ' : 'Error' }}</span>
                        <span class="text-xs font-medium opacity-80">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="p-1.5 rounded-lg hover:bg-rose-100 transition-colors flex-shrink-0">
                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- =================== FOOTER — DARK NAVY TECH =================== -->
    <footer class="relative overflow-hidden" style="background: linear-gradient(180deg, #060e1a 0%, #0a1628 50%, #060e1a 100%);">
        <!-- Decorative tech grid -->
        <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
        <!-- Ambient glow -->
        <div class="absolute top-0 start-1/3 w-96 h-48 bg-brand-500/8 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 end-1/4 w-80 h-40 bg-accent-sky/6 rounded-full blur-[100px] pointer-events-none"></div>

        <!-- Top glow line -->
        <div class="section-glow-line"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12" data-reveal-stagger="80">
                
                <!-- Col 1: About STS -->
                <div class="space-y-5 reveal-up">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-navy-900 border border-brand-500/30 overflow-hidden flex items-center justify-center p-0.5 shadow-dark-glow">
                            <img src="{{ asset('images/sts-logo-v2.jpg') }}" alt="STS Logo" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-white font-outfit leading-tight">STS</span>
                            <span class="text-[10px] tracking-widest text-brand-400 uppercase font-bold">SecureTech Systems</span>
                        </div>
                    </div>
                    <p class="text-sm text-surface-400 leading-relaxed">
                        {{ __('messages.footer_about') }}
                    </p>
                    <div class="pt-1 flex items-center gap-3">
                        <a href="{{ \App\Models\SiteSetting::get('social_linkedin', 'https://linkedin.com') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/8 hover:bg-brand-500 hover:text-white flex items-center justify-center transition-all duration-200 text-surface-400 hover:scale-110">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.738-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="{{ \App\Models\SiteSetting::get('social_x', 'https://x.com') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/8 hover:bg-accent-sky hover:text-white flex items-center justify-center transition-all duration-200 text-surface-400 hover:scale-110">
                            <span class="sr-only">X</span>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="space-y-4 reveal-up">
                    <h3 class="text-base font-bold text-white tracking-wide">{{ __('messages.footer_quick_links') }}</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_home') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_about') }}</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_services') }}</a></li>
                        <li><a href="{{ route('offers.index') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_offers') }}</a></li>
                        <li><a href="{{ route('sectors') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_sectors') }}</a></li>
                        <li><a href="{{ route('projects.index') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_projects') }}</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_articles') }}</a></li>
                        <li><a href="{{ route('about') }}#contact" class="text-surface-400 hover:text-brand-400 transition-colors hover-underline-brand">{{ __('messages.nav_contact') }}</a></li>
                        <li><a href="{{ route('quote.create') }}" class="text-brand-400 font-semibold hover:underline">{{ __('messages.nav_quote_btn') }}</a></li>
                    </ul>
                </div>

                <!-- Col 3: Core Services -->
                <div class="space-y-4 reveal-up">
                    <h3 class="text-base font-bold text-white tracking-wide">{{ __('messages.footer_services') }}</h3>
                    <ul class="space-y-2.5 text-sm text-surface-400">
                        <li><a href="{{ route('services.show', 'cctv-surveillance-systems') }}" class="hover:text-white transition-colors hover-underline-brand">أنظمة المراقبة CCTV</a></li>
                        <li><a href="{{ route('services.show', 'access-control-systems') }}" class="hover:text-white transition-colors hover-underline-brand">التحكم في الدخول Access Control</a></li>
                        <li><a href="{{ route('services.show', 'fire-alarm-systems') }}" class="hover:text-white transition-colors hover-underline-brand">إنذار الحريق Fire Alarm</a></li>
                        <li><a href="{{ route('services.show', 'data-centers-and-server-rooms') }}" class="hover:text-white transition-colors hover-underline-brand">مراكز البيانات Data Centers</a></li>
                        <li><a href="{{ route('services.show', 'smart-home-automation') }}" class="hover:text-white transition-colors hover-underline-brand">المنازل الذكية Smart Home</a></li>
                        <li><a href="{{ route('services.show', 'system-integration') }}" class="hover:text-white transition-colors hover-underline-brand">تكامل الأنظمة Integration</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact Info -->
                <div class="space-y-4 reveal-up">
                    <h3 class="text-base font-bold text-white tracking-wide">{{ __('messages.footer_contact') }}</h3>
                    <ul class="space-y-3.5 text-sm text-surface-400">
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-brand-500 group-hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="group-hover:text-white transition-colors">{{ \App\Models\SiteSetting::get('contact_address', 'الرياض، المملكة العربية السعودية') }}</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:bg-brand-500 group-hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\SiteSetting::get('contact_phone', '+966506761942')) }}" dir="ltr" class="group-hover:text-white transition-colors hover:text-brand-400">
                                {{ \App\Models\SiteSetting::get('contact_phone', '+966 50 676 1942') }}
                            </a>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-lg bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:bg-brand-500 group-hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="group-hover:text-white transition-colors">{{ \App\Models\SiteSetting::get('contact_email', 'info@sts.com.sa') }}</span>
                        </li>
                    </ul>

                    <!-- Newsletter / Quick CTA -->
                    <div class="pt-4 border-t border-white/10">
                        <a href="{{ route('quote.create') }}" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-brand-500/15 hover:bg-brand-500 text-brand-300 hover:text-white border border-brand-500/30 hover:border-brand-500 text-xs font-bold transition-all duration-300 group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>{{ __('messages.nav_quote_btn') }}</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Sub-Footer -->
            <div class="mt-12 pt-8 border-t border-white/8 flex flex-col lg:flex-row items-center justify-between gap-4 text-xs text-surface-400">
                <p>© {{ date('Y') }} {{ __('messages.all_rights_reserved') }}.</p>

                <!-- Developer Attribution & Contact Actions -->
                <div class="flex items-center flex-wrap justify-center gap-2.5 py-1.5 px-4 rounded-full bg-white/5 border border-white/10 hover:border-brand-500/40 transition-all duration-300 group">
                    <span class="text-surface-300 flex items-center gap-1.5 font-medium">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'تصميم وتطوير:' : 'Design & Development:' }}</span>
                        <span class="text-white font-bold group-hover:text-brand-300 transition-colors">{{ app()->getLocale() === 'ar' ? 'م. عبد السلام الماعطي' : 'Eng. Abdulsalam Al-Maati' }}</span>
                    </span>
                    <span class="hidden sm:inline w-1 h-1 rounded-full bg-white/20"></span>
                    <div class="inline-flex items-center gap-1.5" dir="ltr">
                        <!-- Direct WhatsApp Button with WhatsApp Icon -->
                        <a href="https://wa.me/967776288511?text={{ urlencode(app()->getLocale() === 'ar' ? 'السلام عليكم م. عبد السلام الماعطي، بخصوص تطوير وبرمجة الأنظمة' : 'Hello Eng. Abdulsalam Al-Maati, regarding system development') }}" 
                           target="_blank" 
                           rel="noopener" 
                           class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-500/30 hover:shadow-[0_0_15px_rgba(16,185,129,0.4)] transition-all font-mono font-bold text-xs active:scale-95"
                           title="{{ app()->getLocale() === 'ar' ? 'مراسلة م. عبد السلام الماعطي عبر واتساب' : 'Chat with Eng. Abdulsalam Al-Maati on WhatsApp' }}">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.589 1.761.882 2.796.882 3.183 0 5.772-2.587 5.772-5.769 0-3.181-2.589-5.766-5.772-5.766zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824z"/>
                            </svg>
                            <span>+967 776 288 511</span>
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('privacy') }}" class="hover:text-surface-300 transition-colors">{{ __('messages.privacy_policy') }}</a>
                    <a href="{{ route('terms') }}" class="hover:text-surface-300 transition-colors">{{ __('messages.terms_conditions') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- =================== SCROLL TO TOP BUTTON =================== -->
    <button id="scrollTopBtn" 
            class="scroll-top-btn hidden lg:flex items-center justify-center"
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            aria-label="{{ app()->getLocale() === 'ar' ? 'العودة للأعلى' : 'Scroll to top' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <!-- =================== WHATSAPP FLOATING BUTTON (Desktop) =================== -->
    <div class="whatsapp-float hidden lg:block">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '966506761942')) }}?text={{ urlencode(app()->getLocale() === 'ar' ? 'السلام عليكم، أود الاستفسار عن أنظمة وحلول STS' : 'Hello, I would like to inquire about STS smart systems.') }}" 
           target="_blank" 
           rel="noopener"
           aria-label="WhatsApp"
           data-tooltip="{{ app()->getLocale() === 'ar' ? 'تواصل عبر واتساب' : 'Chat on WhatsApp' }}">
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.589 1.761.882 2.796.882 3.183 0 5.772-2.587 5.772-5.769 0-3.181-2.589-5.766-5.772-5.766zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-10.416c-4.416 0-8 3.584-8 8 0 1.405.365 2.725 1.004 3.876l-1.004 3.676 3.772-.992c1.102.594 2.36.934 3.696.934h.004c4.416 0 8-3.584 8-8s-3.584-8-8-8h-.004z"/></svg>
        </a>
    </div>

    <!-- =================== MOBILE STICKY BOTTOM DOCK (90% MOBILE PRIORITY) =================== -->
    <div class="lg:hidden fixed bottom-3 inset-x-3 z-40 animate-slide-up">
        <div class="bg-surface-950/90 backdrop-blur-xl border border-white/20 rounded-2xl p-2 shadow-2xl flex items-center justify-between gap-2">
            <!-- Direct WhatsApp -->
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '966506761942')) }}?text={{ urlencode(app()->getLocale() === 'ar' ? 'السلام عليكم، أود الاستفسار عن أنظمة وحلول STS' : 'Hello, I would like to inquire about STS smart systems.') }}" 
               target="_blank" 
               rel="noopener" 
               class="flex-1 py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm active:scale-95 transition-all">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.589 1.761.882 2.796.882 3.183 0 5.772-2.587 5.772-5.769 0-3.181-2.589-5.766-5.772-5.766zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'واتساب' : 'WhatsApp' }}</span>
            </a>

            <!-- Request Quote CTA -->
            <a href="{{ route('quote.create') }}" 
               class="flex-1 py-2.5 px-3 rounded-xl text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-brand-glow active:scale-95 transition-all" style="background: linear-gradient(135deg, #0c6db5, #0c8de7);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'عرض سعر' : 'Quote' }}</span>
            </a>
        </div>
    </div>

    @stack('scripts')

    <!-- =================== GLOBAL UI SCRIPTS =================== -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ========== Scroll Progress Bar ==========
        const scrollProgress = document.getElementById('scrollProgress');
        if (scrollProgress) {
            window.addEventListener('scroll', function() {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
                scrollProgress.style.width = scrolled + '%';
            }, { passive: true });
        }

        // ========== Scroll to Top Button ==========
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        if (scrollTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 400) {
                    scrollTopBtn.classList.add('visible');
                } else {
                    scrollTopBtn.classList.remove('visible');
                }
            }, { passive: true });
        }
    });
    </script>

    <!-- =================== DARK MODE PERMANENT ENFORCEMENT (NO DAY MODE) =================== -->
    <script>
    (function() {
        try { localStorage.setItem('sts_public_theme', 'dark'); } catch(e) {}
        document.documentElement.classList.remove('theme-light');
        document.documentElement.classList.add('theme-dark');
        if (document.body) {
            document.body.classList.remove('theme-light');
            document.body.classList.add('theme-dark');
            document.body.style.backgroundColor = '#010318';
        }
    })();
    </script>
</body>
</html>
