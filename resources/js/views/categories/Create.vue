<script lang="ts" setup>
const route = useRoute()
const router = useRouter()
const categoryStore = useCategoryStore()
const isLoading = ref(false)
const isFetching = ref(false)
const file = ref<File | null>()
// const form = ref<HTMLFormElement>()

const isEdit = computed (() => route.name === 'categories.edit')

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Field is Required.', required),
    },
  }
})

const v$ = useVuelidate(
  rules,
  computed(() => categoryStore.categoryData),
)

if (isEdit.value)
  fetchCategory()

async function fetchCategory() {
  isFetching.value = true
  await categoryStore.fetchCategory(route.params.id)
  isFetching.value = false
}

async function onSubmit() {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true
  isLoading.value = true

  const data = {
    id: route.params.id,
    ...categoryStore.categoryData,
  }

  const action = isEdit.value
    ? categoryStore.updateCategory
    : categoryStore.addCategory

  try {
    isLoading.value = true
    await action(data)
    router.push({ name: 'categories.index' })
  }
  finally {
    // if (isEdit.value)
    // toast.add({ severity: 'success', summary: 'Success Message', detail: 'Message Content', life: 3000 })
    // else
    // toast.add({ severity: 'success', summary: 'Success Message', detail: 'Message Content', life: 3000 })

    isLoading.value = false
  }
}

function onFileChanged($event: Event) {
  const target = $event.target as HTMLInputElement
  if (target && target.files)
    categoryStore.categoryData.image = target.files[0]
}

onBeforeUnmount(() => {
  categoryStore.resetData()
  v$.value.$reset()
})
const pageHeader = {
  title: 'New Category',
  breadcrumb: [
    { label: 'Categories', route: '/categories' },
    { label: 'Create', route: '/categories/create' },
  ],
}
</script>

<template>
  <BasePage>
    <Toast />
    <BasePageHeader :data="pageHeader" />

    <Card class="w-1/2 mt-6">
      <template #content>
        <form class="mt-18 text-left" @submit.prevent="onSubmit">
          <BaseInputGrid layout="column">
            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Image"
              required
            >
              <InputText
                type="file"
                accept="image/*"
                capture
                @change="onFileChanged($event)"
              />
              <!-- <InputText v-model="categoryStore.categoryData.name" :invalid="v$.name.$error" /> -->
            </BaseInputGroup>
          </BaseInputGrid>
          <BaseInputGrid layout="column">
            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Name"
              required
            >
              <InputText v-model="categoryStore.categoryData.name" :invalid="v$.name.$error" />
            </BaseInputGroup>
          </BaseInputGrid>
          <Button
            :disabled="isLoading"
            type="submit"
            class="mt-8"
            :loading="isLoading"
          >
            Save
          </Button>
        </form>
      </template>
    </Card>
  </BasePage>
</template>