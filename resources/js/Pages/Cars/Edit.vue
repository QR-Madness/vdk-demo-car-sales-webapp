<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    car: Object,
});

const form = useForm({
    make: props.car.make,
    model: props.car.model,
    year: props.car.year,
    price: props.car.price,
});

function submit() {
    form.put(`/cars/${props.car.id}`);
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-2xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Car</h1>

            <form @submit.prevent="submit" class="bg-white rounded-lg shadow p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                    <input 
                        v-model="form.make" 
                        type="text" 
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': form.errors.make }"
                    >
                    <p v-if="form.errors.make" class="mt-1 text-sm text-red-600">{{ form.errors.make }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                    <input 
                        v-model="form.model" 
                        type="text" 
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': form.errors.model }"
                    >
                    <p v-if="form.errors.model" class="mt-1 text-sm text-red-600">{{ form.errors.model }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <input 
                        v-model="form.year" 
                        type="number" 
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': form.errors.year }"
                    >
                    <p v-if="form.errors.year" class="mt-1 text-sm text-red-600">{{ form.errors.year }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input 
                        v-model="form.price" 
                        type="number" 
                        step="0.01"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': form.errors.price }"
                    >
                    <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
                </div>

                <div class="flex items-center space-x-4">
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Updating...</span>
                        <span v-else>Update Car</span>
                    </button>
                    <Link href="/cars" class="text-gray-600 hover:text-gray-800">Cancel</Link>
                </div>
            </form>
        </div>
    </div>
</template>
