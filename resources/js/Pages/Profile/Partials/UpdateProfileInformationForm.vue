<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <v-card flat class="pa-5 border">
        <v-card-title>
            Profile Information
        </v-card-title>
        <v-card-subtitle>
            Update your account's profile information and email address.
        </v-card-subtitle>
        <v-card-text class="w-66">
            <v-form @submit.prevent="form.patch(route('profile.update'))">
                <div>
                    <InputLabel for="name" value="Name" />
                    <v-text-field id="name" type="text" class="mt-2" v-model="form.name" required autofocus
                        autocomplete="name"  variant="outlined" single-line :error-messages="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />

                    <v-text-field id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" variant="outlined" single-line :error-messages="form.errors.email" />
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <Link :href="route('verification.send')" method="post" as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <v-btn type="submit" color="black" :loading="form.processing" :disabled="form.processing">Save</v-btn>

                    <v-snackbar :model-value="form.recentlySuccessful" class="mt-5" density="compact">
                        Profile information saved.
                        <template #actions="{isActive}">
                            <v-btn @click="isActive.value = false" class="text-capitalize">Close</v-btn>
                        </template>
                    </v-snackbar>
                </div>
            </v-form>
        </v-card-text>
    </v-card>
</template>
