<template>
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    <Menubar :model="items" />
                </h1>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import Menubar from 'primevue/menubar';
import { ref } from "vue";

const items = ref([
    {
        label: '快樂小夥伴的部落格',
        url: route('posts.index')
    }
]);
</script>
