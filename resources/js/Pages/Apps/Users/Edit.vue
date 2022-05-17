<template>
    <AppLayout title="Create Users">
        <template #title>
                Create users
        </template>
        <!-- Content -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/apps/users"
                    class="flex justify-end text-gray-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </Link>
                <div class="mb-3">
                    <label for="name" class="text-white mb-3">Full Name</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.name"
                        :class="{ 'border-accent-red': errors.name }"
                        placeholder="user name"
                    />
                    <div v-if="errors.name" class="text-accent-red">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="text-white mb-3">Email Address</label>
                    <input
                        type="email"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.email"
                        :class="{ 'border-accent-red': errors.email }"
                        placeholder="user email"
                    />
                    <div v-if="errors.email" class="text-accent-red">
                        {{ errors.email }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="text-white mb-3">Password</label>
                    <input
                        type="password"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.password"
                        :class="{ 'border-accent-red': errors.password }"
                        placeholder="user password"
                    />
                    <div v-if="errors.password" class="text-accent-red">
                        {{ errors.password }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="text-white mb-3">Password Confirmation</label>
                        <input type="password" v-model="form.password_confirmation" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" placeholder="Password Confirmation">
                </div>

                <div class="mb-5">
                    <label for="Roles" class="text-white">Roles</label>
                    <div v-for="(role, index) in roles" :key="index">
                        <input type="checkbox" class="border-gray-300 rounded h-5 w-5" v-model="form.roles" :value="role.name" :id="`check-${role.id}`" />
                        <label class="text-white mb-3 my-3 ml-3" :for="`check-${role.id}`">{{ role.name }}</label>
                    </div>
                    <div v-if="errors.roles" class="text-accent-red">
                        {{ errors.roles }}
                    </div>
                </div>
               
                <div class="mt-5">
                    <ButtonPrimary
                        :class="`mb-3 font-bold text-center  w-full bg-primary border-primary hover:text-primary text-white py-3`"
                    >
                        UPDATE
                    </ButtonPrimary>

                    <ButtonPrimary
                        :type="`reset`"
                        :class="`w-full font-bold text-gray-300 py-3`"
                    >
                        RESET
                    </ButtonPrimary>
                </div>
            </form>
        </div>
        <!-- End of Content -->
        <template #aside> </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

import ButtonPrimary from "@/Components/Button.vue";

const props = defineProps({
    errors: Object,
    user: Object,
    roles: Array,
});

 //define form with reactive
const form = reactive({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    roles: props.user.roles.map(obj => obj.name),
});

//method "submit"
const submit = () => {

    //send data to server
    Inertia.put(`/apps/users/${props.user.id}`, {
        //data
        name: form.name,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
        roles: form.roles
    }, {
        onSuccess: () => {
            //show success alert
            Swal.fire({
                title: 'Success!',
                text: 'User updated successfully.',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        },
    });

};
</script>
