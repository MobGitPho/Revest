import { createApp } from 'vue'
import { createHead } from '@vueuse/head'

import BreezeUI from '@arkn/breeze-ui'

import App from './App.vue'

import { LANG_COOKIE } from './utils/constants'

import loadInitialData from './bootloader'
import getRouter from './router'
import pinia from './stores'
import i18n from './i18n'

async function launchApp() {
  await loadInitialData()

  document.documentElement.setAttribute(
    'lang',
    localStorage.getItem(LANG_COOKIE) || 'fr'
  )

  let router = getRouter()

  const app = createApp(App)
    .use(i18n)
    .use(pinia)
    .use(router)
    .use(BreezeUI)
    .use(createHead())

  router.isReady().then(() => {
    app.mount('#app')

    /* Hide preloader */
    document.getElementById('preloader').style.display = 'none'
  })
}

launchApp()
