<script setup>
  // section: BannerSupportSection

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
    <section class="support__banner bg__img clear__top" 
    :style="`background:url('/assets/images/support-bg.png')`">
        <div class="container">
            <div class="support__banner__area">
                <div class="support__banner__inner">
                    <h1 class="neutral-top">How can we help?</h1>
                    <div class="input input--secondary">
                        <input type="text" name="sear" id="sear_faq" placeholder="Search" />
                    </div>
                    <div class="faq__tab">
                        <a href="#start" class="faq__tab__btn faq__tab__btn__active">Getting Started</a>
                        <a href="#funds" class="faq__tab__btn">Adding Funds</a>
                        <a href="#investing" class="faq__tab__btn">Investing</a>
                        <a href="#security" class="faq__tab__btn">Security</a>
                        <a href="#taxes" class="faq__tab__btn">Taxes</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>