<script lang="js" setup>
const props = defineProps({
  date: {
    type: String,
    default: '',
  },
  format: {
    type: String,
    default: 'DD MMM YYYY',
  },
})
const formattedDate = computed(() => dayjs(props.date).format(props.format))
</script>

<template>
  <span class="whitespace-nowrap">
    {{ formattedDate }}
  </span>
</template>
