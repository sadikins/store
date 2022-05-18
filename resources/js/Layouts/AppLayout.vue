<script setup>

import { ref } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Sidebar from '@/Components/Sidebar.vue';
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { 

    KeyIcon,
    UserIcon,
    ShieldCheckIcon,
    ChartBarIcon,
    PresentationChartLineIcon,
    LogoutIcon,
    }
from '@heroicons/vue/outline'

const props = defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route("logout"));
};

</script>

<template>
<Head :title="title" />
 <div class="flex w-full min-h-screen font-sans bg-gray-800">
        <!-- Sidebar Menu -->
        <Sidebar />

        <!-- Main Section -->
        <main class="flex flex-col flex-1 gap-6 p-4">
            <header class="flex justify-between">
                <div>
                    <h2 class="text-3xl font-semibold leading-loose text-white">
                        <slot name="title">
                        Dashboard
                        </slot>
                    </h2>
                    <div class="text-gray-200">{{ $page.props.tanggal }}</div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="mr-5 relative">
                        <Dropdown>

                            <template #trigger>
                            <button>

                            <img class="rounded-full w-10 h-10"
                            :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&amp;background=FFB572&amp;color=ffffff&amp;size=100`" :alt="$page.props.auth.user.name">

                            </button>

                            


                            </template>
                            <template #content>
                                <div  class="block px-4 py-2 text-sm ">
                                    Hello, 
                                    <span class="text-accent-orange font-semibold"> 
                                        {{ $page.props.auth.user.name }}
                                    </span>
                                </div>
                                 
                                 <div class="border-t border-gray-100" />

                                 <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                    v-if="hasAnyPermission(['users.index'])"
                                >
                                    Manage Account
                                </div>
                           

                                <DropdownLink :href="route('apps.users.index')" v-if="hasAnyPermission(['users.index'])">
                                   <div class="flex">

                                   <UserIcon class="w-4 mr-2"/> Users
                                   </div>
                                </DropdownLink>

                                <!-- <DropdownLink :href="route('apps.permissions.index')" v-if="hasAnyPermission(['permissions.index'])">
                                  <div class="flex">
                                  <KeyIcon class="w-4 mr-2"/>  Permissions

                                  </div>
                                </DropdownLink> -->

                                <DropdownLink :href="route('apps.roles.index')" v-if="hasAnyPermission(['roles.index'])">
                                    <div class="flex">
                                    <ShieldCheckIcon class=" w-4 mr-2" />   Roles

                                    </div>
                                </DropdownLink>

                                 <div
                                    class="block px-4 py-2 text-xs text-gray-400" v-if="hasAnyPermission(['sales.index'])"
                                >
                                    Reports
                                </div>

                                <DropdownLink :href="route('apps.sales.index')" v-if="hasAnyPermission(['sales.index'])">
                                    <div class="flex">
                                    <ChartBarIcon class=" w-4 mr-2" />   Sales

                                    </div>
                                </DropdownLink>
                                <DropdownLink :href="route('apps.profits.index')" v-if="hasAnyPermission(['profits.index'])">
                                    <div class="flex">
                                    <PresentationChartLineIcon class=" w-4 mr-2" />   Profits

                                    </div>
                                </DropdownLink>


                                 <div class="border-t border-gray-100" />

                                  <form @submit.prevent="logout">
                                    <DropdownLink as="button" >
                                        <div class="flex">
                                             Log Out
                                        <LogoutIcon class="ml-2 w-4"/>  
                                     
                                        </div>
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>

                </div>
            </header>

            <hr class="border-gray-700" />

            <slot> </slot>

        </main>

        <!-- Aside -->
        <aside class="flex flex-col gap-y-6 pt-6 pr-6 w-96">
            <slot name="aside"> </slot>
        </aside>

        <!-- Footer -->
    </div>
</template>