import './bootstrap';
import Alpine from 'alpinejs';
import * as lucide from 'lucide';
import './counter';
import './scroll-reveal';

window.Alpine = Alpine;
window.lucide = lucide;

// Auto initialize lucide icons if any [data-lucide] exist
document.addEventListener('DOMContentLoaded', () => {
    if (lucide && lucide.createIcons) {
        lucide.createIcons();
    }
});

Alpine.start();
