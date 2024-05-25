import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import Components from 'unplugin-vue-components/vite'
import { PrimeVueResolver } from 'unplugin-vue-components/resolvers'
import AutoImport from 'unplugin-auto-import/vite'

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: ['resources/js/app.js'],
      refresh: true,
    }),
    // https://github.com/antfu/unplugin-auto-import
    AutoImport({
      imports: [
        'vue',
        'vue-router',
        // 'vue/macros',
        '@vueuse/head',
        '@vueuse/core',
        'pinia',
        {
          'axios': [['default', 'axios']],
          'dayjs': [['default', 'dayjs']],
          '@vuelidate/validators': [
            'required',
            'minLength',
            'url',
            'maxLength',
            'minValue',
            'helpers',
            'email',
            'sameAs',
            'requiredIf',
            'numeric',
            'between',
          ],
          '@vuelidate/core': ['useVuelidate'],
          '@vueform/multiselect': ['Multiselect'],
        },
      ],
      dts: 'resources/js/auto-imports.d.ts',
      dirs: ['resources/js/stores', 'resources/js/composables'],
      vueTemplate: true,
    }),
    // https://github.com/antfu/unplugin-vue-components
    Components({
      resolvers: [
        PrimeVueResolver(),
      ],
      // allow auto load markdown components under `./src/components/`
      dirs: ['resources/js/components'],
      extensions: ['vue'],
      // allow auto import and register components used in markdown
      include: [/\.vue$/, /\.vue\?vue/, /\.md$/],
      dts: 'resources/js/components.d.ts',

    }),
  ],
  resolve: {
    alias: {
      '@': '/resources',
    },
  },
})
