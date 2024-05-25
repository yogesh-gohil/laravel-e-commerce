<script setup>
const router = useRouter()
const userStore = useUserStore()

const menu = ref()
const items = shallowRef([
  {
    label: 'Settings',
    icon: 'pi pi-cog',
  },
  {
    label: 'Logout',
    icon: 'pi pi-upload',
    command: () => {
      logout()
    },
  },
])

function toggle(event) {
  menu.value.toggle(event)
}

function logout() {
  userStore.logout()
  router.push('/login')
}
</script>

<template>
  <header
    class="
      fixed
      top-0
      left-0
      z-20
      flex
      items-center
      justify-between
      w-full
      px-4
      py-3
      md:h-16 md:px-8
      bg-gradient-to-r
      from-primary-200/70
      to-primary-300/70
      dark:from-gray-700/70 dark:to-gray-800/70
      bg-primary-400
      dark:bg-transparent
      dark:backdrop-blur-xl
      dark:shadow-glass
      dark:border
      dark:border-white/10
    "
  >
    <a
      href="javascript:void(0)"
      class="
        hidden
        md:block
      "
      @click="router.push('/dashboard')"
    >
      <span class="inline-flex items-center">
        <LogoBlack class="sm:w-40 w-auto dark:hidden " />
        <LogoWhite class="sm:w-40 w-auto hidden dark:flex " />
      </span>
    </a>

    <!-- toggle button -->
    <div
      class="
        flex
        float-left
        border-0
        cursor-pointer
        md:hidden md:ml-0
        dark:bg-gray-800 dark:border-gray-500 dark:border
      "
    >
      <Button icon="pi pi-bars" @click="userStore.isVisible = !userStore.isVisible" />
    </div>

    <ul class="flex float-right h-8 m-0 list-none md:h-9">
      <!-- User Dropdown -->
      <li class="relative block float-left ml-2">
        <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" shape="circle" aria-controls="overlay_menu" @click="toggle" />
        <!-- <Button type="button" icon="pi pi-ellipsis-v"    /> -->
        <Menu id="overlay_menu" ref="menu" :model="items" aria-haspopup="true" :popup="true" />
      </li>
    </ul>
  </header>
</template>
