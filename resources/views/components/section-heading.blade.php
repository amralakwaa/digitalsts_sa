@props([
    'badge' => '',
    'title' => '',
    'subtitle' => '',
    'centered' => true,
    'dark' => false,
])

<div class="{{ $centered ? 'text-center max-w-3xl mx-auto' : '' }} mb-10 sm:mb-14 reveal-up">
    @if($badge)
        <span class="{{ $dark ? 'inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/15 text-brand-300 border border-brand-500/30 mb-4 shadow-brand-glow/20 backdrop-blur-md' : 'badge-brand mb-4 inline-flex' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $dark ? 'bg-brand-400 animate-ping' : 'bg-brand-500' }}"></span>
            {{ $badge }}
        </span>
    @endif
    
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black {{ $dark ? 'text-white drop-shadow-md' : 'text-surface-900' }} tracking-tight leading-tight mb-4">
        {{ $title }}
    </h2>
    
    @if($subtitle)
        <p class="text-base sm:text-lg {{ $dark ? 'text-surface-200/90' : 'text-surface-500' }} leading-relaxed font-normal">
            {{ $subtitle }}
        </p>
    @endif
</div>
