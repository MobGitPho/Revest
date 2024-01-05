<script setup>
  // section: BannerSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="banner__alt bg__img" 
    :style="`background:url('/assets/images/banner/banner-two-bg.png')`" >
        <div class="container">
            <div class="banner__alt__area">
                <h1 class="neutral-top neutral-bottom">{{t('Browse Properties')}}</h1>
            </div>
        </div>
    </section>
  </section>
</template>