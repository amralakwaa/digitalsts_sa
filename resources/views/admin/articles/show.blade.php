@extends('layouts.admin')

@section('title', (app()->getLocale() === 'ar' ? 'تفاصيل المقال' : 'Article Details') . ' — ' . $article->title . ' — STS')
@section('header_title', app()->getLocale() === 'ar' ? 'تفاصيل المقال' : 'Article Details')

@section('content')

<div class="max-w-5xl space-y-6">

    {{-- Back + Quick Actions Bar --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-surface-500 hover:text-brand-600 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'ar' ? 'العودة لقائمة المقالات' : 'Back to Articles List' }}</span>
        </a>

        <div class="flex items-center gap-2 flex-wrap">
            @if($article->is_published)
                <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 hover:text-brand-700 px-3 py-2 rounded-xl bg-brand-50 border border-brand-100 hover:bg-brand-100 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'معاينة' : 'View Live' }}</span>
                </a>
            @endif

            <a href="{{ route('admin.articles.edit', $article->id) }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold text-surface-700 hover:text-brand-600 px-3 py-2 rounded-xl bg-surface-50 border border-surface-200 hover:bg-surface-100 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'تعديل' : 'Edit' }}</span>
            </a>

            <form action="{{ route('admin.articles.duplicate', $article->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 px-3 py-2 rounded-xl bg-indigo-50 border border-indigo-100 hover:bg-indigo-100 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'تكرار' : 'Duplicate' }}</span>
                </button>
            </form>

            <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold {{ $article->is_published ? 'text-amber-600 bg-amber-50 border-amber-100 hover:bg-amber-100' : 'text-emerald-600 bg-emerald-50 border-emerald-100 hover:bg-emerald-100' }} px-3 py-2 rounded-xl border transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $article->is_published ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}"/></svg>
                    <span>{{ $article->is_published ? (app()->getLocale() === 'ar' ? 'إلغاء النشر' : 'Unpublish') : (app()->getLocale() === 'ar' ? 'نشر الآن' : 'Publish') }}</span>
                </button>
            </form>

            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المقال نهائياً؟' : 'Permanently delete this article?' }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-700 px-3 py-2 rounded-xl bg-rose-50 border border-rose-100 hover:bg-rose-100 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'حذف' : 'Delete' }}</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {{-- Views Count --}}
        <div class="card-light rounded-2xl p-4 text-center border-brand-100 group hover:border-brand-300 transition-all">
            <div class="w-10 h-10 mx-auto rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <span class="text-2xl font-black text-surface-900 font-outfit block">{{ number_format($article->views_count) }}</span>
            <span class="text-[10px] text-surface-400 font-medium">{{ app()->getLocale() === 'ar' ? 'إجمالي المشاهدات' : 'Total Views' }}</span>
        </div>

        {{-- Reading Time --}}
        <div class="card-light rounded-2xl p-4 text-center border-indigo-100 group hover:border-indigo-300 transition-all">
            <div class="w-10 h-10 mx-auto rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-2xl font-black text-surface-900 font-outfit block">{{ $article->reading_time }}</span>
            <span class="text-[10px] text-surface-400 font-medium">{{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'Min Read' }}</span>
        </div>

        {{-- Rank in Category --}}
        <div class="card-light rounded-2xl p-4 text-center border-emerald-100 group hover:border-emerald-300 transition-all">
            <div class="w-10 h-10 mx-auto rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <span class="text-2xl font-black text-surface-900 font-outfit block">#{{ $rankInCategory }}<span class="text-sm text-surface-400">/{{ $categoryCount }}</span></span>
            <span class="text-[10px] text-surface-400 font-medium">{{ app()->getLocale() === 'ar' ? 'الترتيب بالتصنيف' : 'Category Rank' }}</span>
        </div>

        {{-- Views vs Average --}}
        <div class="card-light rounded-2xl p-4 text-center border-amber-100 group hover:border-amber-300 transition-all">
            <div class="w-10 h-10 mx-auto rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            @php $viewDiff = $article->views_count - $avgViews; @endphp
            <span class="text-2xl font-black font-outfit block {{ $viewDiff >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $viewDiff >= 0 ? '+' : '' }}{{ number_format($viewDiff) }}</span>
            <span class="text-[10px] text-surface-400 font-medium">{{ app()->getLocale() === 'ar' ? 'عن المتوسط العام' : 'vs. Average' }}</span>
        </div>
    </div>

    {{-- Main Article Card --}}
    <div class="card-light rounded-3xl overflow-hidden shadow-soft">

        {{-- Hero Image --}}
        @if($article->image)
            <div class="w-full h-56 sm:h-72 overflow-hidden bg-surface-100 relative">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <div class="absolute bottom-4 start-4 end-4 flex items-end justify-between">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-surface-900 shadow-sm backdrop-blur-sm">
                        {{ $article->category_label }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $article->is_published ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white' }} shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white/80"></span>
                        {{ $article->is_published ? (app()->getLocale() === 'ar' ? 'منشور' : 'Published') : (app()->getLocale() === 'ar' ? 'مسودة' : 'Draft') }}
                    </span>
                </div>
            </div>
        @endif

        {{-- Article Content Preview --}}
        <div class="p-8 sm:p-10 space-y-8">

            {{-- Status Bar (shown when no image) --}}
            @if(!$article->image)
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-700 border border-brand-100">
                        {{ $article->category_label }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $article->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $article->is_published ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $article->is_published ? (app()->getLocale() === 'ar' ? 'منشور حالياً' : 'Currently Published') : (app()->getLocale() === 'ar' ? 'مسودة داخلية' : 'Internal Draft') }}
                    </span>
                </div>
            @endif

            {{-- Title --}}
            <div class="space-y-3">
                <h2 class="text-2xl sm:text-3xl font-black text-surface-900 leading-tight">{{ $article->title_ar }}</h2>
                @if($article->title_en)
                    <h3 class="text-lg sm:text-xl font-bold text-surface-600 font-outfit" dir="ltr">{{ $article->title_en }}</h3>
                @endif
            </div>

            {{-- Author & Meta --}}
            <div class="flex flex-wrap items-center gap-6 py-4 border-y border-surface-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ mb_substr($article->author_name ?? 'S', 0, 1) }}
                    </div>
                    <div>
                        <span class="block text-sm font-bold text-surface-900">{{ $article->author_name ?? 'فريق STS' }}</span>
                        <span class="block text-[11px] text-surface-400">{{ app()->getLocale() === 'ar' ? 'الكاتب والمحرر' : 'Author' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-1.5 text-xs text-surface-500">
                    <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="font-outfit">{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</span>
                </div>

                <div class="flex items-center gap-1.5 text-xs text-surface-500">
                    <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $article->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'min read' }}</span>
                </div>

                <div class="flex items-center gap-1.5 text-xs text-surface-500">
                    <svg class="w-4 h-4 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                    <span class="font-mono text-[11px]">{{ $article->slug }}</span>
                </div>
            </div>

            {{-- Excerpt --}}
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'المقتطف / الملخص' : 'Excerpt / Summary' }}
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 uppercase block mb-2">عربي</span>
                        <p class="text-sm text-surface-700 leading-relaxed">{{ $article->excerpt_ar }}</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-surface-50 border border-surface-200/80" dir="ltr">
                        <span class="text-[10px] font-bold text-surface-400 uppercase block mb-2">English</span>
                        <p class="text-sm text-surface-700 leading-relaxed font-outfit">{{ $article->excerpt_en }}</p>
                    </div>
                </div>
            </div>

            {{-- Full Content Preview --}}
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'محتوى المقال الكامل' : 'Full Article Content' }}
                </h4>

                @if($article->content_ar)
                    <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 uppercase block mb-3">{{ app()->getLocale() === 'ar' ? 'المحتوى العربي' : 'Arabic Content' }}</span>
                        <div class="prose max-w-none text-sm text-surface-800 leading-relaxed">
                            {!! $article->content_ar !!}
                        </div>
                    </div>
                @endif

                @if($article->content_en)
                    <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200/80" dir="ltr">
                        <span class="text-[10px] font-bold text-surface-400 uppercase block mb-3">English Content</span>
                        <div class="prose max-w-none text-sm text-surface-800 leading-relaxed font-outfit">
                            {!! $article->content_en !!}
                        </div>
                    </div>
                @endif

                @if(!$article->content_ar && !$article->content_en)
                    <div class="p-5 rounded-2xl bg-surface-50 border border-surface-200/80 text-center">
                        <p class="text-sm text-surface-400 italic">{{ app()->getLocale() === 'ar' ? 'لم يتم إدخال محتوى تفصيلي لهذا المقال بعد.' : 'No detailed content has been entered for this article yet.' }}</p>
                    </div>
                @endif
            </div>

            {{-- Tags --}}
            @php
                $tagsAr = is_array($article->tags_ar) ? $article->tags_ar : [];
                $tagsEn = is_array($article->tags_en) ? $article->tags_en : [];
            @endphp
            @if(count($tagsAr) > 0 || count($tagsEn) > 0)
                <div class="space-y-3 pt-4 border-t border-surface-100">
                    <h4 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                        {{ app()->getLocale() === 'ar' ? 'الوسوم والكلمات المفتاحية' : 'Tags & Keywords' }}
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tagsAr as $tag)
                            <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-100">#{{ $tag }}</span>
                        @endforeach
                        @foreach($tagsEn as $tag)
                            <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100 font-outfit" dir="ltr">#{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Technical Metadata --}}
            <div class="space-y-3 pt-4 border-t border-surface-100">
                <h4 class="text-xs font-bold text-brand-600 uppercase tracking-wider">
                    {{ app()->getLocale() === 'ar' ? 'البيانات التقنية والتعريفية' : 'Technical Metadata' }}
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="p-3 rounded-xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 block mb-1">ID</span>
                        <span class="text-sm font-bold text-surface-900 font-outfit">#{{ $article->id }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 block mb-1">{{ app()->getLocale() === 'ar' ? 'ترتيب الظهور' : 'Sort Order' }}</span>
                        <span class="text-sm font-bold text-surface-900 font-outfit">{{ $article->sort_order }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 block mb-1">{{ app()->getLocale() === 'ar' ? 'تاريخ الإنشاء' : 'Created' }}</span>
                        <span class="text-sm font-bold text-surface-900 font-outfit">{{ $article->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-surface-50 border border-surface-200/80">
                        <span class="text-[10px] font-bold text-surface-400 block mb-1">{{ app()->getLocale() === 'ar' ? 'آخر تحديث' : 'Updated' }}</span>
                        <span class="text-sm font-bold text-surface-900 font-outfit">{{ $article->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
