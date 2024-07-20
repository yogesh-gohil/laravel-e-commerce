<script setup>
const brandStore = useBrandStore()
const totalRecords = ref(0)
const loading = ref(false)
const { brandIndexHeader } = usePageHeader()
const LIMIT = 5
const params = reactive({
  page: 1,
  limit: LIMIT,
})

fetchBrands()

async function fetchBrands() {
  loading.value = true

  const res = await brandStore.fetchBrands(params)

  totalRecords.value = res.data.meta.total

  loading.value = false
}

function onPage({ page }) {
  params.page = page + 1
  fetchBrands()
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="brandIndexHeader">
      <template #actions>
        <RouterLink :to="{ name: 'brands.create' }">
          <Button label="Add Brand" icon="pi pi-plus" />
        </RouterLink>
      </template>
    </BasePageHeader>
    <BaseEmptyPlaceholder v-if="!brandStore.brands.length" title="No Brands Found!" description="This section contains brands.">
      <template #action>
        <RouterLink :to="{ name: 'brands.create' }">
          <Button outlined icon="pi pi-plus" label="Add Brand" />
        </RouterLink>
      </template>
    </BaseEmptyPlaceholder>
    <DataTable
      v-else
      :value="brandStore.brands"
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
      <Column field="brand_img_url" header="Image">
        <template #body="slotProps">
          <img :src="slotProps.data.brand_img_url ?? '/images/default.png'" class="h-10 w-10 rounded-md object-contain">
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
          <router-link :to="{ name: 'brands.edit', params: { id: slotProps.data.id } }">
            <i class="pi pi-pencil h-10 w-10" />
          </router-link>
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
