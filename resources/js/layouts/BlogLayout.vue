<template>
  <Head>
    <meta property="og:site_name" content="快樂小夥伴的部落格" head-key="og:site_name" />
  </Head>
  <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <BlogHeader />

    <main class="flex-grow py-8">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    <BlogFooter />
  </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BlogFooter from '@/components/BlogFooter.vue';
import BlogHeader from '@/components/BlogHeader.vue';
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
