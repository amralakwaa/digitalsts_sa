@extends('layouts.app')

@section('title', $project->title . ' — ' . __('messages.company_name'))

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
            <a href="{{ route('projects.index') }}" class="hover:text-white transition-colors">{{ __('messages.nav_projects') }}</a>
            <span class="text-surface-500">/</span>
            <span class="text-brand-300 font-semibold truncate">{{ $project->title }}</span>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 backdrop-blur-md reveal-up">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <span>
                    {{ match($project->category) {
                        'commercial' => app()->getLocale() === 'ar' ? 'قطاع تجاري' : 'Commercial',
                        'hospitality' => app()->getLocale() === 'ar' ? 'قطاع الضيافة' : 'Hospitality',
                        'residential' => app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Residential',
                        'industrial' => app()->getLocale() === 'ar' ? 'مستودعات وصناعي' : 'Industrial',
                        'government' => app()->getLocale() === 'ar' ? 'قطاع حكومي' : 'Government',
                        default => $project->category,
                    } }}
                </span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4 reveal-up leading-tight" data-reveal-delay="100">
                {{ $project->title }}
            </h1>
            <p class="text-sm sm:text-lg text-surface-200/90 leading-relaxed reveal-up" data-reveal-delay="200">
                {{ $project->description }}
            </p>
        </div>
    </div>
</section>

