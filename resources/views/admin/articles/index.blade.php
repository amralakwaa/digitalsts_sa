@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'إدارة المقالات والأخبار' : 'Manage Articles & Insights') . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'إدارة المقالات والمدونة' : 'Manage Articles & Blog')

@section('content')

<div class="space-y-6">
    
    <!-- Top Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Articles -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between group hover:border-brand-200 transition-all">
            <div>
                <span class="text-xs text-surface-400 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي المقالات' : 'Total Articles' }}
                </span>
                <span class="text-3xl font-black text-surface-900 font-outfit" data-counter>{{ $stats['total'] }}</span>
                <span class="text-[11px] text-surface-400 block mt-1">
                    {{ app()->getLocale() === 'ar' ? 'المحتوى التثقيفي والهندسي' : 'All published and draft posts' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
        </div>

        <!-- Published Articles -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-emerald-100 group hover:border-emerald-300 transition-all">
            <div>
                <span class="text-xs text-emerald-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المقالات المنشورة' : 'Published Articles' }}
                </span>
                <span class="text-3xl font-black text-emerald-600 font-outfit" data-counter>{{ $stats['published'] }}</span>
                <span class="text-[11px] text-emerald-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'متاحة للزوار والباحثين' : 'Active on live portal' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Draft Articles -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-amber-100 group hover:border-amber-300 transition-all">
            <div>
                <span class="text-xs text-amber-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المسودات غير المنشورة' : 'Draft Articles' }}
                </span>
                <span class="text-3xl font-black text-amber-600 font-outfit" data-counter>{{ $stats['draft'] }}</span>
                <span class="text-[11px] text-amber-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'قيد المراجعة والتحرير' : 'Draft / Unpublished' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>

        <!-- Total Views -->
        <div class="card-light rounded-2xl p-5 flex items-center justify-between border-indigo-100 group hover:border-indigo-300 transition-all">
            <div>
                <span class="text-xs text-indigo-800 block mb-1 font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'إجمالي القراءات' : 'Total Reader Views' }}
                </span>
                <span class="text-3xl font-black text-indigo-600 font-outfit" data-counter>{{ number_format($stats['total_views']) }}</span>

                <span class="text-[11px] text-indigo-700 block mt-1 font-medium">
                    {{ app()->getLocale() === 'ar' ? 'تفاعل الزوار مع المحتوى' : 'Aggregated article pageviews' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">
        
        <!-- Header & Add Button -->
        <div class="p-6 border-b border-surface-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-surface-900">{{ app()->getLocale() === 'ar' ? 'قائمة المقالات والأخبار الهندسية' : 'Articles & Industry News Directory' }}</h2>
                <span class="text-xs text-surface-400">
                    {{ app()->getLocale() === 'ar' ? 'نشر وإدارة المقالات والرؤى الهندسية، التحليلات الفنية، وأخبار التقنيات الذكية' : 'Manage tech articles, engineering research, fire safety guides, and company news' }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                {{-- Bulk Delete Button (hidden by default) --}}
                <button type="button" id="bulkDeleteBtn" onclick="submitBulkDelete()" style="display:none;"
                        class="btn-primary text-xs py-2.5 px-4 shadow-sm bg-rose-600 hover:bg-rose-700 border-rose-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span id="bulkDeleteLabel">{{ app()->getLocale() === 'ar' ? 'حذف المحدد' : 'Delete Selected' }}</span>
                </button>

                {{-- Save Order Button (hidden by default) --}}
                <button type="button" id="saveOrderBtn" onclick="saveSortOrder()" style="display:none;"
                        class="btn-primary text-xs py-2.5 px-4 shadow-sm bg-indigo-600 hover:bg-indigo-700 border-indigo-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حفظ الترتيب' : 'Save Order' }}</span>
                </button>

                <a href="{{ route('admin.articles.create') }}" class="btn-primary text-xs py-2.5 px-4 shadow-sm self-start md:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'إضافة مقال جديد' : 'Write New Article' }}</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="p-4 bg-surface-50/70 border-b border-surface-100">
            <form action="{{ route('admin.articles.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[240px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-surface-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'البحث في المقالات بالعنوان أو الكاتب أو المقتطف...' : 'Search articles by title, author, or excerpt...' }}"
                           class="w-full ps-9 pe-4 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-900 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/10">
                </div>

                <!-- Category Filter -->
                <div class="w-48">
                    <select name="category" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ request('category') === 'all' || !request('category') ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'جميع التصنيفات' : 'All Categories' }}
                        </option>
                        @foreach($categories as $catKey => $catLabel)
                            <option value="{{ $catKey }}" {{ request('category') === $catKey ? 'selected' : '' }}>
                                {{ $catLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="w-36">
                    <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-surface-200 text-surface-700 font-medium focus:outline-none focus:border-brand-500">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'كافة الحالات' : 'All Statuses' }}
                        </option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'منشور فقط' : 'Published Only' }}
                        </option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'مسودة فقط' : 'Draft Only' }}
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn-primary text-xs py-2 px-4">
                    {{ app()->getLocale() === 'ar' ? 'تصفية' : 'Filter' }}
                </button>

                @if(request('q') || (request('category') && request('category') !== 'all') || (request('status') && request('status') !== 'all'))
                    <a href="{{ route('admin.articles.index') }}" class="text-xs text-rose-600 hover:text-rose-700 font-semibold px-2">
                        {{ app()->getLocale() === 'ar' ? 'إعادة ضبط' : 'Reset' }}
                    </a>
                @endif
            </form>
        </div>

        {{-- Bulk Delete Hidden Form --}}
        <form id="bulkDeleteForm" action="{{ route('admin.articles.bulkDelete') }}" method="POST" style="display:none;">
            @csrf
            <div id="bulkDeleteInputs"></div>
        </form>

        <!-- Articles Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs text-surface-700">
                <thead class="bg-surface-50 text-surface-500 font-bold uppercase tracking-wider border-b border-surface-100">
                    <tr>
                        <th class="py-3.5 px-4 text-start w-10">
                            <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="rounded border-surface-300 text-brand-600 focus:ring-brand-500">
                        </th>
                        <th class="py-3.5 px-4 text-start w-16">#</th>
                        <th class="py-3.5 px-4 text-start">{{ app()->getLocale() === 'ar' ? 'المقال والتصنيف' : 'Article & Category' }}</th>
                        <th class="py-3.5 px-4 text-start">{{ app()->getLocale() === 'ar' ? 'الكاتب ووقت القراءة' : 'Author & Read Time' }}</th>
                        <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'ar' ? 'المشاهدات' : 'Views' }}</th>
                        <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'ar' ? 'تاريخ النشر' : 'Date' }}</th>
                        <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}</th>
                        <th class="py-3.5 px-4 text-end">{{ app()->getLocale() === 'ar' ? 'الإجراءات' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody id="sortableArticles" class="divide-y divide-surface-100">
                    @forelse($articles as $article)
                        <tr class="hover:bg-surface-50/80 transition-colors article-row" data-id="{{ $article->id }}" data-sort="{{ $article->sort_order }}">
                            {{-- Checkbox --}}
                            <td class="py-3.5 px-4">
                                <input type="checkbox" name="article_ids[]" value="{{ $article->id }}" onchange="updateBulkUI()" class="article-checkbox rounded border-surface-300 text-brand-600 focus:ring-brand-500">
                            </td>

                            <!-- Image / Thumbnail + Drag Handle -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="drag-handle cursor-grab active:cursor-grabbing text-surface-300 hover:text-surface-500 transition-colors" title="{{ app()->getLocale() === 'ar' ? 'اسحب للترتيب' : 'Drag to reorder' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                                    </div>
                                    <div class="w-14 h-11 rounded-xl overflow-hidden bg-surface-100 border border-surface-200 flex-shrink-0 flex items-center justify-center">
                                        @if($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-brand-50 to-brand-100/50 flex items-center justify-center text-brand-600">
                                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Title & Excerpt -->
                            <td class="py-3.5 px-4 max-w-xs sm:max-w-md">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-brand-50 text-brand-700 border border-brand-200">
                                        {{ $article->category_label }}
                                    </span>
                                    <span class="text-[10px] text-surface-400 font-mono">
                                        {{ $article->slug }}
                                    </span>
                                </div>
                                <h3 class="text-xs sm:text-sm font-bold text-surface-900 line-clamp-1 hover:text-brand-600 transition-colors">
                                    <a href="{{ route('admin.articles.show', $article->id) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-[11px] text-surface-500 line-clamp-1 mt-0.5">
                                    {{ $article->excerpt }}
                                </p>
                            </td>

                            <!-- Author & Reading Time -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-[10px]">
                                        {{ mb_substr($article->author_name ?? 'S', 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="block text-xs font-semibold text-surface-800">{{ $article->author_name ?? 'فريق STS' }}</span>
                                        <span class="block text-[10px] text-surface-400">
                                            {{ $article->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'min read' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Views Count -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-100 text-surface-700 font-bold text-xs font-outfit">
                                    <svg class="w-3.5 h-3.5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    {{ number_format($article->views_count) }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <span class="text-xs text-surface-600 block">
                                    {{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}
                                </span>
                                <span class="text-[10px] text-surface-400 block">
                                    {{ $article->created_at->diffForHumans() }}
                                </span>
                            </td>

                            <!-- Status & Toggle -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" title="{{ app()->getLocale() === 'ar' ? 'تبديل حالة النشر' : 'Toggle publish status' }}"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold transition-all {{ $article->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $article->is_published ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                        <span>{{ $article->is_published ? (app()->getLocale() === 'ar' ? 'منشور' : 'Published') : (app()->getLocale() === 'ar' ? 'مسودة' : 'Draft') }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-end whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- View Details --}}
                                    <a href="{{ route('admin.articles.show', $article->id) }}" title="{{ app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View details' }}"
                                       class="p-2 rounded-lg text-surface-400 hover:text-brand-600 hover:bg-surface-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    @if($article->is_published)
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" title="{{ app()->getLocale() === 'ar' ? 'معاينة في الموقع' : 'View live' }}"
                                           class="p-2 rounded-lg text-surface-400 hover:text-brand-600 hover:bg-surface-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.articles.edit', $article->id) }}" title="{{ app()->getLocale() === 'ar' ? 'تعديل المقال' : 'Edit article' }}"
                                       class="p-2 rounded-lg text-surface-600 hover:text-brand-600 hover:bg-surface-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    {{-- Duplicate --}}
                                    <form action="{{ route('admin.articles.duplicate', $article->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="{{ app()->getLocale() === 'ar' ? 'تكرار المقال' : 'Duplicate article' }}"
                                                class="p-2 rounded-lg text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المقال نهائياً؟' : 'Are you sure you want to permanently delete this article?' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="{{ app()->getLocale() === 'ar' ? 'حذف المقال' : 'Delete article' }}"
                                                class="p-2 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-surface-400">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="w-16 h-16 mx-auto rounded-3xl bg-brand-50 text-brand-600 flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-surface-800">
                                        {{ app()->getLocale() === 'ar' ? 'لم يتم العثور على مقالات مطابقة' : 'No articles found' }}
                                    </p>
                                    <p class="text-xs text-surface-400">
                                        {{ app()->getLocale() === 'ar' ? 'ابدأ بإضافة مقال جديد أو قم بتغيير معايير البحث والتصفية' : 'Create your first engineering article or try different search filters.' }}
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.articles.create') }}" class="btn-primary text-xs inline-flex py-2 px-4">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            <span>{{ app()->getLocale() === 'ar' ? 'إضافة مقال الآن' : 'Create Article Now' }}</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="p-4 border-t border-surface-100 bg-surface-50/50">
                {{ $articles->links() }}
            </div>
        @endif

    </div>

</div>

{{-- SortableJS CDN for Drag & Drop --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

<script>
// ==================== Bulk Delete Logic ====================
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.article-checkbox');
    checkboxes.forEach(cb => cb.checked = masterCheckbox.checked);
    updateBulkUI();
}

function updateBulkUI() {
    const checkboxes = document.querySelectorAll('.article-checkbox:checked');
    const bulkBtn = document.getElementById('bulkDeleteBtn');
    const label = document.getElementById('bulkDeleteLabel');
    const count = checkboxes.length;

    if (count > 0) {
        bulkBtn.style.display = 'inline-flex';
        label.textContent = '{{ app()->getLocale() === "ar" ? "حذف" : "Delete" }} (' + count + ')';
    } else {
        bulkBtn.style.display = 'none';
    }
}

function submitBulkDelete() {
    const checkboxes = document.querySelectorAll('.article-checkbox:checked');
    const count = checkboxes.length;

    if (count === 0) return;

    const confirmMsg = '{{ app()->getLocale() === "ar" ? "هل أنت متأكد من حذف المقالات المحددة نهائياً؟ عدد المقالات:" : "Permanently delete selected articles? Count:" }}' + ' ' + count;
    if (!confirm(confirmMsg)) return;

    const inputsContainer = document.getElementById('bulkDeleteInputs');
    inputsContainer.innerHTML = '';

    checkboxes.forEach(cb => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = cb.value;
        inputsContainer.appendChild(input);
    });

    document.getElementById('bulkDeleteForm').submit();
}

// ==================== Drag & Drop Sorting ====================
let orderChanged = false;

document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.getElementById('sortableArticles');
    if (!tbody || tbody.children.length === 0 || typeof Sortable === 'undefined') return;

    new Sortable(tbody, {
        handle: '.drag-handle',
        animation: 200,
        ghostClass: 'bg-brand-50',
        chosenClass: 'shadow-lg',
        dragClass: 'opacity-50',
        onEnd: function() {
            orderChanged = true;
            document.getElementById('saveOrderBtn').style.display = 'inline-flex';
        }
    });
});

function saveSortOrder() {
    const rows = document.querySelectorAll('#sortableArticles .article-row');
    const orderData = [];

    rows.forEach((row, index) => {
        orderData.push({
            id: parseInt(row.dataset.id),
            sort: index + 1
        });
    });

    const btn = document.getElementById('saveOrderBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg><span>{{ app()->getLocale() === "ar" ? "جاري الحفظ..." : "Saving..." }}</span>';

    fetch('{{ route("admin.articles.updateOrder") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ order: orderData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span>{{ app()->getLocale() === "ar" ? "تم الحفظ ✓" : "Saved ✓" }}</span>';
            btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700', 'border-indigo-600');
            btn.classList.add('bg-emerald-600', 'hover:bg-emerald-700', 'border-emerald-600');
            setTimeout(() => {
                btn.style.display = 'none';
                btn.disabled = false;
                btn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700', 'border-emerald-600');
                btn.classList.add('bg-indigo-600', 'hover:bg-indigo-700', 'border-indigo-600');
                btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span>{{ app()->getLocale() === "ar" ? "حفظ الترتيب" : "Save Order" }}</span>';
                orderChanged = false;
            }, 2000);
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg><span>{{ app()->getLocale() === "ar" ? "خطأ - أعد المحاولة" : "Error - Retry" }}</span>';
    });
}
</script>

@endsection
