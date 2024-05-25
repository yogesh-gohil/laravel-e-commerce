<script setup lang="js">
const props = defineProps({
  title: {
    required: false,
    default: 'No Data Found!',
  },
  description: {
    required: false,
    default: 'This section contains data of related table!',
  },
})
</script>

<template>
  <div class=" border-dashed border-2 border-gray-300 rounded-md dark:border-gray-500 flex flex-col items-center justify-center mt-10 p-6 ">
    <i class="pi pi-exclamation-circle text-3xl mb-2 text-gray-600 dark:text-gray-400" />
    <p class="text-xl text-gray-500 dark:text-gray-400">
      {{ title }}
    </p>
    <p class="text-sm text-gray-400 mb-2 dark:text-gray-300">
      {{ description }}
    </p>
    <div class="my-4">
      <slot name="action" />
    </div>
  </div>
</template>