<!-- =================== MAIN CONTENT (DARK LUXURY TECH) =================== -->
<div class="py-12 sm:py-20 relative overflow-hidden bg-surface-950">
    <div class="absolute inset-0 bg-grid-dark opacity-25 pointer-events-none"></div>
    <div class="absolute top-1/4 start-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        @php
            $coverUrl = $project->cover_image_url;
        @endphp

        <!-- Project Hero Card -->
        <div class="rounded-3xl overflow-hidden mb-12 shadow-soft-xl border border-white/10 bg-surface-900/80 backdrop-blur-md reveal-scale">
            @if($coverUrl)
                <div class="relative h-72 sm:h-[420px] w-full overflow-hidden group bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] border-b border-white/10 img-skeleton-holder">
                    <img src="{{ $coverUrl }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 img-lazy-transition" loading="lazy" decoding="async">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/45 to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-6 start-6 end-6 flex flex-wrap items-center justify-between gap-3 text-white">
                        <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-brand-600/90 backdrop-blur-md shadow-brand-glow border border-brand-400/30">
                            {{ match($project->category) {
                                'commercial' => app()->getLocale() === 'ar' ? 'قطاع تجاري' : 'Commercial',
                                'hospitality' => app()->getLocale() === 'ar' ? 'قطاع الضيافة' : 'Hospitality',
                                'residential' => app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Residential',
                                'industrial' => app()->getLocale() === 'ar' ? 'مستودعات وصناعي' : 'Industrial',
                                'government' => app()->getLocale() === 'ar' ? 'قطاع حكومي' : 'Government',
                                default => $project->category,
                            } }}
                        </span>
                        @if($project->location)
                            <span class="text-xs font-semibold flex items-center gap-1.5 bg-surface-900/80 backdrop-blur-md px-3.5 py-1.5 rounded-xl border border-white/20">
                                <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $project->location }}</span>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="p-8 sm:p-12 space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-white/10 pb-5">
                    <span class="text-xs font-bold text-brand-300 bg-brand-500/15 px-3.5 py-1.5 rounded-xl border border-brand-500/30 inline-flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-ping"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'دراسة حالة وتوثيق ميداني' : 'Field Case Study' }}</span>
                    </span>

                    @if($project->completion_date)
                        <span class="text-xs text-surface-400 font-medium flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'تاريخ الإنجاز: ' : 'Completed: ' }}</span>
                            <strong class="text-white">{{ $project->completion_date->format('Y/m') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Metadata specs table -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 text-sm" data-reveal-stagger="70">
                    @if($project->client)
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs text-surface-400 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'الجهة المستفيدة / العميل' : 'Client / Entity' }}</span>
                            <span class="font-bold text-white block">{{ $project->client }}</span>
                        </div>
                    @endif

                    @if($project->location)
                        <div class="p-4 rounded-2xl bg-surface-800/60 border border-white/10 reveal-up hover-lift">
                            <span class="text-xs text-surface-400 block mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'الموقع الجغرافي' : 'Location' }}</span>
                            <span class="font-bold text-white block">{{ $project->location }}</span>
                        </div>
                    @endif

                    <div class="p-4 rounded-2xl bg-brand-500/10 border border-brand-500/25 reveal-up hover-lift">
                        <span class="text-xs text-brand-300 block mb-1 font-bold uppercase tracking-wider">{{ app()->getLocale() === 'ar' ? 'معايير التنفيذ' : 'Execution Standards' }}</span>
                        <span class="font-bold text-emerald-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'مطابقة معتمدة 100%' : '100% Certified' }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Case Study Description -->
        @if($project->content)
            <div class="rounded-3xl p-8 sm:p-10 mb-12 text-surface-200 leading-relaxed text-base space-y-4 shadow-soft border border-white/10 bg-surface-900/70 backdrop-blur-md reveal-up">
                <h2 class="text-xl font-black text-white flex items-center gap-3 mb-4">
                    <span class="w-10 h-10 rounded-2xl bg-brand-500/15 text-brand-300 flex items-center justify-center border border-brand-500/30 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    <span>{{ app()->getLocale() === 'ar' ? 'تفاصيل ونطاق التنفيذ الميداني' : 'Scope of Execution & Systems Deployed' }}</span>
                </h2>
                <p class="whitespace-pre-line text-surface-300 leading-relaxed text-sm sm:text-base">{{ $project->content }}</p>
            </div>
        @endif

        <!-- Project Photo Gallery Section -->
        @if($project->images->isNotEmpty())
            <div class="rounded-3xl p-8 sm:p-10 mb-12 space-y-6 shadow-soft border border-white/10 bg-surface-900/70 backdrop-blur-md reveal-up" id="project-gallery">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-5">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'التوثيق المصور' : 'Photo Documentation' }}</span>
                        </div>
                        <h2 class="text-2xl font-black text-white">
                            {{ app()->getLocale() === 'ar' ? 'معرض صور الأنظمة والتجهيزات الميدانية' : 'Installed Systems Photo Gallery' }}
                        </h2>
                    </div>
                    <span class="text-xs font-bold text-brand-300 bg-brand-500/20 px-3 py-1.5 rounded-xl border border-brand-500/30 self-start sm:self-auto font-outfit">
                        {{ $project->images->count() }} {{ app()->getLocale() === 'ar' ? 'صور موثقة' : 'Photos' }}
                    </span>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5" data-reveal-stagger="60">
                    @foreach($project->images as $index => $img)
                        <div class="group relative rounded-2xl overflow-hidden border border-white/10 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] aspect-[4/3] cursor-pointer shadow-soft hover:shadow-brand-glow/20 hover:border-brand-400 transition-all duration-300 reveal-up hover-lift img-skeleton-holder"
                             onclick="openLightbox({{ $index }})">
                            <img src="{{ $img->image_url }}" 
                                 alt="{{ $img->caption ?: $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out img-lazy-transition" 
                                 loading="lazy" decoding="async">
                            
                            <!-- Gradient Overlay (STS Logo Palette) -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity pointer-events-none"></div>
                            
                            <!-- Zoom Icon -->
                            <div class="absolute top-3 end-3 w-9 h-9 rounded-xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                            </div>

                            <!-- Caption -->
                            <div class="absolute bottom-3 start-3 end-3 text-white">
                                <span class="text-xs font-semibold line-clamp-2 leading-snug drop-shadow-md">
                                    {{ $img->caption ?: $project->title }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div id="galleryLightbox" class="fixed inset-0 z-50 bg-surface-950/95 backdrop-blur-xl hidden flex items-center justify-center p-4" onclick="closeLightbox(event)">
                <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center justify-center" onclick="event.stopPropagation()">
                    <!-- Close button -->
                    <button type="button" onclick="closeLightbox()" class="absolute -top-12 end-0 text-white/80 hover:text-white p-2 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <!-- Main Image in Lightbox (STS Logo Palette) -->
                    <div class="relative w-full rounded-2xl overflow-hidden border border-white/10 bg-gradient-to-b from-[#000418] to-[#010318] shadow-2xl flex items-center justify-center max-h-[75vh]">
                        <img id="lightboxImage" src="" alt="Full view" class="w-full h-auto max-h-[75vh] object-contain">
                    </div>

                    <!-- Caption & Counter Bar -->
                    <div class="w-full flex items-center justify-between mt-3 px-2 text-white/90 text-sm">
                        <span id="lightboxCaption" class="font-medium truncate max-w-[80%]"></span>
                        <span id="lightboxCounter" class="text-xs font-mono text-white/60"></span>
                    </div>

                    <!-- Navigation arrows -->
                    @if($project->images->count() > 1)
                        <button type="button" onclick="prevLightboxImage()" class="absolute start-2 sm:-start-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" onclick="nextLightboxImage()" class="absolute end-2 sm:-end-14 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-md text-white flex items-center justify-center transition-colors">
                            <svg class="w-6 h-6 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @endif
                </div>
            </div>

            <script>
                const galleryImages = @json($project->images->map(fn($img) => ['url' => $img->image_url, 'caption' => $img->caption ?: $project->title])->values());
                let currentLightboxIndex = 0;

                function openLightbox(index) {
                    currentLightboxIndex = index;
                    updateLightbox();
                    document.getElementById('galleryLightbox').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }

                function closeLightbox(e) {
                    if (e && e.target !== e.currentTarget && !e.target.closest('button')) return;
                    document.getElementById('galleryLightbox').classList.add('hidden');
                    document.body.style.overflow = '';
                }

                function updateLightbox() {
                    const item = galleryImages[currentLightboxIndex];
                    if (!item) return;
                    document.getElementById('lightboxImage').src = item.url;
                    document.getElementById('lightboxCaption').textContent = item.caption;
                    document.getElementById('lightboxCounter').textContent = (currentLightboxIndex + 1) + ' / ' + galleryImages.length;
                }

                function nextLightboxImage() {
                    currentLightboxIndex = (currentLightboxIndex + 1) % galleryImages.length;
                    updateLightbox();
                }

                function prevLightboxImage() {
                    currentLightboxIndex = (currentLightboxIndex - 1 + galleryImages.length) % galleryImages.length;
                    updateLightbox();
                }

                document.addEventListener('keydown', function(e) {
                    const lb = document.getElementById('galleryLightbox');
                    if (!lb || lb.classList.contains('hidden')) return;
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowRight') {{ app()->getLocale() === 'ar' ? 'prevLightboxImage()' : 'nextLightboxImage()' }};
                    if (e.key === 'ArrowLeft') {{ app()->getLocale() === 'ar' ? 'nextLightboxImage()' : 'prevLightboxImage()' }};
                });
            </script>
        @endif

        <!-- Related Projects Section -->
        @if(isset($relatedProjects) && $relatedProjects->isNotEmpty())
            <div class="mb-12 space-y-6">
                <div class="border-b border-white/10 pb-4 reveal-up">
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-400 block mb-1">
                        {{ app()->getLocale() === 'ar' ? 'سابقة أعمال مشابهة' : 'Case Studies' }}
                    </span>
                    <h2 class="text-2xl font-black text-white tracking-tight">
                        {{ app()->getLocale() === 'ar' ? 'مشاريع أخرى في نفس القطاع' : 'Related Sector Installations' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-reveal-stagger="80">
                    @foreach($relatedProjects as $index => $relProj)
                        <div class="reveal-up hover-lift">
                            <x-project-card :project="$relProj" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- CTA Box -->
        <div class="rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal-scale hover-lift border border-brand-500/30 bg-gradient-to-br from-surface-950 via-brand-950 to-surface-900 shadow-xl">
            <div class="absolute inset-0 bg-grid-dark opacity-30 pointer-events-none"></div>
            <div class="absolute -end-16 -top-16 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-start">
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/20 text-brand-300 border border-brand-500/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>{{ app()->getLocale() === 'ar' ? 'دراسة فنية مجانية' : 'Complimentary Assessment' }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2">
                        {{ app()->getLocale() === 'ar' ? 'هل تخطط لمشروع مشابه؟' : 'Planning a Similar Enterprise Project?' }}
                    </h3>
                    <p class="text-surface-300 text-xs sm:text-sm">
                        {{ app()->getLocale() === 'ar' ? 'تواصل مع فريقنا الهندسي لدراسة المخططات ومواصفات المشروع وتقديم عرض أسعار رسمي مفصل.' : 'Contact our engineering team to review site drawings and receive a formal bill of quantities (BOQ).' }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 flex-shrink-0">
                    <a href="{{ route('quote.create') }}" class="btn-primary shadow-brand-glow">
                        <span>{{ __('messages.nav_quote_btn') }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
