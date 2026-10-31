@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إعدادات الموقع وهوية النظام' : 'Site Settings & System Identity') . ' — STS Executive')
@section('header_title', app()->getLocale() === 'ar' ? 'إعدادات المنظومة وهوية الموقع' : 'Site Settings & Identity')

@section('content')

<div class="max-w-5xl space-y-8">
    
    <!-- Top Intro Hero -->
    <div class="card-light rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-soft">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                <span>{{ app()->getLocale() === 'ar' ? 'الهوية المؤسسية الموحدة لشركة STS' : 'Unified Corporate Identity' }}</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-surface-900 tracking-tight">
                {{ app()->getLocale() === 'ar' ? 'بيانات وإعدادات الموقع الرسمية' : 'Official Site Settings & Identity' }}
            </h2>
            <p class="text-xs sm:text-sm text-surface-500 max-w-2xl leading-relaxed">
                {{ app()->getLocale() === 'ar' 
                    ? 'التحكم الكامل في أرقام الاتصال الموحدة، المقر الرئيسي، روابط التواصل الاجتماعي، ومعلومات تهيئة محركات البحث (SEO).' 
                    : 'Manage official telephone numbers, headquarters address, corporate emails, social profiles, and SEO metadata.' }}
            </p>
        </div>

        <button type="button" onclick="document.getElementById('settingsForm').submit()" class="btn-primary text-xs py-3 px-6 shadow-sm self-start md:self-auto flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ __('messages.save_changes') }}</span>
        </button>
    </div>

    <form id="settingsForm" action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf

        <!-- 1. General Brand Info Section -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="flex items-center gap-3.5 border-b border-surface-100 pb-4">
                <div class="w-10 h-10 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center font-black text-sm border border-brand-100">
                    1
                </div>
                <div>
                    <h3 class="text-base font-bold text-surface-900">
                        {{ app()->getLocale() === 'ar' ? 'الهوية العامة والعناوين الرسمية' : 'General Brand & Headlines' }}
                    </h3>
                    <p class="text-xs text-surface-400">
                        {{ app()->getLocale() === 'ar' ? 'اسم المنصة والشعار الرقمي الرئيسي المعتمد' : 'Platform title and primary tagline' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'اسم الموقع والمنظومة (عربي)' : 'Site Name (Arabic)' }}
                    </label>
                    <input type="text" name="settings[site_name][ar]" 
                           value="{{ old('settings.site_name.ar', \App\Models\SiteSetting::where('key', 'site_name')->value('value_ar')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold">
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        Site Name (English)
                    </label>
                    <input type="text" name="settings[site_name][en]" dir="ltr"
                           value="{{ old('settings.site_name.en', \App\Models\SiteSetting::where('key', 'site_name')->value('value_en')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit font-semibold">
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'الشعار التسويقي الرئيسي (عربي)' : 'Tagline (Arabic)' }}
                    </label>
                    <input type="text" name="settings[site_tagline][ar]" 
                           value="{{ old('settings.site_tagline.ar', \App\Models\SiteSetting::where('key', 'site_tagline')->value('value_ar')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        Tagline (English)
                    </label>
                    <input type="text" name="settings[site_tagline][en]" dir="ltr"
                           value="{{ old('settings.site_tagline.en', \App\Models\SiteSetting::where('key', 'site_tagline')->value('value_en')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                </div>
            </div>
        </div>

        <!-- 2. Unified Contact Details Section -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="flex items-center gap-3.5 border-b border-surface-100 pb-4">
                <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-sm border border-amber-100">
                    2
                </div>
                <div>
                    <h3 class="text-base font-bold text-surface-900">
                        {{ app()->getLocale() === 'ar' ? 'معلومات الاتصال وقنوات خدمة العملاء' : 'Unified Contact & Hotline Channels' }}
                    </h3>
                    <p class="text-xs text-surface-400">
                        {{ app()->getLocale() === 'ar' ? 'الهاتف الموحد، الواتساب المعتمد، والبريد الرسمي للمؤسسة' : 'Direct line, authorized WhatsApp, and official corporate email' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'الهاتف الموحد' : 'Unified Telephone' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-surface-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <input type="text" name="settings[contact_phone][ar]" dir="ltr"
                               value="{{ old('settings.contact_phone.ar', \App\Models\SiteSetting::where('key', 'contact_phone')->value('value_ar')) }}"
                               placeholder="+966 50 676 1942"
                               class="w-full ps-10 pe-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'رقم WhatsApp المعتمد' : 'Authorized WhatsApp Number' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-emerald-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <input type="text" name="settings[contact_whatsapp][ar]" dir="ltr"
                               value="{{ old('settings.contact_whatsapp.ar', \App\Models\SiteSetting::where('key', 'contact_whatsapp')->value('value_ar')) }}"
                               placeholder="+966 50 676 1942"
                               class="w-full ps-10 pe-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني الرسمي' : 'Official Corporate Email' }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-surface-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" name="settings[contact_email][ar]" dir="ltr"
                               value="{{ old('settings.contact_email.ar', \App\Models\SiteSetting::where('key', 'contact_email')->value('value_ar')) }}"
                               placeholder="info@sts.com.sa"
                               class="w-full ps-10 pe-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'ساعات وأيام العمل (عربي)' : 'Working Hours (Arabic)' }}
                    </label>
                    <input type="text" name="settings[working_hours][ar]" 
                           value="{{ old('settings.working_hours.ar', \App\Models\SiteSetting::where('key', 'working_hours')->value('value_ar')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'العنوان الميداني للمقر الرئيسي (عربي)' : 'Headquarters Address (Arabic)' }}
                    </label>
                    <input type="text" name="settings[contact_address][ar]" 
                           value="{{ old('settings.contact_address.ar', \App\Models\SiteSetting::where('key', 'contact_address')->value('value_ar')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        Headquarters Address (English)
                    </label>
                    <input type="text" name="settings[contact_address][en]" dir="ltr"
                           value="{{ old('settings.contact_address.en', \App\Models\SiteSetting::where('key', 'contact_address')->value('value_en')) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                </div>
            </div>
        </div>

        <!-- 3. Social Media & External Presence -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="flex items-center gap-3.5 border-b border-surface-100 pb-4">
                <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm border border-indigo-100">
                    3
                </div>
                <div>
                    <h3 class="text-base font-bold text-surface-900">
                        {{ app()->getLocale() === 'ar' ? 'شبكات التواصل الاجتماعي والمنصات الرقمية' : 'Social Profiles & Digital Presence' }}
                    </h3>
                    <p class="text-xs text-surface-400">
                        {{ app()->getLocale() === 'ar' ? 'روابط الحسابات الرسمية المعتمدة لشركة STS' : 'Official social media and networking URLs' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        LinkedIn Profile URL
                    </label>
                    <input type="url" name="settings[social_linkedin][ar]" dir="ltr"
                           value="{{ old('settings.social_linkedin.ar', \App\Models\SiteSetting::where('key', 'social_linkedin')->value('value_ar')) }}"
                           placeholder="https://linkedin.com/company/sts"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        X (Twitter) Profile URL
                    </label>
                    <input type="url" name="settings[social_x][ar]" dir="ltr"
                           value="{{ old('settings.social_x.ar', \App\Models\SiteSetting::where('key', 'social_x')->value('value_ar')) }}"
                           placeholder="https://x.com/sts_systems"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono">
                </div>
            </div>
        </div>

        <!-- 4. SEO & Search Engine Optimization -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="flex items-center gap-3.5 border-b border-surface-100 pb-4">
                <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-sm border border-emerald-100">
                    4
                </div>
                <div>
                    <h3 class="text-base font-bold text-surface-900">
                        {{ app()->getLocale() === 'ar' ? 'تهيئة محركات البحث (SEO) والأوصاف الوصفية' : 'Search Engine Optimization (SEO)' }}
                    </h3>
                    <p class="text-xs text-surface-400">
                        {{ app()->getLocale() === 'ar' ? 'الوصف المعتمد الذي يظهر في نتائج بحث Google وشبكات المشاركة' : 'Meta description for Google index and rich snippet previews' }}
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'الوصف التعريفي لمحركات البحث (عربي)' : 'Meta Description (Arabic)' }}
                    </label>
                    <textarea name="settings[meta_description][ar]" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('settings.meta_description.ar', \App\Models\SiteSetting::where('key', 'meta_description')->value('value_ar')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        Meta Description (English)
                    </label>
                    <textarea name="settings[meta_description][en]" rows="3" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit text-start leading-relaxed">{{ old('settings.meta_description.en', \App\Models\SiteSetting::where('key', 'meta_description')->value('value_en')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sticky Bottom Bar -->
        <div class="pt-4 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs py-2.5 px-5">
                {{ __('messages.cancel') }}
            </a>
            <button type="submit" class="btn-primary text-xs py-3 px-8 shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ __('messages.save_changes') }}</span>
            </button>
        </div>
    </form>

</div>

@endsection
