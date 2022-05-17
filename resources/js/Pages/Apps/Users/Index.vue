<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import ButtonLink from "@/Components/NavLink.vue";
    import {Link} from '@inertiajs/inertia-vue3';
    import {ref} from 'vue';
    import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        'users': Object,
    });

  //define state search
    const search = ref('' || (new URL(document.location)).searchParams.get('q'));

    //define method search
    const handleSearch = () => {
        Inertia.get('/apps/users', {
            
            //send params "q" with value from state "search"
            q: search.value,
        });
    }

    //method destroy
    const destroy = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.isConfirmed) {

                Inertia.delete(`/apps/users/${id}`);

                Swal.fire({
                    title: 'Deleted!',
                    text: 'User deleted successfully.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        })
    };

</script>

<template>
<AppLayout title="users">
    <template #title>
         users
    </template>

    <div class="p-5 md:p-10 bg-gray-900 rounded-lg">

            <!-- Search bar -->
            <div class="flex flex-col md:flex-row  gap-3 md:gap-0 justify-between pb-4 mt-5">
                <form
                    @submit.prevent="handleSearch"
                    class="flex justify-center bg-gray-700 rounded-lg px-5"
                >
                    <!-- Icon search -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-500 mt-3 mr-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                    <input
                        type="text"
                        class="py-3 bg-transparent border-0 text-white focus:ring-0"
                        v-model="search"
                        placeholder="search by user name..."
                    />
                </form>

                <!-- Button Create New  -->
                <ButtonLink
                as="button"
                :href="route('apps.users.create')"
                :class="`bg-primary  text-white px-9 py-2 rounded-sm `"
                >Create New
                </ButtonLink>
            </div>

            <!-- Table -->
            <table class="sm:w-full mt-3">
                <thead>
                    <tr class="text-sm font-semibold text-white">
                        <td class="py-4 border-b border-gray-700">#</td>
                        <td class="py-4 border-b border-gray-700">Full Name</td>
                        <td class="py-4 border-b border-gray-700">Email Address</td>
                        <td class="py-4 border-b border-gray-700">Roles</td>
                        <td class="py-4 border-b border-gray-700 text-center">
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(user, index) in users.data"
                        :key="index"
                        class="text-sm text-gray-500"
                    >
                        <td class="py-4">#</td>
                        <td class="py-4">{{ user.name }}</td>
                        
                        <td class="py-4">{{ user.email }}</td>
                        <td class="py-4">
                            <span v-for="(role, index) in user.roles" :key="index" class="py-2 px-5 rounded-full  mb-2" :class="role.name == 'admin' ? 'bg-accent-orange/20 text-accent-orange': 'bg-accent-green/20 text-accent-green' ">
                                {{ role.name }}
                            </span>
                        </td>
                        <td class="py-4 space-x-2 text-center">
                            <ButtonLink
                                v-if="hasAnyPermission(['users.edit'])"
                                as="button"
                                :href="
                                    route('apps.users.edit', `${user.id}`)
                                "
                                :class="` md:bg-accent-orange/20  text-accent-orange rounded-sm px-5 py-2`"
                            >
                                Edit
                            </ButtonLink>
                            <ButtonLink
                                v-if="hasAnyPermission(['users.delete'])"
                                as="button"
                                @click.prevent="destroy(user.id)"
                                :class="` md:bg-accent-red/20  text-accent-red rounded-sm px-5 py-2`"
                            >
                                Delete
                            </ButtonLink>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-5 mt-7">
                <Pagination :links="users.links" />
            </div>
    </div>




    <template #aside>

    </template>

</AppLayout>
</template>