export function useFileUploader() {
  const uploadFiles = (files, url) => {
    return Promise.all(files.map(file => uploadFile(file, url)))
  }
  const uploadFile = async (file, url) => {
    // set up the request data
    const formData = new FormData()
    formData.append('file', file.file)

    // track status and upload file
    file.status = 'loading'
    const response = await fetch(url, { method: 'POST', body: formData })

    // change status to indicate the success of the upload request
    file.status = response.ok

    return response
  }
  const createUploader = (url) => {
    return {
      uploadFile(file) {
        return uploadFile(file, url)
      },
      uploadFiles(files) {
        return uploadFiles(files, url)
      },
    }
  }
  return {
    uploadFiles,
    uploadFile,
    createUploader,
  }
}
