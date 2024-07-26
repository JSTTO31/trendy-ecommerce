<template>
     <v-card height="250" class="rounded-lg d-flex">
        <v-card class="h-100" width="250">
            <v-img class="bg-grey-lighten-4" :src="product.thumbnail"></v-img>
        </v-card>
        <v-card-text class="d-flex flex-column h-100">
            <h2 style="font-family: 'Roboto', san-serif" >{{ product.title }}</h2>
            <h3 style="font-family: 'Roboto', san-serif" >&#x24;{{ product.price }}</h3>
            <h3 style="font-family: 'Roboto', san-serif"  class="mt-2 text-success">Discount - &#x24;{{ product.price }}</h3>
            <v-spacer></v-spacer>
            <div class="d-flex align-center" style="gap: 15px;">
                <v-btn flat class="text-capitalize" prepend prepend-icon="mdi-cart" size="large" color="grey-lighten-2">Add to Cart</v-btn>
                <v-btn flat class="text-capitalize" prepend prepend-icon="mdi-briefcase-outline" size="large" color="black">Buy now</v-btn>

            </div>
        </v-card-text>
    </v-card>
</template>

<script setup lang="ts">
import { Product } from '@/types';

const props = defineProps<{product: Product}>()
</script>

<style scoped>

</style>
