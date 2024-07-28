<template>
     <v-card height="250" class="rounded-lg d-flex" @click="router.get(route('products.show', {product: product.id}))">
        <v-card class="h-100" width="250">
            <v-img class="bg-grey-lighten-4" :src="product.thumbnail"></v-img>
        </v-card>
        <v-card-text class="d-flex flex-column h-100">
            <v-card-title class="px-0 pt-0 font-weight-bold" style="font-family: 'Roboto', san-serif" >{{ product.title }}</v-card-title>
            <h3 style="font-family: 'Roboto', san-serif" >&#x24;{{ product.price }}</h3>
            <h3 style="font-family: 'Roboto', san-serif"  class="mt-2 text-success">Discount - &#x24;{{ product.price }}</h3>
            <v-spacer></v-spacer>
            <div class="w-66 mb-5">
                <v-text-field hide-details density="comfortable" readonly class="text-right mt-2"
                    :model-value="form.quantity" variant="outlined" type="number">
                    <template #prepend>
                        <v-btn @click.stop="form.quantity--" :disabled="form.quantity < 2" icon="mdi-minus" class="rounded"
                            variant="flat" color="grey-darken-3"></v-btn>
                    </template>
                    <template #append>
                        <v-btn @click.stop="form.quantity++" :disabled="form.quantity >= product.minimumOrderQuantity"
                            icon="mdi-plus" class="rounded" variant="flat" color="grey-darken-3"></v-btn>
                    </template>
                </v-text-field>
            </div>
            <div class="d-flex align-center" style="gap: 15px;">
                <v-btn @click.stop="addToCart" flat class="text-capitalize" prepend prepend-icon="mdi-cart" size="large" color="grey-lighten-2">Add to Cart</v-btn>
                <v-btn @click.stop="addToCart" flat class="text-capitalize" prepend prepend-icon="mdi-briefcase-outline" size="large" color="black">Buy now</v-btn>

            </div>
        </v-card-text>
    </v-card>
</template>

<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { Product } from '@/types';
const props = defineProps<{product: Product}>()

const form = useForm({
    quantity: 1
})

function addToCart(){
    form.post(route('carts.store', {product: props.product.id}), {
        preserveScroll: true,
        onFinish(){
            form.reset();
        }
    })
}
</script>

<style scoped>

</style>
