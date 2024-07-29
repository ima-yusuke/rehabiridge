import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/side-menu.css',
                'resources/css/posts.css',
                'resources/js/app.js',
                "resources/js/user.js",
                'resources/js/admin/dash-post.js',
                'resources/js/admin/dash-category.js',
                'resources/js/admin/dash-member.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'localhost'
        }
    },
    build: {
        manifest: 'manifest.json',
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                admin: 'resources/js/admin.js',
                sideMenu: 'resources/css/side-menu.css',
                userPosts: 'resources/css/posts.css',
                appStyles: 'resources/css/app.css',
                user: 'resources/js/user.js',
                adminPosts: 'resources/js/admin/dash-post.js',
                categories: 'resources/js/admin/dash-category.js',
                members: 'resources/js/admin/dash-member.js'
            }
        }
    }
});
