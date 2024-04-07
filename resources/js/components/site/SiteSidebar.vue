<script setup>
const userStore = useUserStore()
const visible = ref(false)
const checked = ref(false)

const globalStore = useGlobalStore()

const isDark = ref(
  localStorage.getItem('theme') === 'dark'
    || document.documentElement.classList.contains('dark'),
)

globalStore.isDarkModeOn = isDark.value
setTheme(isDark.value)

const enabled = computed({
  get: () => globalStore.isDarkModeOn,
  set: (value) => {
    globalStore.isDarkModeOn = value
    setTheme(value)
  },
})
function setTheme(value) {
  if (value) {
    localStorage.setItem('theme', 'dark')
    document.documentElement.classList.add('dark')
    document.documentElement.style.setProperty('color-scheme', 'dark')
  }
  else {
    localStorage.setItem('theme', 'light')
    document.documentElement.classList.remove('dark')
    document.documentElement.style.setProperty('color-scheme', 'light')
  }
}
</script>

<template>
  <div class="card flex justify-center md:hidden">
    <Sidebar v-model:visible="userStore.isVisible">
      <template #container="{ closeCallback }">
        <MenuList key="mobile" :close="closeCallback" />
      </template>
    </Sidebar>
  </div>
  <!-- DESKTOP MENU -->
  <div
    class="
      hidden
      w-56
      h-screen
      bg-white
      border-r border-gray-200 border-solid
      xl:w-64
      md:fixed md:flex md:flex-col md:inset-y-0
      pt-16
      dark:border-gray-800
      dark:bg-gray-800/80
    "
  >
    <div
      class="
        scrollbar-track-transparent
        scrollbar
        scrollbar-thin
        scrollbar-thumb-rounded
        scrollbar-thumb-gray-300
        dark:scrollbar-thumb-gray-600
        overflow-y-auto
        w-full
        flex flex-col
        relative
        h-full
        justify-between
      "
    >
      <MenuList key="desktop" />
    </div>
    <div class="mt-auto">
      <hr class="mb-3 mx-3 border-top-1 border-none surface-border">
      <div class="m-3 flex align-items-center cursor-pointer p-3 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors">
        <InputSwitch v-model="enabled" />
      </div>
    </div>
  </div>
</template>
