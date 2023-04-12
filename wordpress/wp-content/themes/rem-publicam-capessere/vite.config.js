import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
const { resolve } = require('path')
import { fileURLToPath, URL } from "url";

// https://vitejs.dev/config
export default defineConfig({

    plugins: [
        liveReload(__dirname + '/**/*.php')
    ],

    // config
    root: '',
    base: process.env.NODE_ENV === 'development'
        ? '/'
        : '/wp-content/themes/rem-publicam-capessere/dist/',

    build: {
        // output dir for production build
        outDir: resolve(__dirname, './dist'),
        emptyOutDir: true,

        // emit manifest so PHP can find the hashed files
        manifest: true,

        // esbuild target
        target: 'es2018',

        // our entry
        rollupOptions: {
            input: {
                main: resolve(__dirname + '/main.js')
            },
        },

        // minifying switch
        minify: true,
        write: true
    },

    server: {
        hmr: {
            host: 'rpc.ddev.site',
            protocol: "wss"
        },
    },

    resolve: {
        alias: {
            '@fonts': process.env.NODE_ENV === 'development'
                ? fileURLToPath(new URL('wp-content/themes/rem-publicam-capessere/src/css/typography/fonts', import.meta.url))
                : fileURLToPath(new URL('./src/css/typography/fonts', import.meta.url))
        },
    }
})

