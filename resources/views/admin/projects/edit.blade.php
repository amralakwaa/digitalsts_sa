@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل المشروع: ' : 'Edit Project: ') . $project->title_ar . ' — STS')
@section('header_title', (app()->getLocale() === 'ar' ? 'تعديل المشروع: ' : 'Edit Project: ') . $project->title_ar)

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة المشاريع' : 'Back to Projects List' }}</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="text-xs font-semibold text-brand-600 hover:underline flex items-center gap-1 bg-brand-50 px-3 py-1.5 rounded-xl border border-brand-100">
                <span>{{ app()->getLocale() === 'ar' ? 'معاينة في الموقع' : 'Preview on Site' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>

            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المشروع؟' : 'Are you sure you want to delete this project?' }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 text-xs font-bold transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'حذف المشروع' : 'Delete Project' }}
                </button>
            </form>
        </div>
    </div>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="card-light rounded-3xl p-8 sm:p-10 space-y-8 shadow-soft">
        @csrf
        @method('PUT')

        <div class="border-b border-surface-100 pb-4">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'تعديل بيانات وسابقة أعمال المشروع' : 'Update Project Information' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                Slug: <code class="text-brand-600 bg-brand-50 px-2 py-0.5 rounded font-mono">{{ $project->slug }}</code>
            </p>
        </div>

        <!-- Section 1: Main Information -->
        <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم المشروع (عربي) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar', $project->title_ar) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('title_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Project Title (English) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $project->title_en) }}" required dir="ltr"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                    @error('title_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold text-surface-700 uppercase mb-2">القطاع <span class="text-rose-500">*</span></label>
                    <select id="category" name="category" required class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                        <option value="commercial" {{ old('category', $project->category) === 'commercial' ? 'selected' : '' }}>تجاري ومكاتب (Commercial)</option>
                        <option value="hospitality" {{ old('category', $project->category) === 'hospitality' ? 'selected' : '' }}>ضيافة وفنادق (Hospitality)</option>
                        <option value="residential" {{ old('category', $project->category) === 'residential' ? 'selected' : '' }}>فلل وقصور وسكني (Residential)</option>
                        <option value="industrial" {{ old('category', $project->category) === 'industrial' ? 'selected' : '' }}>صناعي ومستودعات ومصانع (Industrial)</option>
                        <option value="government" {{ old('category', $project->category) === 'government' ? 'selected' : '' }}>حكومي ومؤسسات عامة (Government)</option>
                    </select>
                </div>

                <div>
                    <label for="client" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم العميل / الجهة</label>
                    <input type="text" id="client" name="client" value="{{ old('client', $project->client) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="location" class="block text-xs font-bold text-surface-700 uppercase mb-2">الموقع</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="completion_date" class="block text-xs font-bold text-surface-700 uppercase mb-2">تاريخ الإنجاز</label>
                    <input type="date" id="completion_date" name="completion_date" value="{{ old('completion_date', $project->completion_date ? $project->completion_date->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">الترتيب <span class="text-rose-500">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-3 cursor-pointer text-sm font-semibold text-surface-700 select-none p-3.5 rounded-xl border border-surface-200 bg-surface-50/50 hover:bg-surface-100 transition-colors w-full">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }} class="w-5 h-5 rounded border-surface-300 text-brand-600 focus:ring-brand-500">
                        <div>
                            <span class="block font-bold text-surface-900">نشر المشروع</span>
                            <span class="block text-xs text-surface-400 font-normal">ظاهر في الموقع العام</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Short Descriptions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="description_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوصف المختصر (عربي) <span class="text-rose-500">*</span></label>
                    <textarea id="description_ar" name="description_ar" rows="3" required
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('description_ar', $project->description_ar) }}</textarea>
                    @error('description_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Short Description (English) <span class="text-rose-500">*</span></label>
                    <textarea id="description_en" name="description_en" rows="3" required dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('description_en', $project->description_en) }}</textarea>
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

            <!-- Existing Cover & Replacement -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-surface-700 uppercase">صورة الغلاف الحالية للمشروع</label>
                <div class="flex flex-col sm:flex-row items-center gap-5 p-5 rounded-2xl bg-surface-50 border-2 border-dashed border-surface-200 hover:border-brand-300 transition-colors">
                    <div id="coverPreviewContainer" class="w-28 h-20 rounded-2xl bg-white border border-surface-200 flex items-center justify-center overflow-hidden flex-shrink-0 text-surface-400 shadow-xs relative">
                        @if($project->cover_image_url)
                            <img id="coverPreview" src="{{ $project->cover_image_url }}" alt="Cover" class="w-full h-full object-cover">
                        @else
                            <svg id="coverPlaceholderIcon" class="w-8 h-8 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <img id="coverPreview" src="" alt="Cover Preview" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                    <div class="space-y-2 text-center sm:text-start flex-1">
                        <input type="file" id="coverImageInput" name="cover_image" accept="image/*" class="block w-full text-xs text-surface-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all cursor-pointer">
                        <p class="text-[11px] text-surface-400">يمكنك رفع صورة بديلة للغلاف أو إبقاء الصورة الحالية.</p>
                        
                        @if($project->cover_image)
                            <label class="inline-flex items-center gap-2 text-xs text-rose-600 font-semibold cursor-pointer pt-1">
                                <input type="checkbox" name="remove_cover" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                                <span>حذف صورة الغلاف الحالية</span>
                            </label>
                        @endif

                        @error('cover_image')
                            <p class="text-xs text-rose-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Existing Project Gallery Images -->
            <div class="space-y-3">
                <label class="block text-xs font-bold text-surface-700 uppercase">
                    معرض الصور الحالي للمشروع ({{ $project->images->count() }} صورة)
                </label>
                
                @if($project->images->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-2xl bg-surface-50 border border-surface-200">
                        @foreach($project->images as $img)
                            <div class="group relative rounded-xl overflow-hidden border border-surface-200 bg-white shadow-xs aspect-video flex items-center justify-center">
                                <img src="{{ $img->image_url }}" alt="Project Photo" class="w-full h-full object-cover">
                                <button type="button" 
                                        onclick="if(confirm('حذف هذه الصورة من المعرض؟')) { document.getElementById('delete-img-{{ $img->id }}').submit(); }"
                                        class="absolute inset-0 bg-surface-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-1">
                                    <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>حذف</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 rounded-xl bg-surface-50 border border-surface-200 text-xs text-surface-400 text-center">
                        لا توجد صور إضافية في ألبوم هذا المشروع حالياً.
                    </div>
                @endif

                <!-- Upload More Gallery Images -->
                <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200 space-y-1.5">
                    <label class="block text-xs font-bold text-surface-700">إضافة صور جديدة للألبوم</label>
                    <input type="file" name="gallery_images[]" multiple accept="image/*" class="block w-full text-xs text-surface-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-surface-200 file:text-surface-700 hover:file:bg-surface-300 transition-all cursor-pointer">
                    <p class="text-[11px] text-surface-400">يمكنك تحديد عدة صور دفعة واحدة لرفعها وإضافتها إلى المعرض.</p>
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
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed">{{ old('content_ar', $project->content_ar) }}</textarea>
                </div>

                <div>
                    <label for="content_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Execution Details (English)</label>
                    <textarea id="content_en" name="content_en" rows="6" dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all leading-relaxed text-start font-outfit">{{ old('content_en', $project->content_en) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Footer -->
        <div class="pt-6 border-t border-surface-100 flex items-center justify-between">
            <button type="submit" class="btn-primary py-3 px-6 shadow-md">
                <span>{{ __('messages.save_changes') }}</span>
                <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary py-3 px-6">
                {{ __('messages.cancel') }}
            </a>
        </div>
    </form>
</div>

<!-- Hidden Delete Forms for Gallery Images -->
@foreach($project->images as $img)
    <form id="delete-img-{{ $img->id }}" action="{{ route('admin.projects.images.destroy', ['id' => $project->id, 'imageId' => $img->id]) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endforeach

<script>
    document.getElementById('coverImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const img = document.getElementById('coverPreview');
                img.src = evt.target.result;
                img.classList.remove('hidden');
                const placeholder = document.getElementById('coverPlaceholderIcon');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
