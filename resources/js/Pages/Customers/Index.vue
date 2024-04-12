<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ customers: Object })

</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Customers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">#</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">FirstName</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">LastName</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Email</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(customer) in customers.data"
                                :key="customer.id"
                                class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ customer.index }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ customer.first_name }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ customer.last_name }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ customer.email }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ customer.phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <pagination class="mt-6" :links="customers.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
