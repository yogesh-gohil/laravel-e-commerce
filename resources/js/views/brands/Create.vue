<script lang="ts" setup>
import { useToast } from 'primevue/usetoast'

const route = useRoute()
const router = useRouter()
const brandStore = useBrandStore()
const isSubmitting = ref(false)
const isFetching = ref(false)
const brandPhoto = ref<File | null>()
const toast = useToast()
const { brandCreateHeader, brandEditHeader } = usePageHeader()

const isEdit = computed (() => route.name === 'brands.edit')

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Field is Required.', required),
    },
  }
})

const v$ = useVuelidate(
  rules,
  computed(() => brandStore.brandData),
)

if (isEdit.value)
  fetchBrand()

async function fetchBrand() {
  isFetching.value = true
  await brandStore.fetchBrand(route.params.id)
  isFetching.value = false
}

async function onSubmit() {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true
  isSubmitting.value = true

  const data = {
    id: route.params.id,
    ...brandStore.brandData,
  }

  if (data.image !== 'null')
    delete data.image

  if (brandPhoto.value)
    data.image = brandPhoto.value.file

  if (isEdit.value)
    data._method = 'PUT'
  const action = isEdit.value
    ? brandStore.updateBrand
    : brandStore.addBrand

  try {
    isSubmitting.value = true
    const res = await action(data)
    if (res.data) {
      toast.add({
        severity: 'success',
        detail: isEdit.value ? 'Brand updated successfully' : 'Brand created successfully',
        life: 2000,
      })
    }
    router.push({ name: 'brands.index' })
  }
  finally {
    isSubmitting.value = false
  }
}

onBeforeUnmount(() => {
  brandStore.resetData()
  v$.value.$reset()
})

function removeImage() {
  brandStore.brandData.image = 'null'
}
</script>

<template>
  <BasePage>
    <Toast />
    <BasePageHeader :data="isEdit ? brandEditHeader(brandStore.brandData) : brandCreateHeader" />
    <Card v-if="!isFetching" class="w-full md:w-1/2 mt-6">
      <template #content>
        <form class="mt-18 text-left" @submit.prevent="onSubmit">
          <BaseInputGrid layout="column">
            <BaseInputGroup
              label="Image"
              required
            >
              <BaseDropZone key="cover" v-model="brandPhoto" :images="[brandStore.brandData.image]" class="!w-full" @remove="removeImage" />
            </BaseInputGroup>

            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Name"
              required
            >
              <InputText v-model="brandStore.brandData.name" :invalid="v$.name.$error" />
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
