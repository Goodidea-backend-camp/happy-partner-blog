<template>
  <footer class="bg-gray-800 text-white mt-auto py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <Toolbar>
        <template #center>
          <div class="text-center text-sm">
            &copy; {{ new Date().getFullYear() }} 快樂小夥伴的部落格. All rights reserved.
            <p class="text-xs text-gray-400 mt-1">Powered by Laravel & Vue</p>
          </div>
        </template>
      </Toolbar>
    </div>
  </footer>
</template>

<script setup lang="ts">
</script>
