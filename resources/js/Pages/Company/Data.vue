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
                    <a-table
                        :columns="columns"
                        :row-key="record => record.id"
                        :data-source="dataSource"
                        :pagination="pagination"
                        :loading="loading"
                        @change="handleTableChange"
                        >

                        <template #bodyCell="{ record,column }">
                            <template v-if="column.key === 'action' && record.employees_num === 0">
                                <a-popconfirm
                                v-if="dataSource.length"
                                title="Sure to delete?"
                                @confirm="onDelete(record.id)"
                                >
                                <a>Delete</a>
                                </a-popconfirm>
                            </template>
                        </template>

                        </a-table>
                </div>
            </div>
        </div>
    </div>
  </AuthenticatedLayout>

    
  </template>
  
  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, Link, useForm } from '@inertiajs/vue3';
  import { ref, computed } from 'vue';
  import { usePagination } from 'vue-request';
  import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
  import { createVNode } from 'vue';
  import { Modal } from 'ant-design-vue';

  const columns = [
    {
      title: 'ID',
      dataIndex: 'id',
    },
    {
      title: 'Name',
      dataIndex: 'name',
    },
    {
      title: 'Email',
      dataIndex: 'email',
    },
    {
      title: '∑ Employees',
      dataIndex: 'employees_num',
      align: 'right',
    },
    {
        title: 'Action',
        key: 'action',
        fixed: 'right',
        width: 100,
    }
  ];

  const totalRecords = ref(0); // Holds the total from API

  const queryData = params => {
    return axios.get('/companies/data', {
      params,
    })

    /* @TODO Below is special in Laravel only. Not needed in the Example from the Docs. WHY? */
    .then(response => {
        totalRecords.value = response.data.meta.total; // Set the total records
        return response.data.data;
    });
    /* end */

  };
  
  const {
    data: dataSource,
    run,
    loading,
    current,
    pageSize,
  } = usePagination(queryData, {
    formatResult: res => res.data.results,
    pagination: {
      currentKey: 'page',
      pageSizeKey: 'results',
    },
  });
  const pagination = computed(() => ({
    total: totalRecords.value,
    current: current.value,
    pageSize: pageSize.value,
  }));
  const handleTableChange = (pag, filters, sorter) => {
    run({
      results: pag.pageSize,
      page: pag?.current,
      sortField: sorter.field,
      sortOrder: sorter.order,
      ...filters,
    });
  };


    const onDelete = (id) => {
        //console.log(id);
        axios.delete(`/companies/${id}`)
            .then(() => {
                run();
            });
    };
  </script>
  