<script setup>
  // section: BannerContactSection

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
    <section class="support__banner contact__banner bg__img clear__top"
       :style="`background:url('/assets/images/contact-banner-bg.png')`">
        <div class="container">
            <div class="support__banner__area">
                <div class="support__banner__inner">
                    <h1 class="neutral-top">How can we help?</h1>
                    <h5 class="neutral-top">Got a question?</h5>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>