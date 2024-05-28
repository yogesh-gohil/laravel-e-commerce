<script setup>
const { productIndexHeader } = usePageHeader()
const productStore = useProductStore()
const totalRecords = ref(0)
const loading = ref(false)

const params = reactive({
  page: 0,
  limit: 5,
})

fetchProducts()

async function fetchProducts() {
  loading.value = true

  const res = await productStore.fetchProducts(params)

  totalRecords.value = res.data.meta.total

  loading.value = false
}

function onPage({ page }) {
  params.page = page + 1
  fetchProducts()
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="productIndexHeader">
      <template #actions>
        <RouterLink :to="{ name: 'products.create' }">
          <Button icon="pi pi-plus" label="Add Product" />
        </RouterLink>
      </template>
    </BasePageHeader>
    <BaseEmptyPlaceholder v-if="!productStore.products.length" title="No Products Found!" description="This section contains products.">
      <template #action>
        <RouterLink :to="{ name: 'products.create' }">
          <Button outlined icon="pi pi-plus" label="Add Product" />
        </RouterLink>
      </template>
    </BaseEmptyPlaceholder>
    <DataTable
      v-else
      :value="productStore.products"
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
      <Column field="cover_url" header="Cover photo">
        <template #body="slotProps">
          <img :src="slotProps.data.cover_url ?? '/images/default.png'" class="h-10 w-10 rounded-md object-contain">
        </template>
      </Column>
      <Column field="name" header="Name" />
      <Column field="category" header="Category">
        <template #body="slotProps">
          {{ slotProps.data.category.name }}
        </template>
      </Column>
      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
      <Column header-style="width: 5rem; text-align: center" body-style="text-align: center; overflow: visible">
        <template #body="slotProps">
          <router-link :to="{ name: 'products.edit', params: { id: slotProps.data.id } }">
            <i class="pi pi-pencil h-10 w-10" />
          </router-link>
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
