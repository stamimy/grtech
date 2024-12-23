<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  companies: {
    type: Array,
    default: () => [],
  },

  employee: {
    type: Object,
    default: () => {},
  },
});

const form = useForm({
  firstname: props.employee.firstname,
  lastname: props.employee.lastname,
  email: props.employee.email,
  company_id: props.employee.company_name,
});

const submit = () => {
  form.post("/employees");
};
</script>

<template>
    <Head title="Manage Employees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Employee</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/employees"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button></Link>
                        
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label 
                                    for="firstname" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Firstname:</label>
                                <input 
                                    type="text" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter Firstname" 
                                    id="firstname"
                                    v-model="form.firstname" />

                            </div>

                            <div class="mb-4">
                                <label 
                                    for="lastname" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Firstname:</label>
                                <input 
                                    type="text" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter Lastname" 
                                    id="lastname"
                                    v-model="form.lastname" />

                            </div>

                            <div class="mb-4">
                                <label 
                                    for="email" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Email:</label>
                                <input 
                                    type="text" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter Email" 
                                    id="email"
                                    v-model="form.email" />
                            </div>

                            <div class="mb-4">
                                <label 
                                    for="company_id" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Company:</label>
                                
                                    <v-select label="name" value="id" :options="companies" id="company_id" v-model="form.company_id"></v-select>

                            </div>

                            

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 text-white">
                                Submit
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
