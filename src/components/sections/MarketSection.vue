<script setup>
  // section: MarketSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('market_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <section class="market section__space over__hi">
        <div class="container">
            <div class="market__area">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-xl-5">
                        <div class="market__thumb thumb__rtl column__space">
                            <img :src="res(uniqueWidget?.image)" alt="Explore the Market" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="content">
                            <h5 class="neutral-top">{{tr(uniqueWidget?.subtitle)}}</h5>
                            <h2>{{tr(uniqueWidget?.title)}}</h2>
                            <p v-html="rHtml(uniqueWidget?.text)"/>
                            <a href="properties.html" class="button button--effect">Start Exploring</a>
                            <img :src="res(uniqueWidget?.image_arrow)" alt="Go to" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>