<template>
    <nav class="flex items-center justify-between">
        <PaginationSmall :posts="posts" />
        <PaginationLarge :posts="posts" />
    </nav>
</template>

<script setup lang="ts">
import PaginationSmall from './PaginationSmall.vue';
import PaginationLarge from './PaginationLarge.vue';

const props = defineProps<{
    posts: {
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
}>();
</script>
