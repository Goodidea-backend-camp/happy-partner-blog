<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import BlogLayout from '@/Layouts/BlogLayout.vue';
import { computed } from 'vue';
import { marked } from 'marked'; // Import marked

// defineProps is a compiler macro and does not need to be imported
const props = defineProps<{
  post: {
    id: number;
    title: string;
    slug: string;
    content: string; // Markdown content
    published_at: string;
    user: {
      name: string;
    };
  };
}>();

// Compute the HTML from markdown content
const renderedContent = computed(() => {
  if (props.post && props.post.content) {
    // Basic Marked usage. For security, consider DOMPurify if content is from untrusted sources.
    // marked.setOptions({ gfm: true, breaks: true, sanitize: false }); // sanitize is deprecated, use a sanitizer lib
    return marked(props.post.content, { gfm: true, breaks: true });
  }
  return '';
});

// Function to format date (basic example)
function formatDate(dateString: string) {
  if (!dateString) return 'N/A';
  const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
}

</script>

<template>
  <Head :title="post.title" />
  <BlogLayout>
    <article class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
      <div class="p-6 md:p-8">
        <header class="mb-6">
          <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-3">{{ post.title }}</h1>
          <div class="text-md text-gray-500 dark:text-gray-400">
            <span>By {{ post.user.name }}</span> &middot;
            <span>Published on {{ formatDate(post.published_at) }}</span>
          </div>
        </header>
        
        <div class="prose dark:prose-invert lg:prose-xl max-w-none" v-html="renderedContent">
          <!-- Rendered Markdown content -->
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
          <Link :href="route('posts.index')" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            &larr; Back to all posts
          </Link>
        </div>
      </div>
    </article>
  </BlogLayout>
</template>

<style scoped>
/* Ensure prose styles apply correctly if not globally configured */
.prose :deep(h1) {
  /* Example of overriding prose styles if needed */
  /* margin-bottom: 0.5em; */
}
/* Add other page-specific styles here */
</style> 