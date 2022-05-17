<script setup>
import ChevronDownIcon from "@/Icons/ChevronDownIcon.vue";

const props = defineProps({
    permissions: {
        type: String,
        default: 'dashboard.index',

    }

})

</script>

<template>
    <div v-if="hasAnyPermission([permissions])" class="flex flex-col p-6 bg-gray-900 rounded-lg gap-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-loose text-white">
                <slot name="title" />
            </h2>
            <button
                class="flex gap-x-2.5 py-3 px-4 rounded-lg border border-gray-700"
            >
                <ChevronDownIcon />
                <span class="text-sm text-white">
                    <slot name="filter" />
                </span>
            </button>
        </div>
        <hr class="border-gray-700" />
            <slot name="chart" />
    </div>
</template>