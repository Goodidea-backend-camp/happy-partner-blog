<template>
  <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
      <Navbar />
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
import Navbar from '@/components/ui/navbar/Navbar.vue';
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
