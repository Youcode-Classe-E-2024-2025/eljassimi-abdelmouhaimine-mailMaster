<!-- resources/js/Pages/Register.vue -->
<template>
    <div class="register-container flex justify-center items-center min-h-screen bg-gradient-to-tr from-green-600 to-purple-600">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Register</h2>
            <form @submit.prevent="submitRegister">
                <input v-model="name" type="text" placeholder="Name" class="w-full p-3 rounded mb-4 focus:outline-none border border-gray-300" />
                <input v-model="email" type="email" placeholder="Email" class="w-full p-3 rounded mb-4 focus:outline-none border border-gray-300" />
                <input v-model="password" type="password" placeholder="Password" class="w-full p-3 rounded mb-4 focus:outline-none border border-gray-300" />
                <input v-model="password_confirmation" type="password" placeholder="Confirm Password" class="w-full p-3 rounded mb-4 focus:outline-none border border-gray-300" />
                <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded shadow-md hover:shadow-lg transition">Register</button>
            </form>
            <p class="text-center mt-4 text-gray-600">
                Already have an account?
                <a href="/" class="text-green-600 font-semibold hover:underline">Login here</a>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const router = useRouter();

const submitRegister = async () => {
    try {
        const response = await axios.post('/api/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });
        console.log('Registration response:', response.data);
        router.push('/');
    } catch (error) {
        console.error('Registration error:', error);
    }
};
</script>

<style scoped>
.register-container {
    text-align: center;
    margin-top: 50px;
}
input {
    margin: 10px;
    padding: 10px;
    width: 200px;
}
button {
    padding: 10px 20px;
    background-color: #038DFE;
    color: white;
}
</style>
