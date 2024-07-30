<template>
    <v-card class="pa-5 border" flat v-if="usePage().props.cart_items.total > 0">
        <h3 class="text-capitalize text-grey-darken-4">Order Summary</h3>
        <v-container class="pa-0 mt-5">
            <v-row>
                <v-col cols="5" class="text-capitalize text-grey-darken-3 text-subtitle-2">Shipping fee</v-col>
                <v-col cols="7" class="font-weight-bold">&#x24;2.00</v-col>
            </v-row>
            <v-row>
                <v-col cols="5" class="text-capitalize text-grey-darken-3 text-subtitle-2">Tax</v-col>
                <v-col cols="7" class="font-weight-bold">&#x24;0.00</v-col>
            </v-row>
            <v-row>
                <v-col cols="5" class="text-capitalize text-grey-darken-3 text-subtitle-2">Discount</v-col>
                <v-col cols="7" class="font-weight-bold">&#x24;{{discount}}</v-col>
            </v-row>
            <v-row>
                <v-col cols="5" class="text-capitalize text-grey-darken-3 text-subtitle-2">Sub total</v-col>
                <v-col cols="7" class="font-weight-bold">&#x24;{{subtotal}}</v-col>
            </v-row>
            <v-divider class="my-5"></v-divider>
            <h3 class="d-flex w-100 font-weight-bold text-grey-darken-4">
                <span>Estimated Total</span>
                <v-spacer></v-spacer>
                <span>&#x24;{{ price }}</span>
            </h3>
            <v-divider class="my-5"></v-divider>
            <div>
                <label for="" class="text-subtitle-2">Apply Promo Code</label>
                <v-text-field label="code" class="mt-2" density="compact" hide-details variant="solo-filled" flat single-line>
                    <template #append>
                        <v-btn color="blue">Apply</v-btn>
                    </template>
                </v-text-field>
            </div>

            <v-btn size="large" class="mt-10" block color="black" @click="router.replace(route('checkout.index'))">Checkout</v-btn>
        </v-container>
    </v-card>
</template>

<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
const discount = computed(() => usePage().props.cart_items.data.reduce((carrier, next) => {
    const discount = (next.product.discountPercentage / next.product.price);
    carrier += discount
    return carrier
}, 0).toFixed(2))

const subtotal = computed(() => usePage().props.cart_items.data.reduce((carrier, next) => carrier + parseInt(next.product.price.toString()), 0))

const price = computed(() => subtotal.value - parseInt(discount.value))

</script>

<style scoped>

</style>
