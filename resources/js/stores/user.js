import toastr from 'toastr'

export const useUserStore = defineStore({
  id: 'user',

  state: () => ({
    currentUser: null,
    isLoggedIn: false,
    loginData: {
      email: '',
      password: '',
    },
    registerData: {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    },
    isVisible: false,
  }),

  actions: {
    login(data) {
      return new Promise((resolve, reject) => {
        axios.get('/sanctum/csrf-cookie').then((response) => {
          if (response) {
            axios
              .post('/api/login', data)
              .then((response) => {
                toastr.success('Login successful')
                resolve(response)
              })
              .catch((err) => {
                reject(err)
              })
          }
        })
      })
    },
    logout(data) {
      console.log('logout')
      return new Promise((resolve, reject) => {
        axios
          .post('/logout', data)
          .then((response) => {
            toastr.success('Logout successful')
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    register(data) {
      return new Promise((resolve, reject) => {
        axios
          .post('/api/register', data)
          .then((response) => {
            toastr.success('Register successful')
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
    getAuthUser(data) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/user', data)
          .then((response) => {
            this.currentUser = response.data.data
            this.isLoggedIn = true
            resolve(response)
          })
          .catch((err) => {
            reject(err)
          })
      })
    },
  },
})
