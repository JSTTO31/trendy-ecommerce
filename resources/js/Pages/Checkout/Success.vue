<template>
    <Head title="Checkout successful"></Head>
    <HeadlessLayout>
        <v-container class="h-screen d-flex align-center justify-center">
            <v-card class="d-flex flex-column py-15 justify-center align-center" style="padding-inline: 250px;">
                <v-avatar size="200" class="rounded-0">
                    <v-img :src="image"></v-img>
                </v-avatar>
                <h1 class="mt-5 text-center">Checkout Successful</h1>
                <p class="text-center">Thank you for your purchase! Your order has been successfully placed. You will receive a confirmation email shortly.</p>
                <div class="d-flex" style="gap: 15px">
                    <v-btn class="text-capitalize mt-15" size="large" variant="outlined" color="black" @click="">View Details</v-btn>
                    <v-btn class="text-capitalize mt-15" size="large" color="black" @click="router.get('/')">Go shopping again</v-btn>
                </div>
            </v-card>
        </v-container>
    </HeadlessLayout>
</template>

<script setup lang="ts">
import HeadlessLayout from '@/Layouts/HeadlessLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
defineProps<{
    image: string
}>()

</script>

<style scoped>

</style>
