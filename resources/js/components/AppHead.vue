<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
  title?: string;
}>();
</script>

<template>
  <Head :title="title ? `${title} - 快樂小夥伴的部落格` : '快樂小夥伴的部落格'">
    <slot />
  </Head>
</template> 