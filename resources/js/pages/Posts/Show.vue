<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import BlogLayout from '@/layouts/BlogLayout.vue';
import { computed } from 'vue';
import * as marked from 'marked';

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

// Compute the HTML from markdown content
const renderedContent = computed(() => {
  if (props.post && props.post.content) {
    try {
      // Initialize marked with options
      marked.setOptions({
        gfm: true,
        breaks: true
      });

      // Parse markdown to HTML
      return marked.parse(props.post.content);
    } catch (error) {
      console.error('Error parsing markdown:', error);
      return props.post.content; // Fallback to raw content if parsing fails
    }
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
            <span>Last Edited at {{ formatDate(post.updated_at) }}</span>
          </div>
        </header>

        <!-- <pre v-if="false" class="text-xs overflow-auto mb-4 p-2 bg-gray-100 dark:bg-gray-900 rounded">{{ post.content }}</pre> -->

        <div class="prose dark:prose-invert lg:prose-xl max-w-none" v-html="renderedContent">
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

<style>
/* Make prose styles global to ensure they affect the rendered content */
.prose {
  width: 100%;
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
}

.prose h1 {
  font-size: 2em;
  margin-top: 0.67em;
  margin-bottom: 0.67em;
}

.prose h2 {
  font-size: 1.5em;
  margin-top: 0.83em;
  margin-bottom: 0.83em;
}

.prose h3 {
  font-size: 1.17em;
  margin-top: 1em;
  margin-bottom: 1em;
}

.prose h4 {
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
}

.prose p {
  margin-top: 1em;
  margin-bottom: 1em;
  max-width: 100%;
  overflow-wrap: break-word;
  word-wrap: break-word;
}

.prose ul {
  list-style-type: disc;
  padding-left: 2em;
  margin-top: 1em;
  margin-bottom: 1em;
}

.prose ol {
  list-style-type: decimal;
  padding-left: 2em;
  margin-top: 1em;
  margin-bottom: 1em;
}

.prose li {
  margin-bottom: 0.5em;
}

.prose blockquote {
  padding-left: 1em;
  border-left: 4px solid #e2e8f0;
  font-style: italic;
  margin: 1em 0;
}

.prose pre {
  padding: 1em;
  background-color: #f7fafc;
  border-radius: 0.25rem;
  overflow-x: auto;
  margin: 1em 0;
  white-space: pre-wrap;       /* Since CSS 2.1 */
  white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
  white-space: -pre-wrap;      /* Opera 4-6 */
  white-space: -o-pre-wrap;    /* Opera 7 */
  word-wrap: break-word;       /* Internet Explorer 5.5+ */
}

.prose code {
  font-family: monospace;
  background-color: #f1f5f9;
  padding: 0.2em 0.4em;
  border-radius: 0.25rem;
  white-space: pre-wrap;
  word-wrap: break-word;
}

.prose pre code {
  white-space: pre-wrap;
}

.prose img {
  max-width: 100%;
  height: auto;
}

.dark .prose code {
  background-color: #1e293b;
}

.dark .prose pre {
  background-color: #0f172a;
}

.dark .prose blockquote {
  border-left-color: #475569;
}
</style>
