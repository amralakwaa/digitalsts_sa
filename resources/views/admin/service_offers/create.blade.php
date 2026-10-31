@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إضافة باقة عرض خدمة جديدة' : 'Create New Service Package') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إضافة باقة / عرض خدمة' : 'New Service Package')

@section('content')

<div class="max-w-4xl space-y-6">

    <!-- Back Button -->
    <a href="{{ route('admin.service-offers.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>العودة لقائمة الباقات والعروض</span>
    </a>

    <!-- Main Card Form -->
    <div class="card-light rounded-3xl p-6 sm:p-8 shadow-soft">
        <div class="border-b border-surface-100 pb-5 mb-6">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'إنشاء باقة ترويجية أو عرض خدمة جديد' : 'Create Turnkey Service Package or Promotional Offer' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                {{ app()->getLocale() === 'ar' ? 'حدد اسم الباقة، الخدمة المرتبطة، الأسعار والخصومات، والمواصفات المشمولة' : 'Configure package scope, pricing tiers, discounts, and itemized features' }}
            </p>
        </div>

        <form action="{{ route('admin.service-offers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Section 1: Basic Info -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '1. البيانات الأساسية للباقة' : '1. Package Identity' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Title AR -->
                    <div>
                        <label for="title_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم الباقة بالعربية <span class="text-rose-500">*</span></label>
                        <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required
                               placeholder="مثال: باقة المراقبة الذكية الشاملة للشركات"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                        @error('title_ar')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title EN -->
                    <div>
                        <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Package Title (English) <span class="text-rose-500">*</span></label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" required dir="ltr"
                               placeholder="e.g. Enterprise Smart AI Surveillance Pack"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-outfit text-start">
                        @error('title_en')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Linked Service -->
                    <div>
                        <label for="service_id" class="block text-xs font-bold text-surface-700 uppercase mb-2">الخدمة التابعة لها</label>
                        <select id="service_id" name="service_id" class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                            <option value="">باقة عامة (شاملة لعدة خدمات)</option>
                            @foreach($services as $srv)
                                <option value="{{ $srv->id }}" {{ old('service_id') == $srv->id ? 'selected' : '' }}>
                                    {{ $srv->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">ترتيب الظهور <span class="text-rose-500">*</span></label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $nextSort) }}" required min="1"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                    </div>

                    <!-- Badge AR -->
                    <div>
                        <label for="badge_text_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">شارة ترويجية بالعربية (اختياري)</label>
                        <input type="text" id="badge_text_ar" name="badge_text_ar" value="{{ old('badge_text_ar') }}"
                               placeholder="مثال: الأكثر طلباً، خصم 25%، باقة المشاريع"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">
                    </div>

                    <!-- Badge EN -->
                    <div>
                        <label for="badge_text_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Promotional Badge (English)</label>
                        <input type="text" id="badge_text_en" name="badge_text_en" value="{{ old('badge_text_en') }}" dir="ltr"
                               placeholder="e.g. Most Popular, 25% OFF, Best Value"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-outfit text-start">
                    </div>
                </div>
            </div>

            <!-- Section 2: Pricing & Validity -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '2. التسعير، الخصم، وفترة السريان' : '2. Pricing & Terms' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Original Price -->
                    <div>
                        <label for="price" class="block text-xs font-bold text-surface-700 uppercase mb-2">السعر الأصلي (ر.س) <span class="text-rose-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" required step="0.01" min="0"
                               placeholder="25000"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                        @error('price')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discounted Price -->
                    <div>
                        <label for="discount_price" class="block text-xs font-bold text-surface-700 uppercase mb-2">السعر بعد الخصم (ر.س)</label>
                        <input type="number" id="discount_price" name="discount_price" value="{{ old('discount_price') }}" step="0.01" min="0"
                               placeholder="19500 (اتركه فارغاً إذا لا يوجد خصم)"
                               class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                        @error('discount_price')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Billing Period -->
                    <div>
                        <label for="billing_period" class="block text-xs font-bold text-surface-700 uppercase mb-2">نظام الاحتساب <span class="text-rose-500">*</span></label>
                        <select id="billing_period" name="billing_period" required class="w-full px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-bold">
                            <option value="project" {{ old('billing_period', 'project') === 'project' ? 'selected' : '' }}>لكل مشروع (Turnkey Project)</option>
                            <option value="monthly" {{ old('billing_period') === 'monthly' ? 'selected' : '' }}>شهرياً (Monthly)</option>
                            <option value="annually" {{ old('billing_period') === 'annually' ? 'selected' : '' }}>سنوياً (Annually SLA)</option>
                            <option value="one_time" {{ old('billing_period') === 'one_time' ? 'selected' : '' }}>دفعة واحدة (One-Time)</option>
                        </select>
                    </div>

                    <!-- Valid Until -->
                    <div class="sm:col-span-3">
                        <label for="valid_until" class="block text-xs font-bold text-surface-700 uppercase mb-2">تاريخ انتهاء العرض (اختياري)</label>
                        <input type="date" id="valid_until" name="valid_until" value="{{ old('valid_until') }}"
                               class="w-full sm:w-72 px-4 py-2.5 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-mono">
                        <p class="mt-1 text-[11px] text-surface-400">إذا لم يتم تحديد تاريخ، سيظل العرض سارياً ومتاحاً بصفة دائمة</p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Descriptions -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '3. النبذة والوصف التفصيلي' : '3. Descriptions' }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="description_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوصف بالعربية</label>
                        <textarea id="description_ar" name="description_ar" rows="3"
                                  placeholder="موجز عن الباقة والقيمة المضافة التي تقدمها للمنشأة..."
                                  class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500">{{ old('description_ar') }}</textarea>
                    </div>

                    <div>
                        <label for="description_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Description (English)</label>
                        <textarea id="description_en" name="description_en" rows="3" dir="ltr"
                                  placeholder="Summary of this package, technical deliverables, and value proposition..."
                                  class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-outfit text-start">{{ old('description_en') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 4: Features & Included Items -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                        {{ app()->getLocale() === 'ar' ? '4. البنود والمواصفات المشمولة في الباقة' : '4. Included Items & Features' }}
                    </h3>
                    <span class="text-[11px] text-surface-400">اكتب كل بند في سطر مستقل</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="features_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">المواصفات والبنود بالعربية (سطر لكل بند)</label>
                        <textarea id="features_ar" name="features_ar" rows="6"
                                  placeholder="16 كاميرا مراقبة بدقة 4K&#10;جهاز تسجيل شبكي NVR بسعة 32 تيرابايت&#10;رخصة التعرف على لوحات المركبات&#10;تمديد كابلات وتوصيلات Cat6 معتمدة&#10;ضمان شامل سنتين مع صيانة دورية"
                                  class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 leading-relaxed">{{ old('features_ar') }}</textarea>
                    </div>

                    <div>
                        <label for="features_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Features in English (One per line)</label>
                        <textarea id="features_en" name="features_en" rows="6" dir="ltr"
                                  placeholder="16x 4K Ultra-HD Security Cameras&#10;32TB Industrial NVR Storage Server&#10;Automatic Number Plate Recognition (ANPR)&#10;Certified Cat6 Cabling & Gigabit PoE Switches&#10;24-Month Comprehensive Warranty"
                                  class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 font-outfit text-start leading-relaxed">{{ old('features_en') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 5: Status & Visibility Toggles -->
            <div class="space-y-4 pt-4 border-t border-surface-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Featured Toggle -->
                    <label class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80 flex items-center justify-between cursor-pointer hover:border-brand-200 transition-all">
                        <div>
                            <span class="font-bold text-surface-900 text-sm block">تمييز الباقة (Featured Deal)</span>
                            <span class="text-xs text-surface-400 mt-0.5 block">تظهر في أعلى قائمة العروض وتتميز بإطار مضيء</span>
                        </div>
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-surface-300 text-brand-600 focus:ring-brand-500 w-5 h-5">
                    </label>

                    <!-- Active Toggle -->
                    <label class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80 flex items-center justify-between cursor-pointer hover:border-brand-200 transition-all">
                        <div>
                            <span class="font-bold text-surface-900 text-sm block">تفعيل الباقة للجمهور</span>
                            <span class="text-xs text-surface-400 mt-0.5 block">متاحة ومفعلة للظهور والطلب في الموقع</span>
                        </div>
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-surface-300 text-emerald-600 focus:ring-emerald-500 w-5 h-5">
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-surface-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.service-offers.index') }}" class="btn-secondary py-3 px-6">
                    إلغاء
                </a>
                <button type="submit" class="btn-primary py-3 px-8 shadow-brand-glow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>حفظ ونشر الباقة</span>
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
