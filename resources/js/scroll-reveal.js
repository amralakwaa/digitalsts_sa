/**
 * STS Smart Tech Systems — Unified Scroll Reveal & Smart Lazy Loading Engine
 * 
 * Features:
 * 1. Hardware-accelerated IntersectionObserver Scroll Reveal (Fade, Slide Up/Down/Left/Right, Scale, Stagger)
 * 2. Progressive Enhancement: Content 100% visible if JS disabled, print media, or prefers-reduced-motion
 * 3. Smart Lazy Loading for images: blur-up, shimmer skeleton, aspect-ratio CLS shield, error recovery
 * 4. Automatic grid item staggering for natural luxury flow
 * 5. Dynamic MutationObserver support for Alpine.js tabs, filters, and dynamic content
 */

const prefersReducedMotion = () => {
    return typeof window !== 'undefined' && 
           window.matchMedia && 
           window.matchMedia('(prefers-reduced-motion: reduce)').matches;
};

class ScrollRevealEngine {
    constructor() {
        this.observer = null;
        this.imageObserver = null;
        this.mutationObserver = null;
        this.observedElements = new WeakSet();
        this.observedImages = new WeakSet();
        this.isInitialized = false;
    }

    init() {
        if (typeof document === 'undefined') return;

        // Mark JS as active for CSS progressive enhancement
        document.documentElement.classList.add('js-reveal-active');

        // Respect user accessibility preference for reduced motion
        if (prefersReducedMotion()) {
            document.documentElement.classList.add('reduced-motion');
            this.revealAll();
            this.initImages();
            return;
        }

        // Verify IntersectionObserver support
        if (!('IntersectionObserver' in window)) {
            document.documentElement.classList.add('no-intersection-observer');
            this.revealAll();
            this.initImages();
            return;
        }

        this.setupObservers();
        this.scanAndObserve();
        this.initImages();
        this.setupMutationObserver();

        this.isInitialized = true;
    }

    setupObservers() {
        // Scroll Reveal Observer: triggers when element enters viewport
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    this.revealElement(el);
                    this.observer.unobserve(el);
                }
            });
        }, {
            root: null,
            // Negative bottom margin triggers reveal slightly before entering or as it enters
            rootMargin: '0px 0px -40px 0px',
            threshold: 0.08
        });
    }

    revealElement(el) {
        if (!el) return;

        // Handle custom delay from data attribute if set
        const customDelay = el.dataset.revealDelay;
        if (customDelay) {
            el.style.transitionDelay = `${customDelay}ms`;
        }

        // Apply will-change temporarily for GPU acceleration
        el.style.willChange = 'transform, opacity';

        // Add revealed class
        el.classList.add('revealed');

        // Clean up will-change after transition completes to preserve mobile GPU memory
        const cleanup = () => {
            el.style.willChange = '';
            el.removeEventListener('transitionend', cleanup);
        };
        el.addEventListener('transitionend', cleanup, { once: true });
        // Fallback cleanup in case transitionend does not fire
        setTimeout(cleanup, 1200);
    }

    revealAll() {
        const elements = document.querySelectorAll(
            '.reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right, .reveal-scale, .reveal-fade, [data-reveal]'
        );
        elements.forEach(el => el.classList.add('revealed'));
    }

    scanAndObserve() {
        if (!this.observer) return;

        // 1. Explicit reveal targets
        const explicitElements = document.querySelectorAll(
            '.reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right, .reveal-scale, .reveal-fade, [data-reveal]'
        );
        explicitElements.forEach(el => this.registerElement(el));

        // 2. Auto-stagger containers: [data-reveal-stagger], .reveal-stagger, or grid card groups
        const staggerContainers = document.querySelectorAll(
            '[data-reveal-stagger], .reveal-stagger-parent, [data-stagger-group]'
        );

        staggerContainers.forEach(container => {
            const stepMs = parseInt(container.dataset.revealStagger || container.dataset.staggerStep || '80', 10);
            const children = Array.from(container.children);
            children.forEach((child, index) => {
                // If child doesn't have an explicit reveal class, add standard reveal-up
                if (!child.matches('.reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right, .reveal-scale, .reveal-fade, [data-reveal]')) {
                    child.classList.add('reveal');
                }
                if (!child.dataset.revealDelay) {
                    child.dataset.revealDelay = String(Math.min(index * stepMs, 600));
                }
                this.registerElement(child);
            });
        });
    }

    registerElement(el) {
        if (!el || this.observedElements.has(el)) return;
        this.observedElements.add(el);
        this.observer.observe(el);
    }

    /* =========================================================
       SMART LAZY LOADING & IMAGE REVEAL SYSTEM
       ========================================================= */
    initImages() {
        const images = document.querySelectorAll('img');

        images.forEach(img => {
            if (this.observedImages.has(img)) return;
            this.observedImages.add(img);

            // Skip critical above-the-fold Hero & LCP images
            const isHero = img.closest('#hero-section') || 
                           img.getAttribute('fetchpriority') === 'high' ||
                           img.hasAttribute('data-no-lazy');

            if (isHero) {
                img.classList.add('img-priority-loaded');
                return;
            }

            // Ensure native lazy loading & asynchronous decoding
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
            if (!img.hasAttribute('decoding')) {
                img.setAttribute('decoding', 'async');
            }

            // Add smooth transition class
            img.classList.add('img-lazy-transition');

            // Set up fallback error handler
            if (!img.dataset.hasErrorHandler) {
                img.dataset.hasErrorHandler = 'true';
                img.addEventListener('error', function onError() {
                    this.removeEventListener('error', onError);
                    this.classList.add('img-load-error');
                    // Fallback to STS logo if image fails to load
                    const fallbackSrc = '/images/sts-logo-v2.jpg';
                    if (this.src && !this.src.includes('sts-logo-v2.jpg')) {
                        this.src = fallbackSrc;
                    }
                }, { once: true });
            }

            // Check if already completed (from cache)
            if (img.complete && img.naturalWidth > 0) {
                img.classList.add('loaded');
                if (img.parentElement) {
                    img.parentElement.classList.add('img-loaded');
                }
            } else {
                img.addEventListener('load', function onLoad() {
                    this.classList.add('loaded');
                    if (this.parentElement) {
                        this.parentElement.classList.add('img-loaded');
                    }
                }, { once: true });
            }
        });
    }

    /* =========================================================
       DYNAMIC MUTATION OBSERVER (ALPINJS / AJAX RESILIENT)
       ========================================================= */
    setupMutationObserver() {
        if (!('MutationObserver' in window)) return;

        let debounceTimer = null;
        this.mutationObserver = new MutationObserver((mutations) => {
            let hasNewNodes = false;
            for (const mutation of mutations) {
                if (mutation.addedNodes.length > 0) {
                    hasNewNodes = true;
                    break;
                }
            }

            if (hasNewNodes) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    this.scanAndObserve();
                    this.initImages();
                }, 60);
            }
        });

        this.mutationObserver.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    refresh() {
        this.scanAndObserve();
        this.initImages();
    }
}

// Instantiate singleton
export const scrollReveal = new ScrollRevealEngine();

// Auto-boot on DOM ready
if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => scrollReveal.init());
    } else {
        scrollReveal.init();
    }

    // Re-check on full window load in case late stylesheets/fonts adjusted layout
    window.addEventListener('load', () => scrollReveal.refresh());
}

// Expose globally for inline blade scripts and Alpine.js components
if (typeof window !== 'undefined') {
    window.STSReveal = scrollReveal;
}

