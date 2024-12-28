<template>
    <AuthenticatedLayout>

        <Head title="Edit Whiteboard" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-semibold mb-4">Edit Whiteboard</h1>

                <form @submit.prevent="onSubmit" class="flex flex-col gap-4 w-full max-w-md mb-8 text-black">
                    <input v-model="name" class="border p-2" type="text" placeholder="Whiteboard name" />
                    <textarea v-model="description" class="border p-2" placeholder="Description (optional)"></textarea>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Update
                        </button>
                    </div>
                </form>
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2">Participants</h2>
                    <div class="flex gap-2 items-center mb-4">
                        <input v-model="inviteEmail" class="border p-2 text-black" type="email"
                            placeholder="Enter participant email" />
                        <button @click="addParticipantToWhiteboard"
                            class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                            Add
                        </button>
                    </div>
                    <ul>
                        <li v-for="(participant, index) in participants" :key="index"
                            class="flex items-center gap-2 mb-1">
                            <span>{{ participant.email }}</span>
                            <button @click="removeParticipantFromWhiteboard(participant.id)"
                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Remove
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import { Head, router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const store = useStore();
const page = usePage();

const whiteboardId = page.props.whiteboard;

const name = ref('');
const description = ref('');
const inviteEmail = ref('');

const whiteboard = computed(() => {
    return store.getters['whiteboards/getWhiteboard'];
});

const participants = computed(() => {
    return whiteboard.value?.participants || [];
});

onMounted(async () => {
    await store.dispatch('whiteboards/fetchWhiteboard', whiteboardId);
});

name.value = whiteboard.value?.name;
description.value = whiteboard.value?.description;

async function onSubmit() {
    try {
        await store.dispatch('whiteboards/updateWhiteboard', {
            id: whiteboardId,
            payload: {
                name: name.value,
                description: description.value,
            },
        });
        router.visit('/dashboard');
    } catch (error) {
        console.error('Update failed:', error);
    }
}

async function addParticipantToWhiteboard() {
    if (!inviteEmail.value) return;
    try {
        await store.dispatch('whiteboards/addParticipant', {
            whiteboardId: whiteboardId,
            email: inviteEmail.value,
        });
        inviteEmail.value = '';
    } catch (error) {
        console.error('Add participant failed:', error);
    }
}

async function removeParticipantFromWhiteboard(userId) {
    if (!userId) return;
    try {
        await store.dispatch('whiteboards/removeParticipant', {
            whiteboardId: whiteboardId,
            userId,
        });
    } catch (error) {
        console.error('Remove participant failed:', error);
    }
}
</script>