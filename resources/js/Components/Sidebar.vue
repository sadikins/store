<script setup>
import StoreIcon from "@/Icons/StoreIcon.vue";
import { 
    ShoppingCartIcon, 
    ChartPieIcon, 
    ShoppingBagIcon, 
    FolderIcon,
    LogoutIcon,
    UserIcon,
    PresentationChartLineIcon,
    UsersIcon,
    ChartBarIcon,
    }
from '@heroicons/vue/outline'

import { ref } from "vue";

import { Link } from "@inertiajs/inertia-vue3";
import NavLink from "@/Components/SidebarLink.vue";

const activeMenu = ref("Dashboard");

const menus = [
    {
        name: "Transaction",
        icon: ShoppingCartIcon,
        link: "/apps/transactions",
        method: "get",
        permission: "transactions.index",
    },
    
    {
        name: "Categories",
        icon: FolderIcon,
        link: "/apps/categories",
        method: "get",
        permission: "categories.index",
    },
    {
        name: "Products",
        icon: ShoppingBagIcon,
        link: "/apps/products",
        method: "get",
        permission: "products.index",
    },
    {
        name: "Customers",
        icon: UsersIcon,
        link: "/apps/customers",
        method: "get",
        permission: "customers.index",
    },
    {
        name: "Dashboard Reports",
        icon: ChartPieIcon,
        link: "/apps/dashboard",
        method: "get",
        permission: "dashboard.index",
        
    },

    {
        name: "Sales Report",
        icon: ChartBarIcon,
        link: "/apps/reports/sales",
        method: "get",
        permission: "sales.index",
    },
    {
        name: "Profits Report",
        icon: PresentationChartLineIcon,
        link: "/apps/reports/profits",
        method: "get",
        permission: "profits.index",
    },
    {
        name: "Users",
        icon: UserIcon,
        link: "/apps/users",
        method: "get",
        permission: "users.index",
    },
    {
        name: "Logout",
        icon: LogoutIcon,
        link: "/logout",
        method: "post",
        permission: "dashboard.index",
    },
];
</script>


<template>
    <div class="flex flex-col gap-y-4 items-center py-8 w-24 bg-gray-900">
        <button class="p-2 bg-opacity-20 rounded-xl bg-primary">
            <StoreIcon />
        </button>
        <div class="flex flex-col gap-y-4 items-end self-end" v-for="(menu, i) in menus"  :key="i">
            <div 
                
                v-if="hasAnyPermission([menu.permission])"
                :title="menu.name"
                :class="
                    menu.link === $page.url
                        ? 'bg-gray-800 rounded-l-xl relative before:absolute before:w-4 before:h-8 before:-top-8 before:rounded-br-xl before:right-0 before:shadow-inverse-top  after:absolute after:w-4 after:h-8 after:-bottom-8 after:rounded-tr-xl after:right-0 after:shadow-inverse-bottom'
                        : ''
                "
                
            >
                <NavLink 
                    
                    as="button"
                    
                    v-on:click="activeMenu = menu.name"
                    :href="menu.link"
                    :active="$page.url.startsWith(menu.link)"
                    :method="menu.method"
                >
                    <Component :is="menu.icon" class="w-6 h-6" />
                </NavLink>
            </div>
        </div>

    </div>
</template>

