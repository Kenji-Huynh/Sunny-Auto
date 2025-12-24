import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
        tailwindcss(),
        react(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        // Optimize bundle size
        rollupOptions: {
            output: {
                // Manual chunks - Tách vendors thành files riêng
                manualChunks: {
                    // React core
                    'react-vendor': ['react', 'react-dom'],
                    
                    // React Router
                    'router-vendor': ['react-router-dom'],
                    
                    // Framer Motion (heavy library)
                    'animation-vendor': ['framer-motion'],
                    
                    // Axios
                    'http-vendor': ['axios'],
                },
            },
        },
        
        // Chunk size warning limit
        chunkSizeWarningLimit: 500,
        
        // Minify options
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.log in production
                drop_debugger: true,
            },
        },
        
        // CSS code splitting
        cssCodeSplit: true,
        
        // Source maps (disable for smaller bundle)
        sourcemap: false,
    },
    
    // Optimize dependencies
    optimizeDeps: {
        include: ['react', 'react-dom', 'react-router-dom', 'framer-motion', 'axios'],
    },
});
