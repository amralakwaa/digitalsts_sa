/* STS 2027 motion layer — progressive enhancement, no dependencies. */

const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
const raf = window.requestAnimationFrame.bind(window);

function injectBackdrop() {
    if (document.querySelector('.fx-aurora')) return;
    const aurora = document.createElement('div');
    aurora.className = 'fx-aurora';
    aurora.setAttribute('aria-hidden', 'true');
    aurora.innerHTML = '<i></i><i></i><i></i>';
    const noise = document.createElement('div');
    noise.className = 'fx-noise';
    noise.setAttribute('aria-hidden', 'true');
    document.body.prepend(noise);
    document.body.prepend(aurora);
}

function curtain() {
    if (reduced) return;
    const el = document.createElement('div');
    el.className = 'fx-curtain';
    el.innerHTML = '<div class="fx-ring"></div>';
    document.body.appendChild(el);
    const hide = () => {
        el.classList.add('out');
        setTimeout(() => el.remove(), 800);
    };
    if (document.readyState === 'complete') raf(hide);
    else window.addEventListener('load', hide, { once: true });
    setTimeout(hide, 2500); // never block the page
}

// Wrap every word of a headline so it can slide up from a mask.
function splitHeadings() {
    const targets = document.querySelectorAll('main h1, main h2');
    targets.forEach((h) => {
        if (h.dataset.fxSplit || h.children.length > 3 || h.querySelector('[x-text], [x-html]')) return;
        h.dataset.fxSplit = '1';
        let i = 0;
        const walk = (node) => {
            [...node.childNodes].forEach((n) => {
                if (n.nodeType === 3) {
                    const parts = n.textContent.split(/(\s+)/);
                    const frag = document.createDocumentFragment();
                    parts.forEach((p) => {
                        if (!p) return;
                        if (/^\s+$/.test(p)) {
                            frag.appendChild(document.createTextNode(' '));
                            return;
                        }
                        const w = document.createElement('span');
                        w.className = 'fx-word';
                        const inner = document.createElement('span');
                        inner.style.setProperty('--i', String(i++));
                        inner.textContent = p;
                        w.appendChild(inner);
                        frag.appendChild(w);
                    });
                    n.replaceWith(frag);
                } else if (n.nodeType === 1 && !n.matches('svg, img, br')) {
                    walk(n);
                }
            });
        };
        walk(h);
        h.classList.add('fx-split');
    });

    const io = new IntersectionObserver(
        (entries) => entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('fx-in');
                io.unobserve(e.target);
            }
        }),
        { threshold: 0.2 }
    );
    document.querySelectorAll('.fx-split').forEach((h) => io.observe(h));
}

// Pointer-follow spotlight on cards + optional 3D tilt.
function cards() {
    const sel = '.card-dark, .card-light, .hover-lift';
    document.addEventListener('pointermove', (e) => {
        const card = e.target.closest && e.target.closest(sel);
        if (!card) return;
        const r = card.getBoundingClientRect();
        const x = e.clientX - r.left;
        const y = e.clientY - r.top;
        card.style.setProperty('--mx', x + 'px');
        card.style.setProperty('--my', y + 'px');
        if (card.hasAttribute('data-fx-tilt') && !reduced) {
            const rx = ((y / r.height) - 0.5) * -6;
            const ry = ((x / r.width) - 0.5) * 6;
            card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
        }
    }, { passive: true });
    document.addEventListener('pointerout', (e) => {
        const card = e.target.closest && e.target.closest('[data-fx-tilt]');
        if (card && !card.contains(e.relatedTarget)) card.style.transform = '';
    }, { passive: true });

    if (finePointer && !reduced) {
        document.querySelectorAll('.card-dark').forEach((c) => c.setAttribute('data-fx-tilt', ''));
    }
}

function magnetic() {
    if (!finePointer || reduced) return;
    document.querySelectorAll('.btn-primary, .btn-ghost-dark').forEach((b) => b.setAttribute('data-fx-magnetic', ''));
    document.addEventListener('pointermove', (e) => {
        document.querySelectorAll('[data-fx-magnetic]').forEach((b) => {
            const r = b.getBoundingClientRect();
            const dx = e.clientX - (r.left + r.width / 2);
            const dy = e.clientY - (r.top + r.height / 2);
            const d = Math.hypot(dx, dy);
            if (d < 90) b.style.transform = `translate(${dx * 0.18}px, ${dy * 0.25}px)`;
            else if (b.style.transform) b.style.transform = '';
        });
    }, { passive: true });
}

function cursorGlow() {
    if (!finePointer || reduced) return;
    const g = document.createElement('div');
    g.className = 'fx-cursor';
    g.setAttribute('aria-hidden', 'true');
    document.body.appendChild(g);
    let x = 0, y = 0, tx = 0, ty = 0, running = false;
    const tick = () => {
        x += (tx - x) * 0.12;
        y += (ty - y) * 0.12;
        g.style.setProperty('--cx', x + 'px');
        g.style.setProperty('--cy', y + 'px');
        if (Math.abs(tx - x) + Math.abs(ty - y) > 0.5) raf(tick);
        else running = false;
    };
    window.addEventListener('pointermove', (e) => {
        tx = e.clientX; ty = e.clientY;
        g.classList.add('on');
        if (!running) { running = true; raf(tick); }
    }, { passive: true });
    document.addEventListener('pointerleave', () => g.classList.remove('on'));
}

// Parallax on hero/background images and floating decor, scroll-driven.
function parallax() {
    if (reduced) return;
    const els = [...document.querySelectorAll('[data-fx-parallax], #hero-section img.absolute, #hero-section .animate-float')];
    if (!els.length) return;
    let ticking = false;
    const update = () => {
        const y = window.scrollY;
        els.forEach((el) => {
            const speed = parseFloat(el.dataset.fxParallax || '0.12');
            el.style.transform = `translate3d(0, ${(y * speed).toFixed(1)}px, 0)`;
        });
        ticking = false;
    };
    window.addEventListener('scroll', () => {
        if (!ticking) { ticking = true; raf(update); }
    }, { passive: true });
}

// Hide the floating nav while scrolling down, show on scroll up.
function smartNav() {
    const header = document.querySelector('body > header');
    if (!header) return;
    let last = window.scrollY, ticking = false;
    window.addEventListener('scroll', () => {
        if (ticking) return;
        ticking = true;
        raf(() => {
            const y = window.scrollY;
            const down = y > last && y > 240;
            header.classList.toggle('fx-nav-hidden', down && !header.matches(':focus-within'));
            last = y;
            ticking = false;
        });
    }, { passive: true });
}

function boot() {
    injectBackdrop();
    curtain();
    splitHeadings();
    cards();
    magnetic();
    cursorGlow();
    parallax();
    smartNav();
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
else boot();
