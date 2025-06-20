<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import BlogLayout from '@/layouts/BlogLayout.vue';
import ArticleIndexPage from '@/components/ui/article/ArticleIndexPage.vue';

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
      <nav class="flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            <Link
                v-if="posts.links[0].url"
                :href="posts.links[0].url || '#'"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                preserve-scroll
            ><div v-html="posts.links[0].label"></div></Link>
            <Link
                v-if="posts.links[posts.links.length - 1].url"
                :href="posts.links[posts.links.length - 1].url || '#'"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                preserve-scroll
            ><div v-html="posts.links[posts.links.length - 1].label"></div></Link>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
          <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
              <template v-for="(link, key) in posts.links" :key="key">
                <Link
                  :href="link.url || '#'"
                  class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                  :class="{
                    'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 dark:bg-indigo-900 dark:border-indigo-700 dark:text-indigo-300': link.active,
                    'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700': !link.active && link.url,
                    'bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500': !link.url
                  }"
                  :disabled="!link.url"
                  preserve-scroll
                ><div v-html="link.label"></div></Link>
              </template>
            </span>
          </div>
        </div>
      </nav>
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
