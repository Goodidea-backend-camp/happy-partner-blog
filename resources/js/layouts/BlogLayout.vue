<template>
  <Head>
    <title>{{ site.title }}</title>
    <meta name="description" :content="site.description" head-key="description" />
    <meta property="og:site_name" :content="site.title" head-key="og:site_name" />
    <meta property="og:title" :content="site.title" head-key="og:title" />
    <meta property="og:description" :content="site.description" head-key="og:description" />
    <meta property="og:type" content="website" head-key="og:type" />
    <meta property="og:url" :content="site.url" head-key="og:url" />
    <meta property="og:image" :content="site.image" head-key="og:image" />
    <meta property="og:locale" content="zh_TW" head-key="og:locale" />
  </Head>
  <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            <Link :href="route('posts.index')">快樂小夥伴的部落格</Link>
          </h1>
          <!-- Future navigation links can go here -->
          <!-- e.g., About, Contact, Login/Register if needed -->
        </div>
      </div>
    </header>

    <main class="flex-grow py-8">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    <footer class="bg-gray-800 text-white mt-auto py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
        &copy; {{ new Date().getFullYear() }} 快樂小夥伴的部落格. All rights reserved.
        <p class="text-xs text-gray-400 mt-1">Powered by Laravel & Vue</p>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

const site = {
  title: '快樂小夥伴的部落格',
  description: '歡迎來到快樂小夥伴的部落格，這裡會分享各種技術文章與心得。',
  url: 'https://jyu1999.com',
  // image: '/images/og-image.png', // 建立一個預設的分享圖片
};
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
