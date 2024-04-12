<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SearchInput from '@/Components/SearchInput.vue';

const props = defineProps({
    customers: {
        type: Object,
        required: true
    },
    status: {
        type: String,
    },
    search : {
        type:String,
        required:false
    }
})

const form = useForm({
    search: props.search,
});

const searchCustomers = () => {
    form.get(route('customers.index'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
        },
    });
};

</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Customers</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
               <div class="flex justify-between gap-2 mb-4">
                <div>
                    <SearchInput placeholder="Search..." type="search" v-model="form.search" @update:modelValue="searchCustomers"  />
                </div>
                <div class="flex gap-2">
                    <div v-if="status" class="px-4 py-2 text-white bg-green-500 border rounded-md dark:text-gray-400 dark:hover:text-gray-100">
                        {{ status }}
                    </div>

                    <a
                            :href="route('customers.export', {'search' : form.search})"
                            target="blank"
                            download
                            class="px-4 py-2 text-white bg-blue-500 border rounded-md dark:text-gray-400 hover:text-gray-200 dark:hover:text-gray-100"
                        >
                            Export
                    </a>

                    <Link
                            :href="route('customers.create')"
                            class="px-4 py-2 text-white bg-indigo-500 border rounded-md dark:text-gray-400 hover:text-gray-200 dark:hover:text-gray-100"
                        >
                            Create
                    </Link>
                </div>

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
