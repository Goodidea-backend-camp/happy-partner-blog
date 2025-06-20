<template>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
        <Link :href="route('posts.show', post.slug)" class="hover:underline">
        {{ post.title }}
        </Link>
    </h2>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    post: {
        title: string;
        slug: string;
    };
}>();
</script>
