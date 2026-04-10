<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    cars: Array,
});

const page = usePage();
const user = computed(() => page.props.auth?.user);

const form = useForm({});

function deleteCar(id) {
    if (confirm('Are you sure you want to delete this car?')) {
        form.delete(`/cars/${id}`);
    }
}

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
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Car Inventory</h1>
                    <p class="text-gray-600 mt-1">{{ cars.length }} vehicles available</p>
                </div>
                <Link 
                    v-if="user"
                    href="/cars/create" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                >
                    + Add Car
                </Link>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Details</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Condition</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="car in cars" :key="car.id" class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <img 
                                    v-if="car.image" 
                                    :src="`/storage/${car.image}`" 
                                    class="h-16 w-24 object-cover rounded"
                                    alt="Car image"
                                >
                                <div v-else class="h-16 w-24 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">
                                    No image
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ car.year }} {{ car.make }} {{ car.model }}</div>
                                <div v-if="car.color" class="text-sm text-gray-500">{{ car.color }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <div v-if="car.mileage">{{ car.mileage.toLocaleString() }} miles</div>
                                <div v-if="car.horsepower">{{ car.horsepower }} HP</div>
                                <div v-if="car.transmission">{{ car.transmission }}</div>
                                <div v-if="car.fuel_type">{{ car.fuel_type }}</div>
                            </td>
                            <td class="px-4 py-4 text-sm font-semibold text-gray-900">
                                ${{ parseFloat(car.price).toLocaleString() }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span 
                                    v-if="car.condition"
                                    :class="getConditionColor(car.condition)"
                                    class="px-2 py-1 text-xs font-semibold rounded-full"
                                >
                                    {{ car.condition }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right space-x-2">
                                <Link 
                                    :href="`/cars/${car.id}`" 
                                    class="text-gray-600 hover:text-gray-900"
                                >
                                    View
                                </Link>
                                <template v-if="user">
                                    <Link 
                                        :href="`/cars/${car.id}/edit`" 
                                        class="text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </Link>
                                    <button 
                                        @click="deleteCar(car.id)" 
                                        class="text-red-600 hover:text-red-800"
                                        :disabled="form.processing"
                                    >
                                        Delete
                                    </button>
                                </template>
                            </td>
                        </tr>
                        <tr v-if="cars.length === 0">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No cars yet. 
                                <Link v-if="user" href="/cars/create" class="text-blue-600 hover:underline">Add your first car!</Link>
                                <span v-else>Check back later for new inventory.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <Link href="/" class="text-blue-600 hover:text-blue-800">← Back to Home</Link>
            </div>
        </div>
    </div>
</template>
