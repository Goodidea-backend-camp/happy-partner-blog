<template>
    <article class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <ArticleHeader :post="post" />
            <ArticleContent :post="post" />
            <ArticleBackToAll />
        </div>
    </article>
</template>

<script setup lang="ts">
import ArticleHeader from '@/components/ui/article/ArticleHeader.vue';
import ArticleContent from '@/components/ui/article/ArticleContent.vue';
import ArticleBackToAll from '@/components/ui/article/ArticleBackToAll.vue';

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
