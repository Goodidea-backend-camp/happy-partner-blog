<template>
  <Head>
    <meta property="og:site_name" content="快樂小夥伴的部落格" head-key="og:site_name" />
  </Head>
  <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            <Link :href="route('posts.index')">快樂小夥伴的部落格</Link>
          </h1>
        </div>
      </div>
    </header>

    <main class="flex-grow py-8">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    <BlogFooter />
  </div>
</template>

<script setup lang="ts">
import { Link, Head } from '@inertiajs/vue3';
import BlogFooter from '@/components/BlogFooter.vue';
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
