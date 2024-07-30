<script setup lang="ts">
import ProductCard from '@/Components/ProductCard.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Product } from '@/types';
import { Head } from '@inertiajs/vue3';

defineProps<{
    products: {
        data: Product[],
        options: {
            "path": string,
            "per_page": number,
            "next_cursor": string | null,
            "next_page_url": string | null,
            "prev_cursor"?: string | null,
            "prev_page_url"?: string | null
        }
    }
}>()

</script>

<template>
    <Head title="Explore Our Best Sellers"></Head>
    <DefaultLayout>
        <v-container class="px-0">
            <div class="d-flex align-center">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Explore Our Best Sellers
                </h1>
            </div>
            <v-row>
                <v-col cols="3" v-for="product in products.data" :key="product.id">
                    <ProductCard :product="product"></ProductCard>
                </v-col>
            </v-row>
        </v-container>
    </DefaultLayout>
</template>



<style scoped>

</style>
