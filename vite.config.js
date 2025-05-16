import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.43.234'
        },
        watch: {
            usePolling: true
        }
    },
    css: {
        postcss: {
            plugins: [
                tailwindcss,
                autoprefixer,
            ],
        }
    },
    optimizeDeps: {
        include: ['@tailwindcss/forms']
    }
}); 