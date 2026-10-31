@props(['project'])

@php
    $coverUrl = $project->cover_image_url;
    $extraImages = $project->relationLoaded('images') ? $project->images : $project->images()->take(4)->get();
    $totalPhotosCount = ($coverUrl ? 1 : 0) + $extraImages->count();
@endphp

<div class="relative rounded-3xl overflow-hidden flex flex-col justify-between group hover:shadow-brand-glow/25 hover:border-brand-400/50 transition-all duration-500 border border-brand-500/20 bg-surface-950 text-white shadow-soft reveal-up hover-lift">
    <!-- Card High-Tech Background Image (matching the hero smart city security aesthetic) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <img src="{{ asset('images/project-card-tech-bg.jpg') }}" 
             alt="" 
             loading="lazy"
             decoding="async"
             class="w-full h-full object-cover object-center opacity-30 group-hover:opacity-40 group-hover:scale-105 transition-all duration-700 img-lazy-transition">
        <div class="absolute inset-0 bg-gradient-to-t from-surface-950 via-surface-950/92 to-surface-950/75"></div>
        <div class="absolute inset-0 bg-grid-light opacity-5"></div>
    </div>

    <!-- Visual Image Container (STS Logo Midnight Palette) -->
    <div class="relative h-60 overflow-hidden flex items-center justify-center border-b border-white/10 z-10 bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] img-skeleton-holder">
        @if($coverUrl)
            <img src="{{ $coverUrl }}" 
                 alt="{{ $project->title }}" 
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out img-lazy-transition" 
                 loading="lazy"
                 decoding="async"
                 onerror="this.onerror=null; this.src='{{ asset('images/project-card-tech-bg.jpg') }}';">
            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/50 to-black/20 pointer-events-none"></div>
        @else
            <!-- Tech City Visual Backdrop when no specific photo -->
            <img src="{{ asset('images/project-card-tech-bg.jpg') }}" 
                 alt="{{ $project->title }}" 
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out opacity-85 img-lazy-transition" 
                 loading="lazy"
                 decoding="async">
            <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/60 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 w-16 h-16 rounded-2xl bg-surface-950/80 backdrop-blur-md border border-brand-500/40 flex items-center justify-center text-brand-300 group-hover:scale-110 group-hover:border-brand-400 group-hover:shadow-brand-glow/40 transition-all duration-300 shadow-soft">
                @if($project->category === 'commercial')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                @elseif($project->category === 'hospitality')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                @elseif($project->category === 'residential')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                @elseif($project->category === 'industrial')
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                @else
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                @endif
            </div>
        @endif

        <!-- Category Badge -->
        <span class="absolute top-4 start-4 px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wider uppercase bg-surface-950/80 text-brand-300 border border-brand-500/30 backdrop-blur-md shadow-soft z-10">
            {{ match($project->category) {
                'commercial' => app()->getLocale() === 'ar' ? 'قطاع تجاري' : 'Commercial',
                'hospitality' => app()->getLocale() === 'ar' ? 'قطاع الضيافة' : 'Hospitality',
                'residential' => app()->getLocale() === 'ar' ? 'فلل وقصور' : 'Residential',
                'industrial' => app()->getLocale() === 'ar' ? 'مستودعات وصناعي' : 'Industrial',
                'government' => app()->getLocale() === 'ar' ? 'قطاع حكومي' : 'Government',
                default => $project->category,
            } }}
        </span>

        <!-- Total Photos Count Badge -->
        @if($totalPhotosCount > 0)
            <span class="absolute top-4 end-4 px-2.5 py-1 rounded-full text-[11px] font-bold bg-surface-950/85 text-white backdrop-blur-md border border-white/20 flex items-center gap-1.5 shadow-soft z-10 font-outfit">
                <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $totalPhotosCount }} {{ app()->getLocale() === 'ar' ? 'صور' : 'Photos' }}</span>
            </span>
        @endif

        <!-- Location Badge -->
        @if($project->location)
            <span class="absolute bottom-3 end-4 text-[11px] text-surface-200 flex items-center gap-1 backdrop-blur-md bg-surface-950/80 px-2.5 py-1 rounded-lg border border-white/15 shadow-sm z-10 font-semibold">
                <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $project->location }}</span>
            </span>
        @endif
    </div>

    <!-- Mini Gallery Preview Thumbnails -->
    @if($extraImages->isNotEmpty())
        <div class="px-6 pt-4 pb-1 border-b border-white/10 flex items-center gap-2 bg-surface-900/50 relative z-10 backdrop-blur-xs">
            <span class="text-[11px] font-semibold text-surface-300 flex items-center gap-1">
                <svg class="w-3 h-3 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ app()->getLocale() === 'ar' ? 'لقطات ميدانية:' : 'Field shots:' }}</span>
            </span>
            <div class="flex items-center gap-1.5 overflow-hidden">
                @foreach($extraImages->take(3) as $extra)
                    <a href="{{ route('projects.show', $project->slug) }}#project-gallery" title="{{ $extra->caption ?: $project->title }}" class="block w-9 h-7 rounded-lg overflow-hidden border border-white/20 hover:border-brand-400 hover:scale-105 transition-all flex-shrink-0 img-skeleton-holder">
                        <img src="{{ $extra->image_url }}" alt="{{ $extra->caption ?: $project->title }}" class="w-full h-full object-cover img-lazy-transition" loading="lazy" decoding="async">
                    </a>
                @endforeach
                @if($extraImages->count() > 3)
                    <a href="{{ route('projects.show', $project->slug) }}#project-gallery" class="w-7 h-7 rounded-lg bg-surface-800 text-surface-300 hover:bg-brand-600 hover:text-white text-[10px] font-bold flex items-center justify-center transition-colors border border-white/10">
                        +{{ $extraImages->count() - 3 }}
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- Content -->
    <div class="p-6 flex-grow flex flex-col justify-between relative z-10">
        <div>
            <h3 class="text-lg font-bold text-white mb-2 group-hover:text-brand-300 transition-colors line-clamp-1">
                <a href="{{ route('projects.show', $project->slug) }}">
                    {{ $project->title }}
                </a>
            </h3>

            <p class="text-sm text-surface-300 leading-relaxed line-clamp-3 mb-4">
                {{ $project->description }}
            </p>
        </div>

        <div class="pt-4 border-t border-white/10 flex items-center justify-between">
            <span class="text-xs text-surface-400 font-medium">
                @if($project->client)
                    {{ $project->client }}
                @elseif($project->completion_date)
                    {{ $project->completion_date->format('Y/m') }}
                @endif
            </span>

            <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-300 group-hover:text-brand-200 transition-colors">
                <span>{{ app()->getLocale() === 'ar' ? 'عرض المشروع والصور' : 'View Project & Photos' }}</span>
                <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
