<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <v-card class="pa-5 border" flat>
        <header>
            <v-card-title>Delete Account</v-card-title>

            <v-card-subtitle>
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </v-card-subtitle>
        </header>

        <v-card-text>
            <v-btn prepend-icon="mdi-trash-can" variant="tonal" color="error" @click="confirmUserDeletion">Delete
                Account</v-btn>
        </v-card-text>

        <v-dialog width="650" v-model="confirmingUserDeletion">
            <v-card>
                <v-card-text>
                    <h3>
                        Are you sure you want to delete your account?
                    </h3>
                    <p class="mt-2">Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.</p>
                    <div class="mt-6">
                        <InputLabel for="password" value="Password" class="sr-only" />

                        <v-text-field id="password" ref="passwordInput" v-model="form.password" type="password"
                            class="mt-2" placeholder="Password" @keyup.enter="deleteUser" variant="outlined" :error-messages="form.errors.password"
                            single-line />
                    </div>
                </v-card-text>



                <v-card-actions class="px-7">
                    <v-btn @click="closeModal"> Cancel </v-btn>

                    <v-btn color="error" variant="flat" :loading="form.processing" :disabled="form.processing"
                        @click="deleteUser">
                        Delete Account
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>
