<script setup>
const bannerStore = useBannerStore()
const totalRecords = ref(0)
const loading = ref(false)
const { bannerIndexHeader } = usePageHeader()
const LIMIT = 5
const params = reactive({
  page: 1,
  limit: LIMIT,
})

fetchBanners()

async function fetchBanners() {
  loading.value = true

  const res = await bannerStore.fetchBanners(params)

  totalRecords.value = res.data.meta.total

  loading.value = false
}

function onPage({ page }) {
  params.page = page + 1
  fetchBanners()
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="bannerIndexHeader">
      <template #actions>
        <RouterLink :to="{ name: 'banners.create' }">
          <Button label="Add Banner" icon="pi pi-plus" />
        </RouterLink>
      </template>
    </BasePageHeader>
    <BaseEmptyPlaceholder v-if="!bannerStore.banners.length" title="No Banners Found!" description="This section contains banners.">
      <template #action>
        <RouterLink :to="{ name: 'banners.create' }">
          <Button outlined icon="pi pi-plus" label="Add Banner" />
        </RouterLink>
      </template>
    </BaseEmptyPlaceholder>
    <DataTable
      v-else
      :value="bannerStore.banners"
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
      <Column field="banner_url" header="Image">
        <template #body="slotProps">
          <img :src="slotProps.data.banner_url ?? '/images/default.png'" class="h-10 w-10 rounded-md object-contain">
        </template>
      </Column>
      <Column field="name" header="Name" />
      <Column field="active" header="Active">
        <template #body="slotProps">
          <Badge v-if="slotProps.data.active" value="ACTIVE" size="xsmall" severity="success" class="text-sm font-normal" />
          <Badge v-else value="INACTIVE" size="xsmall" severity="danger" class="text-sm font-normal" />
        </template>
      </Column>

      <Column field="created_at" header="Added ON">
        <template #body="slotProps">
          <BaseDateFormat :date="slotProps.data.created_at" />
        </template>
      </Column>
      <Column header-style="width: 5rem; text-align: center" body-style="text-align: center; overflow: visible">
        <template #body="slotProps">
          <router-link :to="{ name: 'banners.edit', params: { id: slotProps.data.id } }">
            <i class="pi pi-pencil h-10 w-10" />
          </router-link>
        </template>
      </Column>
    </DataTable>
  </BasePage>
</template>
