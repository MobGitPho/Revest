<script setup>
  // section: BannerContactSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res,rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('contact_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

</script>

<template>
  <section
    class="support__banner contact__banner bg__img clear__top"
    :style="
      uniqueWidget?.image
        ? `background:url(${res(uniqueWidget?.image)} )`
        : `background:url('/assets/images/contact-banner-bg.png' )`
    ">
    <div class="container">
      <div class="support__banner__area">
        <div class="support__banner__inner">
          <h1 v-if="tr(uniqueWidget?.title)"  class="neutral-top" > {{ tr(uniqueWidget?.title) }}</h1>
          <h5 v-if="tr(uniqueWidget?.subtitle)" class="neutral-top">{{ tr(uniqueWidget?.subtitle) }}</h5>
        </div>
      </div>
    </div>
  </section>
</template>
