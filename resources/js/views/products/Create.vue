<script lang="ts" setup>
import Multiselect from '@vueform/multiselect'

import { useToast } from 'primevue/usetoast'
const route = useRoute()
const router = useRouter()
const productStore = useProductStore()
const categoryStore = useCategoryStore()
const isLoading = ref(false)
const isFetching = ref(false)
const { productCreateHeader } = usePageHeader()
const isEdit = computed (() => route.name === 'products.edit')
const coverPhoto = ref(null)
const otherPhotos = ref([])
const removedPhotos = ref([])
const toast = useToast()
const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Field is Required.', required),
    },
    description: {
      required: helpers.withMessage('Field is Required.', required),
    },
    category_id: {
      required: helpers.withMessage('Field is Required.', required),
    },
    price: {
      required: helpers.withMessage('Field is Required.', required),
    },
    sale_price: {
      required: helpers.withMessage('Field is Required.', required),
    },
    stock: {
      required: helpers.withMessage('Field is Required.', required),
    },
  }
})

const v$ = useVuelidate(
  rules,
  computed(() => productStore.currentProduct),
)

const fetchProduct = async () => {
  await productStore.fetchProduct(route.params.id)
}

const fetchInitialData = async () => {
  isFetching.value = true
  if (isEdit.value)
    await fetchProduct()

  await categoryStore.fetchCategories()
  isFetching.value = false
}

fetchInitialData()

const onSubmit = async () => {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true

  isLoading.value = true

  const data = {
    id: route.params.id,
    ...productStore.currentProduct,
    photos: otherPhotos.value.map(photo => photo.file ? photo.file : null).filter(p => p !== null),
    removed_photos: removedPhotos.value,
  }

  if (coverPhoto.value)
    data.cover_photo = coverPhoto.value?.file

  const action = isEdit.value
    ? productStore.updateProduct
    : productStore.addProduct

  try {
    isLoading.value = true
    const res = await action(data)
    if (res.data) {
      toast.add({
        severity: 'success',
        detail: isEdit.value ? 'Product updated successfully' : 'Product created successfully',
        life: 2000,
      })
    }

    router.push({ name: 'products.index' })
  }
  finally {
    isLoading.value = false
  }
}

onBeforeUnmount(() => {
  productStore.resetData()
  v$.value.$reset()
})

const removePhotos = (file: any) => {
  removedPhotos.value.push(file.id)
}

const removeCoverPhoto = () => {
  productStore.currentProduct.cover_photo = 'null'
}
</script>

<template>
  <BasePage>
    <BasePageHeader :data="productCreateHeader" />

    <Card v-if="!isFetching" class="w-full mt-6">
      <template #content>
        <form class="mb-1 text-left" @submit.prevent="onSubmit">
          <BaseInputGroup
            label="Product Cover"
            class="mb-6"
          >
            <BaseDropZone key="cover" v-model="coverPhoto" :images="[productStore.currentProduct.cover_photo]" @remove="removeCoverPhoto" />
          </BaseInputGroup>

          <BaseInputGrid>
            <BaseInputGroup
              :error="v$.name.$error && v$.name.$errors[0].$message"
              label="Name"
              required
            >
              <InputText v-model="productStore.currentProduct.name" :invalid="v$.name.$error" />
            </BaseInputGroup>
            <BaseInputGroup
              :error="v$.category_id.$error && v$.category_id.$errors[0].$message"
              label="Category"
              required
            >
              <Multiselect
                v-model="productStore.currentProduct.category_id"
                :options="categoryStore.categories"
                label="name"
                value-prop="id"
              />
            </BaseInputGroup>
          </BaseInputGrid>

          <BaseInputGroup
            :error="v$.description.$error && v$.description.$errors[0].$message"
            label="Description"
            class="my-6"
            required
          >
            <BaseEditor
              v-model="productStore.currentProduct.description"
            />
          </BaseInputGroup>
          <BaseInputGrid>
            <BaseInputGroup
              :error="v$.price.$error && v$.price.$errors[0].$message"
              label="Price"
              required
            >
              <InputNumber v-model="productStore.currentProduct.price" input-id="currency-us" mode="currency" currency="USD" locale="en-US" />
            </BaseInputGroup>
            <BaseInputGroup
              :error="v$.sale_price.$error && v$.sale_price.$errors[0].$message"
              label="Sale Price"
              required
            >
              <InputNumber v-model="productStore.currentProduct.sale_price" input-id="currency-us" mode="currency" currency="USD" locale="en-US" />
            </BaseInputGroup>
            <BaseInputGroup
              :error="v$.stock.$error && v$.stock.$errors[0].$message"
              label="Stock"
              required
            >
              <InputNumber v-model="productStore.currentProduct.stock" />
            </BaseInputGroup>
          </BaseInputGrid>
          <BaseDropZone key="photos" v-model="otherPhotos" multiple class="mt-6" :images="productStore.currentProduct.product_photos" @remove="removePhotos" />
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
