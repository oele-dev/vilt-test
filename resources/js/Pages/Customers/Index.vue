<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    customers: Object,
    status: {
        type: String,
    },
})

</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Customers</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="status" class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                    {{ status }}
                </div>

                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-900">#</th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-900">FirstName</th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-900">LastName</th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-900">Email</th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-900">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(customer) in customers.data"
                                :key="customer.id"
                                class="transition duration-300 ease-in-out bg-white border-b hover:bg-gray-100">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ customer.index }}</td>
                                <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                     <Link
                                        :href="route('customers.edit', customer.id)"
                                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    >
                                    {{ customer.first_name }}
                                    </Link>
                                </td>
                                <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">{{ customer.last_name }}</td>
                                <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">{{ customer.email }}</td>
                                <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">{{ customer.phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <pagination class="mt-6" :links="customers.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
