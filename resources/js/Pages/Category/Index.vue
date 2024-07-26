<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Category } from '@/types';
import { Head, router } from '@inertiajs/vue3';
defineProps<{
    categories: Category[]
}>()
</script>


<template>
    <Head title="Trendify - Discover and Shop the Hottest Trends Online" />
    <DefaultLayout>
        <v-container class="px-0 mt-5">
            <div class="d-flex align-center mb-5">
                <h1 style="font-family: 'Roboto', san-serif" class="mb-2 text-grey-darken-4">Shop Categories
                </h1>
            </div>
            <v-row>
                <v-col cols="3" v-for="category in categories" :key="category.id">
                    <v-card flat @click="router.get(route('categories.show', {category: category.id}))" class="rounded-lg bg-transparent pa-5  d-flex align-center justify-center flex-column">
                        <v-avatar size="250" style="overflow: visible;" class="pa-5" :color="category.color">
                            <img class="w-100" :src="category.image" />
                        </v-avatar>
                        <h4 style="font-family: 'Roboto', san-serif" class="text-center text-capitalize mt-2">{{
                            category.name }}</h4>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </DefaultLayout>
</template>

<style scoped></style>
