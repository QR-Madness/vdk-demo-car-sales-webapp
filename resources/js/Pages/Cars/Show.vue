<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';

defineProps({
    car: Object,
});

const page = usePage();
const user = computed(() => page.props.auth?.user);

const pageLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        pageLoaded.value = true;
    }, 100);
});

function getConditionColor(condition) {
    const colors = {
        'New': 'bg-emerald-500 text-white',
        'Excellent': 'bg-copper text-charcoal',
        'Good': 'bg-blue-500 text-white',
        'Fair': 'bg-amber-500 text-white',
        'Poor': 'bg-red-500 text-white',
    };
    return colors[condition] || 'bg-white/20 text-white';
}

function formatPrice(price) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(price);
}
</script>

<template>
    <div class="min-h-screen bg-charcoal">
        <!-- Hero Section - Full Width Image -->
        <section class="relative h-[70vh] min-h-[500px]">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img 
                    v-if="car.image" 
                    :src="`/storage/${car.image}`" 
                    :alt="`${car.year} ${car.make} ${car.model}`"
                    class="w-full h-full object-cover"
                    :class="pageLoaded ? 'scale-100' : 'scale-110'"
                    style="transition: transform 1.5s cubic-bezier(0.16, 1, 0.3, 1);"
                >
                <div 
                    v-else 
                    class="w-full h-full bg-charcoal-light flex items-center justify-center"
                >
                    <svg class="w-32 h-32 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <!-- Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal/60 via-transparent to-charcoal/60"></div>
            </div>

            <!-- Back Button -->
            <div class="absolute top-24 left-4 sm:left-8 z-10">
                <Link 
                    href="/cars"
                    class="group flex items-center space-x-2 text-white/80 hover:text-copper transition-colors"
                >
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm tracking-wider uppercase">Back to Inventory</span>
                </Link>
            </div>

            <!-- Condition Badge -->
            <div 
                v-if="car.condition"
                class="absolute top-24 right-4 sm:right-8 z-10"
            >
                <span 
                    :class="getConditionColor(car.condition)"
                    class="px-4 py-2 text-sm font-medium tracking-[0.15em] uppercase rounded-sm"
                >
                    {{ car.condition }}
                </span>
            </div>

            <!-- Hero Content -->
            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Year & Make -->
                    <div 
                        class="transition-all duration-1000 ease-out delay-200"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <span class="text-copper text-sm tracking-[0.4em] uppercase">{{ car.year }}</span>
                    </div>
                    
                    <!-- Model -->
                    <h1 
                        class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extralight text-white tracking-tight mt-2 transition-all duration-1000 ease-out delay-300"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        {{ car.make }}
                    </h1>
                    <h2 
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight transition-all duration-1000 ease-out delay-400"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        {{ car.model }}
                    </h2>

                    <!-- Price -->
                    <div 
                        class="mt-6 transition-all duration-1000 ease-out delay-500"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <span class="text-4xl sm:text-5xl font-bold text-copper">{{ formatPrice(car.price) }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Details Section -->
        <section class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Left Column - Specs -->
                    <div class="lg:col-span-2">
                        <div 
                            class="transition-all duration-700 delay-600"
                            :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        >
                            <h3 class="text-copper text-sm tracking-[0.4em] uppercase mb-6">Vehicle Specifications</h3>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                                <!-- Mileage -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Mileage</span>
                                    </div>
                                    <div class="text-2xl font-semibold text-white">
                                        {{ car.mileage ? car.mileage.toLocaleString() : 'N/A' }}
                                    </div>
                                    <div class="text-white/40 text-sm">miles</div>
                                </div>

                                <!-- Transmission -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Transmission</span>
                                    </div>
                                    <div class="text-2xl font-semibold text-white">
                                        {{ car.transmission || 'N/A' }}
                                    </div>
                                </div>

                                <!-- Fuel Type -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Fuel Type</span>
                                    </div>
                                    <div class="text-2xl font-semibold text-white">
                                        {{ car.fuel_type || 'N/A' }}
                                    </div>
                                </div>

                                <!-- Horsepower -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Horsepower</span>
                                    </div>
                                    <div class="text-2xl font-semibold text-white">
                                        {{ car.horsepower ? car.horsepower + ' HP' : 'N/A' }}
                                    </div>
                                </div>

                                <!-- Color -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Color</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div 
                                            v-if="car.color"
                                            class="w-6 h-6 rounded-full border-2 border-white/30"
                                            :style="{ backgroundColor: car.color.toLowerCase() }"
                                        ></div>
                                        <div class="text-2xl font-semibold text-white">
                                            {{ car.color || 'N/A' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Year -->
                                <div class="bg-charcoal-lighter p-6 rounded-sm">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-10 h-10 bg-copper/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white/50 text-xs tracking-wider uppercase">Year</span>
                                    </div>
                                    <div class="text-2xl font-semibold text-white">
                                        {{ car.year }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Actions -->
                    <div 
                        class="transition-all duration-700 delay-700"
                        :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    >
                        <div class="bg-charcoal-lighter p-8 rounded-sm sticky top-24">
                            <h3 class="text-copper text-sm tracking-[0.4em] uppercase mb-6">Interested?</h3>
                            
                            <p class="text-white/60 mb-8 leading-relaxed">
                                This exceptional vehicle is available for viewing at our showroom. 
                                Contact us to schedule a private appointment.
                            </p>

                            <div class="space-y-4">
                                <button class="w-full py-4 bg-copper text-charcoal font-medium tracking-[0.2em] uppercase text-sm hover:bg-copper-light transition-colors">
                                    Schedule Viewing
                                </button>
                                
                                <button class="w-full py-4 border border-white/20 text-white font-medium tracking-[0.2em] uppercase text-sm hover:bg-white hover:text-charcoal transition-all">
                                    Request Info
                                </button>
                            </div>

                            <div class="mt-8 pt-8 border-t border-white/10">
                                <div class="text-white/40 text-sm mb-2">Questions?</div>
                                <div class="text-white font-medium">+1 (555) 123-4567</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Admin Actions -->
        <section v-if="user" class="py-12 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <span class="text-white/50 text-sm tracking-wider uppercase">Admin Actions</span>
                    <div class="flex items-center space-x-4">
                        <Link 
                            :href="`/cars/${car.id}/edit`"
                            class="px-6 py-3 bg-copper/20 text-copper font-medium tracking-wider uppercase text-sm hover:bg-copper hover:text-charcoal transition-all"
                        >
                            Edit Vehicle
                        </Link>
                        <button 
                            @click="$emit('delete', car.id)"
                            class="px-6 py-3 border border-red-500/30 text-red-400 font-medium tracking-wider uppercase text-sm hover:bg-red-500 hover:text-white transition-all"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
