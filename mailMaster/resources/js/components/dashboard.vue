<template>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-tr from-green-600 to-purple-600">
        <div class="bg-white/20 backdrop-blur-lg p-8 rounded-2xl shadow-lg w-96">
            <h1 class="text-2xl font-bold text-white text-center mb-6">Admin Dashboard</h1>

            <!-- Newsletter Form -->
            <div class="newsletter-form">
                <h2 class="text-xl font-semibold text-white mb-4">Send Newsletter</h2>
                <form @submit.prevent="sendNewsletter">
                    <div class="mb-4">
                        <label for="subject" class="text-white">Subject:</label>
                        <input v-model="newsletter.subject" type="text" id="subject" placeholder="Enter subject" class="w-full p-3 rounded-md bg-white/10 text-white focus:outline-none" required />
                    </div>

                    <div class="mb-4">
                        <label for="body" class="text-white">Body:</label>
                        <textarea v-model="newsletter.body" id="body" placeholder="Enter message body" class="w-full p-3 rounded-md bg-white/10 text-white focus:outline-none" required></textarea>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-white text-green-600 font-semibold py-3 rounded-md shadow-md hover:bg-green-600 hover:text-white transition duration-200">Send Newsletter</button>
                    </div>
                </form>
            </div>

            <!-- Status Message -->
            <div v-if="statusMessage" class="status-message text-center mt-4 text-white">
                {{ statusMessage }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const newsletter = ref({
    subject: '',
    body: ''
});
const statusMessage = ref('');

// Function to handle sending the newsletter
const sendNewsletter = async () => {
    try {
        const token = localStorage.getItem('token');

        const response = await fetch('/api/newsletter/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            },
            body: JSON.stringify(newsletter.value)
        });

        const data = await response.json();

        if (response.ok) {
            statusMessage.value = 'Newsletter sent successfully!';
            newsletter.value.subject = '';
            newsletter.value.body = '';
        } else {
            statusMessage.value = data.message || 'Something went wrong.';
        }

    } catch (error) {
        statusMessage.value = 'Failed to send newsletter.';
        console.error(error);
    }
};

</script>
