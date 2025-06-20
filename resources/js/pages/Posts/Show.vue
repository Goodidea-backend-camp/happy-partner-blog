<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BlogLayout from '@/layouts/BlogLayout.vue';
import ArticleShowPage from '@/components/ui/article/ArticleShowPage.vue';

// defineProps is a compiler macro and does not need to be imported
const props = defineProps<{
    post: {
        id: number;
        title: string;
        slug: string;
        content: string; // Markdown content
        updated_at: string;
        user: {
            name: string;
        };
    };
}>();

</script>

<template>
    <Head :title="post.title" />
    <BlogLayout>
        <ArticleShowPage :post="post" />
    </BlogLayout>
</template>
