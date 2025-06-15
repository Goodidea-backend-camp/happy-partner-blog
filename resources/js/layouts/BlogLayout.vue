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

    <Footer />
  </div>
</template>

<script setup lang="ts">
import Navbar from '@/components/ui/navbar/Navbar.vue';
import Footer from '@/components/ui/footer/Footer.vue';
</script>

<style scoped>
/* Add any layout-specific styles here if needed */
</style>
