<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
defineProps<{
    canResetPassword?: boolean;
    status?: string;
    image: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false)

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <AuthenticationLayout>

        <Head title="Log in" />

        <v-container style="height: 750px;" class="pt-5 d-flex justify-center">
                <v-col cols="6" class="px-0">
                    <v-card class="pa-5">
                        <h2 class="mb-5">Login</h2>
                        <v-form @submit.prevent="submit">
                            <label for="email">Email Address</label>
                            <v-text-field class="mt-2" id="email" single-line :error-messages="form.errors.email" required v-model="form.email" variant="outlined" type="email" label="Email address"></v-text-field>
                            <label for="password">Password</label>
                            <v-text-field class="mt-2" id="password" single-line :error-messages="form.errors.password" required v-model="form.password" variant="outlined" :type="showPassword ? 'text' : 'password'" :append-inner-icon="showPassword ? 'mdi-eye-outline' : 'mdi-eye-off-outline'" label="Password" @click:append-inner="showPassword = !showPassword"></v-text-field>
                            <v-btn size="large" block color="black" class="text-capitalize my-2" :loading="form.processing" type="submit">Login</v-btn>
                            <div class="d-flex align-center text-subtitle-2">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                </label>
                                <v-spacer></v-spacer>
                                <Link v-if="canResetPassword" :href="route('password.request')" class="text-grey-darken-4">
                                Forgot your password?
                                </Link>
                            </div>
                            <div class="d-flex align-center">
                                <v-divider></v-divider>
                                <span class="font-weight-medium my-5 mx-5 text-grey-darken-1">OR</span>
                                <v-divider></v-divider>
                            </div>
                            <p class="text-capitalize text-center text-subtitle-2 text-grey-darken-1">
                                Don't have an account?
                                <Link :href="route('register')" class="text-black font-weight-bold">
                                 Sign up
                                </Link>
                            </p>
                        </v-form>
                    </v-card>
                </v-col>
        </v-container>
    </AuthenticationLayout>
</template>
