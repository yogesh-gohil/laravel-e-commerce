<script setup>
defineProps({
  file: { type: Object, required: true },
  tag: { type: String, default: 'li' },
})

defineEmits(['remove'])
</script>

<template>
  <component :is="tag" class="w-40 h-40 m-4 mx-3 relative aspect-square overflow-hidden rounded-md border border-gray-500 p-2">
    <button type="button" class="absolute right-2 top-1 h-5" @click="$emit('remove', file)">
      <i class="pi pi-trash text-red-500 text-lg" />
    </button>
    <img :src="file.url" :alt="file.name" :title="file.name" class="object-contain rounded-md w-40 h-36">
  </component>
</template>

