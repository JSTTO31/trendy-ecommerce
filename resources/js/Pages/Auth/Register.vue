<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

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

        <v-container style="height: 700px;" class="pt-10">
            <v-row>
                <v-col cols="7" class="d-flex flex-column pa-15">
                    <h1>Welcome back, Trend Enthusiast! Discover your new favorites.</h1>
                    <v-avatar class="rounded-0 ml-auto" size="300">
                        <v-img :src="image"></v-img>
                    </v-avatar>
                </v-col>
                <v-col cols="5" class="pa-15">
                    <v-card class="pa-5">
                        <h2 class="mb-5">Login</h2>
                        <v-form @submit.prevent="submit">
                            <label for="email">Email Address</label>
                            <v-text-field class="mt-2" id="email" single-line :error-messages="form.errors.email"
                                required v-model="form.email" variant="outlined" type="email"
                                label="Email address"></v-text-field>
                            <label for="password">Password</label>
                            <v-text-field class="mt-2" id="password" single-line :error-messages="form.errors.password"
                                required v-model="form.password" variant="outlined"
                                :type="showPassword ? 'text' : 'password'"
                                :append-inner-icon="showPassword ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
                                label="Password" @click:append-inner="showPassword = !showPassword"></v-text-field>
                            <v-btn size="large" block color="black" class="text-capitalize my-2"
                                :loading="form.processing" type="submit">Login</v-btn>
                            <div class="d-flex align-center text-subtitle-2">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                </label>
                                <v-spacer></v-spacer>
                                <Link v-if="canResetPassword" :href="route('password.request')"
                                    class="text-grey-darken-4">
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
            </v-row>
        </v-container>
    </AuthenticationLayout>
    <GuestLayout>

        <Head title="Register" />


        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
