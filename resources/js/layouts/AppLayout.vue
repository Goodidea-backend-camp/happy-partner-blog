<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <header class="bg-white dark:bg-gray-800 shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
          <Link :href="route('posts.index')">My Awesome Blog</Link>
        </h1>
        <!-- Navigation can be added here later -->
      </div>
    </header>

    <main class="py-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    <footer class="bg-white dark:bg-gray-800 mt-auto py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 dark:text-gray-400">
        &copy; {{ new Date().getFullYear() }} My Awesome Blog. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
