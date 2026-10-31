import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // تقليل حجم الـ chunks
        chunkSizeWarningLimit: 600,
        rollupOptions: {
            output: {
                // تقسيم الكود لتحسين التحميل
                manualChunks: {
                    'alpine': ['alpinejs'],
                },
                // تحسين أسماء الملفات للـ cache
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
            },
        },
        // تفعيل ضغط CSS
        cssMinify: true,
        // تفعيل ضغط JS
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,      // حذف console.log في الإنتاج
                drop_debugger: true,     // حذف debugger
                pure_funcs: ['console.log', 'console.warn', 'console.info'],
            },
            mangle: {
                safari10: true,
            },
            format: {
                comments: false,        // حذف التعليقات
            },
        },
        // تقليل sourcemaps في الإنتاج
        sourcemap: false,
        // تحسين الأصول الصغيرة
        assetsInlineLimit: 4096,
    },
    // تحسين الاستيراد المتزامن
    optimizeDeps: {
        include: ['alpinejs'],
    },
});
