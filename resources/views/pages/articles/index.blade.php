@extends('layouts.app')

@section('title', (app()->getLocale() === 'ar' ? 'المقالات والمدونة الهندسية' : 'Articles & Engineering Insights') . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-ping"></span>
                <svg class="w-3.5 h-3.5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span>{{ app()->getLocale() === 'ar' ? 'المدونة الهندسية والمعرفية' : 'Engineering Insights & Knowledge Hub' }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ app()->getLocale() === 'ar' ? 'أحدث المقالات والرؤى الهندسية' : 'Latest Technical Articles & Industry Insights' }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ app()->getLocale() === 'ar' ? 'مقالات متخصصة ودراسات فنية في مجالات المراقبة الذكية، السلامة ومكافحة الحريق، إنترنت الأشياء والشبكات المتطورة.' : 'In-depth engineering analyses, CCTV standards, fire safety guidelines, and smart IoT architectural research.' }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-80 h-80 bg-accent-sky/8 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Search & Filter Bar -->
        <div class="max-w-4xl mx-auto mb-12 reveal-up">
            <form action="{{ route('articles.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative flex-1 w-full group">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none text-surface-400 group-hover:text-brand-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'ابحث في موضوعات ومقالات المدونة (كاميرات، حريق، شبكات، أمان...)' : 'Search articles and technical topics...' }}"
                           class="w-full ps-11 pe-4 py-3.5 text-sm rounded-2xl bg-surface-900/70 backdrop-blur-md border border-white/10 text-white placeholder-surface-500 focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 shadow-soft transition-all group-hover:border-white/20">
                </div>

                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <button type="submit" class="btn-primary w-full sm:w-auto py-3.5 px-7 shadow-brand-glow">
                    <span>{{ app()->getLocale() === 'ar' ? 'بحث' : 'Search' }}</span>
                </button>

                @if(request('q') || request('category'))
                    <a href="{{ route('articles.index') }}" class="btn-secondary w-full sm:w-auto py-3.5 px-4 text-rose-400 hover:text-rose-300 border-white/10 bg-white/5 hover:bg-white/10">
                        <span>{{ app()->getLocale() === 'ar' ? 'إلغاء التصفية' : 'Clear' }}</span>
                    </a>
                @endif
            </form>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-14 reveal-up">
            <a href="{{ route('articles.index', request('q') ? ['q' => request('q')] : []) }}"
               class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all duration-300 {{ !request('category') || request('category') === 'all' ? 'bg-brand-600 text-white shadow-brand-glow scale-105' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 text-surface-300 hover:text-brand-300 hover:border-brand-500/40 shadow-soft' }}">
                {{ app()->getLocale() === 'ar' ? 'كافة المقالات' : 'All Articles' }}
            </a>

            @foreach($categories as $catKey => $catData)
                <a href="{{ route('articles.index', array_merge(request('q') ? ['q' => request('q')] : [], ['category' => $catKey])) }}"
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all duration-300 flex items-center gap-2 {{ request('category') === $catKey ? 'bg-brand-600 text-white shadow-brand-glow scale-105' : 'bg-surface-900/70 backdrop-blur-md border border-white/10 text-surface-300 hover:text-brand-300 hover:border-brand-500/40 shadow-soft' }}">
                    <span>{{ app()->getLocale() === 'ar' ? $catData['label_ar'] : $catData['label_en'] }}</span>
                    @if($catData['count'] > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-mono {{ request('category') === $catKey ? 'bg-white/20 text-white' : 'bg-surface-800 text-surface-400 border border-white/5' }}">
                            {{ $catData['count'] }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- Featured Article Spotlight (If on page 1 without search) -->
        @if($featuredArticle && !request('q') && (!request('category') || request('category') === 'all') && (!request('page') || request('page') == 1))
            <div class="rounded-3xl overflow-hidden shadow-soft-xl hover:shadow-brand-glow/20 transition-all duration-300 mb-16 border border-brand-500/30 bg-surface-900/80 backdrop-blur-md reveal-scale">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b lg:border-b-0 lg:border-e border-white/10 group">
                        @if($featuredArticle->image_url)
                            <img src="{{ $featuredArticle->image_url }}" alt="{{ $featuredArticle->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" fetchpriority="high" decoding="async">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#000418] to-[#010318] flex items-center justify-center text-slate-400 p-12">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>
                        <div class="absolute top-4 start-4">
                            <span class="px-3.5 py-1.5 rounded-full text-xs font-black bg-brand-600 text-white shadow-brand-glow">
                                {{ app()->getLocale() === 'ar' ? 'مقال مميز' : 'Featured Insight' }}
                            </span>
                        </div>
                    </div>

                    <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30">
                                    {{ $featuredArticle->category_label }}
                                </span>
                                <span class="text-xs text-surface-400 flex items-center gap-1 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $featuredArticle->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'min read' }}
                                </span>
                            </div>

                            <h2 class="text-xl sm:text-2xl font-black text-white leading-snug hover:text-brand-300 transition-colors">
                                <a href="{{ route('articles.show', $featuredArticle->slug) }}">
                                    {{ $featuredArticle->title }}
                                </a>
                            </h2>

                            <p class="text-xs sm:text-sm text-surface-300 leading-relaxed line-clamp-3">
                                {{ $featuredArticle->excerpt }}
                            </p>
                        </div>

                        <div class="pt-6 border-t border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-2xl bg-brand-600/30 text-brand-300 border border-brand-500/30 flex items-center justify-center font-bold text-xs shadow-xs">
                                    {{ mb_substr($featuredArticle->author_name ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-white">{{ $featuredArticle->author_name ?? 'فريق STS' }}</span>
                                    <span class="block text-[10px] text-surface-400 font-mono">{{ $featuredArticle->published_at ? $featuredArticle->published_at->format('Y-m-d') : $featuredArticle->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="btn-primary text-xs py-2 px-4 group shadow-brand-glow">
                                <span>{{ app()->getLocale() === 'ar' ? 'قراءة المقال' : 'Read Article' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-stagger="90">
            @forelse($articles as $index => $article)
                <article class="rounded-3xl overflow-hidden shadow-soft hover:shadow-brand-glow/20 transition-all duration-300 flex flex-col group border border-white/10 bg-surface-900/70 backdrop-blur-md hover:border-brand-500/40 reveal-up hover-lift">
                    <!-- Thumbnail (STS Logo Palette) -->
                    <div class="relative h-52 overflow-hidden bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-skeleton-holder">
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 img-lazy-transition" loading="lazy" decoding="async">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#000418] to-[#010318] flex items-center justify-center text-slate-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>

                        <div class="absolute top-3.5 start-3.5">
                            <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-surface-900/90 text-brand-300 shadow-sm backdrop-blur-sm border border-brand-500/30">
                                {{ $article->category_label }}
                            </span>
                        </div>

                        <div class="absolute bottom-3.5 end-3.5">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-semibold bg-surface-950/80 text-white backdrop-blur-sm flex items-center gap-1 font-outfit border border-white/10">
                                <svg class="w-3 h-3 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($article->views_count) }}
                            </span>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 sm:p-7 flex-grow flex flex-col justify-between space-y-4">
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-2 text-xs text-surface-400">
                                <span class="font-mono">{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}</span>
                                <span>&bull;</span>
                                <span>{{ $article->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'mins' }}</span>
                            </div>

                            <h3 class="text-base font-bold text-white group-hover:text-brand-300 transition-colors line-clamp-2 leading-snug">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-xs text-surface-400 line-clamp-3 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs">
                            <span class="font-semibold text-surface-400 truncate max-w-[150px]">
                                {{ $article->author_name ?? 'فريق STS' }}
                            </span>

                            <a href="{{ route('articles.show', $article->slug) }}" class="font-bold text-brand-400 hover:text-brand-300 flex items-center gap-1 group/btn">
                                <span>{{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 rounded-3xl p-8 text-surface-400 reveal-up bg-surface-900/70 backdrop-blur-md border border-white/10">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-surface-800 text-brand-400 flex items-center justify-center border border-white/10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <p class="text-base font-bold text-white">
                        {{ app()->getLocale() === 'ar' ? 'لا توجد مقالات منشورة تطابق بحثك حالياً.' : 'No published articles found matching your criteria.' }}
                    </p>
                    <p class="text-xs text-surface-400 mt-1">
                        {{ app()->getLocale() === 'ar' ? 'جرب البحث بكلمات أخرى أو اختر تصنيفاً آخر.' : 'Try adjusting your search keywords or browse all categories.' }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('articles.index') }}" class="btn-primary text-xs py-2 px-5 shadow-brand-glow">
                            {{ app()->getLocale() === 'ar' ? 'عرض كافة المقالات' : 'View All Articles' }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="mt-16 flex justify-center reveal-up">
                {{ $articles->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
