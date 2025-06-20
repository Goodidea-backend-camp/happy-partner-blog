<template>
    <Link :href="link.url || '#'" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="{
        'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 dark:bg-indigo-900 dark:border-indigo-700 dark:text-indigo-300': link.active,
        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700': !link.active && link.url,
        'bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500': !link.url
    }" :disabled="!link.url" preserve-scroll>
    <div v-html="link.label"></div>
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    link: {
        url: string | null;
        label: string;
        active: boolean;
    };
}>();
</script>
