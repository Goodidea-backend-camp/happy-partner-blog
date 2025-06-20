<template>
    <header class="mb-6">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-3">{{ post.title }}</h1>
        <div class="text-md text-gray-500 dark:text-gray-400">
            <span>By {{ post.user.name }}</span> &middot;
            <span>Last Edited at {{ formatDate(post.updated_at) }}</span>
        </div>
    </header>
</template>

<script setup lang="ts">
const props = defineProps<{
    post: {
        title: string;
        updated_at: string;
        user: {
            name: string;
        };
    };
}>();

function formatDate(dateString: string) {
    if (!dateString) return 'N/A';
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
}
</script>
