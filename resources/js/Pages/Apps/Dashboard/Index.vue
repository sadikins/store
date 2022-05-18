<script setup>

    import AppLayout from "@/Layouts/AppLayout.vue";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import CoinIcon from "@/Icons/CoinIcon.vue";
    import ArrowUpIcon from "@/Icons/ArrowUpIcon.vue";
    import ArrowDownIcon from "@/Icons/ArrowDownIcon.vue";
    import OrderIcon from "@/Icons/OrderIcon.vue";
    import CustomerIcon from "@/Icons/CustomerIcon.vue";
    import ChevronDownIcon from "@/Icons/ChevronDownIcon.vue";
    import AsideContainer from "@/Components/AsideContainer.vue";

    //import ref from vue
    import { ref } from 'vue';

    //chart
    import { BarChart, DoughnutChart } from 'vue-chart-3';
    import { Chart, registerables } from "chart.js";

    Chart.register(...registerables);

    const props = defineProps({

        count_customer: Number,

        count_sales_today: Number,

        sum_sales_today: Number,

        sum_profits_today: Number,


        sales_date: Array,
        grand_total: Array,

        product: Array,
        total: Array,

        products_limit_stock: Array,
        sales_report: Array,
        total: Number
    });



    //option chart
    const options = ref({
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: false,
            },
        },
        beginZero: true
    });

    


    //chart sell week
    const chartSellWeek = {
        labels: props.sales_date,
        datasets: [{
            data: props.grand_total,
            backgroundColor:[
            'rgba(80, 209, 170, 1)', //green
            'rgba(146, 144, 254, 1)', //purple
            'rgba(101, 176, 246, 1)', //blue
            'rgba(255, 181, 114, 1)', //orange
            'rgba(255, 124, 163, 1)', //red
            ],
        }, ],
    };


     //Doughnut
    const opts= ref({
         responsive: true,
        plugins: {
            legend: {

                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    color: 'white',
                    
                }

            },
            title: {
                display: false,
            },
        },
    })

     //chart produk terlaris
    const chartBestProduct = {
        labels: props.product,
        datasets: [{
            data: props.total,
            backgroundColor: [
            'rgba(80, 209, 170, 1)',  //green
            'rgba(146, 144, 254, 1)', //purple
            'rgba(101, 176, 246, 1)', //blue
            'rgba(255, 181, 114, 1)', //orange
            'rgba(255, 124, 163, 1)', //red
           
            ]
            
        },
         ],
    };


   

</script>

