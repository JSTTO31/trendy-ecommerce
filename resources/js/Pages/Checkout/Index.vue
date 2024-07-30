<template>
    <Head title="checkout your orders"></Head>
    <HeadlessLayout>
        <v-app-bar style="padding-inline: 300px;">
            <h2 @click="router.get('/')">Trendy Checkout</h2>
            <v-spacer></v-spacer>
            <v-btn class="text-capitalize" prepend-icon="mdi-arrow-left" @click="router.get('/')">Go back shopping</v-btn>
        </v-app-bar>
        <v-container class="py-5 px-0 h-screen">
            <div id="checkout"></div>
        </v-container>
    </HeadlessLayout>
</template>
<script setup lang="ts">
import HeadlessLayout from '@/Layouts/HeadlessLayout.vue';
import { Head } from '@inertiajs/vue3';
import { loadStripe } from '@stripe/stripe-js';
import axios from 'axios';
import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

router.on('before', (event) => {
    if (!confirm('Are you sure you want to navigate away?')) {
        event.preventDefault()
    }
})

onMounted(async () => {
    const stripe = await loadStripe('pk_test_51PhajiRoaXrDQXp340gJyk5Sqrynu6l70m2ZaWmmLIRLlG5epLTdHJM9qFtA1XdCxwUWgTrUYIcdeXJ89ejG6Pm000dAXEcXHa');

    if (stripe) {
        const fetchClientSecret = async () => {
            const response = await axios.post(route('checkout.create'));
            console.log('troggered');

            const { clientSecret } = await response.data;
            return clientSecret;
        };

        // Initialize Checkout
        const checkout = await stripe.initEmbeddedCheckout({
            fetchClientSecret,
        });

        // Mount Checkout
        checkout.mount('#checkout');
    }
})
</script>

<style scoped></style>
