import { defineConfig } from 'vite';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';

export default defineConfig({
    root: './',
    publicDir: 'resources/',
    build: {
        outDir: 'public/',
        assetsDir: 'build/',
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                styles: 'resources/scss/style.scss',
                critical: 'resources/scss/critical.scss',
                admin: 'resources/scss/admin.scss',
                scripts: 'resources/js/scripts.js',
                loadmore: 'resources/js/loadmore.js',
            }
        }
    },
    plugins: [
        ViteImageOptimizer({
            png: {
                quality: 80,
            },
            jpeg: {
                quality: 80,
            },
            jpg: {
                quality: 80,
            },
            webp: {
                lossless: true,
            },
            svg: {
                multipass: true,
                plugins: [
                    {
                        name: 'preset-default',
                        params: {
                            overrides: {
                                cleanupNumericValues: false,
                                removeViewBox: false,
                            },
                            cleanupIDs: {
                                minify: false,
                                remove: false,
                            },
                            convertPathData: false,
                        },
                    },
                    'sortAttrs',
                    {
                        name: 'addAttributesToSVGElement',
                        params: {
                            attributes: [{ xmlns: 'http://www.w3.org/2000/svg' }],
                        },
                    },
                ],
            },
        }),
    ]
});