<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ButtonPrimary from '@/Components/Button.vue';
    import VueMultiselect from 'vue-multiselect';
    import 'vue-multiselect/dist/vue-multiselect.css';
    import { ref } from 'vue';
    import axios from 'axios';
    import { Inertia } from '@inertiajs/inertia';
    import Swal from 'sweetalert2';

    const props = defineProps({
        customers: Array,
        carts_total: Number,
        session: Object,
        carts: Array,
    });

    const barcode = ref('');
    const product = ref({});
    const qty = ref(1);

    const searchProduct = () => {

        axios.post(route('apps.transactions.searchProduct'), {

            barcode: barcode.value

        }).then(response => {

            if(response.data.success) {

                product.value = response.data.data;

            }else {
                product.value = {};
            }
        });
    }


    const clearSearch = () => {
        product.value = {};

        barcode.value = '';
    }

    const grandTotal = ref(props.carts_total);

    const addToChart = () => {
        Inertia.post('/apps/transactions/addToCart', {
            product_id: product.value.id,
            qty: qty.value,
            sell_price: product.value.sell_price,
        }, {
            onSuccess: () => {

                clearSearch();

                qty.value = 1;

                grandTotal.value = props.carts_total;

                cash.value = 0;

                change.value= 0;
            }
        });
    }

    const destroyCart = (cart_id) => {
        Inertia.post('/apps/transactions/destroyCart', {
            cart_id:cart_id
        }, {
            onSuccess: () => {
                grandTotal.value = props.carts_total;

                cash.value  = 0;
                change.value= 0;
            },
        })
    }

    const cash     = ref(0);
    const change   = ref(0);
    const discount = ref(0);

    const setDiscount = () => {
        grandTotal.value = props.carts_total - discount.value;

        cash.value = 0;

        change.value = 0;
    }

    const setChange = () => {
        change.value  = cash.value - grandTotal.value;
    }

    const customer_id = ref('');

    const storeTransaction = () => {
        axios.post('/apps/transactions/store', {
            customer_id: customer_id.value ? customer_id.value.id: '',
            discount   : discount.value,
            grand_total: grandTotal.value,
            cash       : cash.value,
            change     : change.value,
        })
        .then(response => {
            clearSearch();
            qty.value         = 1;
            grandTotal.value  = props.carts_total;
            cash.value        = 0;
            change.value      = 0;
            customer_id.value = '';

            Swal.fire({
                title            : 'Success!',
                text             : 'Transaction Successfully',
                icon             : 'success',
                showConfirmButton: false,
                timer            : 2000
            })
            .then(() => {
                setTimeout(() => {

                    window.open(`/apps/transactions/print?invoice=${response.data.data.invoice}`, '_blank');

                    location.reload();

                }, 50);
            })

        })
    }
</script>