<template>

    <AppLayout title="Dashboard">

        <template #title>
                Dashboard
        </template>



        <main>
            
            <!-- Stats -->
            <div class="flex gap-6 mb-5">

            <!-- Stats Sales today -->
                <div v-if="hasAnyPermission(['dashboard.sales_today'])" class="flex flex-col p-4 w-1/3 bg-gray-900 rounded-lg gap-y-3">
                    <div class="flex items-center gap-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <CoinIcon/>
                        </div>
                            <span class="text-xs font-medium " :class="count_sales_today > 0 ? 'text-accent-green': 'text-accent-red' "> 
                            {{ count_sales_today }}  
                            </span>
                            <div class="p-0.5 rounded-full" :class="count_sales_today > 0 ? 'bg-accent-green/20' : 'bg-accent-red/20'">

                           <ArrowUpIcon
                                v-if="count_sales_today > 0"
                                class="fill-current text-accent-green"
                            />
                            <ArrowDownIcon
                                v-else
                                class="fill-current text-accent-red"
                            />

                            </div>
                        </div>
                    <div class="text-3xl font-semibold text-white">
                        Rp. {{ formatPrice(sum_sales_today) }} 
                    </div>
                    <div class="text-sm tracking-wide text-gray-500">
                        Sales Today
                    </div>
                </div>
            <!-- End of Stats Sales today -->

             <!-- Stats Profit today -->
                <div v-if="hasAnyPermission(['dashboard.profits_today'])" class="flex flex-col p-4 w-1/3 bg-gray-900 rounded-lg gap-y-3">
                    <div class="flex items-center gap-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <OrderIcon/>
                        </div>
                            <span class="text-xs font-medium" :class="sum_profits_today > 0 ? 'text-accent-green': 'text-accent-red' "> 
                            {{ formatPrice(sum_profits_today) }}  
                            </span>
                            <div class="p-0.5 rounded-full" :class="sum_profits_today > 0 ? 'bg-accent-green/20' : 'bg-accent-red/20'">

                             <ArrowUpIcon
                                v-if="sum_profits_today > 0"
                                class="fill-current text-accent-green"
                            />
                            <ArrowDownIcon
                                v-else
                                class="fill-current text-accent-red"
                            />

                            </div>
                        </div>
                    <div class="text-3xl font-semibold text-white">
                        Rp. {{ formatPrice(sum_profits_today) }}
                    </div>
                    <div class="text-sm tracking-wide text-gray-500">
                        Profit Today
                    </div>
                </div>

                <!-- Stats Total Customers -->
                 <div v-if="hasAnyPermission(['dashboard.profits_today'])" class="flex flex-col p-4 w-1/3 bg-gray-900 rounded-lg gap-y-3">
                    <div class="flex items-center gap-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <CustomerIcon/>
                        </div>
                            <span class="text-xs font-medium" 
                            :class="
                            count_customer > 0
                            ? 'text-accent-green'
                            : 'text-accent-red'
                    "
                            > 
                        
                   
                            {{ count_customer }}  
                            </span>
                            <div class="p-0.5 rounded-full" :class="
                            count_customer > 0
                            ? 'bg-accent-green/20'
                            : 'bg-accent-red/20'
                    ">

                            <ArrowUpIcon
                                v-if="count_customer > 0"
                                class="fill-current text-accent-green"
                            />
                            <ArrowDownIcon
                                v-else
                                class="fill-current text-accent-red"
                            />
                            </div>
                        </div>
                    <div class="text-3xl font-semibold text-white">
                        {{ count_customer }}
                    </div>
                    <div class="text-sm tracking-wide text-gray-500">
                        Total Customer
                    </div>
                </div>
                <!-- End of stats Total Customer -->
            </div>
            <!-- End of Stats  -->

            <div class="container w-full mt-5">

                <div v-if="hasAnyPermission(['dashboard.sales_chart'])" class="p-10 bg-gray-900 rounded-lg">

                <div class="mb-5">
                    <h2 class="text-xl font-semibold leading-loose text-white">SALES CHART 7 DAYS</h2>
                </div>
                <div class="text-white">
                    <BarChart :chartData="chartSellWeek" :options="options" />
                </div>
            </div>

           
                        


            </div>
        </main>

        <template #aside>

            <AsideContainer>
                    <div :permissions="dashboard.product_stock"></div>

                    <template #title>
                        Product Stock
                    </template>

                    <template #filter>
                        Today
                    </template>
                    <template #chart>
                        <div class="flex flex-col gap-y-4">
                            <div v-if="products_limit_stock.length > 0">
                                <div v-for="product in products_limit_stock" :key="product.id" class="flex justify-between gap-x-4 items-center">
                                    <img  :src="product.image" :alt="product.name" class="w-16 h-16 border-2 border-accent-red/20 rounded-full mb-3"/> 

                                    <div class="flex flex-col w-56">
                                        <div class="text-sm font-medium text-white">{{ product.title }} </div>
                                        <span class="text-xs text-gray-500">{{ product.category.name }}</span>
                                    </div>
                                    <div class="rounded-full  bg-accent-red/20 py-1 px-3 text-accent-red text-sm">{{ product.stock }}</div>
                                </div>

                                <Link as="button" :href="route('apps.products.index')" class="mt-3 py-3.5 rounded-lg w-full border border-primary text-primary text-sm font-semibold">

                                View all
                                </Link>
                            </div>

                            <div v-else class="border-0 text-accent-red rounded-md">
                                Data Tidak Tersedia!.
                            </div>
                        </div>
                    </template>
                    
                </AsideContainer>

             <AsideContainer>
                    <div :permissions="dashboard.best_selling_product"></div>
                    <template #title>
                        Most Ordered
                    </template>

                    <template #filter>
                        Today
                    </template>
                    <template #chart>
                         <div class="flex">
                        <DoughnutChart :chartData="chartBestProduct" :options="opts" />
                         </div>
                    </template>
                    
                </AsideContainer>

            
        </template>

    </AppLayout>
</template>