<script setup>
const pageHeader = {
  title: 'Categories',
  breadcrumb: [
    { label: 'Categories', route: '/categories' },
  ],
}
const categoryStore = useCategoryStore()

fetchCategories()

async function fetchCategories(params) {
  await categoryStore.fetchCategories()
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
    <div v-if="categoryStore.categories.length">
      <DataTable :value="categoryStore.categories" striped-rows size="large">
        <Column field="name" header="Name" style="width: 25%" />
        <Column field="created_at" header="Added ON" style="width: 25%" />
        <!-- <Column field="country.name" header="Country" style="width: 25%" />
        <Column field="representative.name" header="Representative" style="width: 25%" /> -->
      </DataTable>
    </div>
  </BasePage>
</template>
