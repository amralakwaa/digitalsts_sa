@extends('layouts.app')

@section('title', __('messages.quote_page_title') . ' — ' . __('messages.company_name'))

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>{{ __('messages.nav_quote_btn') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up reveal-delay-1">
                {{ __('messages.quote_page_title') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up reveal-delay-2">
                {{ __('messages.quote_page_subtitle') }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT =================== -->
<div class="py-16 sm:py-24 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-80 h-80 bg-accent-sky/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Success Modal / Alert Card -->
        @if(session('quote_success'))
            <div class="mb-10 rounded-3xl p-8 sm:p-12 bg-surface-900/80 backdrop-blur-md border border-emerald-500/30 text-center space-y-6 shadow-soft-xl reveal-scale">
                <div class="w-20 h-20 rounded-3xl bg-emerald-500 text-white mx-auto flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="space-y-2">
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight">
                        {{ __('messages.quote_success_title') }}
                    </h2>
                    <p class="text-sm sm:text-base text-surface-400 max-w-xl mx-auto leading-relaxed">
                        {{ __('messages.quote_success_desc', ['ref' => session('reference_number')]) }}
                    </p>
                </div>

                <!-- Reference Card Pill -->
                <div class="inline-block px-8 py-5 rounded-2xl bg-surface-800/80 border border-brand-500/30 shadow-soft-lg">
                    <span class="text-xs text-surface-500 block mb-1 font-semibold uppercase tracking-wider">{{ __('messages.quote_ref') }}</span>
                    <span class="text-3xl sm:text-4xl font-black tracking-widest text-brand-400 font-outfit select-all block">
                        {{ session('reference_number') }}
                    </span>
                    <span class="text-[11px] text-surface-500 mt-1 block">{{ app()->getLocale() === 'ar' ? 'احتفظ بهذا الرقم لمتابعة حالة الطلب' : 'Keep this reference to track your request' }}</span>
                </div>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('home') }}" class="btn-secondary text-white border-white/20 bg-white/5 hover:bg-white/10">
                        {{ __('messages.nav_home') }}
                    </a>
                    <a href="{{ route('quote.create') }}" class="btn-primary">
                        {{ __('messages.nav_quote_btn') }}
                    </a>
                </div>
            </div>
        @else

            @if(isset($selectedPackage) && $selectedPackage)
                <!-- Selected Offer/Package Notice Banner -->
                <div class="mb-8 rounded-3xl p-6 bg-gradient-to-r from-surface-950 via-brand-950 to-surface-900 text-white shadow-soft-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border border-brand-500/40 relative overflow-hidden reveal-scale hover-lift">
                    <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
                    <div class="flex items-center gap-4 relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-brand-500/20 backdrop-blur border border-brand-400/30 flex items-center justify-center text-brand-300 flex-shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-brand-500/30 text-brand-200 text-[10px] font-black border border-brand-400/40 uppercase tracking-wider">
                                    {{ app()->getLocale() === 'ar' ? 'الباقة المحددة' : 'Selected Package' }}
                                </span>
                                @if($selectedPackage->discount_percentage)
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-500/30 text-emerald-300 text-[10px] font-bold">
                                        -{{ $selectedPackage->discount_percentage }}%
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-base sm:text-xl font-black text-white mt-1">{{ $selectedPackage->title }}</h3>
                            <p class="text-xs text-white/70">{{ optional($selectedPackage->service)->title }} &bull; <span class="font-mono font-black text-brand-300 text-sm">{{ number_format($selectedPackage->price, 0) }} {{ app()->getLocale() === 'ar' ? 'ر.س' : 'SAR' }}</span></p>
                        </div>
                    </div>
                    <a href="{{ route('quote.create') }}" class="relative z-10 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-semibold text-white/80 hover:text-white transition-all whitespace-nowrap border border-white/10">
                        {{ app()->getLocale() === 'ar' ? 'تغيير أو إلغاء الباقة' : 'Clear selection' }}
                    </a>
                </div>
            @endif

            <!-- Interactive Quote Form -->
            <form action="{{ route('quote.store') }}" method="POST" enctype="multipart/form-data" 
                  class="rounded-3xl p-6 sm:p-10 space-y-10 shadow-soft-xl reveal-scale bg-surface-900/70 backdrop-blur-md border border-white/10">
                @csrf

                <!-- Section 1: Contact Details -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-white/10 pb-4">
                        <span class="w-9 h-9 rounded-2xl bg-brand-500/15 text-brand-400 border border-brand-500/30 flex items-center justify-center text-sm font-black font-outfit shadow-xs">01</span>
                        <div>
                            <h3 class="text-base sm:text-lg font-black text-white">
                                {{ app()->getLocale() === 'ar' ? 'بيانات التواصل والمنشأة' : 'Contact & Organization Details' }}
                            </h3>
                            <p class="text-xs text-surface-500">
                                {{ app()->getLocale() === 'ar' ? 'معلومات الاتصال بالمسؤول لمتابعة العرض الهندسي' : 'Direct contact details of project coordinator' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_full_name') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'م. أحمد محمد' : 'Eng. Ahmed Mohammed' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('full_name') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                            @error('full_name')
                                <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_email') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                   placeholder="name@company.com" dir="ltr"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('email') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all text-start">
                            @error('email')
                                <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_phone') }} <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}"
                                   placeholder="+966 5X XXX XXXX" dir="ltr"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('phone') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all text-start">
                            @error('phone')
                                <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label for="company_name" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_company') }}
                            </label>
                            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'شركة أو مؤسسة (اختياري)' : 'Company or Enterprise (Optional)' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Project Scope -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-white/10 pb-4">
                        <span class="w-9 h-9 rounded-2xl bg-brand-500/15 text-brand-400 border border-brand-500/30 flex items-center justify-center text-sm font-black font-outfit shadow-xs">02</span>
                        <div>
                            <h3 class="text-base sm:text-lg font-black text-white">
                                {{ app()->getLocale() === 'ar' ? 'تفاصيل ونطاق المشروع' : 'Project Scope & Requirements' }}
                            </h3>
                            <p class="text-xs text-surface-500">
                                {{ app()->getLocale() === 'ar' ? 'حدد الخدمة المطلوبة ونوع المنشأة والموقع' : 'Select desired solution, sector, and installation location' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Primary Service -->
                        <div>
                            <label for="service_id" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_service') }}
                            </label>
                            <select id="service_id" name="service_id" 
                                    class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                                <option value="">{{ __('messages.form_select_service') }}</option>
                                @foreach($services as $serv)
                                    <option value="{{ $serv->id }}" {{ (old('service_id', $selectedServiceId) == $serv->id) ? 'selected' : '' }}>
                                        {{ $serv->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_project_type') }} <span class="text-rose-500">*</span>
                            </label>
                            <select id="project_type" name="project_type" required
                                    class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('project_type') border-rose-500 @else border-white/10 @enderror text-white focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                                <option value="commercial" {{ old('project_type') === 'commercial' ? 'selected' : '' }}>{{ __('messages.form_project_type_commercial') }}</option>
                                <option value="residential" {{ old('project_type') === 'residential' ? 'selected' : '' }}>{{ __('messages.form_project_type_residential') }}</option>
                                <option value="hospitality" {{ old('project_type') === 'hospitality' ? 'selected' : '' }}>{{ __('messages.form_project_type_hospitality') }}</option>
                                <option value="industrial" {{ old('project_type') === 'industrial' ? 'selected' : '' }}>{{ __('messages.form_project_type_industrial') }}</option>
                                <option value="government" {{ old('project_type') === 'government' ? 'selected' : '' }}>{{ __('messages.form_project_type_government') }}</option>
                                <option value="other" {{ old('project_type') === 'other' ? 'selected' : '' }}>{{ __('messages.form_project_type_other') }}</option>
                            </select>
                            @error('project_type')
                                <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_location') }}
                            </label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'الرياض / جدة / الشرقية / نيوم...' : 'Riyadh / Jeddah / Eastern Province / NEOM...' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                        </div>

                        <!-- Budget -->
                        <div>
                            <label for="estimated_budget" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                                {{ __('messages.form_budget') }}
                            </label>
                            <input type="text" id="estimated_budget" name="estimated_budget" value="{{ old('estimated_budget') }}"
                                   placeholder="50,000 - 200,000 {{ app()->getLocale() === 'ar' ? 'ر.س' : 'SAR' }}"
                                   class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border border-white/10 text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all">
                        </div>
                    </div>

                    <!-- Project Message / Specifications -->
                    <div>
                        <label for="message" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                            {{ __('messages.form_message') }} <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  placeholder="{{ __('messages.form_message_placeholder') }}"
                                  class="w-full px-4 py-3 rounded-xl bg-surface-800/70 border @error('message') border-rose-500 @else border-white/10 @enderror text-white placeholder-surface-500 focus:outline-none focus:bg-surface-800 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition-all leading-relaxed">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Attachment -->
                    <div>
                        <label for="attachment" class="block text-xs font-bold uppercase tracking-wider text-surface-300 mb-2">
                            {{ __('messages.form_attachment') }}
                        </label>
                        <div class="relative">
                            <input type="file" id="attachment" name="attachment"
                                   accept=".pdf,.doc,.docx,.zip,.jpg,.jpeg,.png"
                                   class="w-full text-xs text-surface-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-500/15 file:text-brand-300 hover:file:bg-brand-500/25 file:cursor-pointer border border-dashed border-white/20 rounded-2xl bg-surface-800/50 p-3 hover:border-brand-500/40 transition-colors">
                        </div>
                        <p class="mt-1.5 text-[11px] text-surface-500">
                            {{ app()->getLocale() === 'ar' ? 'الملفات المدعومة: PDF, Word, CAD, ZIP أو صور المخططات (الحد الأقصى 10 ميجابايت)' : 'Supported files: PDF, Word, CAD, ZIP or schematic images (Max 10MB)' }}
                        </p>
                        @error('attachment')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button & Trust Badges -->
                <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <button type="submit" class="btn-primary w-full sm:w-auto text-base px-10 py-4 shadow-lg shadow-brand-500/20">
                        <span>{{ __('messages.form_submit_quote') }}</span>
                        <svg class="w-5 h-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                    <div class="flex items-center gap-2 text-xs text-surface-500">
                        <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>{{ app()->getLocale() === 'ar' ? 'دراسة فنية مجانية معتمدة وتسليم عرض سعر رسمي خلال 24 ساعة' : 'Free engineering assessment & official accredited proposal within 24 hours' }}</span>
                    </div>
                </div>

            </form>
        @endif

    </div>
</div>

@endsection
