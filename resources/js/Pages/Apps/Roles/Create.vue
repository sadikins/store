<template>
    <AppLayout title="Create role">
        <template #title>
                Create Roles
        </template>
        <!-- Content -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/apps/roles"
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
                    <label for="name" class="text-white mb-3">Role Name</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.name"
                        :class="{ 'border-accent-red': errors.name }"
                        placeholder="role name"
                    />
                    <div v-if="errors.name" class="text-accent-red">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="permission" class="text-white mb-5">Permissions</label>
                    <div v-for="(permission, index) in permissions" :key="index">
                        <input class="rounded h-5 w-5 my-3" type="checkbox" v-model="form.permissions" :value="permission.name" :id="`check-${permission.id}`">
                        <label class="text-white mb-3 ml-3" :for="`check-${permission.id}`">{{ permission.name }}</label>
                    </div>
                    <div v-if="errors.permission_id" :class="`text-accent-red`">
                        {{ errors.permission_id }}
                    </div>
                </div>
               
                <div class="mt-5">
                    <ButtonPrimary
                        :class="`mb-3 font-bold text-center  w-full bg-primary border-primary hover:text-primary text-white py-3`"
                    >
                        SAVE
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

defineProps({
    errors: Object,
    permissions: Array,
});

//define form with reactive
const form = reactive({
    name: '',
    permissions: [],
});

//method "submit"
const submit = () => {

    //send data to server
    Inertia.post('/apps/roles', {
        //data
        name: form.name,
        permissions: form.permissions,
    }, {
        onSuccess: () => {
            //show success alert
            Swal.fire({
                title: 'Success!',
                text: 'Role saved successfully.',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        },
    });
};
</script>
