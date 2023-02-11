import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/plus.css',
                'resources/js/postlist.js',
                'resources/js/postcomment.js',
                'resources/js/editpost.js',
                'resources/js/bloguser_profile.js',
            ],
            refresh: true,
        }),
    ],
});
