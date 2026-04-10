<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, onMounted, onUnmounted } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const isScrolled = ref(false);
const mobileMenuOpen = ref(false);

// Track scroll position for header styling
function handleScroll() {
    isScrolled.value = window.scrollY > 50;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <div class="min-h-screen bg-charcoal text-white">
        <!-- Navigation Header -->
        <header 
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
            :class="[
                isScrolled 
                    ? 'bg-charcoal/95 backdrop-blur-md py-3 shadow-2xl' 
                    : 'bg-transparent py-6'
            ]"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <Link 
                        href="/" 
                        class="flex items-center space-x-2 group"
                    >
                        <div class="w-10 h-10 border-2 border-copper rounded-sm flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                            <span class="text-copper font-bold text-lg">V</span>
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-xl font-light tracking-[0.2em] text-white uppercase">Velvet</span>
                            <span class="text-xs block text-copper tracking-[0.3em] uppercase">Motors</span>
                        </div>
                    </Link>

                    <!-- Desktop Navigation -->
                    <nav class="hidden md:flex items-center space-x-8">
                        <Link 
                            href="/" 
                            class="text-sm tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors duration-300"
                            :class="{ 'text-copper': $page.url === '/' }"
                        >
                            Home
                        </Link>
                        <Link 
                            href="/cars" 
                            class="text-sm tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors duration-300"
                            :class="{ 'text-copper': $page.url.startsWith('/cars') }"
                        >
                            Inventory
                        </Link>
                        <Link 
                            href="/about" 
                            class="text-sm tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors duration-300"
                            :class="{ 'text-copper': $page.url === '/about' }"
                        >
                            About
                        </Link>
                    </nav>

                    <!-- Auth Actions -->
                    <div class="hidden md:flex items-center space-x-4">
                        <template v-if="!user">
                            <Link 
                                href="/login" 
                                class="text-sm tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors duration-300"
                            >
                                Login
                            </Link>
                        </template>
                        <template v-else>
                            <span class="text-sm text-white/60 tracking-wider">{{ user.name }}</span>
                            <Link 
                                href="/logout" 
                                method="post"
                                as="button"
                                class="text-sm tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors duration-300"
                            >
                                Logout
                            </Link>
                        </template>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-white hover:text-copper transition-colors"
                    >
                        <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <transition 
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-4"
            >
                <div 
                    v-if="mobileMenuOpen" 
                    class="md:hidden absolute top-full left-0 right-0 bg-charcoal/98 backdrop-blur-md border-t border-white/10"
                >
                    <nav class="px-4 py-6 space-y-4">
                        <Link 
                            href="/" 
                            @click="mobileMenuOpen = false"
                            class="block text-lg tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors"
                            :class="{ 'text-copper': $page.url === '/' }"
                        >
                            Home
                        </Link>
                        <Link 
                            href="/cars" 
                            @click="mobileMenuOpen = false"
                            class="block text-lg tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors"
                            :class="{ 'text-copper': $page.url.startsWith('/cars') }"
                        >
                            Inventory
                        </Link>
                        <Link 
                            href="/about" 
                            @click="mobileMenuOpen = false"
                            class="block text-lg tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors"
                            :class="{ 'text-copper': $page.url === '/about' }"
                        >
                            About
                        </Link>
                        <div class="pt-4 border-t border-white/10">
                            <template v-if="!user">
                                <Link 
                                    href="/login" 
                                    @click="mobileMenuOpen = false"
                                    class="block text-lg tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors"
                                >
                                    Login
                                </Link>
                            </template>
                            <template v-else>
                                <span class="block text-sm text-white/60 mb-2">{{ user.name }}</span>
                                <Link 
                                    href="/logout" 
                                    method="post"
                                    as="button"
                                    @click="mobileMenuOpen = false"
                                    class="block text-lg tracking-[0.15em] uppercase text-white/80 hover:text-copper transition-colors"
                                >
                                    Logout
                                </Link>
                            </template>
                        </div>
                    </nav>
                </div>
            </transition>
        </header>

        <!-- Main Content -->
        <main class="relative">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-charcoal-light border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Brand -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 border border-copper rounded-sm flex items-center justify-center">
                                <span class="text-copper font-bold text-sm">V</span>
                            </div>
                            <div>
                                <span class="text-lg font-light tracking-[0.2em] text-white uppercase">Velvet</span>
                                <span class="text-xs block text-copper tracking-[0.3em] uppercase">Motors</span>
                            </div>
                        </div>
                        <p class="text-white/50 text-sm leading-relaxed">
                            Curating exceptional vehicles for discerning collectors and enthusiasts since 2015.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-copper text-sm tracking-[0.2em] uppercase mb-4">Explore</h4>
                        <nav class="space-y-2">
                            <Link href="/" class="block text-white/60 hover:text-copper transition-colors text-sm">Home</Link>
                            <Link href="/cars" class="block text-white/60 hover:text-copper transition-colors text-sm">Inventory</Link>
                            <Link href="/about" class="block text-white/60 hover:text-copper transition-colors text-sm">About Us</Link>
                        </nav>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="text-copper text-sm tracking-[0.2em] uppercase mb-4">Visit Us</h4>
                        <address class="not-italic text-white/60 text-sm space-y-2">
                            <p>123 Luxury Lane</p>
                            <p>Beverly Hills, CA 90210</p>
                            <p class="pt-2">+1 (555) 123-4567</p>
                        </address>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-white/40 text-xs tracking-wider">
                        &copy; {{ new Date().getFullYear() }} Velvet Motors. All rights reserved.
                    </p>
                    <p class="text-white/40 text-xs tracking-wider">
                        Crafted with passion for automotive excellence
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
