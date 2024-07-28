<template>
      <v-card flat class="border-b rounded-0">
        <v-container class="pa-0 d-flex">
            <v-col cols="2">
                <v-img class="border" :src="order_item.product.thumbnail"></v-img>
            </v-col>
            <v-col cols="3">
                <h4>{{order_item.product.title}}</h4>
                <h4 class="mt-2" style="font-family: 'Roboto', san-serif">
                    <span class="mr-3">&#x24;{{ price }}</span>
                    <del class="text-grey-darken-1">&#x24;{{ order_item.product.price }}</del>
                </h4>
                <v-btn prepend-icon="mdi-trash-can-outline" size="small" class="mt-2 text-capitalize" color="error" variant="tonal" @click="showRemove = true">Remove</v-btn>
            </v-col>
            <v-col class="d-flex justify-center" cols="3">
                <v-btn @click="form.quantity--" :disabled="form.quantity < 2" variant="tonal" size="small" class="rounded" icon="mdi-minus" ></v-btn>
                <span class="mx-5 my-2">{{ form.quantity }}</span>
                <v-btn @click="form.quantity++" :disabled="order_item.product.minimumOrderQuantity <= form.quantity" variant="tonal" size="small" class="rounded" icon="mdi-plus" ></v-btn>
            </v-col>
            <v-col class="d-flex justify-center" cols="2">
                <h4 class="mt-2" style="font-family: 'Roboto', san-serif">
                    <span class="mr-3">&#x24;{{ price }}</span>
                </h4>
            </v-col>
            <v-col class="d-flex justify-center" cols="2">
                <h4 class="mt-2" style="font-family: 'Roboto', san-serif">
                    <span class="mr-3">&#x24;{{ total }}</span>
                </h4>
            </v-col>
        </v-container>
        <v-dialog width="500" v-model="showRemove" persistent>
            <v-card :disabled="loading">
                <v-card-text>
                    <h3>Are you sure you want to remove this item <b class="text-error">{{ order_item.product.title }}</b></h3>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions class="px-5">
                    <v-btn class="text-capitalize" color="error" prepend-icon="mdi-trash-can" variant="tonal" @click="remove" :loading="loading">Remove item</v-btn>
                    <v-btn class="text-capitalize" color="black" variant="text" @click="showRemove = false">Cancel</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script setup lang="ts">
import { OrderItem } from '@/types';
import { computed, ref, watch } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
const props = defineProps<{order_item: OrderItem}>()
const price = computed(() => (props.order_item.product.price - (props.order_item.product.discountPercentage / props.order_item.product.price)).toFixed(2))
const total = computed(() => (props.order_item.quantity * (props.order_item.product.price - (props.order_item.product.discountPercentage / props.order_item.product.price))).toFixed(2))
const showRemove = ref(false)

const form = useForm({
    quantity: props.order_item.quantity
})

function update(){
    form.put(route('carts.update', {product: props.order_item.product_id, orderItem: props.order_item.id}))
}

let timer : null | number = null

watch(() => form.quantity, () => {
    if(timer){
        clearTimeout(timer)
    }

    timer = setTimeout(() => {
        update()
    }, 200);
})

const loading = ref(false)
function remove(){
    router.delete(route('carts.destroy', {product: props.order_item.product_id, orderItem: props.order_item.id}), {
        onProgress(){
            loading.value = true
        },
        onFinish(){
            loading.value = false
            showRemove.value = false
        }
    })
}
</script>

<style scoped>

</style>
