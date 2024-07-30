<template>
    <Head title="My Purchase"></Head>
    <DefaultLayout>
        <v-card class="mt-8 h-100">
            <v-card-title>Purchase</v-card-title>
            <v-card-text class="h-100">
                <v-data-table-server
                    v-model="selected"
                    v-model:items-per-page="itemsPerPage"
                    :items="orders.data"
                    :headers="headers"
                    :items-length="orders.total"
                    :loading="loading"
                    :search="search"
                    item-value="name"
                    @update:options="loadItems"
                    show-select
                >
                    <template #item.total="{value}">
                        <span class="font-weight-bold text-subtitle-1">&#x24;{{value}}</span>
                    </template>
                    <template #item.id="{value}">
                        <span class="">{{value.toString().padStart(6, '0')}}</span>
                    </template>
                    <template #item.created_at="{value}">
                        <span>{{new Date(value).toDateString()}}</span>
                    </template>
                    <template #item.status="{value}">
                        <v-chip v-if="value == 'complete'" color="success" class="rounded text-capitalize">{{ value }}</v-chip>
                        <v-chip v-else-if="value == 'cancelled'" color="error" class="rounded text-capitalize">{{ value }}</v-chip>
                        <v-chip v-else class="rounded text-capitalize">{{ value }}</v-chip>
                    </template>
                    <template #item.actions="{item}">
                        <v-btn variant="text" class="text-capitalize" @click="router.get(route('orders.show', {order: item.id}))">View Order</v-btn>
                    </template>
                </v-data-table-server>
            </v-card-text>
        </v-card>
    </DefaultLayout>
</template>

<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Order } from '@/types';
import { computed, ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
const selected = ref([])
const itemsPerPage = ref(10)
const loading = ref(false)
const search = ref("")

async function loadItems(query: any){
    // router.get(route('orders.index', query))
}


const props = defineProps<{
    orders: {
        data: Order[],
        "next_page_url": string | null,
        "path": string,
        "per_page": number,
        "prev_page_url": string | null,
        "to": number,
        "total": number
    }
}>()

const headers : any = [
    {
        title: 'Order total price',
        align: 'start',
        sortable: false,
        key: 'total',
    },
    { title: 'Order ID', key: 'id', align: 'end' },
    { title: 'Date', key: 'created_at', align: 'end',  },
    { title: 'Status', key: 'status', align: 'end' },
    { title: 'Actions', key: 'actions', sortable: false, align: 'center' },
]


</script>

<style scoped>

</style>
