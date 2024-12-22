<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
  companies: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({});

const deletecompany = (id) => {
    form.delete(`companies/${id}`);
};
</script>

<template>
    <Head title="Manage Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Company Overview</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="companies/create"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Company</button></Link>
                        <table class="table-auto w-full">
                            <thead>
                              <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2" width="250px">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr v-for="company in companies" :key="company.id">
                                  <td class="border px-4 py-2">{{ company.id }}</td>
                                  <td class="border px-4 py-2">{{ company.name }}</td>
                                  <td class="border px-4 py-2">{{ company.email }}</td>
                                  <td class="border px-4 py-2">
                                    <Link :href="`companies/${company.id}/edit`"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></Link>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="deletecompany(company.id)">Delete</button>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
