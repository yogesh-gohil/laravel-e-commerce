<script lang="ts" setup>
import { useToast } from 'primevue/usetoast'

const route = useRoute()
const router = useRouter()
const bannerStore = useBannerStore()
const isSubmitting = ref(false)
const isFetching = ref(false)
const bannerImage = ref<File | null>()
const toast = useToast()
const { bannerCreateHeader, bannerEditHeader } = usePageHeader()

const isEdit = computed (() => route.name === 'banners.edit')

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Field is Required.', required),
    },
  }
})

const v$ = useVuelidate(
  rules,
  computed(() => bannerStore.bannerData),
)

if (isEdit.value)
  fetchBanner()

async function fetchBanner() {
  isFetching.value = true
  await bannerStore.fetchBanner(route.params.id)
  isFetching.value = false
}

async function onSubmit() {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true
  isSubmitting.value = true

  const data = {
    id: route.params.id,
    ...bannerStore.bannerData,
  }

  if (data.image !== 'null')
    delete data.image

  if (bannerImage.value)
    data.image = bannerImage.value.file

  if (isEdit.value)
    data._method = 'PUT'
  const action = isEdit.value
    ? bannerStore.updateBanner
    : bannerStore.addBanner

  try {
    isSubmitting.value = true
    const res = await action(data)
    if (res.data) {
      toast.add({
        severity: 'success',
        detail: isEdit.value ? 'Banner updated successfully' : 'Banner created successfully',
        life: 2000,
      })
    }
    router.push({ name: 'banners.index' })
  }
  finally {
    isSubmitting.value = false
  }
}

onBeforeUnmount(() => {
  bannerStore.resetData()
  v$.value.$reset()
})

function removeImage() {
  bannerStore.bannerData.image = 'null'
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="isEdit ? bannerEditHeader(bannerStore.bannerData) : bannerCreateHeader" />
    <Card v-if="!isFetching" class="w-full md:w-1/2 mt-6">
      <template #content>
        <form class="mt-18 text-left" @submit.prevent="onSubmit">
          <BaseInputGrid layout="column">
            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Image"
              required
            >
              <BaseDropZone key="cover" v-model="bannerImage" :images="[bannerStore.bannerData.banner]" class="!w-full" @remove="removeImage" />
            </BaseInputGroup>

            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Name"
              required
            >
              <InputText v-model="bannerStore.bannerData.name" :invalid="v$.name.$error" />
            </BaseInputGroup>
            <BaseInputGroup
              label="Heading"
            >
              <BaseEditor
                v-model="bannerStore.bannerData.heading"
              />
            </BaseInputGroup>
            <BaseInputGroup
              label="Action URL"
            >
              <InputText
                v-model="bannerStore.bannerData.action_url"
              />
            </BaseInputGroup>
            <BaseInputGroup
              label="Active"
            >
              <InputSwitch v-model="bannerStore.bannerData.active" />
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
    <Toast />
  </BasePage>
</template>
