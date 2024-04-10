export const useProductStore = defineStore({
  id: 'product',

  state: () => ({
    products: [],
    productData: {
      name: '',
      image: '',
    },
  }),

  actions: {
    resetData() {
      this.productData = {
        name: '',
      }
    },
    fetchProducts(params) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/products', { params })
          .then((response) => {
            this.products = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    fetchProduct(id) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/api/products/${id}`)
          .then((response) => {
            this.productData = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    addProduct(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm('/api/products', data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    updateProduct(data) {
      return new Promise((resolve, reject) => {
        axios
          .put(`/api/products/${data.id}`, data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    deleteProduct(id) {
      return new Promise((resolve, reject) => {
        axios
          .delete(`/api/products/${id}`)
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
