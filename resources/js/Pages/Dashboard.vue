<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const whiteboards = computed(() => store.getters['whiteboards/whiteboardsList']);

onMounted(() => {
    store.dispatch('whiteboards/fetchWhiteboards');
});

function goToCreate() {
    router.visit('/whiteboards/create');
}

function goToEdit(id) {
    router.visit(`/whiteboards/${id}/edit`);
}

async function deleteWB(id) {
    if (confirm('Are you sure you want to delete this whiteboard?')) {
        await store.dispatch('whiteboards/deleteWhiteboard', id);
    }
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button 
                            @click="goToCreate"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            New Whiteboard
                        </button>
                    </div>
                </div>
                <ul v-if="whiteboards.length" class="mt-4">
                    <li v-for="wb in whiteboards" :key="wb.id" class="bg-white dark:bg-gray-800 p-4 flex justify-between items-center">
                        <span class="text-gray-900 dark:text-gray-100">{{ wb.name }}</span>
                        <button @click="goToEdit(wb.id)"
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Edit
                        </button>
                        <button @click="deleteWB(wb.id)"
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </li>
                </ul>
                <p v-else>No whiteboards found</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
