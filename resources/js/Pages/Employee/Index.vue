<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Modal } from 'ant-design-vue';

defineProps({
  employees: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({});

const deleteEmployee = (id) => {
  Modal.confirm({
      title: 'Are you sure you want to delete this employee?',
      onOk() {
        form.delete(`employees/${id}`);
      },
  });

    
};

</script>

<template>
    <Head title="Manage Employees" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employee Overview</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="employees/create"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Employee</button></Link>
                        <table class="table-auto w-full">
                            <thead>
                              <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Firstname</th>
                                <th class="border px-4 py-2">Lastname</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Phone</th>
                                <th class="border px-4 py-2">Company</th>
                                <th class="border px-4 py-2" width="250px">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr v-for="employee in employees" :key="employee.id">
                                  <td class="border px-4 py-2">{{ employee.id }}</td>
                                  <td class="border px-4 py-2">{{ employee.firstname }}</td>
                                  <td class="border px-4 py-2">{{ employee.lastname }}</td>
                                  <td class="border px-4 py-2">{{ employee.email }}</td>
                                  <td class="border px-4 py-2">{{ employee.phone }}</td>
                                  <td class="border px-4 py-2">{{ employee.company.name }}</td>
                                  <td class="border px-4 py-2">
                                    <Link :href="`employees/${employee.id}/edit`"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></Link>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="deleteEmployee(employee.id)">Delete</button>
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
