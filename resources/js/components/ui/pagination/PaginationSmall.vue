<template>
    <div class="flex-1 flex justify-between sm:hidden">
        <PaginationSmallPrevious :posts="posts" />
        <<PaginationSmallNext :posts="posts" />
    </div>
</template>

<script setup lang="ts">
import PaginationSmallPrevious from './PaginationSmallPrevious.vue';
import PaginationSmallNext from './PaginationSmallNext.vue';

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
