<script lang="ts" setup>
const userStore = useUserStore()

const router = useRouter()
const isLoading = ref(false)

const rules = {
  email: {
    required: helpers.withMessage('Field is Required', required),
    email: helpers.withMessage('Please Enter Valid Email', email),
  },
  password: {
    required: helpers.withMessage('Field is Required', required),
  },
}

const v$ = useVuelidate(
  rules,
  computed(() => userStore.loginData),
)

async function onSubmit() {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true

  isLoading.value = true

  try {
    userStore.login(userStore.loginData).then((res) => {
      if (res.data) {
        // userStore.isLoggedIn = true
        router.push({ name: 'dashboard' })
      }
    })
  }
  finally {
    isLoading.value = false
  }
}

onBeforeUnmount(() => {
  userStore.loginData.email = ''
  userStore.loginData.password = ''
  v$.value.$reset()
})
</script>

<template>
  <form id="loginForm" class="text-left mt-10" @submit.prevent="onSubmit">
    <BaseInputGroup
      :error="v$.email.$error && v$.email.$errors[0].$message"
      label="Email"
      class="mb-4"
      required
    >
      <InputText
        v-model="userStore.loginData.email"
        :invalid="v$.email.$error"
        focus
        type="email"
        name="email"
      />
    </BaseInputGroup>

    <BaseInputGroup
      :error="v$.password.$error && v$.password.$errors[0].$message"
      label="Password"
      class="mb-4"
      required
    >
      <InputText
        v-model="userStore.loginData.password"
        :invalid="v$.password.$error"
        type="password"
        name="password"
        @blur="v$.password.$touch()"
      />
    </BaseInputGroup>
    <div class="mt-5 mb-8">
      <div class="mb-4">
        <router-link
          to="register"
          class="text-sm text-primary-400 hover:text-gray-700"
        >
          Register
        </router-link>
      </div>
    </div>

    <Button :disabled="isLoading" type="submit" class="w-full flex justify-center items-center" :loading="isLoading">
      Login
    </Button>
  </form>
</template>
