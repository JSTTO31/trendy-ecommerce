<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>

<template>
    <v-card class="rounded pa-5 border" flat>
        <v-card-title>Update Password</v-card-title>

        <v-card-subtitle>
            Ensure your account is using a long, random password to stay secure.
        </v-card-subtitle>

        <v-card-text class="w-66">
            <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="current_password" value="Current Password" />

                    <v-text-field id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                        variant="outlined" single-line :error-messages="form.errors.current_password" type="password"
                        autocomplete="current-password" />

                </div>

                <div>
                    <InputLabel for="password" value="New Password" />

                    <v-text-field id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="mt-2" autocomplete="new-password" variant="outlined" single-line
                        :error-messages="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <v-text-field single-line variant="outlined" id="password_confirmation" v-model="form.password_confirmation" type="password"
                        class="mt-2" autocomplete="new-password" />

                </div>

                <div class="flex items-center gap-4">
                    <v-btn color="black" type="submit" :loading="form.processing" :disabled="form.processing">Save</v-btn>

                    <v-snackbar :model-value="form.recentlySuccessful" class="mt-5" density="compact">
                        New password saved.
                        <template #actions="{isActive}">
                            <v-btn @click="isActive.value = false" class="text-capitalize">Close</v-btn>
                        </template>
                    </v-snackbar>
                </div>
            </form>
        </v-card-text>
    </v-card>
</template>
