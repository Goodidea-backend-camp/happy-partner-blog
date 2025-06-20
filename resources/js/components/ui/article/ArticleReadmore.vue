<template>
    <div class="mt-4">
        <Link :href="route('posts.show', post.slug)"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
        Read more &rarr;
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    post: {
        slug: string;
    };
}>();
</script>
