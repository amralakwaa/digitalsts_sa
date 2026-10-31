@extends('layouts.app')

@section('title', __('messages.contact_page_title') . ' — ' . __('messages.company_name'))

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>{{ __('messages.nav_contact') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up reveal-delay-1">
                {{ __('messages.contact_page_title') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up reveal-delay-2">
                {{ __('messages.contact_page_subtitle') }}
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
            
            <!-- Contact Info Box -->
            <div class="lg:col-span-1 space-y-6 reveal-left">
                <div class="rounded-3xl p-7 sm:p-8 space-y-6 bg-surface-900/70 backdrop-blur-md border border-white/10 hover-lift">
                    <div class="border-b border-white/10 pb-4 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>
                            <span>{{ __('messages.contact_info_title') }}</span>
                        </h2>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>{{ app()->getLocale() === 'ar' ? 'متاحون الآن' : 'Available Now' }}</span>
                        </span>
                    </div>

                    <!-- Address -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'المقر الرئيسي' : 'Headquarters' }}</span>
                            <span class="text-sm font-bold text-white leading-relaxed block">{{ $contactAddress }}</span>
                            <span class="text-xs text-brand-400 mt-1 inline-flex items-center gap-1">
                                <span>{{ app()->getLocale() === 'ar' ? 'المملكة العربية السعودية' : 'Kingdom of Saudi Arabia' }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'الهاتف الموحد' : 'Central Phone' }}</span>
                            <a href="tel:{{ $contactPhone }}" class="text-sm font-bold text-white hover:text-brand-400 transition-colors block" dir="ltr">{{ $contactPhone }}</a>
                        </div>
                    </div>

                    <!-- WhatsApp Direct -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-xs border border-emerald-500/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-surface-500 block mb-1 font-medium">WhatsApp</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWhatsapp) }}" target="_blank" rel="noopener" class="text-sm font-bold text-emerald-400 hover:text-emerald-300 hover:underline flex items-center gap-1.5" dir="ltr">
                                <span>{{ $contactWhatsapp }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}</span>
                            <a href="mailto:{{ $contactEmail }}" class="text-sm font-bold text-white hover:text-brand-400 transition-colors block break-all">{{ $contactEmail }}</a>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-11 h-11 rounded-2xl bg-brand-500/15 text-brand-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300 shadow-xs border border-brand-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-xs text-surface-500 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'أوقات العمل المكتبي' : 'Working Hours' }}</span>
                            <span class="text-sm font-bold text-white block">{{ $workingHours }}</span>
                            <span class="text-xs text-surface-500 mt-1 block">{{ app()->getLocale() === 'ar' ? 'الدعم الفني الميداني يعمل 24/7' : 'Field emergency team active 24/7' }}</span>
                        </div>
                    </div>

                </div>

                <!-- Fast Response Assurance Card -->
                <div class="rounded-3xl p-6 bg-gradient-to-br from-brand-950/80 via-surface-900/80 to-brand-950/60 backdrop-blur-md border border-brand-500/30 flex items-center gap-4 hover-lift">
                    <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center flex-shrink-0 shadow-brand-glow">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-white uppercase tracking-wider mb-1">
                            {{ app()->getLocale() === 'ar' ? 'التزام استجابة SLA' : 'SLA Response Commitment' }}
                        </h4>
                        <p class="text-xs text-surface-400 leading-relaxed">
                            {{ app()->getLocale() === 'ar' ? 'يقوم فريقنا الهندسي بالرد ودراسة الاستفسار خلال أقل من ساعتين عمل.' : 'Our solution engineers respond to all technical inquiries in under 2 business hours.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Message Form -->
            <div class="lg:col-span-2 reveal-scale">
                <form action="{{ route('contact.store') }}" method="POST" class="rounded-3xl p-8 sm:p-10 space-y-6 bg-surface-900/70 backdrop-blur-md border border-white/10">
                    @csrf

                    <div class="border-b border-white/10 pb-5">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            <h2 class="text-xl sm:text-2xl font-black text-white">
                                {{ __('messages.contact_send_msg') }}
                            </h2>
                        </div>
                        <p class="text-xs sm:text-sm text-surface-400">
                            {{ app()->getLocale() === 'ar' ? 'املأ الحقول التالية وسيتواصل معك مستشار هندسي مختص لمناقشة مشروعك' : 'Submit your inquiry below and an authorized technical consultant will get in touch' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_full_name') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'م. خالد عبدالله' : 'Eng. Khalid Abdullah' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('name') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                            @error('name')
                                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_email') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                   placeholder="name@company.com" dir="ltr"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('email') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start">
                            @error('email')
                                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_phone') }}
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="+966 5X XXX XXXX" dir="ltr"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start">
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.contact_form_subject') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'استفسار عن عقد صيانة أو تنفيذ مشروع' : 'Project inquiry or maintenance contract' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('subject') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                            @error('subject')
                                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                            {{ __('messages.contact_form_message') }} <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب تفاصيل استفسارك، موقع المشروع، أو المتطلبات الهندسية هنا...' : 'Write your project details, location, or engineering requirements here...' }}"
                                  class="w-full px-4 py-3.5 rounded-xl bg-surface-800/70 border @error('message') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 text-sm focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-3 border-t border-white/10">
                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            <span>{{ __('messages.contact_form_submit') }}</span>
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                        <span class="text-xs text-surface-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'بياناتك مشفرة ومحمية بخصوصية وسرية تامة' : 'Your data is encrypted and handled with strict confidentiality' }}</span>
                        </span>
                    </div>
                </form>
            </div>

        </div>

        <!-- Interactive Map Visual Section -->
        <div class="mt-16 rounded-3xl p-6 sm:p-8 relative overflow-hidden reveal-up hover-lift bg-surface-900/70 backdrop-blur-md border border-white/10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-black text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'مقرنا الرئيسي في الرياض' : 'Riyadh Headquarters Location' }}</span>
                    </h3>
                    <p class="text-xs text-surface-500 mt-1">
                        {{ app()->getLocale() === 'ar' ? 'نرحب بزيارتكم لمعرض الحلول والمختبر الهندسي في مقر الشركة' : 'Visit our customer experience center and engineering lab in Riyadh' }}
                    </p>
                </div>
                <a href="https://maps.google.com/?q=Riyadh+Saudi+Arabia" target="_blank" rel="noopener" class="btn-secondary text-xs flex-shrink-0 text-white border-white/20 bg-white/5 hover:bg-white/10">
                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'فتح في خرائط Google' : 'Open in Google Maps' }}</span>
                </a>
            </div>
            
            <div class="relative w-full h-64 sm:h-80 rounded-2xl overflow-hidden border border-white/10 shadow-inner bg-surface-950">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115993.45663789018!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d48939b%3A0xedd71f8e7ab007b7!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1620000000000!5m2!1sen!2ssa"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="STS Location Map" class="filter grayscale hover:grayscale-0 transition-all duration-500"></iframe>
            </div>
        </div>

    </div>
</div>

@endsection
