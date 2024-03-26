<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header> Usuarios </template>

        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-blue-500">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                    </path>
                </svg>
            </div>

            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Información</span>
                    <p class="text-sm text-gray-600">
                        Página de tabla de muestra
                    </p>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <input type="text" class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Buscar..." />
        </div>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Correo
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Editar
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <div v-if="editingUser && editingUser.id === user.id">
                                <input v-model="editingUser.name" type="text" class="editing-input" />
                            </div>
                            <p v-else class="text-gray-900 whitespace-no-wrap">
                                {{ user.name }}
                            </p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <div v-if="editingUser && editingUser.id === user.id">
                                <input v-model="editingUser.email" type="text" class="editing-input" />
                            </div>
                            <p v-else class="text-gray-900 whitespace-no-wrap">
                                {{ user.email }}
                            </p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <icon-component :userId="user.id" @edit="(userId) =>
                        (editingUser = users.data.find(
                            (user) => user.id === userId
                        ))
                        "></icon-component>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="users.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import IconComponent from "@/Components/IconComponent.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";


let editingUser = ref(null);

const props = defineProps({
    users: Object,
});

const emit = defineEmits(['edit']);

const saveChanges = (user) => {
    editingUser.value = null;
};
</script>

<style setup>
.editing-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-width: 250px;
    font-size: 14px;
    }

    .text-gray-900 {
        white-space: nowrap;
    }
    </style>

    