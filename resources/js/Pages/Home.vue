<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';

defineProps({
    carsCount: {
        type: Number,
        default: 0
    }
});

const heroVisible = ref(false);
const statsVisible = ref(false);

// Use new URL for public assets in Vite
const heroImageUrl = computed(() => new URL('/home-bg.jpg', import.meta.url).href);

onMounted(() => {
    // Trigger entrance animations
    setTimeout(() => {
        heroVisible.value = true;
    }, 100);
    
    setTimeout(() => {
        statsVisible.value = true;
    }, 800);
});
</script>

<template>
    <div>
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Background Image with Parallax -->
            <div class="absolute inset-0 z-0">
                <img 
                    :src="heroImageUrl" 
                    alt="Luxury car showroom"
                    class="w-full h-full object-cover scale-110"
                    :class="{ 'animate-scale-in': heroVisible }"
                    style="animation-duration: 1.5s;"
                >
                <!-- Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-b from-charcoal/70 via-charcoal/40 to-charcoal"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal/60 via-transparent to-charcoal/60"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
                <!-- Eyebrow -->
                <div 
                    class="mb-6 transition-all duration-1000 ease-out"
                    :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <span class="text-copper text-sm sm:text-base tracking-[0.4em] uppercase font-light">
                        Premium Automotive Collection
                    </span>
                </div>

                <!-- Main Headline -->
                <h1 class="mb-8">
                    <span 
                        class="block text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-extralight text-white tracking-tight leading-none transition-all duration-1000 delay-200 ease-out"
                        :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        DRIVE THE
                    </span>
                    <span 
                        class="block text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-bold text-white tracking-tight leading-none mt-2 transition-all duration-1000 delay-300 ease-out"
                        :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        EXTRAORDINARY
                    </span>
                </h1>

                <!-- Subheadline -->
                <p 
                    class="text-lg sm:text-xl md:text-2xl text-white/70 font-light max-w-2xl mx-auto mb-12 tracking-wide transition-all duration-1000 delay-500 ease-out"
                    :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    Discover our curated collection of exceptional vehicles, 
                    handpicked for those who demand perfection.
                </p>

                <!-- CTA Buttons -->
                <div 
                    class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 transition-all duration-1000 delay-700 ease-out"
                    :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <Link 
                        href="/cars"
                        class="group relative px-10 py-4 bg-copper text-charcoal font-medium tracking-[0.2em] uppercase text-sm overflow-hidden transition-all duration-300 hover:shadow-[0_0_40px_rgba(201,169,98,0.4)]"
                    >
                        <span class="relative z-10">View Inventory</span>
                        <div class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                    </Link>
                    
                    <Link 
                        href="/about"
                        class="px-10 py-4 border border-white/30 text-white font-medium tracking-[0.2em] uppercase text-sm transition-all duration-300 hover:bg-white hover:text-charcoal"
                    >
                        Our Story
                    </Link>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div 
                class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 flex flex-col items-center transition-all duration-1000 delay-1000"
                :class="heroVisible ? 'opacity-100' : 'opacity-0'"
            >
                <span class="text-white/50 text-xs tracking-[0.3em] uppercase mb-4">Scroll</span>
                <div class="w-px h-12 bg-gradient-to-b from-white/50 to-transparent animate-scroll-indicator"></div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="relative py-20 bg-charcoal border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div 
                    class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12"
                    :class="statsVisible ? 'opacity-100' : 'opacity-0'"
                >
                    <div 
                        class="text-center transition-all duration-700 delay-100"
                        :class="statsVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    >
                        <div class="text-4xl sm:text-5xl font-bold text-copper mb-2">50+</div>
                        <div class="text-white/60 text-sm tracking-[0.2em] uppercase">Vehicles</div>
                    </div>
                    
                    <div 
                        class="text-center transition-all duration-700 delay-200"
                        :class="statsVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    >
                        <div class="text-4xl sm:text-5xl font-bold text-copper mb-2">15+</div>
                        <div class="text-white/60 text-sm tracking-[0.2em] uppercase">Brands</div>
                    </div>
                    
                    <div 
                        class="text-center transition-all duration-700 delay-300"
                        :class="statsVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    >
                        <div class="text-4xl sm:text-5xl font-bold text-copper mb-2">10</div>
                        <div class="text-white/60 text-sm tracking-[0.2em] uppercase">Years</div>
                    </div>
                    
                    <div 
                        class="text-center transition-all duration-700 delay-400"
                        :class="statsVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    >
                        <div class="text-4xl sm:text-5xl font-bold text-copper mb-2">100%</div>
                        <div class="text-white/60 text-sm tracking-[0.2em] uppercase">Satisfaction</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Section -->
        <section class="relative py-32 bg-charcoal-light">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-copper text-sm tracking-[0.4em] uppercase">The Collection</span>
                    <h2 class="text-4xl sm:text-5xl md:text-6xl font-extralight text-white mt-4 tracking-tight">
                        Exceptional by Design
                    </h2>
                    <p class="text-white/60 text-lg max-w-2xl mx-auto mt-6">
                        Every vehicle in our showroom represents the pinnacle of automotive engineering and design excellence.
                    </p>
                </div>

                <div class="flex justify-center">
                    <Link 
                        href="/cars"
                        class="group inline-flex items-center space-x-3 text-copper hover:text-white transition-colors duration-300"
                    >
                        <span class="text-sm tracking-[0.3em] uppercase">Explore All Vehicles</span>
                        <svg 
                            class="w-5 h-5 transform group-hover:translate-x-2 transition-transform duration-300" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="relative py-32 bg-charcoal overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-copper/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-copper/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <svg class="w-16 h-16 text-copper/30 mx-auto mb-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                
                <blockquote class="text-2xl sm:text-3xl md:text-4xl font-extralight text-white leading-relaxed tracking-tight">
                    "The cars we drive say a lot about us. We believe they should say 
                    <span class="text-copper font-normal">excellence</span>."
                </blockquote>
                
                <div class="mt-8">
                    <div class="text-copper text-sm tracking-[0.3em] uppercase">Alexandra Velvet</div>
                    <div class="text-white/50 text-sm mt-1">Founder, Velvet Motors</div>
                </div>
            </div>
        </section>
    </div>
</template>
