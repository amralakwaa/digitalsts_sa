@extends('layouts.app')

@section('title', __('messages.nav_projects') . ' — ' . __('messages.company_name'))

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span>{{ __('messages.projects_badge') }}</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up" data-reveal-delay="100">
                {{ __('messages.projects_title') }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ __('messages.projects_subtitle') }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT =================== -->
<div class="py-16 sm:py-24 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/4 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 end-1/4 w-96 h-96 bg-accent-sky/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Category Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-16 reveal-up">
            @php
                $categories = [
                    'all' => app()->getLocale() === 'ar' ? 'كافة المشاريع' : 'All Projects',
                    'commercial' => app()->getLocale() === 'ar' ? 'قطاع تجاري' : 'Commercial',
                    'hospitality' => app()->getLocale() === 'ar' ? 'فندقي وضيافة' : 'Hospitality',
                    'residential' => app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Residential',
                    'industrial' => app()->getLocale() === 'ar' ? 'صناعي ولوجستي' : 'Industrial',
                    'government' => app()->getLocale() === 'ar' ? 'حكومي وصحي' : 'Government',
                ];
            @endphp

            @foreach($categories as $key => $label)
                <a href="{{ route('projects.index', ['category' => $key]) }}"
                   class="px-5 py-2.5 rounded-2xl text-xs font-bold transition-all duration-300 {{ $currentCategory === $key ? 'bg-brand-600 text-white shadow-brand-glow scale-105 border border-brand-400' : 'bg-surface-900/80 border border-white/10 text-surface-300 hover:text-white hover:border-brand-500/40 hover:bg-surface-800/80 shadow-soft backdrop-blur-md' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-stagger="90">
            @forelse($projects as $index => $proj)
                <div class="reveal-up">
                    <x-project-card :project="$proj" />
                </div>
            @empty
                <div class="col-span-3 text-center py-16 card-dark rounded-3xl p-8 text-surface-400 reveal-up border border-white/10">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-surface-900 flex items-center justify-center text-surface-400 border border-white/10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-white mb-2">{{ app()->getLocale() === 'ar' ? 'لا توجد مشاريع في هذا التصنيف حالياً.' : 'No projects found in this category.' }}</p>
                    <a href="{{ route('projects.index') }}" class="btn-secondary text-xs mt-3 text-white border-white/20 bg-white/5 hover:bg-white/10">
                        {{ app()->getLocale() === 'ar' ? 'عرض جميع المشاريع' : 'View All Projects' }}
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
            <div class="mt-16 flex justify-center reveal-up">
                {{ $projects->links() }}
            </div>
        @endif

        <!-- Dedicated Visual Gallery Section for All Projects Photos -->
        @if(isset($galleryImages) && $galleryImages->isNotEmpty())
            <div class="mt-24 pt-16 border-t border-white/10" id="projects-field-gallery">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 reveal-up">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-3 backdrop-blur-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'التوثيق المصور وسابقة الأعمال' : 'Visual Portfolio & Field Proof' }}</span>
                        </div>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight">
                            {{ app()->getLocale() === 'ar' ? 'معرض صور الأنظمة والتجهيزات الميدانية' : 'Installed Systems Field Photo Gallery' }}
                        </h2>
                        <p class="text-sm sm:text-base text-surface-400 mt-2">
                            {{ app()->getLocale() === 'ar' ? 'استعرض لقطات حية وموثقة من مختلف مشاريعنا المنفذة: كاميرات، مراكز بيانات، إنذار، وشبكات ذكية' : 'Explore high-resolution field photos from our deployed installations across Saudi Arabia' }}
                        </p>
                    </div>
                    <span class="text-xs font-bold px-4 py-2 rounded-2xl bg-surface-900/80 text-brand-300 border border-brand-500/30 self-start md:self-auto font-outfit shadow-xs">
                        {{ $galleryImages->count() }} {{ app()->getLocale() === 'ar' ? 'لقطة موثقة' : 'Documented Photos' }}
                    </span>
                </div>

                <!-- Gallery Photo Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5" data-reveal-stagger="60">
                    @foreach($galleryImages as $index => $img)
                        <div class="group relative rounded-2xl overflow-hidden border border-white/10 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] aspect-[4/3] cursor-pointer shadow-soft hover:shadow-soft-xl hover:border-brand-400 transition-all duration-300 reveal-up hover-lift img-skeleton-holder"
                             onclick="openIndexLightbox({{ $index }})">
                            <img src="{{ $img->image_url }}" 
                                 alt="{{ $img->caption ?: ($img->project ? $img->project->title : 'STS Project Image') }}" 
                                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out img-lazy-transition" 
                                 loading="lazy" decoding="async">
                            
                            <!-- STS Logo Dark Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent opacity-85 group-hover:opacity-95 transition-opacity pointer-events-none"></div>
                            
                            <!-- Zoom Icon Badge -->
                            <div class="absolute top-3 end-3 w-8 h-8 rounded-xl bg-white/25 backdrop-blur-md border border-white/30 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                            </div>

                            <!-- Project Tag & Caption -->
                            <div class="absolute bottom-3 start-3 end-3 text-white">
                                @if($img->project)
                                    <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-brand-300 bg-brand-950/80 backdrop-blur-xs px-2 py-0.5 rounded-md mb-1 border border-brand-500/20">
                                        {{ $img->project->title }}
                                    </span>
                                @endif
                                <span class="text-xs font-semibold block line-clamp-1 leading-snug drop-shadow-md text-white/95">
                                    {{ $img->caption ?: ($img->project ? $img->project->title : '') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Lightbox Modal for Projects Index -->
            <div id="indexGalleryLightbox" class="fixed inset-0 z-50 bg-surface-950/90 backdrop-blur-md hidden flex items-center justify-center p-4" onclick="closeIndexLightbox(event)">
                <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center justify-center" onclick="event.stopPropagation()">
                    <!-- Close button -->
                    <button type="button" onclick="closeIndexLightbox()" class="absolute -top-12 end-0 text-white/80 hover:text-white p-2 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md transition-colors" title="إغلاق">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <!-- Main Image in Lightbox (STS Logo Palette) -->
                    <div class="relative w-full rounded-2xl overflow-hidden border border-white/10 bg-gradient-to-b from-[#000418] to-[#010318] shadow-2xl flex items-center justify-center max-h-[72vh]">
                        <img id="indexLightboxImage" src="" alt="Project Photo" class="w-full h-auto max-h-[72vh] object-contain">
                    </div>

                    <!-- Caption & Counter & Link Bar -->
                    <div class="w-full flex flex-col sm:flex-row items-center justify-between gap-3 mt-4 px-2 text-white/90">
                        <div class="flex flex-col text-center sm:text-start max-w-xl">
                            <span id="indexLightboxProjectTitle" class="text-xs font-bold text-brand-400 uppercase tracking-wider"></span>
                            <span id="indexLightboxCaption" class="text-sm font-medium truncate mt-0.5"></span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span id="indexLightboxCounter" class="text-xs font-mono text-white/60 bg-white/10 px-2.5 py-1 rounded-lg"></span>
                            <a id="indexLightboxProjectLink" href="#" class="btn-primary text-xs py-1.5 px-3.5 inline-flex items-center gap-1.5 shadow-sm">
                                <span>{{ app()->getLocale() === 'ar' ? 'عرض تفاصيل المشروع' : 'View Project' }}</span>
                                <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Navigation arrows -->
                    @if($galleryImages->count() > 1)
                        <button type="button" onclick="prevIndexLightboxImage()" class="absolute start-2 sm:-start-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white flex items-center justify-center transition-colors shadow-lg">
                            <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" onclick="nextIndexLightboxImage()" class="absolute end-2 sm:-end-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white flex items-center justify-center transition-colors shadow-lg">
                            <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @endif
                </div>
            </div>

            @php
                $galleryData = $galleryImages->map(function($img) {
                    return [
                        'url' => $img->image_url,
                        'caption' => $img->caption ?: ($img->project ? $img->project->title : ''),
                        'projectTitle' => $img->project ? $img->project->title : '',
                        'projectUrl' => $img->project ? route('projects.show', $img->project->slug) : '#',
                    ];
                })->values()->toArray();
            @endphp

            <script>
                const indexGalleryItems = @json($galleryData);

                let currentIndexLightboxIndex = 0;

                function openIndexLightbox(index) {
                    currentIndexLightboxIndex = index;
                    updateIndexLightbox();
                    document.getElementById('indexGalleryLightbox').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeIndexLightbox(e) {
                    if (e && e.target !== e.currentTarget && !e.target.closest('button')) return;
                    document.getElementById('indexGalleryLightbox').classList.add('hidden');
                    document.body.style.overflow = '';
                }

                function updateIndexLightbox() {
                    const item = indexGalleryItems[currentIndexLightboxIndex];
                    if (!item) return;
                    document.getElementById('indexLightboxImage').src = item.url;
                    document.getElementById('indexLightboxCaption').textContent = item.caption;
                    document.getElementById('indexLightboxProjectTitle').textContent = item.projectTitle;
                    document.getElementById('indexLightboxCounter').textContent = (currentIndexLightboxIndex + 1) + ' / ' + indexGalleryItems.length;
                    
                    const linkEl = document.getElementById('indexLightboxProjectLink');
                    if (item.projectUrl && item.projectUrl !== '#') {
                        linkEl.href = item.projectUrl;
                        linkEl.style.display = 'inline-flex';
                    } else {
                        linkEl.style.display = 'none';
                    }
                }

                function nextIndexLightboxImage() {
                    currentIndexLightboxIndex = (currentIndexLightboxIndex + 1) % indexGalleryItems.length;
                    updateIndexLightbox();
                }

                function prevIndexLightboxImage() {
                    currentIndexLightboxIndex = (currentIndexLightboxIndex - 1 + indexGalleryItems.length) % indexGalleryItems.length;
                    updateIndexLightbox();
                }

                document.addEventListener('keydown', function(e) {
                    const lb = document.getElementById('indexGalleryLightbox');
                    if (!lb || lb.classList.contains('hidden')) return;
                    if (e.key === 'Escape') closeIndexLightbox();
                    if (e.key === 'ArrowRight') {{ app()->getLocale() === 'ar' ? 'prevIndexLightboxImage()' : 'nextIndexLightboxImage()' }};
                    if (e.key === 'ArrowLeft') {{ app()->getLocale() === 'ar' ? 'nextIndexLightboxImage()' : 'prevIndexLightboxImage()' }};
                });
            </script>
        @endif

        <!-- Bottom Tech CTA Banner -->
        <div class="mt-20 card-dark rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal-scale hover-lift">
            <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
            <div class="absolute -end-16 -top-16 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-start">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-300 border border-brand-500/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'سابقة أعمال هندسية موثقة' : 'Proven Track Record' }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'هل تخطط لتنفيذ مشروع مشابه؟' : 'Planning a Similar Enterprise Installation?' }}
                    </h3>
                    <p class="text-surface-300 text-xs sm:text-sm">
                        {{ app()->getLocale() === 'ar' ? 'فريقنا الهندسي جاهز لتقديم حلول متوافقة مع اشتراطات الجهات الرسمية وتسليم مفتاح بالكامل.' : 'Our team provides certified turnkey deployments compliant with all regulatory guidelines.' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 flex-shrink-0">
                    <a href="{{ route('quote.create') }}" class="btn-primary">
                        <span>{{ __('messages.nav_quote_btn') }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
