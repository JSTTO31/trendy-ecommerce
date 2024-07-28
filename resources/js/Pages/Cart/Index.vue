<script setup lang="ts">
import OrderItem from '@/Components/OrderItem.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import CheckoutForm from '@/Components/CheckoutForm.vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const cart_items = computed(() => usePage().props.cart_items)
const page = ref(parseInt(route().queryParams.page) || 1)

function filter(query: any){
    router.visit(route('carts.index'), {
        method: 'get',
        data: query,
        preserveScroll: true,
    })
}

</script>
<template>
    <Head title="Your add to cart"></Head>
    <DefaultLayout>
        <v-card style="height: 840px" class="mt-10 bg-transparent" flat>
            <v-container class="pa-0 h-100 d-flex">
                <v-col cols="8" class="d-flex flex-column bg-white border rounded">
                    <div class="d-flex px-3">
                        <h2 class="text-capitalize text-grey-darken-4">Shopping Cart</h2>
                        <v-spacer></v-spacer>
                        <h3 class="mr-5">{{ cart_items.total }} Items</h3>
                    </div>
                    <v-divider class="my-2"></v-divider>
                    <v-container class="d-flex pa-0">
                        <v-col class="font-weight-medium text-subtitle-2 text-grey-darken-2 pb-0 text-left" cols="5">Product</v-col>
                        <v-col class="font-weight-medium text-subtitle-2 text-grey-darken-2 pb-0 text-center" cols="3">QTY</v-col>
                        <v-col class="font-weight-medium text-subtitle-2 text-grey-darken-2 pb-0 text-center" cols="2">Price</v-col>
                        <v-col class="font-weight-medium text-subtitle-2 text-grey-darken-2 pb-0 text-center" cols="2">Total</v-col>
                    </v-container>
                    <OrderItem v-for="item in cart_items.data" :key="item.id" :order_item="item"></OrderItem>
                    <v-spacer></v-spacer>
                    <v-pagination  :length="Math.ceil(cart_items.total / cart_items.per_page)" v-model="page" @update:model-value="$value => filter({...route().queryParams, page: $value})"></v-pagination>
                </v-col>
                <v-col cols="4" class=" pa-0 pl-5">
                   <CheckoutForm></CheckoutForm>
                </v-col>
            </v-container>
        </v-card>
    </DefaultLayout>
</template>
<style scoped>

</style>
