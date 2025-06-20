<template>
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <Link :href="route('posts.index')" class="text-indigo-600 dark:text-indigo-400 hover:underline">
        &larr; Back to all posts
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
