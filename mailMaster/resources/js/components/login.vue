<template>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-tr from-green-600 to-purple-600">
        <div class="bg-white/20 backdrop-blur-lg p-8 rounded-2xl shadow-lg w-96">
            <h2 class="text-2xl font-bold text-white text-center mb-6">Welcome Back</h2>
            <form @submit.prevent="login">
                <input v-model="email" type="email" placeholder="Email" class="w-full p-3 rounded mb-4 focus:outline-none" />
                <input v-model="password" type="password" placeholder="Password" class="w-full p-3 rounded mb-4 focus:outline-none" />
                <button type="submit" class="w-full bg-white text-green-600 font-semibold py-3 rounded shadow-md hover:shadow-lg transition">
                    Login
                </button>
            </form>
            <p class="text-center mt-4 text-gray-600">
                Dont have an account?
                <a href="/register" class="text-green-600 font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const router = useRouter();

const login = async () => {
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value
        });
        localStorage.setItem('token', response.data.token);
        router.push('/dashboard');
    } catch (error) {
        alert('Invalid credentials!');
    }
};
</script>
