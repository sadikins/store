
<script setup>

import AuthtenticationCard from '@/Components/AuthenticationCard.vue';

import AuthtenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';

import ValidationErrors from '@/Components/ValidationErrors.vue';

import Label from '@/Components/Label.vue';

import Input from '@/Components/Input.vue';

import Button from '@/Components/Button.vue';

import {reactive} from 'vue';

import { Inertia } from '@inertiajs/inertia';

import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    errors: Object,

    session: Object
});

const form = reactive({
    email: '',
    password: '',
});

const submit = () => {
    Inertia.post('/login', {
        email: form.email,
        password: form.password,
    });
}

</script>


<template>

    <Head title="Login" />

   <AuthtenticationCard>
       <template #logo>
           <AuthtenticationCardLogo/>

       </template>


   <ValidationErrors class="mb-4"/>


        <div v-if="session.status" class="mb-4 font-medium text-sm text-green-600">
            {{ session.status }}
        </div>

   <form @submit.prevent="submit" class="p-3">
            <div>
                <Label for="email" value="Email" />
                <Input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    :class="{ 'is-invalid': errors.email }"
                />
            </div>

                <p v-if="errors.email" class="text-accent-red">
                    {{ errors.email }}
                </p>

            <div class="mt-4">
                <Label for="password" value="Password" />
                <Input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                    :class="{ 'is-invalid': errors.password }"
                />
                <p v-if="errors.password" class="text-accent-red">
                    {{ errors.password }}
                </p>
            </div>

              <div class="flex items-center justify-end mt-4">

                  <Link :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                  Forgot Password? 
                  </Link>

                  <Button class="my-2 ml-4 py-2 px-5 rounded-md bg-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                      Log in
                  </Button>
              </div>
   </form>
    
   </AuthtenticationCard>
</template>