import { productStub } from '../../js/stub/product'

export const useProductStore = defineStore({
  id: 'product',

  state: () => ({
    products: [],
    currentProduct: {
      ...productStub.currentProduct,
    },
  }),

  actions: {
    resetData() {
      this.currentProduct = {
        ...productStub.currentProduct,
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
            this.currentProduct = response.data.data
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
      data._method = 'PUT'
      return new Promise((resolve, reject) => {
        axios
          .postForm(`/api/products/${data.id}`, data)
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
