<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import Swal from 'sweetalert2';
    import ButtonLink from '@/Components/NavLink.vue';

    const props = defineProps({

        roles: Object,
    });

     //define state search
        const search = ref('' || (new URL(document.location)).searchParams.get('q'));

        //define method search
        const handleSearch = () => {
            Inertia.get('/apps/roles', {
                
                //send params "q" with value from state "search"
                q: search.value,
            });
        }

        //define method destroy
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

                    Inertia.delete(`/apps/roles/${id}`);

                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Role deleted successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            })
        }



</script>

<template>

<AppLayout title="Roles">
        <template #title>
            Roles
        </template>

        <div class="sm:w-full p-5 md:p-10 bg-gray-900 rounded-lg">

                <!-- Search bar -->
                <div class=" flex flex-col md:flex-row  gap-3 md:gap-0 justify-between pb-4 mt-5">
                    <form
                        @submit.prevent="handleSearch"
                        class=" flex  bg-gray-700 rounded-lg px-5"
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
                            placeholder="search by role name..."
                        />
                    </form>

                      <!-- Button Create New  -->
                    <ButtonLink
                    as="button"
                    :href="route('apps.roles.create')"
                    :class="`bg-primary  text-white px-9 py-2 rounded-sm `"
                    >Create New
                    </ButtonLink>
                </div>

                <!-- Table -->
                <table class="mt-3 ">
                    <thead class="border-b border-gray-700">
                        <tr class="font-semibold text-white items-start ">
                            <th style="width:3%" class="pr-4 py-4 pb-4 ">#</th>
                            <th style="width:10%" class="py-4 ">Role Name</th>
                            <th style="width:60%" class="py-4 ">Permissions</th>
                            <th style="width:20%" class="py-4 ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(role, index) in roles.data" :key="index" class=" text-gray-500 font-semibold items-start  ">
                     
                            <th style="width:3%" class="pr-4 py-4 ">#</th>
                            <th style="width:10%" class="py-4 text-lg  font-bold">{{ role.name }} </th>
                           
                            <th  class="flex flex-wrap text-sm my-5" >
                                <span v-for="(permission, index) in role.permissions" :key="index" 
                                class="bg-accent-blue/20 text-accent-green rounded-full py-2 px-3 ml-2 mb-2">
                                    {{ permission.name }}
                                </span>
                            </th>
                             <th style="width:20%" class="py-4 space-x-2 text-center ">
                                <ButtonLink
                                    as="button"
                                    :href="
                                        route('apps.roles.edit', `${role.id}`)
                                    "
                                    :class="` md:bg-accent-orange/20  text-accent-orange rounded-sm px-5 py-2`"
                                    v-if="hasAnyPermission(['roles.edit'])"
                                >
                                    Edit
                                </ButtonLink>
                                <ButtonLink
                                    as="button"
                                    @click.prevent="destroy(role.id)"
                                    :class="` md:bg-accent-red/20  text-accent-red rounded-sm px-5 py-2`"
                                    v-if="hasAnyPermission(['roles.delete'])"
                                >
                                    Delete
                                </ButtonLink>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-5 mt-7">
                    <Pagination :links="roles.links" />
                </div>

        </div>




     <template #aside>

     </template>

    </AppLayout>

</template>