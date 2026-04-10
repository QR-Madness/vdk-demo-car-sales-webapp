<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900">{{ message }}</h1>
            <p class="mt-4 text-gray-600">Your Inertia.js setup is working!</p>
        </div>
    </div>
</template>
