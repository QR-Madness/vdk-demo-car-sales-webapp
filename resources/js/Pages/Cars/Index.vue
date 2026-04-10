<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';
import CarCard from '../../Components/CarCard.vue';

defineProps({
    cars: Array,
    filters: Object,
});

const page = usePage();
const user = computed(() => page.props.auth?.user);

const form = useForm({});

// Local state for filters
const showFilters = ref(false);
const searchQuery = ref('');
const selectedMake = ref('');
const selectedCondition = ref('');
const priceRange = ref('');
const sortBy = ref('newest');

// Animation state
const pageLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        pageLoaded.value = true;
    }, 100);
});

function deleteCar(id) {
    if (confirm('Are you sure you want to delete this car?')) {
        form.delete(`/cars/${id}`);
    }
}

// Get unique makes from cars for filter
const uniqueMakes = computed(() => {
    const cars = page.props.cars || [];
    const makes = [...new Set(cars.map(car => car.make))].sort();
    return makes;
});

// Filtered cars
const filteredCars = computed(() => {
    let result = [...(page.props.cars || [])];
    
    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        result = result.filter(car => 
            car.make.toLowerCase().includes(query) ||
            car.model.toLowerCase().includes(query) ||
            car.year.toString().includes(query)
        );
    }
    
    // Make filter
    if (selectedMake.value) {
        result = result.filter(car => car.make === selectedMake.value);
    }
    
    // Condition filter
    if (selectedCondition.value) {
        result = result.filter(car => car.condition === selectedCondition.value);
    }
    
    // Price filter
    if (priceRange.value) {
        const [min, max] = priceRange.value.split('-').map(v => v ? parseInt(v) : null);
        result = result.filter(car => {
            const price = parseFloat(car.price);
            if (min && max) return price >= min && price <= max;
            if (min && !max) return price >= min;
            return true;
        });
    }
    
    // Sort
    switch (sortBy.value) {
        case 'price-low':
            result.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
            break;
        case 'price-high':
            result.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));
            break;
        case 'year-new':
            result.sort((a, b) => b.year - a.year);
            break;
        case 'year-old':
            result.sort((a, b) => a.year - b.year);
            break;
        case 'newest':
        default:
            result.sort((a, b) => b.id - a.id);
    }
    
    return result;
});

function clearFilters() {
    searchQuery.value = '';
    selectedMake.value = '';
    selectedCondition.value = '';
    priceRange.value = '';
}

const hasActiveFilters = computed(() => {
    return searchQuery.value || selectedMake.value || selectedCondition.value || priceRange.value;
});
</script>

