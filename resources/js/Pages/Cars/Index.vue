<script setup>
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    cars: Array,
});

const form = useForm({});

function deleteCar(id) {
    if (confirm('Are you sure you want to delete this car?')) {
        form.delete(`/cars/${id}`);
    }
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Car Inventory</h1>
                <Link 
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Make</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Model</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="car in cars" :key="car.id">
                            <td class="px-6 py-4 text-gray-900">{{ car.make }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ car.model }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ car.year }}</td>
                            <td class="px-6 py-4 text-gray-600">${{ car.price }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
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
                            </td>
                        </tr>
                        <tr v-if="cars.length === 0">
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No cars yet. Add your first car!
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
