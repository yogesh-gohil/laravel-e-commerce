import Maska from 'maska'
import { VTooltip } from 'v-tooltip'
import PrimeVue from 'primevue/config'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import './bootstrap'
import Ripple from 'primevue/ripple'
import ToastService from 'primevue/toastservice'

import StyleClass from 'primevue/styleclass'
import Lara from './presets/lara'
import App from '@/js/App.vue'
import router from '@/js/router'
import 'primeicons/primeicons.css'

import '../sass/app.scss'
import 'v-tooltip/dist/v-tooltip.css'
import '@vueform/multiselect/themes/default.css'

const app = createApp(App)

app.use(router)
app.use(Maska)
app.use(createPinia())
app.use(ToastService)
app.directive('tooltip', VTooltip)
app.directive('styleclass', StyleClass)
app.directive('ripple', Ripple)
app.use(PrimeVue, {
  unstyled: true,
  ripple: true,
  pt: Lara, // apply preset
})
app.mount('body')
