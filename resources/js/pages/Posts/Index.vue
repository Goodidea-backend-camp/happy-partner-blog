<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import BlogLayout from '@/Layouts/BlogLayout.vue';
// import * as marked from 'marked'; // Unused in this component
import { computed } from 'vue';
// import { defineProps } from 'vue'; // defineProps is a compiler macro

// Assuming shadcn/vue components are available or will be added
// For example, using placeholder divs if Card is not yet added via CLI
// import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/components/ui/card';
// import { Button } from '@/components/ui/button';

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

// Function to truncate content for preview
function truncate(text: string, length: number, suffix = '...') {
  if (!text) return '';
  
  // For plain text truncation (safer approach)
  if (text.length <= length) {
    return text;
  }
  
  // Find a good breakpoint (word boundary) to truncate at
  let truncatedText = text.substring(0, length);
  
  // If we're in the middle of a word, go back to the last space
  const lastSpace = truncatedText.lastIndexOf(' ');
  if (lastSpace > length * 0.8) { // Only if the space is reasonably far in the text
    truncatedText = truncatedText.substring(0, lastSpace);
  }
  
  return truncatedText + suffix;
}

// Function to format plain text preview from markdown
function getPreviewText(markdown: string, length: number = 150): string {
  if (!markdown) return '';
  
  // Remove markdown characters for a plain text preview
  let plainText = markdown
    .replace(/#{1,6}\s+/g, '') // Remove headers
    .replace(/(\*\*|__)(.*?)\1/g, '$2') // Remove bold
    .replace(/(\*|_)(.*?)\1/g, '$2') // Remove italic
    .replace(/~~(.*?)~~/g, '$1') // Remove strikethrough
    .replace(/\[(.*?)\]\(.*?\)/g, '$1') // Remove links but keep link text
    .replace(/!\[(.*?)\]\(.*?\)/g, '$1') // Remove images but keep alt text
    .replace(/```[\s\S]*?```/g, '') // Remove code blocks
    .replace(/`([^`]*)`/g, '$1') // Remove inline code
    .replace(/(- |\d+\. )/g, '') // Remove list markers
    .replace(/\n/g, ' ') // Replace newlines with spaces
    .replace(/\s+/g, ' ') // Normalize whitespace
    .trim();
  
  return truncate(plainText, length);
}

// Pre-compute the previews to avoid reactivity issues
const postPreviews = computed(() => {
  return props.posts.data.map(post => ({
    ...post,
    previewText: getPreviewText(post.content)
  }));
});

// Function to format date (basic example)
function formatDate(dateString: string) {
  if (!dateString) return 'N/A';
  const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
}
</script>

<template>
  <Head title="All Posts" />
  <BlogLayout>
    <div class="space-y-8">
      <div v-if="posts.data.length === 0" class="text-center text-gray-500 dark:text-gray-400">
        <p class="text-xl">No posts found.</p>
      </div>

      <article v-for="post in postPreviews" :key="post.id"
               class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <div class="p-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
            <Link :href="route('posts.show', post.slug)" class="hover:underline">
              {{ post.title }}
            </Link>
          </h2>
          <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            <span>By {{ post.user.name }}</span> &middot;
            <span>Last Edited at {{ formatDate(post.updated_at) }}</span>
          </div>
          <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-4 break-words">
            {{ post.previewText }}
          </div>
          <div class="mt-4">
            <Link :href="route('posts.show', post.slug)"
                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
              Read more &rarr;
            </Link>
          </div>
        </div>
      </article>
    </div>

    <!-- Pagination -->
    <div v-if="posts.data.length > 0 && posts.links.length > 3" class="mt-12">
      <nav class="flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            <Link
                v-if="posts.links[0].url"
                :href="posts.links[0].url || '#'"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                v-html="posts.links[0].label"
                preserve-scroll
            />
            <Link
                v-if="posts.links[posts.links.length - 1].url"
                :href="posts.links[posts.links.length - 1].url || '#'"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                v-html="posts.links[posts.links.length - 1].label"
                preserve-scroll
            />
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
          <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
              <template v-for="(link, key) in posts.links" :key="key">
                <Link
                  :href="link.url || '#'"
                  v-html="link.label"
                  class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                  :class="{
                    'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 dark:bg-indigo-900 dark:border-indigo-700 dark:text-indigo-300': link.active,
                    'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700': !link.active && link.url,
                    'bg-gray-100 border-gray-300 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500': !link.url
                  }"
                  :disabled="!link.url"
                  preserve-scroll
                />
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
