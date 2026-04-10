<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    car: {
        type: Object,
        required: true
    }
});

function getConditionColor(condition) {
    const colors = {
        'New': 'bg-emerald-500/90 text-white',
        'Excellent': 'bg-copper/90 text-charcoal',
        'Good': 'bg-blue-500/90 text-white',
        'Fair': 'bg-amber-500/90 text-white',
        'Poor': 'bg-red-500/90 text-white',
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
    <Link 
        :href="`/cars/${car.id}`"
        class="group relative block bg-charcoal-lighter rounded-sm overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-copper/10"
    >
        <!-- Image Container -->
        <div class="relative aspect-[4/3] overflow-hidden">
            <!-- Car Image -->
            <img 
                v-if="car.image" 
                :src="`/storage/${car.image}`" 
                :alt="`${car.year} ${car.make} ${car.model}`"
                class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
            >
            <div 
                v-else 
                class="w-full h-full bg-charcoal-light flex items-center justify-center"
            >
                <svg class="w-16 h-16 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>

            <!-- Condition Badge -->
            <div 
                v-if="car.condition"
                class="absolute top-4 left-4"
            >
                <span 
                    :class="getConditionColor(car.condition)"
                    class="px-3 py-1 text-xs font-medium tracking-[0.15em] uppercase rounded-sm backdrop-blur-sm"
                >
                    {{ car.condition }}
                </span>
            </div>

            <!-- Price Badge -->
            <div class="absolute top-4 right-4">
                <span class="bg-charcoal/80 backdrop-blur-sm text-white px-4 py-2 text-lg font-semibold tracking-tight rounded-sm">
                    {{ formatPrice(car.price) }}
                </span>
            </div>

            <!-- Hover Overlay with CTA -->
            <div class="absolute inset-0 bg-copper/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                <span class="bg-white text-charcoal px-6 py-3 text-sm font-medium tracking-[0.2em] uppercase transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    View Details
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-5">
            <!-- Title -->
            <h3 class="text-white font-light text-xl tracking-tight group-hover:text-copper transition-colors duration-300">
                {{ car.year }} {{ car.make }}
            </h3>
            <p class="text-white/70 text-lg font-medium tracking-tight mt-1">
                {{ car.model }}
            </p>

            <!-- Specs Row -->
            <div class="flex items-center space-x-4 mt-4 text-white/50 text-sm">
                <div v-if="car.mileage" class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>{{ car.mileage.toLocaleString() }} mi</span>
                </div>
                
                <div v-if="car.transmission" class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ car.transmission }}</span>
                </div>

                <div v-if="car.fuel_type" class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                    </svg>
                    <span>{{ car.fuel_type }}</span>
                </div>
            </div>

            <!-- Color -->
            <div v-if="car.color" class="mt-3 flex items-center space-x-2">
                <div 
                    class="w-3 h-3 rounded-full border border-white/30"
                    :style="{ backgroundColor: car.color.toLowerCase() }"
                ></div>
                <span class="text-white/40 text-xs tracking-wider uppercase">{{ car.color }}</span>
            </div>
        </div>
    </Link>
</template>
