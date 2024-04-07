<script lang="ts" setup>
// const route = useRoute();

const router = useRouter()
const userStore = useUserStore()
const isLoading = ref(false)
const passwordVal = computed(() => userStore.registerData.password)

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Field is Required.', required),
    },
    email: {
      required: helpers.withMessage('Field is Required.', required),
      email: helpers.withMessage('Please Enter valid email', email),
    },
    password: {
      required: helpers.withMessage('Field is Required.', required),
    },
    password_confirmation: {
      sameAsPassword: helpers.withMessage(
        'Confirm password must be same as password',
        sameAs(passwordVal),
      ),
    },
  }
})

const v$ = useVuelidate(
  rules,
  computed(() => userStore.registerData),
)

async function onSubmit() {
  v$.value.$touch()

  if (v$.value.$invalid)
    return true

  isLoading.value = true

  try {
    isLoading.value = true
    const res = await userStore.register(userStore.registerData)
    if (res.data)
      router.push({ name: 'dashboard' })
  }
  finally {
    isLoading.value = false
  }
}

onBeforeUnmount(() => {
  userStore.registerData.email = ''
  userStore.registerData.password = ''
  v$.value.$reset()
})
</script>

<template>
  <form class="mt-18 pb-10 text-left" @submit.prevent="onSubmit">
    <BaseInputGrid layout="column">
      <BaseInputGroup
        :error="v$.name.$error && v$.name.$errors[0].$message"
        label="Name"
        required
      >
        <InputText
          v-model="userStore.registerData.name"
          :invalid="v$.name.$error"
          focus
          type="text"
          name="name"
        />
      </BaseInputGroup>
      <BaseInputGroup
        :error="v$.email.$error && v$.email.$errors[0].$message"
        label="Email"
        required
      >
        <InputText
          v-model="userStore.registerData.email"
          :invalid="v$.email.$error"
          type="email"
          name="email"
        />
      </BaseInputGroup>

      <BaseInputGroup
        :error="v$.password.$error && v$.password.$errors[0].$message"
        label="Password"
        required
      >
        <InputText
          v-model="userStore.registerData.password"
          :invalid="v$.password.$error"
          type="password"
          name="password"
          @blur="v$.password.$touch()"
        />
      </BaseInputGroup>
      <BaseInputGroup
        label="Confirm Password"
        required
        :error="
          v$.password_confirmation.$error
            && v$.password_confirmation.$errors[0].$message
        "
      >
        <InputText
          v-model="userStore.registerData.password_confirmation"
          :invalid="v$.password_confirmation.$error"
          type="password"
          name="password"
          @blur="v$.password_confirmation.$touch()"
        />
      </BaseInputGroup>
    </BaseInputGrid>
    <Button
      :disabled="isLoading"
      :loading="isLoading"
      type="submit"
      class="w-full flex justify-center items-center mt-8"
    >
      Register
    </Button>
    <p class="dark:text-white text-center pt-4">
      Already have an account ?
      <router-link
        to="login"
        class="text-sm text-primary-400 hover:text-gray-700"
      >
        Login
      </router-link>
    </p>
  </form>
</template>
