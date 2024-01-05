<script setup>
  import pinia from '@/stores'

  import { useSessionStore } from '@/stores/session'

  createHead()

  const route = useRoute()
  const { locale } = useI18n({ inheritLocale: true })

  const sessionStore = useSessionStore(pinia)

  /* Start user session */
  sessionStore.setLoadingSessionId()
  sessionStore.startSession()
</script>

<template>
  <router-view v-slot="{ Component }">
    <component :is="Component" :key="`${route.path}[${locale}]`" />
  </router-view>
</template>

<style src="@/assets/styles/app.css"></style>

<style scoped></style>
