<script setup lang="ts">
import { router } from '@inertiajs/vue3';

const category_groups = {
  "beauty and personalCare": [
    "beauty",
    "fragrances",
    "skin-care",
    "womens-jewellery"
  ],
  electronics: [
    "laptops",
    "mobile-accessories",
    "smartphones",
    "tablets"
  ],
  "fashion and accessories": [
    "mens-shirts",
    "mens-shoes",
    "mens-watches",
    "tops",
    "womens-bags",
    "womens-dresses",
    "womens-shoes",
    "womens-watches",
    "sunglasses"
  ],
  "home And Kitchen": [
    "furniture",
    "home-decoration",
    "kitchen-accessories"
  ],
  "vehicles And Accessories": [
    "motorcycle",
    "vehicle"
  ],
  "groceries And DailyEssentials": [
    "groceries"
  ],
  "sport And Outdoor": [
    "sports-accessories"
  ]
};


</script>

<template>
    <v-app>
        <v-app-bar flat class="border-b" color="grey-darken-4" style="padding-inline: 300px;">
            <h2 @click="router.get('/')" style="font-family: 'Playwrite AR', cursive;font-weight: 900;cursor:pointer">Trendy</h2>
            <v-spacer></v-spacer>
            <span>Need help?</span>
        </v-app-bar>
        <v-main style="padding-inline: 300px;" class="bg-grey-lighten-5 pb-15">
            <slot></slot>
        </v-main>
        <v-footer color="black" class="py-15 " style="padding-inline: 300px;" >
            <v-container class="d-flex px-0">
                <v-col cols="3">
                    <h1 style="font-family: 'Playwrite AR', cursive;font-weight: 900;">Trendy</h1>
                    <h3 class="mt-5">Contact us</h3>
                    <div class="d-flex flex-column">
                        <v-chip variant="text" style="overflow: visible" class="px-1" prepend-icon="mdi-facebook">trendy@facebook.com</v-chip>
                        <v-chip variant="text" style="overflow: visible" class="px-1" prepend-icon="mdi-phone">+63 9903 9099 3932</v-chip>
                        <v-chip variant="text" style="overflow: visible" class="px-1" prepend-icon="mdi-map-marker-up">1234 Elm Street, Apt. 56
                        Springfield, IL 62704
                        USA</v-chip>
                    </div>
                </v-col>
                <v-col cols="9" style="gap: 55px" class="d-flex flex-wrap">
                    <div v-for="group, key in category_groups" :key="key">
                        <h3 class="text-capitalize">{{ key }}</h3>
                        <div class="d-flex flex-column">
                            <ul class="pl-5">
                                <li v-for="name in group" :key="name">{{name}}</li>
                            </ul>
                        </div>
                    </div>
                </v-col>
            </v-container>
        </v-footer>
    </v-app>
</template>

<style scoped>
body{
    background-color: red;
}
</style>
