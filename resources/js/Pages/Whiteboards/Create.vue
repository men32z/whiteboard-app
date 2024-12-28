<template>
    <AuthenticatedLayout>
        <Head title="Create Whiteboard" />

        <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold mb-4">Create a New Whiteboard</h1>
                <form @submit.prevent="onSubmit" class="flex flex-col gap-4 text-black">
                    <input v-model="name" class="border p-2" type="text" placeholder="Whiteboard name" />
                    <textarea v-model="description" class="border p-2" placeholder="Description (optional)"></textarea>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';
import { router, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';    

const store = useStore();

const name = ref('');
const description = ref('');

async function onSubmit() {
    try {
        await store.dispatch('whiteboards/createWhiteboard', {
            name: name.value,
            description: description.value,
        });

        router.visit('/dashboard');
    } catch (error) {
        console.error(error);
    }
}
</script>