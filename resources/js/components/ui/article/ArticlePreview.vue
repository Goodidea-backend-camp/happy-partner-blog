<template>
    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-4 break-words">
        {{ post.previewText }}
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    post: {
        previewText: string;
    };
}>();
</script>
