<script lang="ts" setup>
const props = defineProps({
  data: {
    type: Object,
    default: null,
    required: true,
  },
  extraClass: {
    type: String,
    default: '',
  },
})
const home = {
  name: 'Home',
  icon: 'pi pi-home',
  route: '/dashboard',
}
</script>

<template>
  <div class="flex flex-wrap items-center justify-between">
    <div>
      <h3 class="text-2xl font-bold text-left text-black dark:text-white">
        {{ data.title }}
      </h3>

      <Breadcrumb v-if="data.breadcrumb" :home="home" :model="data.breadcrumb">
        <template #item="{ item, props }">
          <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
            <a :href="href" v-bind="props.action" @click="navigate">
              <span class="text-color" :class="[item.icon]" />
              <span class="text-primary-500 dark:text-primary-400 font-semibold">{{ item.label }}</span>
            </a>
          </router-link>
          <a v-else :href="item.url" :target="item.target" v-bind="props.action">
            <span class="text-surface-700 dark:text-surface-0/80">{{ item.label }}</span>
          </a>
        </template>
      </Breadcrumb>
      <slot v-else />
    </div>
    <div
      v-if="$slots.actions"
      class="mt-4 md:mt-0 flex items-center w-full md:w-auto pb-4 md:pb-0"
      :class="extraClass"
    >
      <slot name="actions" />
    </div>
  </div>
</template>
