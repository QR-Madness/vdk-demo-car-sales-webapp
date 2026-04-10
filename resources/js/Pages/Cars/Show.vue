<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    car: Object,
});

function getConditionColor(condition) {
    const colors = {
        'New': 'bg-green-100 text-green-800',
        'Excellent': 'bg-blue-100 text-blue-800',
        'Good': 'bg-yellow-100 text-yellow-800',
        'Fair': 'bg-orange-100 text-orange-800',
        'Poor': 'bg-red-100 text-red-800',
    };
    return colors[condition] || 'bg-gray-100 text-gray-800';
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <Link href="/cars" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Back to listings</Link>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative h-96 bg-gray-200">
                    <img 
                        v-if="car.image" 
                        :src="`/storage/${car.image}`" 
                        class="w-full h-full object-cover"
                        alt="Car image"
                    >
                    <div v-else class="w-full h-full flex items-center justify-center text-gray-400 text-xl">
                        No image available
                    </div>
                    <div v-if="car.condition" class="absolute top-4 right-4">
                        <span :class="getConditionColor(car.condition)" class="px-3 py-1 text-sm font-semibold rounded-full">
                            {{ car.condition }}
                        </span>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ car.year }} {{ car.make }} {{ car.model }}</h1>
                            <p v-if="car.color" class="text-lg text-gray-600 mt-1">{{ car.color }}</p>
                        </div>
                        <div class="text-3xl font-bold text-blue-600">
                            ${{ parseFloat(car.price).toLocaleString() }}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-8">
                        <div v-if="car.mileage" class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-500">Mileage</div>
                            <div class="text-xl font-semibold">{{ car.mileage.toLocaleString() }} miles</div>
                        </div>
                        
                        <div v-if="car.horsepower" class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-500">Horsepower</div>
                            <div class="text-xl font-semibold">{{ car.horsepower }} HP</div>
                        </div>
                        
                        <div v-if="car.transmission" class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-500">Transmission</div>
                            <div class="text-xl font-semibold">{{ car.transmission }}</div>
                        </div>
                        
                        <div v-if="car.fuel_type" class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-500">Fuel Type</div>
                            <div class="text-xl font-semibold">{{ car.fuel_type }}</div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex space-x-4">
                        <Link 
                            :href="`/cars/${car.id}/edit`" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            Edit
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
