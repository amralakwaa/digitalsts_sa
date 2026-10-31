@extends('layouts.app')

@section('title', $article->title . ' — ' . __('messages.company_name'))

@section('content')

<!-- =================== DARK TECH HERO BANNER =================== -->
<section class="page-hero flex items-end pb-12 sm:pb-16 pt-10 sm:pt-16">
    <div class="absolute inset-0 bg-grid-dark opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 start-1/4 w-80 h-80 bg-brand-500/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 end-1/3 w-64 h-64 bg-accent-sky/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-surface-300/80 mb-6 font-medium reveal-up">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('messages.nav_home') }}</a>
            <span class="text-surface-500">/</span>
            <a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">{{ __('messages.nav_articles') }}</a>
            <span class="text-surface-500">/</span>
            <span class="text-brand-300 font-semibold truncate">{{ $article->title }}</span>
        </nav>

        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-4 reveal-up">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/20 text-brand-300 border border-brand-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    <span>{{ $article->category_label }}</span>
                </span>
                <span class="text-xs text-surface-300 flex items-center gap-1.5 font-medium">
                    <svg class="w-3.5 h-3.5 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $article->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق قراءة' : 'min read' }}</span>
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up leading-tight" data-reveal-delay="100">
                {{ $article->title }}
            </h1>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Article Card Container -->
        <article class="rounded-3xl p-8 sm:p-12 shadow-soft-xl space-y-8 reveal-scale border border-white/10 bg-surface-900/80 backdrop-blur-md">
            
            <!-- Meta Bar -->
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-white/10 pb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-brand-600/30 text-brand-300 border border-brand-500/30 flex items-center justify-center font-bold text-sm shadow-xs">
                        {{ mb_substr($article->author_name ?? 'S', 0, 1) }}
                    </div>
                    <div>
                        <span class="block text-sm font-bold text-white">{{ $article->author_name ?? 'فريق STS الهندسي' }}</span>
                        <span class="block text-xs text-surface-400">{{ app()->getLocale() === 'ar' ? 'استشارات وتقنيات STS الذكية' : 'STS Smart Systems & Engineering' }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 text-xs text-surface-400 font-mono">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ number_format($article->views_count) }} {{ app()->getLocale() === 'ar' ? 'مشاهدة' : 'views' }}
                    </span>
                </div>
            </div>

            <!-- Excerpt Callout -->
            @if($article->excerpt)
                <div class="p-6 rounded-2xl bg-brand-500/10 border-s-4 border-brand-400 text-surface-200 text-base sm:text-lg leading-relaxed font-semibold backdrop-blur-sm reveal-fade">
                    {{ $article->excerpt }}
                </div>
            @endif

            <!-- Cover Image (STS Logo Palette) -->
            @if($article->image_url)
                <div class="rounded-3xl overflow-hidden shadow-soft-xl border border-white/10 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] img-skeleton-holder reveal-scale">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-auto max-h-[500px] object-cover img-lazy-transition" loading="lazy" decoding="async">
                </div>
            @endif

            <!-- Body Content -->
            <div class="prose prose-invert max-w-none text-surface-200 text-base sm:text-lg leading-relaxed space-y-6 pt-4 font-sans reveal-fade">
                @if($article->content)
                    @if(strip_tags($article->content) !== $article->content)
                        {!! strip_tags($article->content, '<p><br><strong><em><b><i><u><s><h1><h2><h3><h4><h5><h6><ul><ol><li><a><blockquote><code><pre><img><table><thead><tbody><tr><th><td><hr><span><div>') !!}
                    @else
                        {!! nl2br(e($article->content)) !!}
                    @endif
                @else
                    <p class="text-surface-400 italic">{{ app()->getLocale() === 'ar' ? 'لا يوجد تفاصيل إضافية لهذا المقال.' : 'No additional content available for this post.' }}</p>
                @endif
            </div>

            <!-- Tags -->
            @php
                $tags = $article->tags;
            @endphp
            @if(!empty($tags) && count($tags) > 0)
                <div class="pt-6 border-t border-white/10 space-y-3">
                    <span class="text-xs font-bold text-surface-400 block uppercase tracking-wider">
                        {{ app()->getLocale() === 'ar' ? 'الكلمات المفتاحية والمواضيع المرتبطة:' : 'Tags & Topics:' }}
                    </span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('articles.index', ['q' => $tag]) }}" class="px-3 py-1 rounded-xl text-xs font-semibold bg-surface-800/80 hover:bg-brand-500/20 text-surface-300 hover:text-brand-300 transition-colors border border-white/10">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Share Buttons & Social Interaction -->
            <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <span class="text-xs font-bold text-surface-300">
                    {{ app()->getLocale() === 'ar' ? 'مشاركة هذا المقال:' : 'Share this article:' }}
                </span>
                <div class="flex items-center gap-2">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" rel="noopener"
                       class="px-3.5 py-2 rounded-xl bg-emerald-500/15 text-emerald-300 hover:bg-emerald-500/25 text-xs font-bold transition-all flex items-center gap-1.5 border border-emerald-500/30">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                        <span>واتساب</span>
                    </a>

                    <!-- X / Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"
                       class="px-3.5 py-2 rounded-xl bg-surface-800 text-white hover:bg-surface-700 text-xs font-bold transition-all flex items-center gap-1.5 border border-white/10">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        <span>X</span>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"
                       class="px-3.5 py-2 rounded-xl bg-sky-500/15 text-sky-300 hover:bg-sky-500/25 text-xs font-bold transition-all flex items-center gap-1.5 border border-sky-500/30">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                        <span>LinkedIn</span>
                    </a>
                </div>
            </div>

            <!-- Engineering Consultation CTA -->
            <div class="mt-8 p-8 rounded-3xl bg-gradient-to-br from-surface-950 via-brand-950 to-surface-900 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl relative overflow-hidden border border-brand-500/30 reveal-scale hover-lift">
                <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
                <div class="relative z-10 space-y-2 text-center md:text-start">
                    <span class="text-brand-300 text-xs font-bold uppercase tracking-wider block">
                        {{ app()->getLocale() === 'ar' ? 'حلول واستشارات متقدمة' : 'Expert Engineering Consulting' }}
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black">
                        {{ app()->getLocale() === 'ar' ? 'هل تخطط لتنفيذ مشروع أمني أو ذكي لمنشأتك؟' : 'Planning a Security or Smart Infrastructure Project?' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-surface-300 max-w-xl">
                        {{ app()->getLocale() === 'ar' ? 'فريقنا الهندسي جاهز لمعاينة الموقع، وتقديم دراسة جدوى فنية متكاملة وعرض سعر مفصل.' : 'Our engineers provide on-site surveys, risk assessments, and turn-key technical proposals.' }}
                    </p>
                </div>
                <a href="{{ route('quote.create') }}" class="relative z-10 btn-primary shadow-brand-glow px-6 py-3.5 whitespace-nowrap text-sm font-bold flex-shrink-0">
                    <span>{{ __('messages.nav_quote_btn') }}</span>
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

        </article>

        <!-- Related Articles -->
        @if($relatedArticles->isNotEmpty())
            <div class="mt-16 space-y-8 reveal-up">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-white">
                            {{ app()->getLocale() === 'ar' ? 'مقالات ذات صلة' : 'Related Insights' }}
                        </h2>
                        <span class="text-xs text-surface-400">
                            {{ app()->getLocale() === 'ar' ? 'محتوى هندسي إضافي قد يهمك' : 'Explore more analyses from our engineering vault' }}
                        </span>
                    </div>
                    <a href="{{ route('articles.index') }}" class="text-xs font-bold text-brand-400 hover:text-brand-300 flex items-center gap-1">
                        <span>{{ app()->getLocale() === 'ar' ? 'عرض كافة المقالات' : 'All Articles' }}</span>
                        <span class="rtl:rotate-180">&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6" data-reveal-stagger="80">
                    @foreach($relatedArticles as $relArticle)
                        <a href="{{ route('articles.show', $relArticle->slug) }}" class="rounded-3xl overflow-hidden group hover:border-brand-500/50 transition-all flex flex-col justify-between shadow-soft hover:shadow-brand-glow/20 border border-white/10 bg-surface-900/70 backdrop-blur-md reveal-up hover-lift">
                            <div class="h-40 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 overflow-hidden relative img-skeleton-holder">
                                @if($relArticle->image)
                                    <img src="{{ asset('storage/' . $relArticle->image) }}" alt="{{ $relArticle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 img-lazy-transition" loading="lazy" decoding="async">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#000418] to-[#010318] flex items-center justify-center text-slate-400">
                                        <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent pointer-events-none"></div>
                                <span class="absolute top-2 start-2 px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-surface-900/90 text-brand-300 shadow-sm border border-brand-500/30">
                                    {{ $relArticle->category_label }}
                                </span>
                            </div>
                            <div class="p-5 space-y-2 flex-grow flex flex-col justify-between">
                                <h3 class="text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors line-clamp-2 leading-snug">
                                    {{ $relArticle->title }}
                                </h3>
                                <div class="flex items-center justify-between text-[11px] text-surface-400 pt-3 border-t border-white/10 font-mono">
                                    <span>{{ $relArticle->reading_time }} {{ app()->getLocale() === 'ar' ? 'دقائق' : 'mins' }}</span>
                                    <span class="text-brand-400 font-bold group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform">&rarr;</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
