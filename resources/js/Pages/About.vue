<script setup>
import { ref, onMounted } from 'vue';

const pageLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        pageLoaded.value = true;
    }, 100);
});
</script>

<template>
    <div class="min-h-screen bg-charcoal">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pb-32 overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-copper/5 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-copper/5 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl">
                    <!-- Eyebrow -->
                    <div 
                        class="transition-all duration-1000 ease-out"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <span class="text-copper text-sm tracking-[0.4em] uppercase">Our Story</span>
                    </div>

                    <!-- Headline -->
                    <h1 
                        class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extralight text-white mt-6 tracking-tight leading-[0.9] transition-all duration-1000 delay-200 ease-out"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        A Legacy of
                        <span class="block font-bold">Excellence</span>
                    </h1>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-20 lg:py-32 bg-charcoal-light">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Text Content -->
                    <div 
                        class="transition-all duration-1000 delay-300"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <h2 class="text-3xl sm:text-4xl font-light text-white mb-8 tracking-tight">
                            Curating the world's finest automobiles since 2015
                        </h2>
                        
                        <div class="space-y-6 text-white/60 text-lg leading-relaxed">
                            <p>
                                Velvet Motors began with a simple belief: that exceptional vehicles deserve an exceptional 
                                home. Founded by automotive enthusiasts with decades of combined experience, we've built 
                                our reputation on an unwavering commitment to quality and an eye for the extraordinary.
                            </p>
                            
                            <p>
                                Every vehicle that enters our showroom undergoes a rigorous selection process. We don't 
                                just sell cars—we curate experiences. From rare classics to the latest supercars, each 
                                automobile in our collection represents the pinnacle of automotive artistry.
                            </p>
                            
                            <p>
                                Our team of experts brings together knowledge spanning engineering, design, and automotive 
                                history. This expertise allows us to guide our clients through the journey of finding not 
                                just a car, but a companion for life's adventures.
                            </p>
                        </div>
                    </div>

                    <!-- Visual Element -->
                    <div 
                        class="relative transition-all duration-1000 delay-500"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <div class="aspect-[4/5] bg-charcoal-lighter rounded-sm overflow-hidden">
                            <!-- Placeholder for showroom image -->
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-charcoal-lighter to-charcoal">
                                <div class="text-center p-8">
                                    <div class="w-24 h-24 mx-auto mb-6 border-2 border-copper/30 rounded-full flex items-center justify-center">
                                        <span class="text-4xl font-light text-copper">V</span>
                                    </div>
                                    <div class="text-copper text-sm tracking-[0.3em] uppercase">Velvet Motors</div>
                                    <div class="text-white/30 text-xs tracking-wider mt-2">Est. 2015</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative frame -->
                        <div class="absolute -bottom-4 -right-4 w-full h-full border border-copper/20 rounded-sm -z-10"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-20 lg:py-32 bg-charcoal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-copper text-sm tracking-[0.4em] uppercase">Our Principles</span>
                    <h2 class="text-4xl sm:text-5xl font-extralight text-white mt-4 tracking-tight">
                        What Drives Us
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div 
                        class="bg-charcoal-lighter p-8 rounded-sm transition-all duration-700 delay-100 hover:bg-charcoal-light"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <div class="w-12 h-12 bg-copper/10 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-white mb-3 tracking-tight">Uncompromising Quality</h3>
                        <p class="text-white/50 leading-relaxed">
                            We accept only the finest vehicles, each meticulously inspected and prepared 
                            to exceed the expectations of the most discerning collectors.
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div 
                        class="bg-charcoal-lighter p-8 rounded-sm transition-all duration-700 delay-200 hover:bg-charcoal-light"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <div class="w-12 h-12 bg-copper/10 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-white mb-3 tracking-tight">Personalized Service</h3>
                        <p class="text-white/50 leading-relaxed">
                            Every client receives our undivided attention. We take time to understand 
                            your desires and match you with the perfect vehicle.
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div 
                        class="bg-charcoal-lighter p-8 rounded-sm transition-all duration-700 delay-300 hover:bg-charcoal-light"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <div class="w-12 h-12 bg-copper/10 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-white mb-3 tracking-tight">Expert Knowledge</h3>
                        <p class="text-white/50 leading-relaxed">
                            Our team's deep understanding of automotive history and engineering ensures 
                            you receive informed guidance every step of the way.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="py-20 lg:py-32 bg-charcoal-light overflow-hidden relative">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-copper/5 rounded-full blur-3xl"></div>
            
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <svg class="w-16 h-16 text-copper/30 mx-auto mb-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                
                <blockquote class="text-2xl sm:text-3xl md:text-4xl font-extralight text-white leading-relaxed tracking-tight">
                    "We don't just sell cars. We facilitate the union between driver and machine, 
                    creating relationships that last a lifetime."
                </blockquote>
                
                <div class="mt-8">
                    <div class="w-16 h-px bg-copper mx-auto mb-4"></div>
                    <div class="text-copper text-sm tracking-[0.3em] uppercase">The Velvet Motors Promise</div>
                </div>
            </div>
        </section>

        <!-- Visit CTA -->
        <section class="py-20 lg:py-32 bg-charcoal">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl sm:text-5xl font-extralight text-white tracking-tight mb-6">
                    Visit Our Showroom
                </h2>
                <p class="text-white/60 text-lg mb-8 max-w-2xl mx-auto">
                    Experience our collection in person. Our doors are open for private viewings 
                    by appointment.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a 
                        href="/cars"
                        class="px-10 py-4 bg-copper text-charcoal font-medium tracking-[0.2em] uppercase text-sm hover:bg-copper-light transition-colors"
                    >
                        View Inventory
                    </a>
                    <div class="text-white/40 text-sm">
                        or call +1 (555) 123-4567
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-white/40 text-xs tracking-[0.3em] uppercase mb-2">Location</div>
                        <div class="text-white">123 Luxury Lane</div>
                        <div class="text-white/60">Beverly Hills, CA 90210</div>
                    </div>
                    <div>
                        <div class="text-white/40 text-xs tracking-[0.3em] uppercase mb-2">Hours</div>
                        <div class="text-white">Mon - Sat: 10AM - 7PM</div>
                        <div class="text-white/60">Sunday: By Appointment</div>
                    </div>
                    <div>
                        <div class="text-white/40 text-xs tracking-[0.3em] uppercase mb-2">Contact</div>
                        <div class="text-white">+1 (555) 123-4567</div>
                        <div class="text-white/60">hello@velvetmotors.com</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
