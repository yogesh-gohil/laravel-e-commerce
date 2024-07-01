export const useBannerStore = defineStore({
  id: 'banner',

  state: () => ({
    banners: [],
    bannerData: {
      name: '',
      image: '',
      active: false,
      action_url: '',
      heading: '',
    },
  }),

  actions: {
    resetData() {
      this.bannerData = {
        name: '',
        image: '',
        active: false,
        action_url: '',
        heading: '',
      }
    },
    fetchBanners(params) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/banners', { params })
          .then((response) => {
            this.banners = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    fetchBanner(id) {
      return new Promise((resolve, reject) => {
        axios
          .get(`/api/banners/${id}`)
          .then((response) => {
            console.log('====================================')
            console.log(response.data.data)
            console.log('====================================')
            this.bannerData = response.data.data
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    addBanner(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm('/api/banners', data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    updateBanner(data) {
      return new Promise((resolve, reject) => {
        axios
          .postForm(`/api/banners/${data.id}`, data)
          .then((response) => {
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    deleteBanner(id) {
      return new Promise((resolve, reject) => {
        axios
          .delete(`/api/banners/${id}`)
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
