<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const showPassword = ref(false)

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

defineProps<{
    image: string
}>()
</script>

<template>
    <AuthenticationLayout>

        <Head title="Register" />

        <v-container style="height: 750px;" class="pt-5 d-flex justify-center">
            <v-col cols="6">
                <v-card class="pa-5">
                    <h2 class="mb-5">Register</h2>
                    <v-form @submit.prevent="submit">
                        <label for="name">Name</label>
                        <v-text-field class="mt-2" id="name" single-line :error-messages="form.errors.name"
                            required v-model="form.name" variant="outlined" type="text"
                            label="Name"></v-text-field>
                        <label for="email">Email Address</label>
                        <v-text-field class="mt-2" id="email" single-line :error-messages="form.errors.email"
                            required v-model="form.email" variant="outlined" type="email"
                            label="Email address"></v-text-field>
                        <label for="password_confirmation">Confirmation Password</label>
                        <v-text-field class="mt-2" id="password_confirmation" single-line :error-messages="form.errors.password_confirmation"
                            required v-model="form.password_confirmation" variant="outlined"
                            :type="showPassword ? 'text' : 'password'"
                            label="Confirmation Password" ></v-text-field>
                        <label for="password">Password</label>
                        <v-text-field class="mt-2" id="password" single-line :error-messages="form.errors.password"
                            required v-model="form.password" variant="outlined"
                            :type="showPassword ? 'text' : 'password'"
                            :append-inner-icon="showPassword ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
                            label="Password" @click:append-inner="showPassword = !showPassword"></v-text-field>
                        <v-btn size="large" block color="black" class="text-capitalize my-2"
                        :loading="form.processing" type="submit">Register</v-btn>
                        <div class="d-flex align-center">
                            <v-divider></v-divider>
                            <span class="font-weight-medium my-5 mx-5 text-grey-darken-1">OR</span>
                            <v-divider></v-divider>
                        </div>
                        <p class="text-capitalize text-center text-subtitle-2 text-grey-darken-1">
                            Already have an account?
                            <Link :href="route('login')" class="text-black font-weight-bold">
                            Sign in
                            </Link>
                        </p>
                    </v-form>
                </v-card>
                </v-col>
        </v-container>
    </AuthenticationLayout>
</template>
