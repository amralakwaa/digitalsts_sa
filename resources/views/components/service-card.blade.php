@props(['service'])

<div class="rounded-3xl p-5 sm:p-7 flex flex-col justify-between group relative overflow-hidden transition-all duration-300 border border-white/10 bg-surface-900/70 backdrop-blur-md hover:border-brand-500/40 shadow-soft hover:shadow-brand-glow/10 h-full reveal-up hover-lift">
    <!-- Decorative accent gradient on hover -->
    <div class="absolute top-0 end-0 w-48 h-48 bg-brand-500/10 rounded-full blur-3xl group-hover:bg-brand-500/20 transition-all duration-500 pointer-events-none opacity-0 group-hover:opacity-100"></div>

    <div class="relative z-10">
        @if($service->image)
            <!-- Service Feature Image with overlay and floating icon (STS Logo Midnight Palette) -->
            <a href="{{ route('services.show', $service->slug) }}" class="block relative -mx-5 -mt-5 sm:-mx-7 sm:-mt-7 mb-5 overflow-hidden rounded-t-3xl aspect-[16/10] bg-gradient-to-b from-[#000418] via-[#010318] to-[#040822] group/img border-b border-white/10 img-skeleton-holder">
                <img src="{{ asset($service->image) }}" 
                     alt="{{ $service->title }}" 
                     loading="lazy"
                     decoding="async"
                     class="w-full h-full object-cover transform group-hover:scale-108 transition-transform duration-700 ease-out img-lazy-transition"
                     onerror="this.onerror=null; this.src='{{ asset('images/sts-logo-v2.jpg') }}';">
                <div class="absolute inset-0 bg-gradient-to-t from-[#010318] via-[#010318]/45 to-transparent pointer-events-none"></div>
                
                <!-- Floating Icon Badge -->
                <div class="absolute bottom-3 start-3.5 z-10">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-surface-900/90 backdrop-blur-md border border-white/20 flex items-center justify-center text-brand-400 shadow-md group-hover:scale-110 group-hover:border-brand-500/40 transition-all duration-300">
                        @if($service->icon === 'video')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        @elseif($service->icon === 'shield-check')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        @elseif($service->icon === 'clock')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($service->icon === 'flame')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
                        @elseif($service->icon === 'bell')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @elseif($service->icon === 'network')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                        @elseif($service->icon === 'server')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
                        @elseif($service->icon === 'home')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @elseif($service->icon === 'monitor')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @elseif($service->icon === 'building')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        @elseif($service->icon === 'cpu')
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                        @else
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        @endif
                    </div>
                </div>
            </a>
        @else
            <!-- Fallback Icon container -->
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-brand-500/15 border border-brand-500/30 flex items-center justify-center text-brand-400 mb-5 group-hover:scale-110 group-hover:shadow-brand-glow/20 transition-all duration-300">
                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
        @endif

        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-3 group-hover:text-brand-300 transition-colors line-clamp-1">
            <a href="{{ route('services.show', $service->slug) }}">
                {{ $service->title }}
            </a>
        </h3>

        <p class="text-xs sm:text-sm text-surface-400 leading-relaxed mb-4 sm:mb-6 line-clamp-2 sm:line-clamp-3">
            {{ $service->description }}
        </p>

        <!-- Highlights (first 2 items) -->
        @if(!empty($service->features))
            <ul class="space-y-2 mb-5 border-t border-white/10 pt-4">
                @foreach(array_slice($service->features, 0, 2) as $feat)
                    <li class="flex items-start gap-2 text-xs text-surface-300">
                        <svg class="w-4 h-4 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="line-clamp-1">{{ $feat }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Action links -->
    <div class="pt-4 border-t border-white/10 flex items-center justify-between relative z-10">
        <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-400 group-hover:text-brand-300 transition-colors">
            <span>{{ __('messages.view_service_details') }}</span>
            <svg class="w-3.5 h-3.5 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <a href="{{ route('quote.create', ['service' => $service->slug]) }}" class="text-[11px] font-semibold text-brand-300 bg-brand-500/15 hover:bg-brand-500/25 px-2.5 py-1 rounded-lg transition-colors border border-brand-500/30" title="{{ __('messages.nav_quote_btn') }}">
            {{ __('messages.nav_quote_btn') }}
        </a>
    </div>
</div>
