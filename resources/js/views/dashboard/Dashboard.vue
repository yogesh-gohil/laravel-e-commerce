<script setup>
const userStore = useUserStore()
</script>

<template>
  <div v-if="userStore.isLoggedIn" class="text-gray-500 text-3xl">
    👋 Welcome Back , <span v-if="userStore.currentUser.name" class="text-primary-500 font-base capitalize">{{ userStore.currentUser.name }}</span>
  </div>
</template>
