<script lang="ts" setup>
import { useToast } from 'primevue/usetoast'

const route = useRoute()
const router = useRouter()
const categoryStore = useCategoryStore()
const isSubmitting = ref(false)
const isFetching = ref(false)
const categoryPhoto = ref<File | null>()
const toast = useToast()
const { categoryCreateHeader, categoryEditHeader } = usePageHeader()

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
  isSubmitting.value = true

  const data = {
    id: route.params.id,
    ...categoryStore.categoryData,
  }

  if (data.image !== 'null')
    delete data.image

  if (categoryPhoto.value)
    data.image = categoryPhoto.value.file

  if (isEdit.value)
    data._method = 'PUT'
  const action = isEdit.value
    ? categoryStore.updateCategory
    : categoryStore.addCategory

  try {
    isSubmitting.value = true
    const res = await action(data)
    if (res.data) {
      toast.add({
        severity: 'success',
        detail: isEdit.value ? 'Category updated successfully' : 'Category created successfully',
        life: 2000,
      })
    }
    router.push({ name: 'categories.index' })
  }
  finally {
    isSubmitting.value = false
  }
}

onBeforeUnmount(() => {
  categoryStore.resetData()
  v$.value.$reset()
})

function removeImage() {
  categoryStore.categoryData.image = 'null'
}
</script>

<template>
  <BasePage>
    <Toast />
    <BasePageHeader :data="isEdit ? categoryEditHeader(categoryStore.categoryData) : categoryCreateHeader" />
    <Card v-if="!isFetching" class="w-full md:w-1/2 mt-6">
      <template #content>
        <form class="mt-18 text-left" @submit.prevent="onSubmit">
          <BaseInputGrid layout="column">
            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Image"
              required
            >
              <BaseDropZone key="cover" v-model="categoryPhoto" :images="[categoryStore.categoryData.image]" class="!w-full" @remove="removeImage" />
            </BaseInputGroup>

            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Name"
              required
            >
              <InputText v-model="categoryStore.categoryData.name" :invalid="v$.name.$error" />
            </BaseInputGroup>
          </BaseInputGrid>
          <Button
            :disabled="isSubmitting"
            type="submit"
            class="mt-8"
            :loading="isSubmitting"
          >
            Save
          </Button>
        </form>
      </template>
    </Card>
  </BasePage>
</template>
