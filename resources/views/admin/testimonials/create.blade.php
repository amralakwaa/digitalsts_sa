@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إضافة تقييم عميل جديد' : 'Add New Client Testimonial') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إضافة تقييم عميل' : 'New Client Testimonial')

@section('content')

<div class="max-w-4xl space-y-6">
    
    <!-- Top Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة التقييمات' : 'Back to Testimonials' }}</span>
        </a>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Main Card -->
        <div class="card-light rounded-3xl p-6 sm:p-8 space-y-6 shadow-soft">
            <div class="border-b border-surface-100 pb-4">
                <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'بيانات العميل والمشروع' : 'Client & Project Profile' }}</h2>
                <span class="text-xs text-surface-400">{{ app()->getLocale() === 'ar' ? 'أدخل تفاصيل العميل والجهة ونوع المنظومة الهندسية المنفذة' : 'Specify client name, organization, project field, and location' }}</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Client Name -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'اسم العميل المعتمد *' : 'Client Full Name *' }}
                    </label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" required
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: م. فهد بن عبد العزيز السالم' : 'e.g. Eng. Fahad Al-Salem' }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all @error('client_name') border-rose-500 @enderror">
                    @error('client_name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'المسمى الوظيفي' : 'Job Title / Position' }}
                    </label>
                    <input type="text" name="client_position" value="{{ old('client_position') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: الرئيس التنفيذي للعمليات' : 'e.g. Chief Operating Officer' }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- Company -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'اسم الشركة أو الجهة' : 'Company / Organization' }}
                    </label>
                    <input type="text" name="company" value="{{ old('company') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: شركة التطوير العقاري الكبرى' : 'e.g. Major Real Estate Development' }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- City -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'المدينة / المنطقة' : 'City / Region' }}
                    </label>
                    <input type="text" name="city" value="{{ old('city') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: الرياض، المملكة العربية السعودية' : 'e.g. Riyadh, Saudi Arabia' }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <!-- Project Type -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نوع المشروع أو المنظومة المنفذة' : 'System / Project Field' }}
                    </label>
                    <input type="text" name="project_type" value="{{ old('project_type') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: أنظمة مراقبة ذكية وإنذار حريق مبكر متكامل' : 'e.g. CCTV Surveillance & Early Fire Detection' }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>
            </div>

            <!-- Star Rating Selector -->
            <div class="border-t border-surface-100 pt-6">
                <label class="block text-xs font-bold text-surface-700 uppercase mb-3">
                    {{ app()->getLocale() === 'ar' ? 'التقييم العام (من 1 إلى 5 نجوم) *' : 'Rating Score (1 to 5 Stars) *' }}
                </label>
                <div class="flex items-center gap-4">
                    @php $currentRating = (int) old('rating', 5); @endphp
                    @for($star = 5; $star >= 1; $star--)
                        <label class="flex items-center gap-1.5 cursor-pointer px-3.5 py-2 rounded-xl border border-surface-200 hover:border-amber-400 hover:bg-amber-50/30 transition-all has-[:checked]:border-amber-400 has-[:checked]:bg-amber-50 has-[:checked]:shadow-xs">
                            <input type="radio" name="rating" value="{{ $star }}" class="sr-only" {{ $currentRating === $star ? 'checked' : '' }}>
                            <div class="flex items-center text-amber-400 text-xs">
                                @for($i = 1; $i <= $star; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @endfor
                            </div>
                            <span class="text-xs font-bold text-surface-800 ms-1">{{ $star }}</span>
                        </label>
                    @endfor
                </div>
            </div>

            <!-- Review Texts -->
            <div class="border-t border-surface-100 pt-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نص التقييم والشهادة (عربي) *' : 'Client Review (Arabic) *' }}
                    </label>
                    <textarea name="review_text" rows="4" required
                              placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب شهادة وتقييم العميل للتنفيذ والدعم الفني والاحترافية...' : 'Enter client review in Arabic...' }}"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all @error('review_text') border-rose-500 @enderror">{{ old('review_text') }}</textarea>
                    @error('review_text')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'نص التقييم (English - اختياري)' : 'Client Review (English - Optional)' }}
                    </label>
                    <textarea name="review_text_en" rows="3" dir="ltr"
                              placeholder="Client review in English..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit">{{ old('review_text_en') }}</textarea>
                </div>
            </div>

            <!-- Avatar Image Upload -->
            <div class="border-t border-surface-100 pt-6">
                <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                    {{ app()->getLocale() === 'ar' ? 'صورة العميل أو شعار الشركة (اختياري)' : 'Client Photo or Organization Logo (Optional)' }}
                </label>
                <div class="flex items-center gap-4">
                    <div id="avatarPreviewContainer" class="w-16 h-16 rounded-2xl bg-surface-100 border border-surface-200 flex items-center justify-center text-surface-400 overflow-hidden flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="avatar" id="avatarInput" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="block w-full text-xs text-surface-500 file:me-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                        <span class="text-[11px] text-surface-400 block mt-1">
                            {{ app()->getLocale() === 'ar' ? 'إذا تركت فارغة، سيتم إنشاء دائرة بالأحرف الأولى لاسم العميل تلقائياً.' : 'If left empty, an elegant avatar with client initials will be generated automatically.' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Display Settings & Sort -->
            <div class="border-t border-surface-100 pt-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Sort Order -->
                <div>
                    <label class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        {{ app()->getLocale() === 'ar' ? 'ترتيب الظهور' : 'Sort Order' }}
                    </label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $nextSort) }}" required min="1"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono">
                </div>

                <!-- Active Toggle -->
                <div class="flex items-center gap-3 pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-surface-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-surface-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        <span class="ms-3 text-xs font-bold text-surface-700">{{ app()->getLocale() === 'ar' ? 'تفعيل العرض في الموقع' : 'Active on Live Site' }}</span>
                    </label>
                </div>

                <!-- Featured Toggle -->
                <div class="flex items-center gap-3 pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-surface-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-surface-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                        <span class="ms-3 text-xs font-bold text-surface-700">⭐ {{ app()->getLocale() === 'ar' ? 'تمييز بالصفحة الرئيسية' : 'Featured in Showcase' }}</span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="border-t border-surface-100 pt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary text-xs py-2.5 px-5">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="btn-primary text-xs py-2.5 px-6 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حفظ ونشر التقييم' : 'Save Testimonial' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const container = document.getElementById('avatarPreviewContainer');
        if (file && container) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                container.innerHTML = `<img src="${evt.target.result}" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
