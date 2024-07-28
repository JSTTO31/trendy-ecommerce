<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Product, User } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
type Review = {
    id: number,
    rating: number,
    comment: string,
    user: User,
    created_at: string
}

type Star = {
    count: number,
    rating: number,
}

const props = defineProps<{
    product: Product,
    reviews: {
        data: Review[],
        "next_page_url": string | null,
        "path": string,
        "per_page": number,
        "prev_page_url": string | null,
        "to": number,
        "total": number
    },
    star_counts: Star[],
    review_counts: number,
    query: any,
}>()

const page = ref(parseInt(props.query.page) || 1)
const sortBy = ref(props.query.sortBy || 'latest')

const currentImage = ref(0)
const price = computed(() => (props.product.price - (props.product.discountPercentage / props.product.price)).toFixed(2))
const numberOfStocks = Math.floor(Math.random() * 9999)

function filter(query: any){
    router.visit(route('products.show', {product: props.product.id}), {
        method: 'get',
        data: query,
        preserveScroll: true,
    })
}

const form = useForm({
    quantity: 1
})

function addToCart(){
    form.post(route('carts.store', {product: props.product.id}), {
        onFinish(){
            form.reset();
        }
    })
}

</script>
<template>
    <Head :title="product.title"></Head>
    <DefaultLayout>
        <v-card class="mt-5  " height="600">
            <v-container class="pa-0 d-flex h-100">
                <v-col class="h-100 d-flex flex-column" style="gap: 10px" cols="5">
                    <v-carousel v-model="currentImage" show-arrows="hover" height="450" hide-delimiters
                        class="rounded-lg">
                        <v-carousel-item color="grey-lighten-4" v-for="image in product.images" :key="image">
                            <img :src="image" class="h-100"
                                style="position: absolute;left: 50%;transform:translateX(-50%)" />
                        </v-carousel-item>
                        <template v-slot:prev="{ props }">
                            <v-btn icon="mdi-chevron-left" size="small" color="black" variant="elevated"
                                class="rounded-lg" @click="props.onClick"></v-btn>
                        </template>
                        <template v-slot:next="{ props }">
                            <v-btn icon="mdi-chevron-right" size="small" color="black" variant="elevated"
                                class="rounded-lg" @click="props.onClick"></v-btn>
                        </template>
                    </v-carousel>
                    <div class="h-25 d-flex justify-start w-100" flat style="gap: 15px;">
                        <v-card @click="currentImage = key" class="rounded-lg h-100 bg-grey-lighten-4" flat
                            style="width: 120px;" :style="{ border: key == currentImage ? '1px solid black' : '' }"
                            v-for="image, key in product.images" :key="image">
                            <v-img :src="image"></v-img>
                        </v-card>
                    </div>
                </v-col>
                <v-col class="h-100" cols="7">
                    <h1>{{ product.title }}</h1>
                    <div class="d-flex align-center mb-5">
                        <v-rating :model-value="product.rating" readonly class="ml-n2" density="comfortable"
                            active-color="yellow-darken-2" color="black"></v-rating>
                        <h3 class="font-weight-medium">({{ product.rating }})</h3>
                    </div>
                    <h1 style="font-family: 'Roboto', san-serif">
                        <span class="mr-3">&#x24;{{ price }}</span>
                        <del class="text-grey-darken-1">&#x24;{{ product.price }}</del>
                    </h1>
                    <v-chip class="rounded-lg mt-5" color="red" size="large" prepend-icon="mdi-truck-fast">{{
                        product.shippingInformation }}</v-chip>
                    <v-divider class="my-5"></v-divider>
                    <div style="gap: 15px">
                        <label for="">Number of stocks</label>
                        <div class="w-33">
                            <v-text-field hide-details density="comfortable" readonly class="text-right mt-2"
                                :model-value="form.quantity" variant="outlined" type="number">
                                <template #prepend>
                                    <v-btn @click.stop="form.quantity--" :disabled="form.quantity <= 1" icon="mdi-minus" class="rounded"
                                    variant="flat" color="grey-darken-3"></v-btn>
                                </template>
                                <template #append>
                                    <v-btn @click="form.quantity++" :disabled="form.quantity >= product.minimumOrderQuantity"
                                        icon="mdi-plus" class="rounded" variant="flat" color="grey-darken-3"></v-btn>
                                </template>
                            </v-text-field>
                        </div>
                    </div>
                    <v-divider class="my-5"></v-divider>
                    <div class="d-flex align-center" style="gap: 15px;">
                        <v-btn flat class="text-capitalize" prepend prepend-icon="mdi-cart" size="x-large"
                            @click="addToCart"
                            color="grey-lighten-2">Add to
                            Cart</v-btn>
                        <v-btn flat class="text-capitalize" prepend prepend-icon="mdi-briefcase-outline" size="x-large"
                            color="black">Buy now</v-btn>
                    </div>
                </v-col>
            </v-container>
        </v-card>
        <v-card class="mt-5 ">
            <v-card-title>Product Details</v-card-title>
            <v-card-text class="px-0" style="font-family: 'Roboto', sans-serif; font-size: 15px">
                <v-container>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">Category</v-col>
                        <v-col cols="8">{{ product.category }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">Stocks</v-col>
                        <v-col cols="8">{{ numberOfStocks }}</v-col>
                    </v-row>
                    <v-row v-if="product.brand">
                        <v-col cols="2" class="text-grey-darken-2">brand</v-col>
                        <v-col cols="8">{{ product.brand }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">Warranty Information</v-col>
                        <v-col cols="8">{{ product.warrantyInformation }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">Shipping</v-col>
                        <v-col cols="8">{{ product.shippingInformation }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">Return Policy</v-col>
                        <v-col cols="8">{{ product.returnPolicy }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2" class="text-grey-darken-2">description</v-col>
                        <v-col cols="8">{{ product.description }}</v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
        <v-card class="mt-5 ">
            <v-card-title>Customer Reviews</v-card-title>
            <v-card-text class="px-0" style="font-family: 'Roboto', sans-serif; font-size: 15px">
                <v-container>
                    <v-row>
                        <v-col cols="4">
                            <div class="d-flex" style="gap: 15px;">
                                <h1 class="text-h2 ">{{ product.rating }}</h1>
                                <div class="d-flex flex-column">
                                    <v-rating class="ml-n2" :model-value="product.rating" readonly density="comfortable"
                                        active-color="yellow-darken-2" color="black"></v-rating>
                                    <h4 class="font-weight-medium">reviews {{ reviews.total }}</h4>
                                </div>
                            </div>
                        </v-col>
                        <v-col cols="5">
                            <div class="d-flex mb-4" v-for="star in star_counts" :key="star.rating">
                                 <span class="text-nowrap  font-weight-medium mr-5">{{ parseInt(star.rating.toString()) }}&nbsp;{{ parseInt(star.rating.toString()) != 1 ? 'Stars' : 'Star&nbsp;&nbsp;' }}</span>
                                <v-progress-linear  :model-value="star.count / review_counts * 100" height="15"></v-progress-linear>
                                <span class="text-nowrap  font-weight-medium ml-5">{{ (star.count / review_counts * 100).toFixed(2) }}%</span>
                            </div>
                        </v-col>
                    </v-row>
                    <v-divider class="my-5"></v-divider>
                    <div class="d-flex align-center mb-5" style="gap: 5px;">
                        <v-btn @click="filter({...query, rating: null})" class="text-capitalize" color="black"  :variant="!query.rating  ? 'flat' : 'outlined'">All</v-btn>
                        <v-btn @click="filter({...query, rating: parseInt(star.rating.toString())})" class="text-capitalize" color="black"  :variant="query.rating == parseInt(star.rating.toString()) ? 'flat' : 'outlined'" v-for="star in star_counts" :key="star.rating">{{ parseInt(star.rating.toString()) }}&nbsp;{{ parseInt(star.rating.toString()) != 1 ? 'Stars' : 'Star' }}</v-btn>
                        <v-divider></v-divider>
                        <v-select @update:model-value="$value => filter({...query, sortBy: $value})" label="select" v-model="sortBy" class="w-25" hide-details variant="outlined" single-line density="compact" :items="['latest', 'oldest']"></v-select>
                    </div>
                    <v-card class="d-flex  border-b pb-5 align-start mb-5" flat v-for="review in reviews.data" :key="review.id">
                        <v-avatar size="65" color="grey-lighten-4">
                            <v-icon size="30" color="grey-darken-3">mdi-account-outline</v-icon>
                        </v-avatar>
                        <div class="ml-5 mt-2 d-flex flex-column">
                            <h4>{{review.user.name}}</h4>
                            <v-rating class="ml-n2" :model-value="review.rating" readonly density="comfortable"
                            active-color="yellow-darken-2" size="small" color="black"></v-rating>
                            <v-chip variant="text" class="pl-0" prepend-icon="mdi-calendar" style="overflow: visible">{{ new Date(review.created_at).toDateString() }}</v-chip>
                            <p class="mt-5">{{ review.comment }}</p>
                        </div>
                    </v-card>

                    <v-pagination color="grey-darken-4" @update:model-value="$value => filter({...query, page: $value})" :length="Math.ceil(reviews.total / reviews.per_page)" v-model="page"></v-pagination>
                </v-container>
            </v-card-text>
        </v-card>
    </DefaultLayout>
</template>



<style scoped>

</style>
