<template>
    <div class="prose dark:prose-invert lg:prose-xl max-w-none" v-html="renderedContent">
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import * as marked from 'marked';

const props = defineProps<{
    post: {
        content: string; // Markdown content
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
</script>

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
    white-space: pre-wrap;
    /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;
    /* Mozilla, since 1999 */
    white-space: pre-wrap;
    /* Opera 4-6 */
    white-space: -o-pre-wrap;
    /* Opera 7 */
    word-wrap: break-word;
    /* Internet Explorer 5.5+ */
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
