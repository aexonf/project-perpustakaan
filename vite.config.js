<<<<<<< HEAD
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
=======
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ["resources/css/app.css", "resources/js/app.jsx"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
=======
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
>>>>>>> bcd07b6ca9fda5c8d7a22514643d24f49da87aa5
});
