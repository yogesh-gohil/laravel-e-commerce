<script setup>
const props = defineProps({
  multiple: {
    type: Boolean,
    default: false,
  },
  modelValue: {
    type: [Array, Object],
    default: () => [],
  },
  images: {
    type: Array,
    default: () => [],
  },
})
const emit = defineEmits(['onDrop', 'onChange', 'update:modelValue', 'remove'])
const { files, addFiles, removeFile, addLocalFile } = useFileList()
const uniqid = Date.now()
const active = ref(false)
let inActiveTimeout = null

const dropzoneClasses = computed(() => {
  const baseClasses = 'border border-dashed h-auto min-h-[150px] relative dark:border-gray-500'
  if (!props.multiple)
    return `${baseClasses} md:w-1/2 w-full`

  return baseClasses
})

const setActive = () => {
  active.value = true
  clearTimeout(inActiveTimeout)
}

const setInactive = () => {
  inActiveTimeout = setTimeout(() => {
    active.value = false
  }, 50)
}

const fileEmitValue = () => {
  if (props.multiple)
    return files.value
  else
    return files.value[0]
}

const onDrop = (e) => {
  setInactive()
  addFiles(e.dataTransfer.files, props.multiple)
  emit('onDrop', fileEmitValue())
  emit('update:modelValue', fileEmitValue())
}

const preventDefaults = (e) => {
  e.preventDefault()
}

const onInputChange = (e) => {
  addFiles(e.target.files, props.multiple)

  emit('onChange', fileEmitValue())
  emit('update:modelValue', fileEmitValue())
  e.target.value = null
}

const events = ['dragenter', 'dragover', 'dragleave', 'drop']

const emitRemove = (file) => {
  emit('remove', file)
  removeFile(file)
}

const setImages = () => {
  if (toRaw(props.images?.length)) {
    props.images.forEach((image) => {
      addLocalFile(image)
    })
  }
}

onMounted(() => {
  events.forEach((eventName) => {
    document.body.addEventListener(eventName, preventDefaults)
  })
  setImages()
})

onUnmounted(() => {
  events.forEach((eventName) => {
    document.body.removeEventListener(eventName, preventDefaults)
  })
})
</script>

<template>
  <div :class="dropzoneClasses" class="relative min-h-[150px] " :data-active="active" @dragenter.prevent="setActive" @dragover.prevent="setActive" @dragleave.prevent="setInactive" @drop.prevent="onDrop">
    <label :for="`file-input-${uniqid}`" class="cursor-pointer absolute inset-0 h-full" :class="!files.length ? 'hover:bg-gray-100 hover:dark:bg-gray-700 transition-all duration-500' : ''">
      <div v-if="!files.length" class="flex h-full justify-center items-center px-6">
        <span v-if="active">
          <span>Drop Them Here</span>
          <span class="smaller">to add them</span>
        </span>
        <span v-else>
          <span>Drag Your Files Here</span>
          <span class="smaller">
            or <strong><em>click here</em></strong> to select files
          </span>
        </span>
      </div>

      <input v-bind="$attrs" :id="`file-input-${uniqid}`" type="file" class="opacity-0 cursor-pointer hidden" :multiple="multiple" @change="onInputChange">
    </label>
    <ul v-if="files.length || images?.length" class="flex flex-wrap list-none" :class="!multiple ? 'justify-center items-center' : ''">
      <BaseFilePreview v-for="file of files" :key="file.id" :file="file" tag="li" @remove="emitRemove" />
    </ul>
  </div>
</template>
