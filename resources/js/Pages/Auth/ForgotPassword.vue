<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import {Inertia} from '@inertiajs/inertia';

const props = defineProps({
    errors: Object,
    session: Object
});

const form = useForm({
    email: '',
})

const submit = () => {
    Inertia.post(route('password.email'), {
        email: form.email
    })
}

</script>

<template>
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="session.status" class="mb-4 font-medium text-sm text-green-600">
            {{ session.status }}
        </div>

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" >
            <div>
                <Label for="email" value="Email" />
                <Input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="flex items-center justify-end my-4">
                <Button class="py-2 px-4 rounded-md bg-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </Button>
            </div>
        </form>
    </AuthenticationCard>



</template>