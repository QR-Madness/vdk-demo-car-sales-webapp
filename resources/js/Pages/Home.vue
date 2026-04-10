<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    message: String,
});

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900">{{ message }}</h1>
            <p class="mt-4 text-gray-600">Your Inertia.js SPA is working!</p>
            
            <!-- Auth status -->
            <div v-if="user" class="mt-4 text-green-600">
                Welcome, {{ user.name }}!
            </div>
            
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
                    Cars
                </Link>
                <template v-if="!user">
                    <Link 
                        href="/login" 
                        class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition"
                    >
                        Login
                    </Link>
                    <Link 
                        href="/register" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition"
                    >
                        Register
                    </Link>
                </template>
                <Link 
                    v-else
                    href="/logout" 
                    method="post"
                    as="button"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
                >
                    Logout
                </Link>
            </div>
        </div>
    </div>
</template>
