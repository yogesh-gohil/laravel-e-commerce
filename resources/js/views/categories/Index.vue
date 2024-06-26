<script setup>
const categoryStore = useCategoryStore()
const totalRecords = ref(0)
const loading = ref(false)
const { categoryIndexHeader } = usePageHeader()
const LIMIT = 5
const params = reactive({
  page: 1,
  limit: LIMIT,
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

function toggle(event) {
  categoryRef.value.toggle(event)
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="categoryIndexHeader">
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
      :rows="LIMIT"
      :total-records="totalRecords"
      :loading="loading"
      striped-rows
      lazy
      paginator
      size="large"
      class="mt-10"
      @page="onPage"
    >
      <Column field="cover_url" header="Image">
        <template #body="slotProps">
          <img :src="slotProps.data.cover_url ?? '/images/default.png'" class="h-10 w-10 rounded-md object-contain">
        </template>
      </Column>
      <Column field="name" header="Name" />

      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
      <Column header-style="width: 5rem; text-align: center" body-style="text-align: center; overflow: visible">
        <template #body="slotProps">
          <router-link :to="{ name: 'categories.edit', params: { id: slotProps.data.id } }">
            <i class="pi pi-pencil h-10 w-10" />
          </router-link>
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
