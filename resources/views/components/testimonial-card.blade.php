@props(['testimonial'])

<div class="rounded-3xl p-6 sm:p-7 flex flex-col justify-between group relative overflow-hidden transition-all duration-300 border border-brand-500/20 bg-surface-900/70 hover:border-brand-400/50 backdrop-blur-xl shadow-soft hover:shadow-brand-glow/20 h-full text-white reveal-up hover-lift">
    <!-- Subtle top decorative gradient glow on hover -->
    <div class="absolute -top-12 -end-12 w-32 h-32 bg-brand-500/10 rounded-full blur-2xl group-hover:bg-brand-500/20 transition-all duration-500 pointer-events-none opacity-0 group-hover:opacity-100"></div>

    <div class="relative z-10 space-y-4">
        <!-- Top bar: Stars + Location & System Badges -->
        <div class="flex items-start justify-between gap-2 border-b border-white/10 pb-4">
            <!-- 5 Golden Stars -->
            <div class="flex items-center gap-1 text-amber-400">
                @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                    <svg class="w-4 h-4 fill-current drop-shadow-xs" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>

            <!-- City Tag -->
            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-surface-300 bg-surface-950/80 px-2.5 py-1 rounded-lg border border-white/10">
                <svg class="w-3 h-3 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $testimonial->city }}</span>
            </span>
        </div>

        <!-- Project System Scope Badge -->
        @if($testimonial->project_type)
            <div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-brand-500/15 text-brand-300 border border-brand-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    <span>{{ $testimonial->project_type }}</span>
                </span>
            </div>
        @endif

        <!-- Review Text -->
        <p class="text-xs sm:text-sm text-surface-300 leading-relaxed relative">
            <span class="text-2xl text-brand-400/40 font-serif leading-none select-none">“</span>
            <span>{{ app()->getLocale() === 'en' && $testimonial->review_text_en ? $testimonial->review_text_en : $testimonial->review_text }}</span>
            <span class="text-2xl text-brand-400/40 font-serif leading-none select-none">”</span>
        </p>
    </div>

    <!-- Client Profile Section -->
    <div class="pt-5 mt-5 border-t border-white/10 flex items-center justify-between relative z-10">
        <div class="flex items-center gap-3">
            <!-- Initial Avatar -->
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-gradient-to-tr from-brand-600 to-brand-400 text-white font-bold text-xs sm:text-sm flex items-center justify-center shadow-brand-glow/30 flex-shrink-0 group-hover:scale-105 transition-transform border border-brand-400/40">
                {{ $testimonial->initials }}
            </div>
            
            <!-- Name & Title -->
            <div class="text-start">
                <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-brand-300 transition-colors line-clamp-1">
                    {{ $testimonial->client_name }}
                </h4>
                <p class="text-[11px] text-surface-400 line-clamp-1">
                    {{ $testimonial->client_position }}
                </p>
                @if($testimonial->company)
                    <p class="text-[10px] text-brand-400 font-medium line-clamp-1">
                        {{ $testimonial->company }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Verified Saudi Client Badge -->
        <div class="flex-shrink-0 ms-2" title="{{ app()->getLocale() === 'ar' ? 'مشروع منفذ ومعتمد' : 'Verified Project' }}">
            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-300 bg-emerald-500/15 border border-emerald-500/30 px-2 py-0.5 rounded-full shadow-2xs">
                <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="hidden sm:inline">{{ app()->getLocale() === 'ar' ? 'موثق' : 'Verified' }}</span>
            </span>
        </div>
    </div>
</div>
