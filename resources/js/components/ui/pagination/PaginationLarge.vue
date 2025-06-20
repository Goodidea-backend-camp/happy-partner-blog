<template>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                <template v-for="(link, key) in posts.links" :key="key">
                    <PaginationLargeButton :link="link" />
                </template>
            </span>
        </div>
    </div>
</template>

<script setup lang="ts">
import PaginationLargeButton from './PaginationLargeButton.vue';

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
