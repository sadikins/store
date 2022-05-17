<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import {Link} from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';
    import { Inertia } from '@inertiajs/inertia';


    const props = defineProps({
        permissions: Object, 
    });

     //define state search
    const search = ref('' || (new URL(document.location)).searchParams.get('q'));

    //define method search
    const handleSearch = () => {
        Inertia.get('/apps/permissions', {
            
            //send params "q" with value from state "search"
            q: search.value,
        });
    }


</script>

<template>

    <AppLayout title="Permissions">
        <template #title>
            Permissions
        </template>

        <div class="sm:w-full md:w-1/2 p-5 md:p-10 bg-gray-900 rounded-lg">

                <!-- Search bar -->
                <div class="flex w-full  pb-4 mt-5">
                    <form
                        @submit.prevent="handleSearch"
                        class="w-full flex  bg-gray-700 rounded-lg px-5"
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
                            placeholder="search by Permission name..."
                        />
                    </form>
                </div>

                <!-- Table -->
                <table class="w-full mt-3 ">
                    <thead >
                        <tr class="flex items-start text-sm font-semibold text-white border-b border-gray-700">
                            <th class="pr-4 py-4 pb-4">#</th>
                            <th class="py-4">Permission Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(permission, index) in permissions.data"
                            :key="index"
                            class="flex items-start text-sm text-gray-500"
                        >
                            <td class="py-4">#</td>
                            <td class="py-4">{{ permission.name }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-5 mt-7">
                    <Pagination :links="permissions.links" />
                </div>

        </div>




     <template #aside>

     </template>

    </AppLayout>
</template>