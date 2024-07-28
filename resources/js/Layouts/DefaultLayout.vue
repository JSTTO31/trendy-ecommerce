<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
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

const isAuthenticated = computed(() => usePage().props.isAuthenticated)
const cart_items = computed(() => usePage().props.cart_items_count)
const success = computed(() => usePage().props.flash.success);
const information = computed(() => usePage().props.flash.information);
const showSnackbar = ref(false)

const search_text = ref(route().queryParams.seach || '');

function search(){
    router.get(route('products.index') + '?search=' + search_text.value);
}


router.on('success', (event) => {

    if(event.detail.page.props.flash.information){
        showSnackbar.value = true
    }

})


</script>

<template>
    <v-app>
        <v-app-bar flat class="border-b" color="grey-darken-4" style="padding-inline: 300px;">
            <h2 @click="router.get('/')" style="font-family: 'Playwrite AR', cursive;font-weight: 900;cursor:pointer">Trendy</h2>
            <v-text-field class="ml-10" density="compact" label="Search..." hide-details single-line v-model="search_text" @keyup.enter="search"
                variant="solo"></v-text-field>
            <v-spacer></v-spacer>
            <div v-if="isAuthenticated" class="d-flex align-center">
                <v-badge :model-value="cart_items > 0" :content="cart_items" color="red">
                    <v-btn @click="router.get(route('carts.index'))" class="ml-5" icon="mdi-cart"></v-btn>
                </v-badge>
                <v-menu class="" location="bottom right">
                    <template #activator="{props}">
                        <v-btn v-bind="props" class="ml-5" icon="mdi-account" ></v-btn>
                    </template>
                    <v-list>
                        <v-list-item class="pr-15" @click="router.get(route('profile.edit'))" prepend-icon="mdi-account-outline">Profile</v-list-item>
                        <v-list-item class="pr-15" @click="router.post(route('logout'))" prepend-icon="mdi-logout">Logout</v-list-item>
                    </v-list>
                </v-menu>

            </div>
            <div class="d-flex" style="gap: 5px" v-else>
                <v-btn @click="router.get(route('login'))" class="text-capitalize">Login</v-btn>
                <v-divider vertical></v-divider>
                <v-btn @click="router.get(route('register'))" class="text-capitalize">Register</v-btn>
            </div>
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
        <v-snackbar v-model="showSnackbar">
            {{ information }}
            <template v-slot:actions>
                <v-btn
                color="pink"
                variant="text"
                @click="showSnackbar = false"
                >
                Close
                </v-btn>
            </template>
        </v-snackbar>
        <Transition name="slide-fade">
            <v-alert prominent :key="(Math.random()*10).toString()" class="alert pa-5 rounded-lg" closable width="480" icon="mdi-party-popper" color="success" v-if="!!success">
                <h3>{{ success.title }}</h3>
                <p>{{ success.sentence }}</p>
            </v-alert>
        </Transition>
    </v-app>
</template>

<style scoped>
body{
    background-color: red;
}

.alert{
    position: fixed;
    left: 25px;
    bottom: 25px;
}

.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.25s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(-20px);
  opacity: 0;
}
</style>
