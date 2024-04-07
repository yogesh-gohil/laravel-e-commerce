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
          <Button>Add New Category </Button>
        </RouterLink>
      </template>
    </BasePageHeader>
    <DataTable
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
      <Column field="name" header="Name" />

      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
