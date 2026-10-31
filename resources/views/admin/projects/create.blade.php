@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إضافة مشروع جديد' : 'Add New Project') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إضافة مشروع جديد' : 'Add New Project')

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة المشاريع' : 'Back to Projects List' }}</span>
        </a>
    </div>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="card-light rounded-3xl p-8 sm:p-10 space-y-8 shadow-soft">
        @csrf

        <div class="border-b border-surface-100 pb-4">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'بيانات وسابقة أعمال المشروع المنفذ' : 'Executed Project Case Study Details' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                {{ app()->getLocale() === 'ar' ? 'أدخل تفاصيل المشروع وصوره لإظهاره في معرض إنجازات وسابقة أعمال الشركة' : 'Provide portfolio case study details and photography to feature in the portfolio' }}
            </p>
        </div>

        <!-- Section 1: Main Information -->
        <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم المشروع (عربي) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required
                           placeholder="مثال: مجمع أبراج المالية الذكي"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('title_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Project Title (English) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" required dir="ltr"
                           placeholder="e.g. Financial Smart Towers Complex"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                    @error('title_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold text-surface-700 uppercase mb-2">القطاع والنشاط <span class="text-rose-500">*</span></label>
                    <select id="category" name="category" required class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                        <option value="commercial" {{ old('category') === 'commercial' ? 'selected' : '' }}>تجاري ومكاتب (Commercial)</option>
                        <option value="hospitality" {{ old('category') === 'hospitality' ? 'selected' : '' }}>ضيافة وفنادق (Hospitality)</option>
                        <option value="residential" {{ old('category') === 'residential' ? 'selected' : '' }}>فلل وقصور وسكني (Residential)</option>
                        <option value="industrial" {{ old('category') === 'industrial' ? 'selected' : '' }}>صناعي ومستودعات ومصانع (Industrial)</option>
                        <option value="government" {{ old('category') === 'government' ? 'selected' : '' }}>حكومي ومؤسسات عامة (Government)</option>
                    </select>
                </div>

                <div>
                    <label for="client" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم العميل / الجهة المالكة</label>
                    <input type="text" id="client" name="client" value="{{ old('client') }}"
                           placeholder="مثال: شركة التطوير العقاري الكبرى"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="location" class="block text-xs font-bold text-surface-700 uppercase mb-2">الموقع الجغرافي والمدينة</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                           placeholder="مثال: الرياض - طريق الملك فهد"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="completion_date" class="block text-xs font-bold text-surface-700 uppercase mb-2">تاريخ الإنجاز والتسليم</label>
                    <input type="date" id="completion_date" name="completion_date" value="{{ old('completion_date') }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">الترتيب في العرض <span class="text-rose-500">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $nextSort ?? 1) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-3 cursor-pointer text-sm font-semibold text-surface-700 select-none p-3.5 rounded-xl border border-surface-200 bg-surface-50/50 hover:bg-surface-100 transition-colors w-full">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-surface-300 text-brand-600 focus:ring-brand-500">
                        <div>
                            <span class="block font-bold text-surface-900">نشر المشروع فوراً</span>
                            <span class="block text-xs text-surface-400 font-normal">ظاهر في قائمة مشاريع الشركة للزوار</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Short Descriptions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="description_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوصف المختصر (عربي) <span class="text-rose-500">*</span></label>
                    <textarea id="description_ar" name="description_ar" rows="3" required
                              placeholder="ملخص نطاق الأعمال والأنظمة التي تم توريدها وتركيبها..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Short Description (English) <span class="text-rose-500">*</span></label>
                    <textarea id="description_en" name="description_en" rows="3" required dir="ltr"
                              placeholder="Brief case study summary for portfolio card display..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Cover Image & Gallery -->
        <div class="border-t border-surface-100 pt-6 space-y-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-surface-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'صورة الغلاف ومعرض صور المشروع' : 'Cover Image & Project Gallery' }}</span>
            </h3>

            <!-- Cover Image -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-surface-700 uppercase">صورة الغلاف الرئيسية للمشروع</label>
                <div class="flex flex-col sm:flex-row items-center gap-5 p-5 rounded-2xl bg-surface-50 border-2 border-dashed border-surface-200 hover:border-brand-300 transition-colors">
                    <div id="coverPreviewContainer" class="w-28 h-20 rounded-2xl bg-white border border-surface-200 flex items-center justify-center overflow-hidden flex-shrink-0 text-surface-400 shadow-xs">
                        <svg id="coverPlaceholderIcon" class="w-8 h-8 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <img id="coverPreview" src="" alt="Cover Preview" class="w-full h-full object-cover hidden">
                    </div>
                    <div class="space-y-1.5 text-center sm:text-start flex-1">
                        <input type="file" id="coverImageInput" name="cover_image" accept="image/*" class="block w-full text-xs text-surface-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all cursor-pointer">
                        <p class="text-[11px] text-surface-400">الصيغ المدعومة: WEBP, JPG, PNG. الدقة الموصى بها: 1200x800 بكسل.</p>
                        @error('cover_image')
                            <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Gallery Images -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-surface-700 uppercase">صور إضافية لمعرض أعمال المشروع (متعددة)</label>
                <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200 space-y-2">
                    <input type="file" name="gallery_images[]" multiple accept="image/*" class="block w-full text-xs text-surface-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-surface-200 file:text-surface-700 hover:file:bg-surface-300 transition-all cursor-pointer">
                    <p class="text-[11px] text-surface-400">يمكنك تحديد عدة صور في نفس الوقت لرفعها في ألبوم المشروع.</p>
                </div>
            </div>
        </div>

        <!-- Section 3: Full Detailed Case Study -->
        <div class="border-t border-surface-100 pt-6 space-y-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-surface-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل نطاق الأعمال والتنفيذ الهندسية' : 'Comprehensive Execution Narrative' }}</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="content_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">التفاصيل الكاملة للتنفيذ (عربي)</label>
                    <textarea id="content_ar" name="content_ar" rows="6"
                              placeholder="شرح متكامل للتحديات، الأنظمة التقنية المنفذة، وشهادات الإنجاز والاعتماد..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('content_ar') }}</textarea>
                </div>

                <div>
                    <label for="content_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Execution Details (English)</label>
                    <textarea id="content_en" name="content_en" rows="6" dir="ltr"
                              placeholder="Comprehensive narrative of engineering challenges, solutions implemented, and completion certificates..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('content_en') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Footer -->
        <div class="pt-6 border-t border-surface-100 flex items-center justify-between">
            <button type="submit" class="btn-primary py-3 px-6 shadow-md">
                <span>{{ app()->getLocale() === 'ar' ? 'حفظ ونشر المشروع' : 'Save & Publish Project' }}</span>
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary py-3 px-6">
                {{ __('messages.cancel') }}
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('coverImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const img = document.getElementById('coverPreview');
                img.src = evt.target.result;
                img.classList.remove('hidden');
                document.getElementById('coverPlaceholderIcon').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
