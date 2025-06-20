<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BlogLayout from '@/layouts/BlogLayout.vue';
import ArticleIndexPage from '@/components/ui/article/ArticleIndexPage.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';

// Define props from controller
const props = defineProps<{
    posts: {
        data: Array<{
            id: number;
            title: string;
            slug: string;
            content: string; // Full content, we'll need to truncate for preview
            updated_at: string;
            user: {
                name: string;
            };
            // Add other fields from your Post model as needed
        }>;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        // other pagination properties like current_page, last_page, etc., if needed directly
    };
}>();
</script>

<template>

    <Head title="All Posts" />
    <BlogLayout>
        <div class="space-y-8">
            <div v-if="posts.data.length === 0" class="text-center text-gray-500 dark:text-gray-400">
                <p class="text-xl">No posts found.</p>
            </div>

            <ArticleIndexPage v-else :posts="posts" />
        </div>

        <!-- Pagination -->
        <div v-if="posts.data.length > 0 && posts.links.length > 3" class="mt-12">
            <Pagination :posts="posts" />
        </div>
    </BlogLayout>
</template>

<style scoped>
/* Add any page-specific styles here if needed */
.prose {
    white-space: normal;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
</style>
