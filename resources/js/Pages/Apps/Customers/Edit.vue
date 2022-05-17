<template>
    <AppLayout>
        <template #title>
                Create customers
        </template>
        <!-- Content -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/apps/customers"
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
                    <label for="name" class="text-white mb-3">Name</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.name"
                        :class="{ 'is-invalid': errors.name }"
                        placeholder="customer Name"
                    />
                    <div v-if="errors.name" class="text-accent-red">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="text-white mb-3">Phone</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.no_telp"
                        :class="{ 'is-invalid': errors.no_telp }"
                        placeholder="customer phone"
                    />
                    <div v-if="errors.no_telp" class="text-accent-red">
                        {{ errors.no_telp }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="text-white mb-3"
                        >address</label
                    >
                    <textarea
                        rows="10"
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.address"
                        :class="{ 'is-invalid': errors.address }"
                        placeholder="customer address"
                    >
                    </textarea>
                    <div v-if="errors.address" class="text-accent-red">
                        {{ errors.address }}
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

const props = defineProps({
    errors: Object,
    customer: Object,
});

const form = reactive({
    name: props.customer.name,
    no_telp: props.customer.no_telp,
    address: props.customer.address,
});

const submit = () => {
    Inertia.post(
        route("apps.customers.update", `${props.customer.id}`),
        {
            _method: "PUT",
            name: form.name,
            no_telp: form.no_telp,
            address: form.address,
        },
        {
            onSuccess: () => {
                Swal.fire({
                    title: "Success",
                    text: "customer update successfully.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
        }
    );
};
</script>
