<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="text-center max-w-2xl px-4">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About Us</h1>
            <p class="text-gray-600 mb-8">
                This page was loaded via Inertia! Notice there's no page refresh 
                when you navigate between pages.
            </p>
            
            <!-- SPA Navigation -->
            <div class="space-x-4">
                <Link 
                    href="/" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                >
                    ← Back to Home
                </Link>
            </div>
        </div>
    </div>
</template>
