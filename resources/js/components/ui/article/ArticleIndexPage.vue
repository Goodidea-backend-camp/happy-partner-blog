<template>
    <article v-for="post in postPreviews" :key="post.id"
        class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <div class="p-6">
            <ArticleTitle :post="post" />
            <ArticleDescription :post="post" />
            <ArticlePreview :post="post" />
            <ArticleReadmore :post="post" />
        </div>
    </article>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import ArticleTitle from '@/components/ui/article/ArticleTitle.vue';
import ArticleDescription from '@/components/ui/article/ArticleDescription.vue';
import ArticlePreview from '@/components/ui/article/ArticlePreview.vue';
import ArticleReadmore from '@/components/ui/article/ArticleReadmore.vue';

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
  const plainText = markdown
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
</script>
