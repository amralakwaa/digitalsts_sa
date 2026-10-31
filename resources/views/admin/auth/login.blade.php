<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('messages.admin_login_title') }} — STS</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/sts-logo-v2.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
<body id="loginBody" class="admin-theme-dark bg-[#060b16] text-white min-h-screen font-cairo antialiased flex flex-col justify-between p-4 sm:p-6 relative overflow-x-hidden selection:bg-brand-500 selection:text-white">
    
    <!-- ================= EXECUTIVE AMBIENT CANVAS (Bespoke UI/UX Aurora & Grid) ================= -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden admin-bg-canvas" aria-hidden="true">
        <!-- Dark Mode Canvas — Deep Obsidian Velvet with Imperial Sapphire & Champagne Gold Auras -->
        <div class="admin-dark-canvas absolute inset-0">
            <!-- Obsidian Base with subtle blue tint -->
            <div class="absolute inset-0 bg-[#060b16]"></div>
            
            <!-- Top Center Spotlight Halo -->
            <div class="absolute -top-32 inset-x-0 h-[560px] bg-[radial-gradient(ellipse_80%_100%_at_50%_0%,rgba(12,141,231,0.28),transparent_75%)]"></div>
            
            <!-- Classical Champagne Gold Ambient Aura -->
            <div class="absolute top-1/4 -start-32 w-[680px] h-[680px] rounded-full bg-[radial-gradient(circle,rgba(212,175,55,0.12)_0%,transparent_70%)] blur-[120px]"></div>
            
            <!-- Deep Amethyst / Royal Indigo Aura -->
            <div class="absolute top-1/2 start-1/3 w-[500px] h-[500px] rounded-full bg-[radial-gradient(circle,rgba(99,102,241,0.14)_0%,transparent_70%)] blur-[130px]"></div>
            
            <!-- Imperial Sapphire Aura -->
            <div class="absolute bottom-10 -end-32 w-[650px] h-[650px] rounded-full bg-[radial-gradient(circle,rgba(14,165,233,0.16)_0%,transparent_70%)] blur-[120px]"></div>
            
            <!-- Architectural Precision Dot-Matrix Grid -->
            <div class="absolute inset-0 admin-grid-matrix opacity-40"></div>
            
            <!-- Subtle Vignette Frame -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_45%,#030712_100%)] opacity-60"></div>
        </div>
    </div>

    <!-- Top Floating Navigation -->
    <header class="w-full max-w-5xl mx-auto flex items-center justify-between py-2 relative z-10">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-surface-200 hover:text-white px-4 py-2.5 rounded-xl bg-surface-900/80 backdrop-blur-md border border-white/15 shadow-sm hover:border-brand-500/40 hover:bg-surface-800/80 transition-all">
            <svg class="w-4 h-4 rtl:rotate-180 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'الرجوع للموقع الرئيسي' : 'Back to Main Website' }}</span>
        </a>

        <div class="flex items-center gap-3">
            <!-- Language Switcher -->
            <a href="{{ route('lang.switch', __('messages.other_lang')) }}" class="inline-flex items-center gap-2 text-xs font-bold text-surface-200 hover:text-white px-4 py-2.5 rounded-xl bg-surface-900/80 backdrop-blur-md border border-white/15 shadow-sm hover:border-brand-500/40 hover:bg-surface-800/80 transition-all font-outfit">
                <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>{{ __('messages.toggle_language') }}</span>
            </a>
        </div>
    </header>

    <!-- Center Card Wrapper -->
    <main class="w-full max-w-md mx-auto my-auto py-8 relative z-10 space-y-6">
        
        <!-- Header & Branding -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-surface-900 border-2 border-brand-500/40 p-1 shadow-brand-glow overflow-hidden">
                <img src="{{ asset('images/sts-logo-v2.jpg') }}" alt="STS Logo" class="w-full h-full object-cover rounded-2xl">
            </div>
            
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-[11px] font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>{{ app()->getLocale() === 'ar' ? 'بوابة الإدارة المركزية الآمنة' : 'Secure Command Gateway' }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-outfit">
                    STS <span class="font-cairo text-xl sm:text-2xl font-bold text-surface-300">| {{ __('messages.admin_login_title') }}</span>
                </h1>
                <p class="text-xs sm:text-sm text-surface-300 max-w-xs mx-auto font-medium">
                    {{ __('messages.admin_login_subtitle') }}
                </p>
            </div>
        </div>

        <!-- Main Form Card with Deep Glassmorphism & Cyber Glow -->
        <div class="rounded-3xl p-7 sm:p-10 space-y-6 shadow-2xl bg-surface-900/90 backdrop-blur-2xl border border-brand-500/35 ring-1 ring-white/10">
            
            <!-- Error Alert -->
            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-500/20 border border-rose-500/40 text-rose-200 text-xs font-semibold flex items-start gap-3 shadow-xs">
                    <svg class="w-5 h-5 text-rose-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div class="flex-1">
                        <span class="font-bold block text-rose-200">{{ app()->getLocale() === 'ar' ? 'تعذر تسجيل الدخول:' : 'Authentication Error:' }}</span>
                        <span class="text-rose-100">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-surface-200">
                        {{ __('messages.email_address') }} <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-surface-400">
                            <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                        </div>
                        <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}" dir="ltr"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل البريد الإلكتروني' : 'name@example.com' }}"
                               class="w-full ps-10 pe-4 py-3.5 rounded-xl bg-surface-950/90 border border-white/20 text-white placeholder-surface-500 text-sm focus:outline-none focus:border-brand-400 focus:ring-4 focus:ring-brand-500/20 transition-all font-mono text-start shadow-inner">
                    </div>
                </div>

                <!-- Password Input with Toggle Eye Button -->
                <div class="space-y-2">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-surface-200">
                        {{ __('messages.password') }} <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-surface-400">
                            <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" id="password" name="password" required value="" dir="ltr"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل كلمة المرور' : '••••••••••••' }}"
                               class="w-full ps-10 pe-11 py-3.5 rounded-xl bg-surface-950/90 border border-white/20 text-white placeholder-surface-500 text-sm focus:outline-none focus:border-brand-400 focus:ring-4 focus:ring-brand-500/20 transition-all text-start shadow-inner">
                        
                        <!-- Toggle Password Visibility Button -->
                        <button type="button" id="togglePasswordBtn" class="absolute inset-y-0 end-0 flex items-center pe-3.5 text-surface-400 hover:text-brand-300 transition-colors" title="{{ app()->getLocale() === 'ar' ? 'إظهار / إخفاء كلمة المرور' : 'Toggle password visibility' }}">
                            <!-- Eye Open Icon -->
                            <svg id="eyeOpenIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <!-- Eye Closed Icon -->
                            <svg id="eyeClosedIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-surface-200 hover:text-white select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-surface-950 border-white/30 text-brand-500 focus:ring-brand-500">
                        <span class="font-medium">{{ __('messages.remember_me') }}</span>
                    </label>

                    <span class="text-[11px] text-brand-300 font-mono">
                        {{ app()->getLocale() === 'ar' ? 'جلسة محمية ومشفرة' : 'Encrypted Session' }}
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full justify-center py-4 text-sm shadow-brand-glow font-bold">
                    <span>{{ __('messages.btn_login') }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <!-- Security Badges Footer -->
            <div class="pt-5 border-t border-white/10 flex items-center justify-center gap-4 text-xs text-surface-300 font-medium">
                <div class="flex items-center gap-1.5 text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>CSRF & Rate-Limit Protected</span>
                </div>
                <span>•</span>
                <div class="flex items-center gap-1.5 text-brand-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Role-Based Access</span>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer Copyright -->
    <footer class="w-full text-center text-xs text-surface-400 py-3 relative z-10 font-medium">
        &copy; {{ date('Y') }} {{ __('messages.company_name') }}. {{ app()->getLocale() === 'ar' ? 'كافة الحقوق محفوظة.' : 'All rights reserved.' }}
    </footer>

    <!-- Interactive Scripts -->
    <script>
        // Password Visibility Toggle
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpenIcon');
        const eyeClosed = document.getElementById('eyeClosedIcon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                }
            });
        }

        // Dark Mode Permanent Enforcement (No Day Mode)
        (function() {
            try { localStorage.setItem('sts_admin_theme', 'dark'); } catch(e) {}
            document.documentElement.classList.remove('admin-theme-light');
            document.documentElement.classList.add('admin-theme-dark');
            document.body.classList.remove('admin-theme-light');
            document.body.classList.add('admin-theme-dark');
            document.body.style.backgroundColor = '#060b16';
        })();
    </script>
</body>
</html>
