/**
 * Fast Animated Springing / Pop-up Metric Counter Engine for STS
 * Automatically detects and animates numbers, statistics, KPIs, and views
 * with an energetic pop-up spring effect and fast easing count-up.
 */

// Inject counter animation styles dynamically to ensure 100% reliability everywhere
function ensureAnimationStyles() {
    if (typeof document === 'undefined' || document.getElementById('sts-counter-styles')) return;
    const style = document.createElement('style');
    style.id = 'sts-counter-styles';
    style.textContent = `
        @keyframes counterPopSpring {
            0% {
                opacity: 0;
                transform: scale(0.6) translateY(14px);
                filter: blur(3px);
            }
            60% {
                opacity: 1;
                transform: scale(1.16) translateY(-3px);
                filter: blur(0);
            }
            80% {
                transform: scale(0.96) translateY(1px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
                filter: blur(0);
            }
        }
        .stat-pop-animated {
            display: inline-block !important;
            will-change: transform, opacity;
            animation: counterPopSpring 0.75s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards !important;
        }
        .stat-counting {
            text-shadow: 0 0 16px rgba(12, 141, 231, 0.45);
        }
    `;
    document.head.appendChild(style);
}

// Parse a raw string into numeric components (prefix, number, suffix, decimals, commas)
function parseNumber(text) {
    if (!text) return null;
    const trimmed = text.trim();

    // Skip special values like "24/7" or years like "2026"
    if (trimmed === '24/7' || trimmed === '24 / 7') return null;
    if (/^(19|20)\d{2}$/.test(trimmed)) return null; // Year
    if (/^\d{1,2}:\d{2}/.test(trimmed)) return null; // Time
    if (/^#\d+$/.test(trimmed)) return null; // ID like #15

    // Match optional prefix, the number (with commas or dots), and optional suffix
    // Supports: "150+", "99.4%", "1,250", "12+", "+500", "4.9", "100%", "4.9 / 5.0"
    const regex = /^([^\d\.]*?)(\d[\d,]*(?:\.\d+)?)(.*)$/;
    const match = trimmed.match(regex);
    if (!match) return null;

    const prefix = match[1] || '';
    const rawNumberStr = match[2];
    const suffix = match[3] || '';

    const cleanNumStr = rawNumberStr.replace(/,/g, '');
    const number = parseFloat(cleanNumStr);

    if (isNaN(number)) return null;

    const hasCommas = rawNumberStr.includes(',');
    const decimalMatch = cleanNumStr.match(/\.(\d+)/);
    const decimals = decimalMatch ? decimalMatch[1].length : 0;

    return {
        prefix,
        number,
        suffix,
        decimals,
        hasCommas,
        originalText: trimmed
    };
}

// Format a number back with its decimals and thousands commas
function formatNumber(value, decimals, hasCommas) {
    let formatted = value.toFixed(decimals);
    if (hasCommas) {
        const parts = formatted.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\\d))/g, ',');
        formatted = parts.join('.');
    }
    return formatted;
}

// Quartic ease out for fast initial acceleration and smooth snap
function easeOutQuart(x) {
    return 1 - Math.pow(1 - x, 4);
}

// Animate a single counter element
export function animateCounter(element, delayMs = 0) {
    if (!element || element.dataset.counterDone === 'true') return;

    ensureAnimationStyles();

    const targetText = element.dataset.counterTarget || element.textContent;
    const parsed = parseNumber(targetText);
    if (!parsed) return;

    element.dataset.counterDone = 'true';
    element.dataset.counterTarget = targetText;

    // Apply springing pop-up animation class
    element.classList.add('stat-pop-animated', 'stat-counting');

    const duration = parseInt(element.dataset.counterDuration || '1150', 10); // ~1.15s fast & snappy
    const startTime = performance.now() + delayMs;
    const target = parsed.number;

    // Set initial text to 0
    element.textContent = parsed.prefix + formatNumber(0, parsed.decimals, parsed.hasCommas) + parsed.suffix;

    function update(now) {
        if (now < startTime) {
            requestAnimationFrame(update);
            return;
        }

        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const currentVal = target * easeOutQuart(progress);

        element.textContent = parsed.prefix + formatNumber(currentVal, parsed.decimals, parsed.hasCommas) + parsed.suffix;

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = parsed.prefix + formatNumber(target, parsed.decimals, parsed.hasCommas) + parsed.suffix;
            setTimeout(() => {
                element.classList.remove('stat-counting');
            }, 300);
        }
    }

    requestAnimationFrame(update);
}

// Auto-discovery of all metrics and statistics elements on the page
export function initCounters() {
    ensureAnimationStyles();

    // 1. Explicit counter elements
    const explicitElements = Array.from(document.querySelectorAll('[data-counter], [data-count], .stat-counter, .count-up'));

    // 2. Auto-detected candidate metric elements across Admin & Public pages
    const candidateSelectors = [
        '.card-light .text-3xl',
        '.card-light .text-4xl',
        '.card-light .text-2xl',
        '.card-dark .text-3xl',
        '.card-dark .text-4xl',
        '.card-dark .text-2xl',
        '.admin-card-executive .text-3xl',
        '.admin-card-executive .text-4xl',
        '.admin-card-executive .text-2xl',
        '[class*="font-outfit"][class*="font-black"]',
        '[class*="font-outfit"][class*="text-3xl"]',
        '[class*="font-outfit"][class*="text-4xl"]'
    ];

    const candidateElements = Array.from(document.querySelectorAll(candidateSelectors.join(',')));
    const allElements = Array.from(new Set([...explicitElements, ...candidateElements]));

    const validCounters = [];

    allElements.forEach(el => {
        // Skip elements marked explicitly with no-counter or inside dates/badges
        if (el.dataset.noCounter !== undefined || el.closest('[data-no-counter]')) return;
        if (el.closest('table tbody')) return; // Avoid table rows like IDs or dates
        if (el.closest('.step-badge')) return;

        const text = el.textContent.trim();
        const parsed = parseNumber(text);
        if (parsed) {
            // Save initial target
            if (!el.dataset.counterTarget) {
                el.dataset.counterTarget = text;
            }
            validCounters.push(el);
        }
    });

    if (validCounters.length === 0) return;

    // Use IntersectionObserver to trigger when visible with staggered pop
    const observer = new IntersectionObserver((entries) => {
        let visibleBatchIndex = 0;
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                observer.unobserve(el);
                // Stagger delay by 50ms per element in the current view batch
                const stagger = Math.min(visibleBatchIndex * 50, 400);
                visibleBatchIndex++;
                animateCounter(el, stagger);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -20px 0px',
        threshold: 0.1
    });

    validCounters.forEach(el => {
        if (el.dataset.counterDone !== 'true') {
            observer.observe(el);
        }
    });
}

// Auto-run on DOMContentLoaded and on window load
if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initCounters());
    } else {
        initCounters();
    }
    // Also re-run on load in case of lazy images/fonts adjusting layout
    window.addEventListener('load', () => initCounters());
}

// Expose globally for dynamic Ajax / Livewire / Blade partial updates
if (typeof window !== 'undefined') {
    window.initCounters = initCounters;
    window.animateCounter = animateCounter;
}
