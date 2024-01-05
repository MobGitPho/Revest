<script setup>
  import icon_404 from '@/assets/images/404.svg'

  const router = useRouter()
  const { t } = useI18n()
</script>

<template>
  <div class="container">
    <section>
      <div class="text-center">
        <h2 style="color: dimgray">{{ t('pageNotFound') }}</h2>
        <div class="mt-10 mb-10">
          <img :src="icon_404" width="600" />
        </div>
        <el-button
          type="primary"
          size="medium"
          icon="el-icon-s-home"
          @click="router.push('/')">
          {{ t('backToHome') }}
        </el-button>
      </div>
    </section>
  </div>
</template>

<style scoped>
  .container {
    width: 90%;
    height: 100%;
    margin: 0 auto;
  }

  .container section {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
