@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إضافة مقال جديد' : 'Write New Article') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إضافة مقال جديد' : 'Write New Article')

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة المقالات' : 'Back to Articles List' }}</span>
        </a>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="card-light rounded-3xl p-8 sm:p-10 space-y-8 shadow-soft">
        @csrf

        <div class="border-b border-surface-100 pb-4">
            <h2 class="text-lg font-bold text-surface-900">
                {{ app()->getLocale() === 'ar' ? 'بيانات ومحتوى المقال الجديد' : 'New Article Publication Details' }}
            </h2>
            <p class="text-xs text-surface-400 mt-1">
                {{ app()->getLocale() === 'ar' ? 'اكتب مقالاً هندسياً أو تحليلاً تقنياً لنشره في مدونة المنصة وقاعدة المعرفة' : 'Publish insights, technical case studies, and engineering knowledge to the public blog' }}
            </p>
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
                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required
                           placeholder="مثال: المعايير الفنية لتصميم شبكات كاميرات المراقبة بالذكاء الاصطناعي"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('title_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title EN -->
                <div>
                    <label for="title_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Article Title (English) <span class="text-rose-500">*</span></label>
                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" required dir="ltr"
                           placeholder="e.g. Technical Standards for Designing AI CCTV Surveillance Networks"
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
                            <option value="{{ $catKey }}" {{ old('category') === $catKey ? 'selected' : '' }}>
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
                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name', 'فريق STS الهندسي') }}"
                           placeholder="مثال: م. أحمد الخالدي — استشاري أنظمة أمنية"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    @error('author_name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-xs font-bold text-surface-700 uppercase mb-2">ترتيب الظهور <span class="text-rose-500">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $nextSort) }}" required min="0"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-outfit">
                    <p class="mt-1 text-[11px] text-surface-400">الرقم الأقل يظهر أولاً في الترتيب</p>
                    @error('sort_order')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publication Date -->
                <div>
                    <label for="published_at" class="block text-xs font-bold text-surface-700 uppercase mb-2">تاريخ النشر المجدول</label>
                    <input type="date" id="published_at" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
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
                <div class="flex items-center gap-6">
                    <!-- Image Preview Container -->
                    <div id="imagePreviewContainer" class="w-36 h-24 rounded-2xl border-2 border-dashed border-surface-300 bg-surface-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                        <div id="imagePlaceholder" class="text-center p-2 text-surface-400">
                            <svg class="w-8 h-8 mx-auto mb-1 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-[10px] block">معاينة الصورة</span>
                        </div>
                        <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>

                    <!-- File Input -->
                    <div class="flex-1">
                        <label for="image" class="block text-xs font-bold text-surface-700 uppercase mb-1">اختر صورة من جهازك</label>
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                               onchange="previewArticleImage(this)"
                               class="w-full text-xs text-surface-500 file:me-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                        <p class="mt-1.5 text-[11px] text-surface-400">الصيغ المدعومة: WEBP, JPG, PNG بحجم أقصى 5 ميجابايت. يفضل أبعاد 1200x630 بكسل.</p>
                        @error('image')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
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
                              placeholder="ملخص مكثف وجذاب يظهر في بطاقة المقال ونتائج محركات البحث (حتى 500 حرف)..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">{{ old('excerpt_ar') }}</textarea>
                    @error('excerpt_ar')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Article Excerpt (English) <span class="text-rose-500">*</span></label>
                    <textarea id="excerpt_en" name="excerpt_en" rows="3" required dir="ltr"
                              placeholder="A concise synopsis shown on the card and search engine snippets (up to 500 chars)..."
                              class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">{{ old('excerpt_en') }}</textarea>
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
                <span class="text-[11px] text-surface-400 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    {{ app()->getLocale() === 'ar' ? 'محرر نصوص متقدم مع تنسيق كامل' : 'Rich text editor with full formatting' }}
                </span>
            </div>

            <!-- Content AR -->
            <div>
                <label for="content_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">محتوى المقال الكامل (عربي)</label>
                <textarea id="content_ar" name="content_ar" class="tinymce-editor-ar">{{ old('content_ar') }}</textarea>
                @error('content_ar')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content EN -->
            <div>
                <label for="content_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Full Article Body (English)</label>
                <textarea id="content_en" name="content_en" class="tinymce-editor-en">{{ old('content_en') }}</textarea>
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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="tags_ar" class="block text-xs font-bold text-surface-700 uppercase mb-2">الوسوم بالعربية (مفصولة بفاصلة)</label>
                    <input type="text" id="tags_ar" name="tags_ar" value="{{ old('tags_ar') }}"
                           placeholder="كاميرات مراقبة, ذكاء اصطناعي, أنظمة أمنية, سلامة"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all">
                    <p class="mt-1 text-[11px] text-surface-400">افصل بين الوسوم بفاصلة (، أو ,)</p>
                </div>

                <div>
                    <label for="tags_en" class="block text-xs font-bold text-surface-700 uppercase mb-2">Tags in English (comma separated)</label>
                    <input type="text" id="tags_en" name="tags_en" value="{{ old('tags_en') }}" dir="ltr"
                           placeholder="CCTV, Artificial Intelligence, Security Systems, Safety"
                           class="w-full px-4 py-3 rounded-xl bg-surface-50 border border-surface-200 text-surface-900 text-sm focus:outline-none focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-start font-outfit">
                    <p class="mt-1 text-[11px] text-surface-400">Separate keywords with a comma (,)</p>
                </div>
            </div>
        </div>

        <!-- Section 6: Publishing Options -->
        <div class="pt-4 border-t border-surface-100">
            <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80 flex items-center justify-between">
                <div>
                    <label for="is_published" class="font-bold text-surface-900 text-sm block cursor-pointer">
                        {{ app()->getLocale() === 'ar' ? 'نشر المقال فوراً على الموقع العام' : 'Publish live on website immediately' }}
                    </label>
                    <p class="text-xs text-surface-400 mt-0.5">
                        {{ app()->getLocale() === 'ar' ? 'إذا كان غير مفعل، سيُحفظ المقال كمسودة داخلية لحين اعتماده' : 'If unchecked, this post will be saved as an internal draft' }}
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="sr-only peer">
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
                <span>{{ app()->getLocale() === 'ar' ? 'حفظ ونشر المقال' : 'Save & Publish Article' }}</span>
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
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
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
