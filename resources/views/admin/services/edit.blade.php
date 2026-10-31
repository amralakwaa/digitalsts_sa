@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل الخدمة: ' : 'Edit Service: ') . $service->title_ar . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'تعديل الخدمة: ' : 'Edit Service: ') . $service->title_ar)

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة الخدمات' : 'Back to Services List' }}</span>
        </a>
        <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="text-xs font-semibold text-brand-600 hover:underline flex items-center gap-1 bg-brand-50 px-3 py-1.5 rounded-xl border border-brand-100">
            <span>{{ app()->getLocale() === 'ar' ? 'معاينة في الموقع' : 'Preview on Site' }}</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>
    </div>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="card-light rounded-3xl p-8 sm:p-10 space-y-8 shadow-soft">
        @csrf
        @method('PUT')

        <div class="border-b border-surface-100 pb-4">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'تعديل بيانات الخدمة الهندسية' : 'Update Engineering Service Specifications' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                Slug: <code class="text-brand-600 bg-brand-50 px-2 py-0.5 rounded font-mono">{{ $service->slug }}</code>
            </p>
        </div>

        <!-- Section 1: Basic Information -->
        <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        اسم الخدمة (عربي) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar', $service->title_ar) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('title_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        Service Title (English) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $service->title_en) }}" required dir="ltr"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                    @error('title_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">
                        ترتيب الظهور <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    <span class="text-[11px] text-surface-400 mt-1 block">الأرقام الأصغر تظهر أولاً في قائمة الموقع</span>
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-3 cursor-pointer text-sm font-semibold text-surface-700 select-none p-3.5 rounded-xl border border-surface-200 bg-surface-50/50 hover:bg-surface-100 transition-colors w-full">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-surface-300 text-brand-600 focus:ring-brand-500">
                        <div>
                            <span class="block font-bold text-surface-900">حالة التفعيل والظهور</span>
                            <span class="block text-xs text-surface-400 font-normal">مفعلة وتظهر للعملاء والزوار في صفحات الموقع</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Short Descriptions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="description_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوصف المختصر (عربي) <span class="text-rose-500">*</span></label>
                    <textarea id="description_ar" name="description_ar" rows="3" required
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('description_ar', $service->description_ar) }}</textarea>
                    @error('description_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Short Description (English) <span class="text-rose-500">*</span></label>
                    <textarea id="description_en" name="description_en" rows="3" required dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('description_en', $service->description_en) }}</textarea>
                    @error('description_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Visual Media & Icon -->
        <div class="border-t border-surface-100 pt-6 space-y-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-surface-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'الصورة التوضيحية والأيقونة الرمزية' : 'Featured Image & Solution Icon' }}</span>
            </h3>

            <!-- Existing Image Preview & Upload -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-surface-700 uppercase">صورة الغلاف / الواجهة للخدمة</label>
                <div class="flex flex-col sm:flex-row items-center gap-5 p-5 rounded-2xl bg-surface-50 border-2 border-dashed border-surface-200 hover:border-brand-300 transition-colors">
                    <div id="imagePreviewContainer" class="w-24 h-24 rounded-2xl bg-white border border-surface-200 flex items-center justify-center overflow-hidden flex-shrink-0 text-surface-400 shadow-xs relative">
                        @if($service->image)
                            <img id="imagePreview" src="{{ asset('storage/' . $service->image) }}" alt="Preview" class="w-full h-full object-cover">
                        @else
                            <svg id="previewPlaceholderIcon" class="w-8 h-8 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                    <div class="space-y-2 text-center sm:text-start flex-1">
                        <input type="file" id="imageInput" name="image" accept="image/*" class="block w-full text-xs text-surface-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all cursor-pointer">
                        <p class="text-[11px] text-surface-400">يمكنك رفع صورة بديلة أو إبقاء الصورة الحالية. الصيغ المدعومة: WEBP, JPG, PNG.</p>
                        
                        @if($service->image)
                            <label class="inline-flex items-center gap-2 text-xs text-rose-600 font-semibold cursor-pointer pt-1">
                                <input type="checkbox" name="remove_image" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                                <span>حذف الصورة الحالية واستخدام الأيقونة الافتراضية</span>
                            </label>
                        @endif

                        @error('image')
                            <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Icon Picker Grid -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-surface-700 uppercase">الأيقونة الهندسية للخدمة</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($icons as $iconKey => $iconLabel)
                        <label class="flex items-center gap-2.5 p-3 rounded-xl border border-surface-200 bg-white hover:border-brand-400 hover:bg-brand-50/20 cursor-pointer transition-all has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50/50 has-[:checked]:ring-2 has-[:checked]:ring-brand-500/20">
                            <input type="radio" name="icon" value="{{ $iconKey }}" {{ old('icon', $service->icon ?: 'shield-check') === $iconKey ? 'checked' : '' }} class="w-4 h-4 text-brand-600 focus:ring-brand-500">
                            <span class="text-xs font-semibold text-surface-800 line-clamp-1">{{ $iconKey }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section 3: Comprehensive Content -->
        <div class="border-t border-surface-100 pt-6 space-y-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-surface-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'المحتوى التفصيلي والهندسي' : 'Full Technical Content' }}</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="content_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">المحتوى التفصيلي الكامل (عربي)</label>
                    <textarea id="content_ar" name="content_ar" rows="6"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('content_ar', $service->content_ar) }}</textarea>
                </div>

                <div>
                    <label for="content_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Detailed Content (English)</label>
                    <textarea id="content_en" name="content_en" rows="6" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('content_en', $service->content_en) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 4: Dynamic Features & Benefits (One per line) -->
        <div class="border-t border-surface-100 pt-6 space-y-6">
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-surface-700 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'المميزات، الفوائد، والقطاعات المستهدفة' : 'Key Features, Benefits & Sectors' }}</span>
                </h3>
                <p class="text-xs text-surface-400 mt-1">اكتب كل عنصر في سطر منفصل (Enter) ليتم تقسيمه تلقائياً وعرضه في بطاقات منسقة داخل صفحة الخدمة.</p>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="features_ar" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        المواصفات والخصائص الهندسية (عربي)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">كل ميزة في سطر منفصل</span>
                    <textarea id="features_ar" name="features_ar" rows="4"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono leading-relaxed">{{ old('features_ar', is_array($service->features_ar) ? implode("\n", $service->features_ar) : '') }}</textarea>
                </div>

                <div>
                    <label for="features_en" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        Key Features & Capabilities (English)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">One capability per line</span>
                    <textarea id="features_en" name="features_en" rows="4" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono leading-relaxed font-outfit">{{ old('features_en', is_array($service->features_en) ? implode("\n", $service->features_en) : '') }}</textarea>
                </div>
            </div>

            <!-- Benefits -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="benefits_ar" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        العائد والقيمة المضافة للعميل (عربي)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">كل فائدة في سطر منفصل</span>
                    <textarea id="benefits_ar" name="benefits_ar" rows="4"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono leading-relaxed">{{ old('benefits_ar', is_array($service->benefits_ar) ? implode("\n", $service->benefits_ar) : '') }}</textarea>
                </div>

                <div>
                    <label for="benefits_en" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        Business & Safety Benefits (English)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">One benefit per line</span>
                    <textarea id="benefits_en" name="benefits_en" rows="4" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono leading-relaxed font-outfit">{{ old('benefits_en', is_array($service->benefits_en) ? implode("\n", $service->benefits_en) : '') }}</textarea>
                </div>
            </div>

            <!-- Target Sectors -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="sectors_ar" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        القطاعات والمنشآت المستفيدة (عربي)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">كل قطاع في سطر منفصل</span>
                    <textarea id="sectors_ar" name="sectors_ar" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-mono leading-relaxed">{{ old('sectors_ar', is_array($service->sectors_ar) ? implode("\n", $service->sectors_ar) : '') }}</textarea>
                </div>

                <div>
                    <label for="sectors_en" class="block text-xs font-bold text-surface-700 uppercase mb-1">
                        Target Industry Sectors (English)
                    </label>
                    <span class="text-[11px] text-surface-400 block mb-2">One sector per line</span>
                    <textarea id="sectors_en" name="sectors_en" rows="3" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-mono leading-relaxed font-outfit">{{ old('sectors_en', is_array($service->sectors_en) ? implode("\n", $service->sectors_en) : '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Submission Footer -->
        <div class="pt-6 border-t border-surface-100 flex items-center justify-between">
            <button type="submit" class="btn-primary py-3 px-6 shadow-md">
                <span>{{ __('messages.save_changes') }}</span>
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn-secondary py-3 px-6">
                {{ __('messages.cancel') }}
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const img = document.getElementById('imagePreview');
                img.src = evt.target.result;
                img.classList.remove('hidden');
                const placeholder = document.getElementById('previewPlaceholderIcon');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
