export const useBrandStore = defineStore({
  id: 'brand',

  state: () => ({
    brands: [],
    brandData: {
      name: '',
      image: '',
    },
  }),

  actions: {
    resetData() {
      this.brandData = {
        name: '',
        image: '',
      }
    },
    fetchBrands(params) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/brands', { params })
          .then((response) => {
            this.brands = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    fetchBrand(id) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/api/brands/${id}`)
          .then((response) => {
            this.brandData = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    addBrand(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm('/api/brands', data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    updateBrand(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm(`/api/brands/${data.id}`, data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    deleteBrand(id) {
      return new Promise((resolve, reject) => {
        axios
          .delete(`/api/brands/${id}`)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
  },
})
