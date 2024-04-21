<script setup>
const pageHeader = {
  title: 'Categories',
  breadcrumb: [
    { label: 'Categories', route: '/categories' },
  ],
}
const categoryStore = useCategoryStore()
const totalRecords = ref(0)
const loading = ref(false)

const params = reactive({
  page: 0,
  limit: 5,
})

fetchCategories()

async function fetchCategories() {
  loading.value = true

  const res = await categoryStore.fetchCategories(params)

  totalRecords.value = res.data.meta.total

  loading.value = false
}

function onPage({ page }) {
  params.page = page + 1
  fetchCategories()
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="pageHeader">
      <template #actions>
        <RouterLink :to="{ name: 'categories.create' }">
          <Button label="Add Category" icon="pi pi-plus" />
        </RouterLink>
      </template>
    </BasePageHeader>
    <BaseEmptyPlaceholder v-if="!categoryStore.categories.length" title="No Categories Found!" description="This section contains categories.">
      <template #action>
        <RouterLink :to="{ name: 'categories.create' }">
          <Button outlined icon="pi pi-plus" label="Add Category" />
        </RouterLink>
      </template>
    </BaseEmptyPlaceholder>
    <DataTable
      v-else
      :value="categoryStore.categories"
      :rows="5"
      :total-records="totalRecords"
      :loading="loading"
      striped-rows
      lazy
      paginator
      size="large"
      class="mt-10"
      @page="onPage"
    >
      <Column field="image" header="Image">
        <template #body="slotProps">
          <img :src="slotProps.data.image" class="h-10 w-10 rounded-md">
        </template>
      </Column>
      <Column field="name" header="Name" />

      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
      <Column header-style="width: 5rem; text-align: center" body-style="text-align: center; overflow: visible">
        <template #body>
          <Button type="button" icon="pi pi-cog" rounded />
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
