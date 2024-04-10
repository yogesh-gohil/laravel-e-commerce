<script setup>
const pageHeader = {
  title: 'Products',
  breadcrumb: [
    { label: 'Products', route: '/products' },
  ],
}
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
    <BasePageHeader :data="pageHeader">
      <template #actions>
        <RouterLink :to="{ name: 'products.create' }">
          <Button>Add New Product </Button>
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
      <Column field="name" header="Name" />

      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
