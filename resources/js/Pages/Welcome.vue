<script setup lang="ts">
import ProductCard from '@/Components/ProductCard.vue';
import ProductCardLandscape from '@/Components/ProductCardLandscape.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Category, Product } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    hero_images: string[],
    products: Product[],
    gadgets: Product[],
    essentials: Product[],
    categories: Category[],
}>();

</script>

<template>

    <Head title="Trendify - Discover and Shop the Hottest Trends Online" />
    <DefaultLayout>
        <v-carousel class="rounded-lg mt-5" height="400" show-arrows="hover" cycle hide-delimiter-background>
            <v-carousel-item v-for="(image, i) in hero_images" :key="i">
                <img style="position: absolute;top: -50%" class="w-100" :src="image" />
            </v-carousel-item>
        </v-carousel>
        <v-container class="px-0 mt-5">
            <div class="d-flex align-center">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Explore Our Best Sellers
                </h1>
                <v-spacer></v-spacer>
                <v-btn class="text-capitalize" variant="text" size="large" @click="router.get(route('best-products'))">See All</v-btn>
            </div>
            <v-row>
                <v-col cols="3" v-for="product in products" :key="product.id">
                    <ProductCard :product="product"></ProductCard>
                </v-col>
            </v-row>
            <div class="d-flex align-center mt-15 mb-5">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Browse Popular Categories
                </h1>
                <v-spacer></v-spacer>
                <v-btn class="text-capitalize" variant="text" size="large" @click="router.get(route('categories.index'))">See All</v-btn>
            </div>
            <v-row>
                <v-col cols="2" v-for="category in categories" :key="category.id">
                    <v-card  flat
                        @click="router.get(route('categories.show', {category: category.id}))"
                        class="rounded-lg bg-transparent pa-5  d-flex align-center justify-center flex-column">
                        <v-avatar size="120" style="overflow: visible;" :color="category.color">
                            <img class="w-100" :src="category.image" />
                        </v-avatar>
                        <h4 style="font-family: 'Roboto', san-serif" class="text-center text-capitalize mt-2">{{
                            category.name }}</h4>
                    </v-card>
                </v-col>
            </v-row>
            <div class="d-flex align-center mt-15 mb-5">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Latest in Electronics
                </h1>
                <v-spacer></v-spacer>
                <v-btn class="text-capitalize" variant="text" size="large" @click="router.get(route('electronic-products'))">See All</v-btn>
            </div>
            <v-row>
                <v-col cols="6" v-for="product in gadgets" :key="product.id">
                    <ProductCardLandscape :product="product"></ProductCardLandscape>
                </v-col>
            </v-row>

            <div class="d-flex align-center mt-15 mb-5">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Essential Items

                </h1>
                <v-spacer></v-spacer>
                <v-btn class="text-capitalize" variant="text" size="large">See All</v-btn>
            </div>
            <v-row>
                <v-col cols="2" v-for="product in essentials" :key="product.id">
                    <ProductCard :product="product"></ProductCard>
                </v-col>
            </v-row>
        </v-container>
    </DefaultLayout>
</template>

<style scoped>
body {
    background-color: red;
}
</style>
