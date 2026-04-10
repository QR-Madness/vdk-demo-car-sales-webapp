<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post('/register');
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow">
            <div>
                <h2 class="text-3xl font-bold text-center text-gray-900">Create Account</h2>
            </div>

            <form @submit.prevent="submit" class="mt-8 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input 
                        v-model="form.name" 
                        type="text" 
                        class="mt-1 w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.name }"
                    >
                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        v-model="form.email" 
                        type="email" 
                        class="mt-1 w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.email }"
                    >
                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        v-model="form.password" 
                        type="password" 
                        class="mt-1 w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        :class="{ 'border-red-500': form.errors.password }"
                    >
                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input 
                        v-model="form.password_confirmation" 
                        type="password" 
                        class="mt-1 w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">Creating account...</span>
                    <span v-else>Register</span>
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Already have an account? 
                <Link href="/login" class="text-blue-600 hover:text-blue-800">Login</Link>
            </p>
        </div>
    </div>
</template>
