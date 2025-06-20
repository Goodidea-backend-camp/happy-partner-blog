<template>
    <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        <span>By {{ post.user.name }}</span> &middot;
        <span>Last Edited at {{ formatDate(post.updated_at) }}</span>
    </div>
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
