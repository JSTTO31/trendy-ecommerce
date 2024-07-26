<template>
    <v-card class="rounded-lg">
        <v-img class="bg-grey-lighten-4" :src="product.thumbnail"></v-img>
        <v-card-text>
            <h3 style="font-family: 'Roboto', san-serif" >{{ product.title }}</h3>
            <h3 style="font-family: 'Roboto', san-serif" >&#x24;{{ product.price }}</h3>
            <h3 style="font-family: 'Roboto', san-serif"  class="mt-2 text-success">Discount - &#x24;{{ (product.discountPercentage / product.price).toFixed(2) }}</h3>
        </v-card-text>
    </v-card>
</template>

<script setup lang="ts">
import { Product } from '@/types';

const props = defineProps<{product: Product}>()
</script>

<style scoped>

</style>
