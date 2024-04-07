
<template>
  <div
    class="grid h-screen grid-cols-12 overflow-y-auto bg-gray-100 dark:bg-gray-900"
  >
    <div
      class="flex items-start md:items-center w-full max-w-md col-span-12 p-4 mx-auto text-gray-900 md:p-8 md:col-span-6 lg:col-span-4 flex-2 pt-20 relative"
    >
      <div class="w-full">
        <h1 class="text-center font-medium text-xl">MY APP</h1>
        <router-view />

        <div
          class="absolute text-sm not-italic font-medium leading-relaxed text-center text-gray-400 bottom-0 w-full left-0"
        >
          <p class="mb-3 flex items-center justify-center mt-4">
            {{ new Date().getFullYear() }}
          </p>
        </div>
      </div>
    </div>
    <div
      class="relative flex-col items-center justify-center hidden w-full h-full pl-10 bg-no-repeat bg-cover md:col-span-6 lg:col-span-8 md:flex content-box overflow-hidden"
    >
      <div class="absolute h-full w-full bg-primary-400" />

      <div class="md:pl-10 xl:pl-0 relative z-10 -mt-32">
        <h1
          class="hidden mb-3 text-5xl leading-normal text-left text-white xl:text-6xl xl:leading-tight md:none lg:block font-semibold"
        >
          Welcome to My App
        </h1>
        <p
          class="hidden text-sm not-italic font-normal leading-normal text-left text-gray-100 xl:text-lg xl:leading-6 md:none lg:block"
        >
          Lorem ipsum dolor sit amet.
        </p>
      </div>
    </div>
  </div>
</template>