<template>
    <AppLayout title="Transaction">
        <template #title>
                Transaction
        </template>

        <!-- Content -->

        <section class="flex flex-col md:flex-row gap-3">
      
        <div class="container w-full  bg-gray-900 rounded-md p-8">
           

        <div class="mb-3 flex justify-between">
            <div class="mb-3">

                

            <h4 class="text-3xl font-semibold leading-loose text-white">GRAND TOTAL</h4>
            <h4 class="text-white font-semibold text-3xl">Rp. {{ formatPrice(grandTotal) }}</h4>
            <div v-if="change > 0">
            <hr class="my-3">
            <h5 class="text-accent-green">
                Change : <strong>Rp. {{formatPrice(change)}}</strong>
            </h5>

            </div>
            </div>

            <div class="mb-3">
            <label for="Cashier" class="text-white block my-3"> Cashier</label>
            <input type="text" class="px-3 text-gray-300 border-0 bg-gray-800 rounded-sm" :value="$page.props.auth.user.name" readonly>
            </div>  

        
        </div>

  

         

        <table class="w-full my-5  border border-gray-700">
            <thead class="bg-gray-700">
                <tr class="text-lg font-semibold text-white">
                    <th class="py-4 border-b border-gray-700">#</th>
                    <th class="py-4 border-b border-gray-700">Product Name</th>
                    <th class="py-4 border-b border-gray-700">Price</th>
                    <th class="py-4 border-b border-gray-700">Qty</th>
                    <th class="py-4 border-b border-gray-700">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cart in carts" :key="cart.id" class="text-md text-white">
                    
                    <th class="py-4 border-b border-gray-700">
                        <button  @click.prevent="destroyCart(cart.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-red" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </th>
                    <th class="py-4 border-b border-gray-700">
                        {{ cart.product.title }}
                    </th>
                    <th class="py-4 border-b border-gray-700"> {{ formatPrice(cart.product.sell_price) }} </th>
                    <th class="py-4 border-b border-gray-700"> {{ cart.qty }} </th>
                    <th class="py-4 border-b border-gray-700"> {{ formatPrice(cart.price) }} </th>
                </tr>
                <tr>
                    <th colspan="4" class="bg-primary text-white text-2xl py-2">TOTAL</th>

                    <th class="text-semibold text-white bg-primary/70 text-2xl py-2">Rp. {{ formatPrice(carts_total) }}</th>
                </tr>
               
            </tbody>
        </table>


        <div class="flex justify-end flex-col">

                <div class=" my-3 rounded-full border-2 border-primary text-primary font-semibold w-10 h-10 flex justify-center items-center">2</div>

            <div class="mb-3">
                <label for="Discount" class="text-white">Discount (Rp.)</label>
                <input type="number" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" v-model="discount" @keyup="setDiscount" placeholder="Discount (Rp.)">
            </div>
                <div class="mb-3">
                <label for="Pay" class="text-white">Pay (Rp.)</label>
                <input type="number" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" v-model="cash" @keyup="setChange">
            </div>
         
               <div class="mb-3 mt-8 flex justify-end gap-3">
                <button :class="`bg-gray-700 py-2 px-4 rounded-sm text-white font-semibold`">
                    CANCEL
                </button>
                <button @click.prevent="storeTransaction" :class="`bg-primary py-2 px-4 rounded-sm text-white font-semibold`" :disabled="cash < grandTotal || grandTotal == 0">
                    PAY ORDER & PRINT
                </button>
            </div>
        </div>

        </div>

        </section>



        


        <!-- End of Content -->

        <template #aside>

        <div class="container w-full bg-gray-900 p-8">

            <div class="mb-3">

            <div class="flex justify-between">
               
                <div class="rounded-full border-2 border-primary text-primary font-semibold w-10 h-10 flex justify-center items-center">1</div>
               

                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/50 mb-3.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd" />
                <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                </svg>
            </div>

            
             <!-- Session -->
            <div v-if="session.error" class="font-semibold italic border-2 border-accent-red text-accent-red bg-accent-red/20 rounded-lg py-3 px-5 mb-3">
                {{ session.error }}

            </div>

             <div v-if="session.success" class="mb-3 italic text-accent-green/80 text-sm">
                {{ session.success }}
            </div> 
            <!-- End of Session -->



                <div class="mb-3">
                <label for="Customer" class="text-white mb-5"> Customer</label>
                <VueMultiselect v-model="customer_id" label="name" track-by="name" :options="customers"></VueMultiselect>
            </div>



                <label for="Barcode" class="text-white mb-5"> Barcode</label>
                <input type="text" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" v-model="barcode" @keyup="searchProduct" placeholder="Scan or Input Barcode">
            </div>

         

            <div class="mb-3">
                <label for="Product Name" class="text-white mb-5">Product Name</label>
                <input type="text" class="px-3 text-gray-300 border-0 rounded-md bg-gray-700 w-full" :value="product.title" placeholder="Product Name" readonly>
            </div>
            <div class="mb-3">
                <label for="Qty" class="text-white mb-3">Qty</label>
                <input type="number" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" v-model="qty" placeholder="Qty" min="1">
            </div>
        
            <div class="mb-3 mt-8 flex justify-end gap-3">
                <button @click.prevent="clearSearch" :class="`bg-gray-700 py-2 px-4 rounded-sm text-white font-semibold`" :disabled="!product.id">
                    CLEAR
                </button>
                <button @click.prevent="addToChart" :class="`bg-primary py-2 px-4 rounded-sm text-white font-semibold`" :disabled="!product.id">
                    ADD ITEM
                </button>
            </div>

        </div>

        </template>

    </AppLayout>

</template>


