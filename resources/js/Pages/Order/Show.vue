<template>
    <Head title="My Purchase"></Head>
    <DefaultLayout>
        <v-card class="mt-8 h-100">
            <v-card-text class="h-100">
                {{order}}
            </v-card-text>
        </v-card>
    </DefaultLayout>
</template>

<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Order } from '@/types';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps<{
    order: Order
}>()

</script>

<style scoped>

</style>
