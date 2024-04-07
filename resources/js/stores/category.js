export const useCategoryStore = defineStore({
  id: 'category',

  state: () => ({
    categories: [],
    categoryData: {
      name: '',
      image: '',
    },
  }),

  actions: {
    resetData() {
      this.categoryData = {
        name: '',
      }
    },
    fetchCategories(params) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/categories', { params })
          .then((response) => {
            this.categories = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    fetchCategory(id) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/api/categories/${id}`)
          .then((response) => {
            this.businessData = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    addCategory(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm('/api/categories', data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    updateCategory(data) {
      return new Promise((resolve, reject) => {
        axios
          .put(`/api/categories/${data.id}`, data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    deleteCategory(id) {
      return new Promise((resolve, reject) => {
        axios
          .delete(`/api/categories/${id}`)
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
