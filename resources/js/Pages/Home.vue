<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    message: String,
});
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900">{{ message }}</h1>
            <p class="mt-4 text-gray-600">Your Inertia.js SPA is working!</p>
            
            <!-- SPA Navigation - no page reload! -->
            <div class="mt-8 space-x-4">
                <Link 
                    href="/" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                >
                    Home
                </Link>
                <Link 
                    href="/about" 
                    class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition"
                >
                    About
                </Link>
                <Link 
                    href="/cars" 
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
                >
                    Cars (CRUD Demo)
                </Link>
            </div>
        </div>
    </div>
</template>
