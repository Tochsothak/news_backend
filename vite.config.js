import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                // Organized Tiptap folder paths:
                "resources/css/tiptap/tiptap.css",
                "resources/js/tiptap/tiptap.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