<template>
    <div class="min-h-screen bg-charcoal">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-16 bg-charcoal-light">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-copper/5 to-transparent"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div 
                    class="transition-all duration-1000 ease-out"
                    :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <span class="text-copper text-sm tracking-[0.4em] uppercase">The Collection</span>
                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-extralight text-white mt-4 tracking-tight">
                        Our Inventory
                    </h1>
                    <p class="text-white/60 text-lg max-w-2xl mt-6">
                        Browse our carefully curated selection of premium vehicles. 
                        Each car is meticulously inspected and prepared to our exacting standards.
                    </p>
                </div>
            </div>
        </section>

        <!-- Filters & Controls -->
        <section class="sticky top-[72px] z-40 bg-charcoal/95 backdrop-blur-md border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Search -->
                    <div class="relative flex-1 max-w-md">
                        <input 
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search by make, model, or year..."
                            class="w-full bg-charcoal-lighter border border-white/10 text-white px-4 py-3 pl-11 text-sm focus:outline-none focus:border-copper/50 transition-colors"
                        >
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Filter Toggle & Sort -->
                    <div class="flex items-center gap-4">
                        <button 
                            @click="showFilters = !showFilters"
                            class="flex items-center space-x-2 px-4 py-3 bg-charcoal-lighter border border-white/10 text-white/80 hover:text-white hover:border-copper/30 transition-all"
                            :class="{ 'border-copper/50 text-copper': showFilters }"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <span class="text-sm tracking-wider">Filters</span>
                            <span v-if="hasActiveFilters" class="w-2 h-2 bg-copper rounded-full"></span>
                        </button>

                        <select 
                            v-model="sortBy"
                            class="bg-charcoal-lighter border border-white/10 text-white px-4 py-3 text-sm focus:outline-none focus:border-copper/50 transition-colors"
                        >
                            <option value="newest">Newest First</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="year-new">Year: Newest First</option>
                            <option value="year-old">Year: Oldest First</option>
                        </select>

                        <Link 
                            v-if="user"
                            href="/cars/create" 
                            class="hidden sm:flex items-center space-x-2 px-6 py-3 bg-copper text-charcoal font-medium tracking-wider uppercase text-sm hover:bg-copper-light transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Car</span>
                        </Link>
                    </div>
                </div>

                <!-- Expanded Filters -->
                <transition 
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 -translate-y-4"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition-all duration-200 ease-in"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 -translate-y-4"
                >
                    <div v-if="showFilters" class="mt-4 pt-4 border-t border-white/5">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Make Filter -->
                            <div>
                                <label class="block text-white/50 text-xs tracking-wider uppercase mb-2">Make</label>
                                <select 
                                    v-model="selectedMake"
                                    class="w-full bg-charcoal-lighter border border-white/10 text-white px-4 py-2 text-sm focus:outline-none focus:border-copper/50 transition-colors"
                                >
                                    <option value="">All Makes</option>
                                    <option v-for="make in uniqueMakes" :key="make" :value="make">{{ make }}</option>
                                </select>
                            </div>

                            <!-- Condition Filter -->
                            <div>
                                <label class="block text-white/50 text-xs tracking-wider uppercase mb-2">Condition</label>
                                <select 
                                    v-model="selectedCondition"
                                    class="w-full bg-charcoal-lighter border border-white/10 text-white px-4 py-2 text-sm focus:outline-none focus:border-copper/50 transition-colors"
                                >
                                    <option value="">All Conditions</option>
                                    <option value="New">New</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Poor">Poor</option>
                                </select>
                            </div>

                            <!-- Price Filter -->
                            <div>
                                <label class="block text-white/50 text-xs tracking-wider uppercase mb-2">Price Range</label>
                                <select 
                                    v-model="priceRange"
                                    class="w-full bg-charcoal-lighter border border-white/10 text-white px-4 py-2 text-sm focus:outline-none focus:border-copper/50 transition-colors"
                                >
                                    <option value="">Any Price</option>
                                    <option value="0-25000">Under $25,000</option>
                                    <option value="25000-50000">$25,000 - $50,000</option>
                                    <option value="50000-100000">$50,000 - $100,000</option>
                                    <option value="100000-">$100,000+</option>
                                </select>
                            </div>
                        </div>

                        <!-- Clear Filters -->
                        <div v-if="hasActiveFilters" class="mt-4 flex justify-end">
                            <button 
                                @click="clearFilters"
                                class="text-copper hover:text-white text-sm tracking-wider transition-colors flex items-center space-x-1"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Clear all filters</span>
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </section>

        <!-- Results Count -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-white/50 text-sm">
                Showing <span class="text-white">{{ filteredCars.length }}</span> of <span class="text-white">{{ cars.length }}</span> vehicles
            </p>
        </div>

        <!-- Cars Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div 
                v-if="filteredCars.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div 
                    v-for="(car, index) in filteredCars" 
                    :key="car.id"
                    class="transition-all duration-700 ease-out"
                    :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    :style="{ transitionDelay: `${index * 100}ms` }"
                >
                    <CarCard :car="car" />
                </div>
            </div>

            <!-- Empty State -->
            <div 
                v-else 
                class="text-center py-20"
            >
                <div class="w-24 h-24 mx-auto mb-6 bg-charcoal-lighter rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-light text-white mb-2">No vehicles found</h3>
                <p class="text-white/50 mb-6">Try adjusting your filters or search criteria</p>
                <button 
                    @click="clearFilters"
                    class="px-6 py-3 bg-copper text-charcoal font-medium tracking-wider uppercase text-sm hover:bg-copper-light transition-colors"
                >
                    Clear Filters
                </button>
            </div>
        </section>
    </div>
</template>
