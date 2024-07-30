<script setup lang="ts">
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, router } from '@inertiajs/vue3';
import HeadlessLayout from '@/Layouts/HeadlessLayout.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head title="Profile" />

    <HeadlessLayout>
        <v-app-bar style="padding-inline: 300px;">
            <v-app-bar-nav-icon @click="router.get('/')" icon="mdi-arrow-left">
            </v-app-bar-nav-icon>
            <v-app-bar-title>Profile</v-app-bar-title>
            <v-spacer></v-spacer>
            <v-btn variant="text" class="text-capitalize" prepend-icon="mdi-logout" @click="router.post(route('logout'))">Logout</v-btn>
        </v-app-bar>
        <div class="py-10">
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
            />
            <UpdatePasswordForm class="mt-5" />
            <DeleteUserForm class="mt-5" />
        </div>
    </HeadlessLayout>
</template>
