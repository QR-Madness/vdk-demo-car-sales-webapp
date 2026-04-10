<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    car: Object,
});

const fileInput = ref(null);
const pageLoaded = ref(false);

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

onMounted(() => {
    setTimeout(() => {
        pageLoaded.value = true;
    }, 100);
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
    <div class="min-h-screen bg-charcoal pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div 
                class="mb-10 transition-all duration-1000 ease-out"
                :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <Link 
                    :href="`/cars/${car.id}`"
                    class="group inline-flex items-center space-x-2 text-white/60 hover:text-copper transition-colors mb-6"
                >
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm tracking-wider uppercase">Back to Vehicle</span>
                </Link>
                
                <h1 class="text-4xl sm:text-5xl font-extralight text-white tracking-tight">
                    Edit Vehicle
                </h1>
                <p class="text-white/50 mt-2">
                    {{ car.year }} {{ car.make }} {{ car.model }}
                </p>
            </div>

            <!-- Form -->
            <form 
                @submit.prevent="submit" 
                class="bg-charcoal-lighter p-8 sm:p-10 rounded-sm border border-white/5 transition-all duration-1000 delay-200"
                :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <!-- Basic Info Section -->
                <div class="mb-10">
                    <h2 class="text-copper text-sm tracking-[0.3em] uppercase mb-6 flex items-center">
                        <span class="w-8 h-px bg-copper mr-4"></span>
                        Basic Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Make -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Make <span class="text-copper">*</span>
                            </label>
                            <input 
                                v-model="form.make" 
                                type="text"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.make }"
                            >
                            <p v-if="form.errors.make" class="mt-2 text-sm text-red-400">{{ form.errors.make }}</p>
                        </div>

                        <!-- Model -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Model <span class="text-copper">*</span>
                            </label>
                            <input 
                                v-model="form.model" 
                                type="text"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.model }"
                            >
                            <p v-if="form.errors.model" class="mt-2 text-sm text-red-400">{{ form.errors.model }}</p>
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Year <span class="text-copper">*</span>
                            </label>
                            <input 
                                v-model="form.year" 
                                type="number"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.year }"
                            >
                            <p v-if="form.errors.year" class="mt-2 text-sm text-red-400">{{ form.errors.year }}</p>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Price <span class="text-copper">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40">$</span>
                                <input 
                                    v-model="form.price" 
                                    type="number" 
                                    step="0.01"
                                    class="w-full bg-charcoal border border-white/10 text-white pl-10 pr-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                    :class="{ 'border-red-500/50': form.errors.price }"
                                >
                            </div>
                            <p v-if="form.errors.price" class="mt-2 text-sm text-red-400">{{ form.errors.price }}</p>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Details Section -->
                <div class="mb-10">
                    <h2 class="text-copper text-sm tracking-[0.3em] uppercase mb-6 flex items-center">
                        <span class="w-8 h-px bg-copper mr-4"></span>
                        Vehicle Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mileage -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Mileage
                            </label>
                            <input 
                                v-model="form.mileage" 
                                type="number"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.mileage }"
                            >
                            <p v-if="form.errors.mileage" class="mt-2 text-sm text-red-400">{{ form.errors.mileage }}</p>
                        </div>

                        <!-- Color -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Color
                            </label>
                            <input 
                                v-model="form.color" 
                                type="text"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.color }"
                            >
                            <p v-if="form.errors.color" class="mt-2 text-sm text-red-400">{{ form.errors.color }}</p>
                        </div>

                        <!-- Horsepower -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Horsepower
                            </label>
                            <input 
                                v-model="form.horsepower" 
                                type="number"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.horsepower }"
                            >
                            <p v-if="form.errors.horsepower" class="mt-2 text-sm text-red-400">{{ form.errors.horsepower }}</p>
                        </div>

                        <!-- Transmission -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Transmission
                            </label>
                            <select 
                                v-model="form.transmission"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.transmission }"
                            >
                                <option value="">Select transmission</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                                <option value="CVT">CVT</option>
                            </select>
                            <p v-if="form.errors.transmission" class="mt-2 text-sm text-red-400">{{ form.errors.transmission }}</p>
                        </div>

                        <!-- Fuel Type -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Fuel Type
                            </label>
                            <select 
                                v-model="form.fuel_type"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.fuel_type }"
                            >
                                <option value="">Select fuel type</option>
                                <option value="Gasoline">Gasoline</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                            <p v-if="form.errors.fuel_type" class="mt-2 text-sm text-red-400">{{ form.errors.fuel_type }}</p>
                        </div>

                        <!-- Condition -->
                        <div>
                            <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                                Condition
                            </label>
                            <select 
                                v-model="form.condition"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                                :class="{ 'border-red-500/50': form.errors.condition }"
                            >
                                <option value="">Select condition</option>
                                <option value="New">New</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                            </select>
                            <p v-if="form.errors.condition" class="mt-2 text-sm text-red-400">{{ form.errors.condition }}</p>
                        </div>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="mb-10">
                    <h2 class="text-copper text-sm tracking-[0.3em] uppercase mb-6 flex items-center">
                        <span class="w-8 h-px bg-copper mr-4"></span>
                        Vehicle Image
                    </h2>
                    
                    <!-- Current Image Preview -->
                    <div v-if="car.image && !form.remove_image" class="mb-6">
                        <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-3">
                            Current Image
                        </label>
                        <div class="relative inline-block">
                            <img 
                                :src="`/storage/${car.image}`" 
                                :alt="`${car.year} ${car.make} ${car.model}`"
                                class="w-64 h-40 object-cover rounded-sm"
                            >
                        </div>
                        
                        <!-- Remove Toggle -->
                        <label class="flex items-center space-x-3 mt-4 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                v-model="form.remove_image" 
                                @change="onRemoveToggle"
                                class="w-4 h-4 bg-charcoal border border-white/20 rounded-sm text-copper focus:ring-copper focus:ring-offset-0"
                            >
                            <span class="text-red-400 text-sm group-hover:text-red-300 transition-colors">
                                Remove current image
                            </span>
                        </label>
                    </div>

                    <!-- New Image Upload -->
                    <div v-if="!form.remove_image">
                        <label class="block text-white/60 text-xs tracking-[0.15em] uppercase mb-2">
                            {{ car.image ? 'Replace Image' : 'Upload Image' }}
                        </label>
                        <div class="relative">
                            <input 
                                ref="fileInput"
                                type="file" 
                                accept="image/*" 
                                @change="handleFileChange"
                                class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-sm file:border-0 file:text-sm file:bg-copper file:text-charcoal file:tracking-wider file:uppercase hover:file:bg-copper-light"
                                :class="{ 'border-red-500/50': form.errors.image }"
                            >
                        </div>
                        <p v-if="form.errors.image" class="mt-2 text-sm text-red-400">{{ form.errors.image }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-white/5">
                    <Link 
                        :href="`/cars/${car.id}`"
                        class="w-full sm:w-auto px-8 py-3 border border-white/20 text-white font-medium tracking-wider uppercase text-sm hover:bg-white hover:text-charcoal transition-all text-center"
                    >
                        Cancel
                    </Link>
                    
                    <button 
                        type="submit"
                        class="w-full sm:w-auto px-10 py-3 bg-copper text-charcoal font-medium tracking-[0.2em] uppercase text-sm hover:bg-copper-light transition-colors disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Updating...</span>
                        <span v-else>Update Vehicle</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
