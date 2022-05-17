<script setup>

    import AppLayout from '@/Layouts/AppLayout.vue';

    import { Head, Link } from '@inertiajs/inertia-vue3';

    //import hook ref
    import { ref } from 'vue';

    //import adapter inertia
    import { Inertia } from '@inertiajs/inertia';


    const props = defineProps({
        errors: Object,
        profits_report: Array,
        profits: Array,
        total: Number
    });



      //define state
    const start_date = ref('' || (new URL(document.location)).searchParams.get('start_date'));
    const end_date = ref('' || (new URL(document.location)).searchParams.get('end_date'));


    //define methods filter
    const filter = () => {

        //HTTP request
        Inertia.get(route('apps.profits.filter'), {

            //send data to server
            start_date: start_date.value,
            end_date: end_date.value,
        });

    }

</script>

<template>
<AppLayout title="Reports">
    <template #title>
        Reports
    </template>
    <div class="container w-full mt-5">


        <div v-if="hasAnyPermission(['profits.index'])" class="p-10 bg-gray-900 rounded-lg">

             <form @submit.prevent="filter" class="flex justify-center  px-5">
                <div class="flex">
                    <div class="mr-10">
                        <div class="flex flex-col items-center mb-3">
                            <label class="text-white mb-3">Start Date</label>
                            <input type="date" v-model="start_date" class="py-3 px-6 bg-gray-800 rounded-lg border-0 text-white focus:ring-0" placeholder="start Date">
                        </div>
                        <div v-if="errors.start_date" class="text-accent-red">
                            {{ errors.start_date }}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="flex flex-col items-center mb-3 ">
                            <label class="text-white mb-3">End Date</label>
                            <input type="date" v-model="end_date" class="py-3 px-6  bg-gray-800 rounded-lg border-0 text-white focus:ring-0" placeholder="End Date">
                        </div>
                        <div v-if="errors.end_date" class="text-accent-red">
                            {{ errors.end_date }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <button class="py-2 px-6 text-white bg-primary font-semibold rounded-md mt-10 ml-5 "> FILTER</button>
                        </div>
                    </div>
                </div>
            </form>

        <div v-if="profits">
              <table class="sm:w-full mt-3">
            <thead>
                <tr class="font-semibold text-white">
                <th scope="col" class="text-left py-4 border-b border-gray-700">#</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Date</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Invoice</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Total</th>
                </tr>
            
            </thead>
            <tbody>
            <tr v-for="profit in profits" :key="profit.id" class="text-gray-500">
                <td class="py-4 border-b border-gray-700">#</td>
                <td class="py-4 border-b border-gray-700">{{ profit.created_at }}</td>
                <td class="py-4 border-b border-gray-700">{{ profit.transaction.invoice }}</td>
                <td class="py-4 border-b border-gray-700">Rp. {{ formatPrice(profit.total) }}</td>
            </tr>
            <tr class="bg-gray-700">

                <td colspan="3" class="py-3 text-white text-xl font-semibold pl-3">TOTAL</td>
                <td class="py-3 text-white text-xl font-semibold ">Rp. {{ formatPrice(total) }}</td>
            </tr>
            
            </tbody>
        </table>

        </div>
        <div v-else>

        <table class="sm:w-full mt-3">
            <thead>
                <tr class="font-semibold text-white">
                <th scope="col" class="text-left py-4 border-b border-gray-700">#</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Date</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Invoice</th>
                <th scope="col" class="text-left py-4 border-b border-gray-700">Total</th>
                </tr>
            
            </thead>
            <tbody>
            <tr v-for="profit in profits_report" :key="profit.id" class="text-gray-500">
                <td class="py-4 border-b border-gray-700">#</td>
                <td class="py-4 border-b border-gray-700">{{ profit.created_at }}</td>
                <td class="py-4 border-b border-gray-700">{{ profit.transaction.invoice }}</td>
                <td class="py-4 border-b border-gray-700">Rp. {{ formatPrice(profit.total) }}</td>
            </tr>
            
            </tbody>
        </table>
        </div>
        </div>
    </div>
</AppLayout>
</template>