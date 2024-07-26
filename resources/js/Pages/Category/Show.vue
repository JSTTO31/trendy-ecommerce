<script setup lang="ts">
import ProductCard from '@/Components/ProductCard.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Category, Product } from '@/types';
import { router } from '@inertiajs/vue3';
defineProps<{
    category: Category,
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

    <Head title="Trendify - Discover and Shop the Hottest Trends Online" />
    <DefaultLayout>
        <v-container class="px-0 mt-5">
            <div class="d-flex align-center mb-5">
                <v-btn icon="mdi-arrow-left" variant="text" class="mr-2" @click="router.get(route('categories.index'))"></v-btn>
                <h1 style="font-family: 'Roboto', san-serif" class="text-grey-darken-4">Category <u>{{ category.name }}</u>
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

<style scoped></style>
