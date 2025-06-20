<template>
    <Link v-if="posts.links[posts.links.length - 1].url" :href="posts.links[posts.links.length - 1].url || '#'"
        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
        preserve-scroll>
    <div v-html="posts.links[posts.links.length - 1].label"></div>
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    posts: {
        links: Array<{
            url: string | null;
            label: string;
        }>;
    };
}>();
</script>
