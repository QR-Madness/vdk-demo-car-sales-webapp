<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    car: Object,
});

const fileInput = ref(null);

const form = useForm({
    make: props.car.make,
    model: props.car.model,
    year: props.car.year,
    price: props.car.price,
    mileage: props.car.mileage || '',
    color: props.car.color || '',
    horsepower: props.car.horsepower || '',
    transmission: props.car.transmission || '',
    fuel_type: props.car.fuel_type || '',
    condition: props.car.condition || '',
    image: null,
    remove_image: false,
});

function onRemoveToggle() {
    if (form.remove_image) {
        form.image = null;
        if (fileInput.value) fileInput.value.value = '';
    }
}

function handleFileChange(event) {
    form.image = event.target.files[0] || null;
}

function submit() {
    form.put(`/cars/${props.car.id}`);
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-2xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Car</h1>

            <form @submit.prevent="submit" class="bg-white rounded-lg shadow p-6 space-y-6">
                <!-- Basic Info -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Make *</label>
                        <input v-model="form.make" type="text"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.make }">
                        <p v-if="form.errors.make" class="mt-1 text-sm text-red-600">{{ form.errors.make }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Model *</label>
                        <input v-model="form.model" type="text"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.model }">
                        <p v-if="form.errors.model" class="mt-1 text-sm text-red-600">{{ form.errors.model }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Year *</label>
                        <input v-model="form.year" type="number"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.year }">
                        <p v-if="form.errors.year" class="mt-1 text-sm text-red-600">{{ form.errors.year }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                        <input v-model="form.price" type="number" step="0.01"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.price }">
                        <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
                    </div>
                </div>

                <!-- Enhanced Stats -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vehicle Details</h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mileage</label>
                            <input v-model="form.mileage" type="number"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.mileage }">
                            <p v-if="form.errors.mileage" class="mt-1 text-sm text-red-600">{{ form.errors.mileage }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                            <input v-model="form.color" type="text"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.color }">
                            <p v-if="form.errors.color" class="mt-1 text-sm text-red-600">{{ form.errors.color }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Horsepower</label>
                            <input v-model="form.horsepower" type="number"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.horsepower }">
                            <p v-if="form.errors.horsepower" class="mt-1 text-sm text-red-600">{{ form.errors.horsepower
                                }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Transmission</label>
                            <select v-model="form.transmission"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.transmission }">
                                <option value="">Select transmission</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                                <option value="CVT">CVT</option>
                            </select>
                            <p v-if="form.errors.transmission" class="mt-1 text-sm text-red-600">{{
                                form.errors.transmission }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fuel Type</label>
                            <select v-model="form.fuel_type"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.fuel_type }">
                                <option value="">Select fuel type</option>
                                <option value="Gasoline">Gasoline</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                            <p v-if="form.errors.fuel_type" class="mt-1 text-sm text-red-600">{{ form.errors.fuel_type
                                }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                            <select v-model="form.condition"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.condition }">
                                <option value="">Select condition</option>
                                <option value="New">New</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                            </select>
                            <p v-if="form.errors.condition" class="mt-1 text-sm text-red-600">{{ form.errors.condition
                                }}</p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="border-t pt-6 space-y-4">
                    <!-- Current image preview + remove toggle -->
                    <div v-if="car.image">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <img v-if="!form.remove_image" :src="`/storage/${car.image}`"
                            class="h-32 w-48 object-cover rounded mb-2">
                        <label class="flex items-center gap-2 text-sm cursor-pointer select-none"
                            :class="form.remove_image ? 'text-red-600 font-medium' : 'text-gray-600'">
                            <input type="checkbox" v-model="form.remove_image" @change="onRemoveToggle"
                                class="rounded">
                            Remove current image
                        </label>
                    </div>

                    <!-- File input (hidden while remove is toggled) -->
                    <div v-if="!form.remove_image">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ car.image ? 'Replace Image' : 'Image' }}
                        </label>
                        <input ref="fileInput" type="file" accept="image/*" @change="handleFileChange"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.image }">
                        <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        :disabled="form.processing">
                        <span v-if="form.processing">Updating...</span>
                        <span v-else>Update Car</span>
                    </button>
                    <Link href="/cars" class="text-gray-600 hover:text-gray-800">Cancel</Link>
                </div>
            </form>
        </div>
    </div>
</template>
