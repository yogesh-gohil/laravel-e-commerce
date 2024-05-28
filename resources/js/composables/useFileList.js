import { ref } from 'vue'

export function useFileList() {
  const files = ref([])

  const addFiles = (newFiles, multiple) => {
    const newUploadableFiles = [...newFiles].map(file => new UploadableFile(file)).filter(file => !fileExists(file.id))
    if (multiple)
      files.value = files.value.concat(newUploadableFiles)
    else
      files.value = newUploadableFiles
  }

  function fileExists(otherId) {
    return files.value.some(({ id }) => id === otherId)
  }

  function removeFile(file) {
    const index = files.value.indexOf(file)

    if (index > -1)
      files.value.splice(index, 1)
  }

  function addLocalFile(file) {
    if (file) {
      const data = { id: file.id ? file.id : null, url: file.original_url, name: file.name }
      files.value = files.value.concat(data)
    }
  }

  return { files, addFiles, removeFile, addLocalFile }
}

class UploadableFile {
  constructor(file) {
    this.file = file
    this.id = `${file.name}-${file.size}-${file.lastModified}-${file.type}`
    this.url = URL.createObjectURL(file)
    this.status = null
  }
}
