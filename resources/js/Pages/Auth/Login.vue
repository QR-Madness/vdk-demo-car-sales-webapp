<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const form = useForm({
    email: import.meta.env.DEV ? 'test@example.com' : '',
    password: import.meta.env.DEV ? 'password' : '',
    remember: false,
});

const pageLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        pageLoaded.value = true;
    }, 100);
});

function submit() {
    form.post('/login');
}
</script>

<template>
    <div class="min-h-screen bg-charcoal flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-copper/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-copper/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-md w-full">
            <!-- Logo -->
            <div 
                class="text-center mb-10 transition-all duration-1000 ease-out"
                :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <Link href="/" class="inline-flex flex-col items-center group">
                    <div class="w-16 h-16 border-2 border-copper rounded-sm flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
                        <span class="text-copper font-bold text-2xl">V</span>
                    </div>
                    <div>
                        <span class="text-2xl font-light tracking-[0.2em] text-white uppercase">Velvet</span>
                        <span class="text-sm block text-copper tracking-[0.3em] uppercase">Motors</span>
                    </div>
                </Link>
            </div>

            <!-- Login Card -->
            <div 
                class="bg-charcoal-lighter p-8 sm:p-10 rounded-sm border border-white/5 transition-all duration-1000 delay-200 ease-out"
                :class="pageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-light text-white tracking-tight">Welcome Back</h2>
                    <p class="text-white/50 text-sm mt-2">Sign in to access the admin portal</p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <label class="block text-white/60 text-xs tracking-[0.2em] uppercase mb-2">
                            Email Address
                        </label>
                        <input 
                            v-model="form.email" 
                            type="email" 
                            class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                            :class="{ 'border-red-500/50': form.errors.email }"
                            placeholder="you@example.com"
                        >
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-400">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label class="block text-white/60 text-xs tracking-[0.2em] uppercase mb-2">
                            Password
                        </label>
                        <input 
                            v-model="form.password" 
                            type="password" 
                            class="w-full bg-charcoal border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-copper/50 transition-colors"
                            :class="{ 'border-red-500/50': form.errors.password }"
                            placeholder="••••••••"
                        >
                        <p v-if="form.errors.password" class="mt-2 text-sm text-red-400">{{ form.errors.password }}</p>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            v-model="form.remember" 
                            type="checkbox" 
                            id="remember"
                            class="w-4 h-4 bg-charcoal border border-white/20 rounded-sm text-copper focus:ring-copper focus:ring-offset-0"
                        >
                        <label for="remember" class="ml-3 text-sm text-white/60">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-4 bg-copper text-charcoal font-medium tracking-[0.2em] uppercase text-sm hover:bg-copper-light transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing" class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-charcoal" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Signing in...
                        </span>
                        <span v-else>Sign In</span>
                    </button>
                </form>

                <!-- Back Link -->
                <div class="mt-8 text-center">
                    <Link 
                        href="/" 
                        class="text-white/40 hover:text-copper text-sm tracking-wider transition-colors inline-flex items-center space-x-1"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Back to home</span>
                    </Link>
                </div>
            </div>

            <!-- Footer Text -->
            <p 
                class="mt-8 text-center text-white/30 text-xs tracking-wider transition-all duration-1000 delay-400"
                :class="pageLoaded ? 'opacity-100' : 'opacity-0'"
            >
                Authorized personnel only
            </p>
        </div>
    </div>
</template>
