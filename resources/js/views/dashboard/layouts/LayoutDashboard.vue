<script setup>
const userStore = useUserStore()

onMounted(async () => {
  await userStore.getAuthUser()
})
</script>

<template>
  <div v-if="userStore.isLoggedIn" class="h-full pt-16 dark:bg-surface-900 dark:text-white">
    <SiteHeader />
    <SiteSidebar />
    <main
      class="
        h-screen h-screen-ios
        overflow-y-auto
        md:pl-56
        xl:pl-64
        min-h-0
        dark:scrollbar-track-transparent
        dark:scrollbar
        dark:scrollbar-thin
        dark:scrollbar-thumb-gray-600
        "
    >
      <div class="pb-16">
        <RouterView />
      </div>
    </main>
  </div>
</template>
