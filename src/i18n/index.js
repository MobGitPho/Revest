import { LANG_COOKIE } from '@/utils/constants'

import messages from '@intlify/unplugin-vue-i18n/messages'
import { createI18n } from 'vue-i18n'

export default createI18n({
  legacy: false,
  globalInjection: true,
  locale: localStorage.getItem(LANG_COOKIE),
  fallbackLocale: import.meta.env.VITE_I18N_FALLBACK_LOCALE || 'fr',
  messages,
})
