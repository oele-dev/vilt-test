<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';


const props = defineProps({
    customer: {
        type: Object
    },
})

const confirmingUserDeletion = ref(false);

const form = useForm({});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const deleteCustomer = () => {
    form.delete(route('customers.destroy', props.customer.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete Customer</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Once your this Customer is deleted, all of its resources and data will be permanently deleted
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete Customer</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this Customer?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once this Customer is deleted, all of its resources and data will be permanently deleted.
                </p>

                <div class="flex justify-end mt-6">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteCustomer"
                    >
                        Delete Customer
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
