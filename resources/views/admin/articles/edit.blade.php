@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تعديل المقال' : 'Edit Article') . ' — ' . $article->title . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'تعديل المقال' : 'Edit Article')

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة المقالات' : 'Back to Articles List' }}</span>
        </a>

        @if($article->is_published)
            <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="text-xs font-bold text-brand-600 hover:underline flex items-center gap-1">
                <span>{{ app()->getLocale() === 'ar' ? 'معاينة في الموقع' : 'View on Public Site' }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        @endif
    </div>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="card-light rounded-3xl p-8 sm:p-10 space-y-8 shadow-soft">
        @csrf
        @method('PUT')

        <div class="border-b border-surface-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-lg font-bold text-surface-900">
                    {{ app()->getLocale() === 'ar' ? 'تعديل بيانات ومحتوى المقال' : 'Edit Article Publication Details' }}
                </h2>
                <p class="text-xs text-surface-400 mt-1 font-mono">
                    ID: #{{ $article->id }} &bull; Slug: {{ $article->slug }} &bull; Views: {{ number_format($article->views_count) }}
                </p>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $article->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                    <span class="w-2 h-2 rounded-full {{ $article->is_published ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                    <span>{{ $article->is_published ? (app()->getLocale() === 'ar' ? 'منشور حالياً' : 'Currently Live') : (app()->getLocale() === 'ar' ? 'مسودة داخلية' : 'Draft') }}</span>
                </span>
            </div>
        </div>

        <!-- Section 1: Titles & Metadata -->
        <div class="space-y-6">
            <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                {{ app()->getLocale() === 'ar' ? '1. العنوان والتصنيف الأساسي' : '1. Core Details & Categorization' }}
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Title AR -->
                <div>
                    <label for="title_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">عنوان المقال (عربي) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar', $article->title_ar) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('title_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title EN -->
                <div>
                    <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Article Title (English) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $article->title_en) }}" required dir="ltr"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                    @error('title_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold text-surface-700 uppercase mb-2">التصنيف الموضوعي <span class="text-rose-500">*</span></label>
                    <select id="category" name="category" required class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                        @foreach($categories as $catKey => $catLabel)
                            <option value="{{ $catKey }}" {{ old('category', $article->category) === $catKey ? 'selected' : '' }}>
                                {{ $catLabel }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author Name -->
                <div>
                    <label for="author_name" class="block text-xs font-bold text-surface-700 uppercase mb-2">اسم الكاتب أو المحرر</label>
                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name', $article->author_name) }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('author_name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">ترتيب الظهور <span class="text-rose-500">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $article->sort_order) }}" required min="0"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit">
                    <p class="mt-1 text-[11px] text-surface-400">الرقم الأقل يظهر أولاً</p>
                    @error('sort_order')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publication Date -->
                <div>
                    <label for="published_at" class="block text-xs font-bold text-surface-700 uppercase mb-2">تاريخ النشر</label>
                    <input type="date" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit">
                    @error('published_at')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Featured Image -->
        <div class="space-y-4 pt-4 border-t border-surface-100">
            <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                {{ app()->getLocale() === 'ar' ? '2. الصورة البارزة للمقال' : '2. Cover / Featured Image' }}
            </h3>

            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <!-- Current / Preview Image Container -->
                    <div id="imagePreviewContainer" class="w-36 h-24 rounded-2xl border-2 border-surface-200 bg-surface-50 flex items-center justify-center overflow-hidden flex-shrink-0 relative group">
                        @if($article->image)
                            <img id="imagePreview" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            <div id="imagePlaceholder" class="text-center p-2 text-surface-400 hidden">
                                <svg class="w-8 h-8 mx-auto mb-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-[10px] block">معاينة الصورة</span>
                            </div>
                        @else
                            <div id="imagePlaceholder" class="text-center p-2 text-surface-400">
                                <svg class="w-8 h-8 mx-auto mb-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-[10px] block">لا توجد صورة</span>
                            </div>
                            <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        @endif
                    </div>

                    <!-- File Input & Remove Option -->
                    <div class="flex-1 space-y-3">
                        <div>
                            <label for="image" class="block text-xs font-bold text-surface-700 uppercase mb-1">استبدال الصورة الحالية</label>
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                                   onchange="previewArticleImage(this)"
                                   class="w-full text-xs text-surface-500 file:me-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                            <p class="mt-1.5 text-[11px] text-surface-400">اختر صورة جديدة لاستبدال الصورة الحالية (WEBP, JPG, PNG حتى 5MB).</p>
                            @error('image')
                                <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($article->image)
                            <div class="flex items-center gap-2">
                                <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-rose-600 font-bold hover:text-rose-700">
                                    <input type="checkbox" name="remove_image" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                                    <span>حذف الصورة الحالية والاعتماد على الأيقونة الافتراضية</span>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Excerpt (Summary) -->
        <div class="space-y-6 pt-4 border-t border-surface-100">
            <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                {{ app()->getLocale() === 'ar' ? '3. المقتطف والملخص السريع (SEO & Card Excerpt)' : '3. Article Excerpts' }}
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="excerpt_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">مقتطف ملخص (عربي) <span class="text-rose-500">*</span></label>
                    <textarea id="excerpt_ar" name="excerpt_ar" rows="3" required
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">{{ old('excerpt_ar', $article->excerpt_ar) }}</textarea>
                    @error('excerpt_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Article Excerpt (English) <span class="text-rose-500">*</span></label>
                    <textarea id="excerpt_en" name="excerpt_en" rows="3" required dir="ltr"
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">{{ old('excerpt_en', $article->excerpt_en) }}</textarea>
                    @error('excerpt_en')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 4: Full Article Content (Rich Text Editor) -->
        <div class="space-y-6 pt-4 border-t border-surface-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? '4. المحتوى الكامل للمقال' : '4. Full Article Body Content' }}
                </h3>
                <span class="text-[11px] text-surface-400 flex items-center gap-2">
                    <span class="font-mono">~{{ str_word_count(strip_tags($article->content_ar . ' ' . $article->content_en)) }} words</span>
                    <span class="text-surface-300">•</span>
                    <span class="text-brand-600 font-medium">{{ app()->getLocale() === 'ar' ? 'محرر متقدم' : 'Rich Text' }}</span>
                </span>
            </div>

            <!-- Content AR -->
            <div>
                <label for="content_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">محتوى المقال الكامل (عربي)</label>
                <textarea id="content_ar" name="content_ar" class="tinymce-editor-ar">{{ old('content_ar', $article->content_ar) }}</textarea>
                @error('content_ar')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content EN -->
            <div>
                <label for="content_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Full Article Body (English)</label>
                <textarea id="content_en" name="content_en" class="tinymce-editor-en">{{ old('content_en', $article->content_en) }}</textarea>
                @error('content_en')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Section 5: Tags & Keywords -->
        <div class="space-y-6 pt-4 border-t border-surface-100">
            <h3 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                {{ app()->getLocale() === 'ar' ? '5. الكلمات المفتاحية والوسوم (Tags)' : '5. Meta Tags & Keywords' }}
            </h3>

            @php
                $tagsArVal = is_array($article->tags_ar) ? implode(', ', $article->tags_ar) : ($article->tags_ar ?? '');
                $tagsEnVal = is_array($article->tags_en) ? implode(', ', $article->tags_en) : ($article->tags_en ?? '');
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="tags_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوسوم بالعربية (مفصولة بفاصلة)</label>
                    <input type="text" id="tags_ar" name="tags_ar" value="{{ old('tags_ar', $tagsArVal) }}"
                           placeholder="كاميرات مراقبة, ذكاء اصطناعي, أنظمة أمنية"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                </div>

                <div>
                    <label for="tags_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Tags in English (comma separated)</label>
                    <input type="text" id="tags_en" name="tags_en" value="{{ old('tags_en', $tagsEnVal) }}" dir="ltr"
                           placeholder="CCTV, Artificial Intelligence, Security"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                </div>
            </div>
        </div>

        <!-- Section 6: Publishing Options -->
        <div class="pt-4 border-t border-surface-100">
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80 flex items-center justify-between">
                <div>
                    <label for="is_published" class="font-bold text-surface-900 text-sm block cursor-pointer">
                        {{ app()->getLocale() === 'ar' ? 'حالة نشر المقال على الموقع' : 'Publish Status on Live Website' }}
                    </label>
                    <p class="text-xs text-surface-400 mt-0.5">
                        {{ app()->getLocale() === 'ar' ? 'المقال المنشور يظهر مباشرة لزوار الموقع في صفحة المقالات وقسم المدونة' : 'Live posts are indexed and visible to all site visitors' }}
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-surface-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-surface-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600"></div>
                </label>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-6 border-t border-surface-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary py-3 px-6">
                {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
            </a>
            <button type="submit" class="btn-primary py-3 px-8 shadow-brand-glow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'حفظ التعديلات' : 'Save Changes' }}</span>
            </button>
        </div>

    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
function previewArticleImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imagePlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// TinyMCE Initialization — Arabic (RTL)
tinymce.init({
    selector: '.tinymce-editor-ar',
    directionality: 'rtl',
    language: 'ar',
    height: 400,
    menubar: 'file edit view insert format tools table',
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount directionality',
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | ltr rtl | removeformat code fullscreen',
    content_style: 'body { font-family: Cairo, Tahoma, sans-serif; font-size: 14px; line-height: 1.8; direction: rtl; }',
    branding: false,
    promotion: false,
    statusbar: true,
    resize: true,
    skin: 'oxide',
    placeholder: 'اكتب المقال الكامل هنا بالتنسيق المتقدم...',
});

// TinyMCE Initialization — English (LTR)
tinymce.init({
    selector: '.tinymce-editor-en',
    directionality: 'ltr',
    height: 400,
    menubar: 'file edit view insert format tools table',
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount directionality',
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | ltr rtl | removeformat code fullscreen',
    content_style: 'body { font-family: Outfit, Inter, system-ui, sans-serif; font-size: 14px; line-height: 1.8; }',
    branding: false,
    promotion: false,
    statusbar: true,
    resize: true,
    skin: 'oxide',
    placeholder: 'Write the complete article content with rich formatting...',
});
</script>

@endsection
