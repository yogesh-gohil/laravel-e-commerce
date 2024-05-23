<script setup>
defineProps({
  close: {
    type: Function,
    default: null,
  },
})
const route = useRoute()
const routes = ref([
  {
    route: '/dashboard',
    name: 'Dashboard',
    icon: 'pi pi-home',
    active_route: 'dashboard',
  },
  {
    route: '/categories',
    name: 'Category',
    icon: 'pi pi-th-large',
    active_route: 'categories',
  },
  {
    route: '/products',
    name: 'Products',
    icon: 'pi pi-shopping-bag',
    active_route: 'products',

  },
])
const isActiveRoute = (activeRoute) => {
  return route.path.includes(activeRoute)
}
</script>

<template>
  <div class="flex flex-col h-full">
    <div v-if="close" class="flex items-center justify-between px-4 pt-4 shrink-0">
      <span class="inline-flex items-center gap-2">
        <LogoBlack class="sm:w-40 w-auto dark:hidden " />
        <LogoWhite class="sm:w-40 w-auto hidden dark:flex " />
      </span>
      <i class="pi pi-times text-primary-500 cursor-pointer items-center" @click="close" />
    </div>
    <div class="overflow-y-auto mt-4">
      <ul class="list-none px-4 m-0 overflow-hidden">
        <li v-for="(routeItem, i) in routes" :key="i">
          <router-link
            :key="routeItem"
            v-ripple
            :to="routeItem.route"
            class="flex items-center cursor-pointer p-3 rounded-md text-surface-800 dark:text-surface-0/80 hover:bg-surface-100 dark:hover:bg-surface-700 duration-200 transition-colors"
            :class="isActiveRoute(routeItem.active_route) ? 'bg-primary-500/20 text-gray-800 font-semibold dark:bg-gray-900' : ''"
          >
            <i :class="`${routeItem.icon} mr-6`" />
            <span class="text-sm">{{ routeItem.name }}</span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
